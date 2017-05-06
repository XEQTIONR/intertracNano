<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lc extends Model
{
    //

    public $primaryKey = 'lc_num';
    protected $casts = ['lc_num' => 'string'];
}
?>
