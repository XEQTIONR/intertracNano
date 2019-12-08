<?php

namespace App\Http\Controllers;

use App\Tyre;
use Illuminate\Http\Request;

class WasteController extends Controller
{
    //

  public function test(){
    $order = resolve('TyresRemainingInContainers')->where("in_stock", ">", 0)->values();
    $tyres = Tyre::all();

    foreach($order as $o)
      $o->tyre = $tyres->where('tyre_id', $o->tyre_id)->first();
    //return $order;
    $ret = $order->groupBy('BOL');

    $remain = collect();

    foreach($ret as $key => $val){
      $array = array( $key => $val->groupBy('Container_num') );
      $remain->push($array);
    }

   //return $remain;

    return view('waste', compact('remain'));
  }

}
