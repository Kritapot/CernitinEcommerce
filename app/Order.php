<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct', 'order_id');
    }
}
