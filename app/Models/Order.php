<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['customer_id', 'order_date', 'use_pickup', 'use_delivery', 'pickup_date', 'delivery_date', 'subtotal', 'shipping_fee', 'discount', 'total', 'pay_method', 'paymenr_url', 'status', 'filled_by', 'created_at', 'updated_at'];
}
