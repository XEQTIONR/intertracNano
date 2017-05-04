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
        $lc->id = $request->inputLCnum;
        $lc->LC_dateissued = $request->inputDateIssue;
        $lc->LC_dateexpiry = $request->inputDateExpiry;
        $lc->LC_applicant = $request->inputApplicant;
        $lc->LC_beneficiary = $request->inputBeneficiary;
        $lc->LC_currencycode = $request->inputCurrencyCode;
        $lc->LC_foreignamount = $request->inputValue;
        $lc->LC_foreignexpense = $request->inputForeignExpense;
        $lc->LC_domesticexpense = $request->inputLocalExpense;
        $lc->LC_exchangerate = $request->inputExchangeRate;
        $lc->LC_portdepart = $request->inputPortDepart;
        $lc->LC_portarrive = $request->inputPortArrive;
        $lc->LC_invoice= $request->inputInvoice;

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
