<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
//use Illuminate\Support\Collection;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        $customers = Customer::all();

        return view('customers',['customers'=>$customers]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

          return view('new_customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ALLOCATE
        $customer = new Customer;


        //INITIAZE
        $customer->name = $request->inputName;
        $customer->address = $request->inputAddress;
        $customer->phone = $request->inputPhone;
        $customer->notes = $request->inputNotes;

        //STORE
        $customer->save();

        return redirect('/customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
        $payments = collect();  //Empty collection
        $orders = $customer->orders()
                          ->get();



        foreach ($orders as $order)
        {
          $some_payments = $order->payment()->get();
          $payments = $payments->union($some_payments);
        }

        return view('profiles.customer', compact('customer', 'orders', 'payments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
