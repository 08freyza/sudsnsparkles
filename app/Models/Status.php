<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public static function buttonColorStatus()
    {
        return
            [
                'wait_confirmation' => 'secondary',
                'picking_up' => 'dark',
                'in_progress' => 'primary',
                'on_shipping' => 'info',
                'unpaid' => 'warning',
                'done' => 'success',
                'cancelled' => 'danger',
            ];
    }

    public static function buttonTextStatus()
    {
        return
            [
                'wait_confirmation' => 'accept_now!',
                'picking_up' => 'picked_up!',
                'in_progress' => 'progress_done!',
                'on_shipping' => 'shipped!',
                'unpaid' => 'pay_now!',
                'done' => '',
                'cancelled' => 'delete_now!',
            ];
    }
}
