<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consignment extends Model
{
    //
    public $primaryKey = 'BOL';
    protected $casts = ['BOL' => 'string'];
}
