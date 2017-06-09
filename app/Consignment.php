<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consignment extends Model
{
    //
    public $primaryKey = 'BOL';
    public $incrementing = false;
    //protected $casts = ['BOL' => 'string']; // laravel 5.0

    public function lc()
    {
      return $this->belongsTo('App\Lc', 'lc');
    }

    public function containers()
    {
      return $this->hasMany('App\Consignment_container','BOL');
    }

    public function expenses()
    {
      return $this->hasMany('App\Consignment_expense','BOL');
    }
}
