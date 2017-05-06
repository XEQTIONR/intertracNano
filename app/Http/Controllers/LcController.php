<?php

namespace App\Http\Controllers;

use App\Lc;
use Illuminate\Http\Request;

class LcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $LCs = Lc::all();

        return view('lcs', compact('LCs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new_lc');
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
        $lc = new Lc;

        //INITIALIZE
        $lc->lc_num = $request->inputLCnum; //LC#
        $lc->date_issued = $request->inputDateIssue;
        $lc->date_expiry = $request->inputDateExpiry;
        $lc->applicant = $request->inputApplicant;
        $lc->beneficiary = $request->inputBeneficiary;
        $lc->port_depart = $request->inputPortDepart;
        $lc->port_arrive = $request->inputPortArrive;
        $lc->invoice_no= $request->inputInvoice;
        $lc->currency_code = $request->inputCurrencyCode;
        $lc->foreign_amount = $request->inputValue;
        $lc->foreign_expense = $request->inputForeignExpense;
        $lc->domestic_expense = $request->inputLocalExpense;
        $lc->exchange_rate = $request->inputExchangeRate;



        //STORE
        $lc->save();

        return redirect('/lcs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lc  $lc
     * @return \Illuminate\Http\Response
     */
    public function show(Lc $lc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lc  $lc
     * @return \Illuminate\Http\Response
     */
    public function edit(Lc $lc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lc  $lc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lc $lc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lc  $lc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lc $lc)
    {
        //
    }
}
