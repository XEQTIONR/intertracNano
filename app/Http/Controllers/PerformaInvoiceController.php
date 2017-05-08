<?php

namespace App\Http\Controllers;

use App\Performa_invoice;
use Illuminate\Http\Request;

class PerformaInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $invoiceRecords = Performa_invoice::all();
        return view('perform_invoices', compact('invoiceRecords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('new_performa_invoice');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //THIS MIGHT NOT WORK BECAUSE OF COMPOSITE PRIMIARY KEY
        /*$invoiceRecord =  new Performa_invoice;
        $invoiceRecord->lc_num = $request->inputLC;
        $invoiceRecord->tyre_id = $request->inputTyreId;
        $invoiceRecord->qty = $request->inputQty;
        $invoiceRecord->unit_price = $request->inputUnitPrice;

        $invoiceRecord->save();

        return redirect('/perform_invoices');*/

        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Performa_invoice  $performa_invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Performa_invoice $performa_invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Performa_invoice  $performa_invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Performa_invoice $performa_invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Performa_invoice  $performa_invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Performa_invoice $performa_invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Performa_invoice  $performa_invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Performa_invoice $performa_invoice)
    {
        //
    }
}
