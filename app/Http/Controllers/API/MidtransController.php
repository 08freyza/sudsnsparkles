<?php

namespace App\Http\Controllers\API;

use Midtrans\Config;
use App\Models\Order;
use Midtrans\Notification;
use App\Http\Controllers\Controller;

class MidtransController extends Controller
{
    public function callback()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        $notification = new Notification();

        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $order_id = $notification->order_id;
        $fraud = $notification->fraud_status;

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $order = Order::find($order_id);
                    $order->update(['status' => 'payment_pending']);
                } else {
                    $order = Order::find($order_id);
                    $order->update(['status' => 'done']);
                }
            }
        } else if ($transaction == 'settlement') {
            $order = Order::find($order_id);
            $order->update(['status' => 'done']);
        } else if ($transaction == 'pending') {
            $order = Order::find($order_id);
            $order->update(['status' => 'payment_pending']);
        } else if ($transaction == 'deny') {
            $order = Order::find($order_id);
            $order->update(['status' => 'unpaid']);
        } else if ($transaction == 'expire') {
            $order = Order::find($order_id);
            $order->update(['status' => 'unpaid']);
        } else if ($transaction == 'cancel') {
            $order = Order::find($order_id);
            $order->update(['status' => 'unpaid']);
        }
    }
}
