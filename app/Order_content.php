<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_content extends Model
{
    //

  public function tyre()
  {
    return $this->belongsTo('App\Tyre', 'tyre_id');
  }
}
