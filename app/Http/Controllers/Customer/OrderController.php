<?php

namespace App\Http\Controllers\Customer;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Service;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getOrder = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select('orders.*', 'customers.name AS cust_name')
            ->where('customers.username', session('username'))
            ->orderBy('orders.order_id', 'desc')
            ->get();

        $data = [
            'title' => 'Order',
            'order' => $getOrder
        ];

        return view('orders.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getCustomer = Customer::where('username', session('username'))->get();
        $getIdCustomer = Customer::where('username', session('username'))->first()['id'];
        $lengthDataOrder = Order::where('customer_id', $getIdCustomer)->where('status', 'done')->where('filled_by', session('username'))->count();
        $getService = Service::all();

        $data = [
            'title' => 'Create Order',
            'customers' => $getCustomer,
            'services' => $getService,
            'length' => intval($lengthDataOrder) ?? 0,
        ];

        return view('orders.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $spaceOrderDetails = [];

        $dataForOrder = $request->except(['service_id', 'quantity', 'subtotal', '_token']);
        $dataForOrderDetail = $request->only(['service_id', 'quantity', 'subtotal']);
        $getFilledBy = $request->only(['filled_by']);

        $dataForOrder['subtotal'] = $dataForOrder['subtotal_order'];
        $dataForOrder['status'] = 'wait_confirmation';
        $dataForOrder['order_date'] = date('Y-m-d H:i:s');

        unset($dataForOrder['subtotal_order']);

        if (Order::create($dataForOrder)) {
            $getOrder = Order::where('filled_by', $getFilledBy)->orderBy('order_date', 'DESC')->first();

            for ($i = 0; $i < count($dataForOrderDetail['service_id']); $i++) {
                $spaceOrderDetails[$i] = [
                    'order_id' => $getOrder['order_id'],
                    'service_id' => $dataForOrderDetail['service_id'][$i],
                    'quantity' => $dataForOrderDetail['quantity'][$i],
                    'subtotal' => $dataForOrderDetail['subtotal'][$i],
                ];
            }

            if (OrderDetail::insert($spaceOrderDetails)) {
                return redirect('order')->with('message', 'orderCreateSuccess');
            }

            Order::where('order_id', $getOrder['order_id'])->delete();
            return redirect('order')->with('message', 'orderDetailsCreateFailed');
        }

        return redirect('order')->with('message', 'orderCreateFailed');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getOrder = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select('orders.*', 'customers.name AS cust_name', 'customers.address AS cust_address', 'customers.email AS cust_email')
            ->where('orders.order_id', $id)
            ->where('customers.username', session('username'))
            ->first();

        $getOrderDetail = OrderDetail::join('services', 'order_details.service_id', '=', 'services.service_id')
            ->select('order_details.*', 'services.name AS serv_name', 'services.price AS serv_price', 'services.unit AS serv_unit')
            ->where('order_details.order_id', $id)
            ->get();

        $data = [
            'title' => 'Detail Order',
            'order' => $getOrder,
            'orderDetail' => $getOrderDetail
        ];

        if ($getOrder['status'] == 'unpaid' && $getOrder['pay_method'] == 'non_cash') {
            // Midtrans configuration
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            // Make midtrans transaction
            $midtrans = [
                'transaction_details' => [
                    'order_id' => $getOrder['order_id'],
                    'gross_amount' => (int) $getOrder['total']
                ],
                'customer_details' => [
                    'first_name' => $getOrder['cust_name'],
                    'email' => $getOrder['cust_email'],
                    'address' => $getOrder['cust_address'],
                ],
            ];

            $snapToken = Snap::getSnapToken($midtrans);

            $data['snap_token'] = $snapToken;
        }

        return view('orders.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $getDataPartOne = $request->only(['status', 'use_pickup', 'use_delivery']);
        $getDataPartTwo = $request->only(['pay_method', 'payment_cash', 'total']);

        if ($getDataPartTwo['pay_method'] == 'cash' && $getDataPartOne['status'] == 'unpaid') {
            $changeCalc = intval($getDataPartTwo['payment_cash']) - intval($getDataPartTwo['total']);
            $getChange = 'Rp. ' . number_format($changeCalc, 0, ',', '.');

            if (intval($getDataPartTwo['payment_cash']) < intval($getDataPartTwo['total']) || $getDataPartTwo['payment_cash'] == '') {
                return redirect('admin/order/' . $id)->with('message', 'orderUpdatePayCashFailed');
            }
        }

        switch ($getDataPartOne['status']) {
            case "wait_confirmation":
                $updateTo = $getDataPartOne['use_pickup'] == 'Y' ? 'picking_up' : 'in_progress';
                break;
            case "picking_up":
                $updateTo = 'in_progress';
                break;
            case "in_progress":
                $updateTo = $getDataPartOne['use_delivery'] == 'Y' ? 'on_shipping' : 'unpaid';
                break;
            case "on_shipping":
                $updateTo = 'unpaid';
                break;
            default:
                $updateTo = 'done';
        }

        $data = [
            'status' => $updateTo,
        ];

        if ($getDataPartOne['status'] == 'picking_up') {
            $data['pickup_date'] = strval(date('Y-m-d H:i:s'));
        } else if ($getDataPartOne['status'] == 'on_shipping') {
            $data['delivery_date'] = strval(date('Y-m-d H:i:s'));
        }

        if (Order::where('order_id', $id)->update($data)) {
            if ($getDataPartOne['status'] == 'unpaid' && $getDataPartTwo['pay_method'] == 'cash') {
                return redirect('admin/order')->with('message', 'orderUpdateSuccessSpecial')->with('additionalmessage', $getChange);
            }
            return redirect('order')->with('message', 'orderUpdateSuccess');
        }

        return redirect('order')->with('message', 'orderUpdateFailed');
    }

    /**
     * Update to cancel order.
     */
    public function cancel($id)
    {
        if (Order::where('order_id', $id)->update(['status' => 'cancelled'])) {
            return redirect('order')->with('message', 'orderCancelSuccess');
        }

        return redirect('order')->with('message', 'orderCancelFailed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get Info customer for calculating shipping fee.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function getInfoCustomer(Request $request, $id)
    {
        $getDataAdmin = Admin::select('name', 'address', 'latitude', 'longitude')->first();
        $getDataCustomer = Customer::select('name', 'address', 'latitude', 'longitude')->where('id', $id)->first();

        if ($getDataCustomer && $getDataAdmin) {
            if (isset($getDataCustomer['latitude'])) {
                return response()->json([
                    'success' => 'getInfoSuccess',
                    'destination' => $getDataCustomer,
                    'origin' => $getDataAdmin,
                    // shipping fee
                    'feePerKilo' => 2500
                ]);
            }

            return response()->json(['failed' => 'latlngNotSet']);
        }

        return response()->json(['failed' => 'getInfoFailed']);
    }
}
