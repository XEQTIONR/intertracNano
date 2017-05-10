<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $primaryKey = 'Order_num';


    public function payment()
    {
      return $this->hasMany('App\Payment','Order_num');
    }
}
