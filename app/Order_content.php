<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_content extends Model
{
    //

  protected $primaryKey = null;
  public $incrementing = false;

  public function tyre()
  {
    return $this->belongsTo('App\Tyre', 'tyre_id');
  }
}
