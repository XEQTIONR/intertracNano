<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();

        return view('payments', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('new_payment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $validator=Validator::make($request->all(),[
        'inputOrderNum' => 'required|numeric',
        'inputPaidAmount' => 'required|numeric|min:0',
      ]);

      if ($validator->fails()) {
        return redirect('payments/create')
                ->withErrors($validator)
                ->withInput();
      }
      else
      {
        //ALLOCATE
        $payment = new Payment;

        //INITIALIZE
        $payment->Order_num = $request->inputOrderNum;
        $payment->payment_amount = $request->inputPaidAmount;

        //STORE
        $payment->save();

        //REDIRECT
        return redirect('/payments');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
