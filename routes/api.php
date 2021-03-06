<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('api')
      ->name('api.')
      ->middleware('auth')
      ->group(function(){

          Route::post('/lcs/check', 'LcController@checkLCNumber')->name('lcs.check');
          Route::post('/customers', 'CustomerController@apiShow')->name('customers');
          Route::post('/customer-update', 'CustomerController@apiUpdate')->name('customers.update');

});


