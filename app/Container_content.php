<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Container_content extends Model
{
    //

  public function tyre()
  {
    return $this->belongsTo('App\Tyre', 'tyre_id');
  }
}
