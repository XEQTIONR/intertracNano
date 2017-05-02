<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', 'WelcomeController@show');

Route::get('test', 'WelcomeController@show');

Route::resource('tyres','TyreController');

Route::resource('lcs','LcController');

Route::resource('customers','CustomerController');

Route::get('title', function()
{
  return view('title');
});

Route::get('/', 'WelcomeController@show');

Route::get('layout', function()
{
  return view('layout');
});
