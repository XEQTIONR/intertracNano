<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Validator;
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

        //VALIDATE

        $validator=Validator::make($request->all(),[
          'Name' => 'required|string',
          'Address' => 'required|string',
          'Phone' => 'required|numeric|digits_between:7,12',
          'Notes' => 'string|nullable',
        ]);

        if($validator->fails())
        {
          return redirect('customers/create')
                  ->withErrors($validator)
                  ->withInput();
        }
        //ALLOCATE
        $customer = new Customer;


        //INITIAZE
        $customer->name = $request->Name;
        $customer->address = $request->Address;
        $customer->phone = $request->Phone;
        $customer->notes = $request->Notes;

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
          //$payments = $payments->union($some_payments); //WHY DOES THIS NOT WORK??

          foreach ($some_payments as $payment)
          {
            $payments->push($payment);
          }
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

        $customer->name = $request->inputCustomerName;
        $customer->address = $request->inputAddress;
        $customer->phone = $request->inputPhone;
        $customer->notes = $request->inputNotes;

        $customer->save();


        return redirect ("/customers/".$customer->id);
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
