<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiscController extends Controller
{
    //

    public function welcome()
    {
      return view('welcome', ['now' => \Carbon\Carbon::now()]);
    }
}
