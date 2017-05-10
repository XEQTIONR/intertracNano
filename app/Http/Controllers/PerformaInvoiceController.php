<?php

namespace App\Http\Controllers;

use App\Performa_invoice;
use App\Lc;
use Illuminate\Http\Request;

//$invoiceRecord;
//$i;

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
        //return view('performa_invoices', compact('invoiceRecords'));
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
        //$index = 0;
        //$itemId = "tyre" + $index;
        //$qty = "qty" + $index;
        //$price = "price" + $index;
        //$invoiceRecord;
        global $invoiceRecord, $i;
        $lc = Lc::find($request->inputLC);
        echo $request->inputLC;


        for ($i=0; $i<$request->numItems; $i++)
        {

          $invoiceRecord[$i] = new Performa_invoice;

          //$invoiceRecord[$i]->lc_num = $request->inputLC;
          $invoiceRecord[$i]->tyre_id = $request->tyre[$i];
          $invoiceRecord[$i]->qty = $request->qty[$i];
          $invoiceRecord[$i]->unit_price = $request->price[$i];
        }

        if(is_null($invoiceRecord))
        {
          //return redirect('/tyres');
          echo "this is null";
          //echo $invoiceRecord[0];
        }
        else
        {
          $lc->performaInvoice()->saveMany($invoiceRecord);
          return redirect('/performa_invoices/create');
          //echo 'echoing $invoiceRecord fails';
          //echo $invoiceRecord;
        }
        //THIS MIGHT NOT WORK BECAUSE OF COMPOSITE PRIMIARY KEY
        /*$invoiceRecord =  new Performa_invoice;
        $invoiceRecord->lc_num = $request->inputLC;
        $invoiceRecord->tyre_id = $request->inputTyreId;
        $invoiceRecord->qty = $request->inputQty;
        $invoiceRecord->unit_price = $request->inputUnitPrice;

        $invoiceRecord->save();

        return redirect('/perform_invoices');*/

        //return redirect('/performa_invoices/create');
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
