<?php

namespace App\Http\Controllers\Customer;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $getUsername = session('username');
        $getOrder = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select('orders.*', 'customers.name AS cust_name')
            ->where('customers.username', $getUsername);

        $numberGetOrderDone = $getOrder->where('orders.status', 'done')->count(); //total order
        $totalGetOrderDone = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select('orders.*', 'customers.name AS cust_name')
            ->where('customers.username', $getUsername)
            ->where('orders.status', 'done')->sum('orders.total'); //total expense
        $getOrderCancel = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select('orders.*', 'customers.name AS cust_name')
            ->where('customers.username', $getUsername)
            ->where('orders.status', 'cancelled')->count(); //order cancel
        $numberGetOrderViaUser = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select('orders.*', 'customers.name AS cust_name')
            ->where('customers.username', $getUsername)
            ->where('orders.status', 'done')
            ->where('filled_by', $getUsername)->count(); // get coupon

        $getAllOrder = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select('orders.*', 'customers.name AS cust_name')
            ->where('customers.username', $getUsername)
            ->orderBy('orders.order_id', 'desc')->paginate(5);

        $data = [
            'title' => 'Dashboard',
            'num_getorderdone' => $numberGetOrderDone ?? 0,
            'total_getorderdone' => $totalGetOrderDone ?? 0,
            'getordercancel' => $getOrderCancel ?? 0,
            'num_getorderdone_user' => intval($numberGetOrderViaUser) % 5 ?? 0,
            'order' => $getAllOrder
        ];

        return view('dashboard', $data);
    }
}
