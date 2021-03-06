<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consignment_container extends Model
{
    //in DB primary key is [Container_num, BOL]
    public $primaryKey = 'Container_num';
    //protected $casts = ['Container_num' => 'string'];
    public $incrementing = false;
    
    public function contents()
    {
      return $this->hasMany('App\Container_content','Container_num');
    }
}
