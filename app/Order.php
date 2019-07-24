<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct', 'order_id');
    }

    /**
     * CountPendingOrders function
     *
     * @return int
     */
    public static function countPending()
    {
        $countPending       =   Order::where('order_status', '!=', 'Deliveried')->count();

        return $countPending;
    }
}
