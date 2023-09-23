<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $monthNow = date('n');

        // Total order per month
        $totalOrderPerMonth = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select('orders.*', 'customers.name AS cust_name', DB::raw('MONTH(orders.order_date)'))
            ->where(DB::raw('MONTH(orders.order_date)'), intval($monthNow))
            ->where('status', 'done')
            ->count();

        // Total income per month
        $totalIncomePerMonth = Order::where(DB::raw('MONTH(order_date)'), intval($monthNow))
            ->where('status', 'done')
            ->sum('total');

        // Total users
        $totalUsers = Customer::count();

        // Loyal customer
        $loyalCustomers = Order::select('customer_id', DB::raw('count(*) as num_of_order'))
            ->where('status', 'done')
            ->groupBy('customer_id')
            ->having('num_of_order', '>=', 10)
            ->count();

        // Get All Order for Table
        $getAllOrder = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select('orders.*', 'customers.name AS cust_name')
            ->orderBy('orders.order_id', 'desc')->paginate(5);

        // Gender Comparison
        $getGenderMale = Customer::where('gender', 'male')->count();
        $getGenderFemale = Customer::where('gender', 'female')->count();

        // Get Income per Month
        $arrIncomePerMonthMale = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $arrIncomePerMonthFemale = $arrIncomePerMonthMale;
        $getIncomePerMonthMale = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select(DB::raw('extract(MONTH from order_date) AS month'), DB::raw('sum(total) AS total_income'))
            ->where(DB::raw('year(order_date)'), date('Y'))
            ->where('customers.gender', 'male')
            ->where('orders.status', 'done')
            ->groupBy(DB::raw('month'))
            ->orderBy(DB::raw('month'), 'asc')
            ->get();
        $getIncomePerMonthFemale = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select(DB::raw('extract(MONTH from order_date) AS month'), DB::raw('sum(total) AS total_income'))
            ->where(DB::raw('year(order_date)'), date('Y'))
            ->where('customers.gender', 'female')
            ->where('orders.status', 'done')
            ->groupBy(DB::raw('month'))
            ->orderBy(DB::raw('month'), 'asc')
            ->get();

        foreach ($getIncomePerMonthMale as $incomePerMonthMale) {
            $arrIncomePerMonthMale[$incomePerMonthMale['month'] - 1] = intval($incomePerMonthMale['total_income']) / 1000;
        }

        foreach ($getIncomePerMonthFemale as $incomePerMonthFemale) {
            $arrIncomePerMonthFemale[$incomePerMonthFemale['month'] - 1] = intval($incomePerMonthFemale['total_income']) / 1000;
        }

        // Order per Month
        $arrOrderPerMonth = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $orderPerMonthData = Order::select(DB::raw('extract(MONTH from order_date) AS month'), DB::raw('count(*) as num_of_order'))
            ->where(DB::raw('year(order_date)'), date('Y'))
            ->where('status', 'done')
            ->groupBy(DB::raw('month'))
            ->orderBy(DB::raw('month'), 'asc')
            ->get();

        foreach ($orderPerMonthData as $eachOrderPerMonthData) {
            $arrOrderPerMonth[$eachOrderPerMonthData['month'] - 1] = intval($eachOrderPerMonthData['num_of_order']);
        }

        $data = [
            'title' => 'Dashboard',
            'total_orderpermonth' => $totalOrderPerMonth ?? 0,
            'total_incomepermonth' => $totalIncomePerMonth ?? 0,
            'total_users' => $totalUsers ?? 0,
            'loyal_customers' => $loyalCustomers ?? 0,
            'order' => $getAllOrder,
            'gender_comparison' => [$getGenderMale, $getGenderFemale],
            'income_per_month_data' => json_encode([$arrIncomePerMonthMale, $arrIncomePerMonthFemale]),
            'order_per_month_data' => json_encode($arrOrderPerMonth)
        ];

        return view('admin.dashboard', $data);
    }
}
