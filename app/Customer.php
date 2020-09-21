<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //

    public function orders()
    {
      return $this->hasMany('App\Order', 'customer_id');
    }

    public function payments()
    {
      return $this->hasManyThrough('App\Payment', 'App\Order', 'customer_id', 'Order_num');
    }

}
