<?php

namespace App\Http\Controllers;

use App\Tyre;
use App\Lc;
use App\Performa_invoice;
use Illuminate\Http\Request;
use Validator;

class LcController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('admin');
    }
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
        $tyres = Tyre::all();
        return view('new_lc', compact('tyres'));
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
          'LcNumber' => 'required|numeric|digits:12',
          'DateIssued' => 'required|date',
          'DateExpiry' => 'required|date|after:DateIssued',
          'Applicant' => 'required|string',
          'Beneficiary' => 'required|string',
          'PortDepart' => 'required|string',
          'PortArrive' => 'required|string',
          'Invoice' => 'required',
          'CurrencyCode' => 'required|alpha|size:3',
          'Value' => 'required|numeric|min:0.0000000001',
          'ForeignExpense' => 'required|numeric|min:0',
          'LocalExpense' => 'required|numeric|min:0',
          'ExchangeRate' => 'required|numeric|min:0.0000000001',
        ]);

        if ($validator->fails())
        {
          # code...
          return redirect('lcs/create')
                  ->withErrors($validator)
                  ->withInput();
        }
        else
        {
          # code...



        //ALLOCATE
        $lc = new Lc;

        //INITIALIZE
        $lc->lc_num = $request->LcNumber; //LC#
        $lc->date_issued = $request->DateIssued;
        $lc->date_expiry = $request->DateExpiry;
        $lc->applicant = $request->Applicant;
        $lc->beneficiary = $request->Beneficiary;
        $lc->port_depart = $request->PortDepart;
        $lc->port_arrive = $request->PortArrive;
        $lc->invoice_no= $request->Invoice;
        $lc->currency_code = $request->CurrencyCode;
        $lc->foreign_amount = $request->Value;
        $lc->foreign_expense = $request->ForeignExpense;
        $lc->domestic_expense = $request->LocalExpense;
        $lc->exchange_rate = $request->ExchangeRate;
        $lc->notes = $request->Notes;



        //STORE
        $lc->save();

        $contents = array();
        $index = 0;

        for ($i=0; $i<$request->numItems; $i++) // each tyre
        {
          $item = new Performa_invoice;

          $item->lc_num = $lc->lc_num;
          $item->tyre_id = $request->tyre[$i];
          $item->qty = $request->qty[$i];
          $item->unit_price = $request->price[$i];

          array_push($contents, $item);
        }

        $lc->performaInvoice()->saveMany($contents);


        //$var = 'LC0001';
        return redirect("/lcs/".$lc->lc_num);

        //return $lc->lc_num;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lc  $lc
     * @return \Illuminate\Http\Response
     */
    public function show(Lc $lc)
    {

        $performa = $lc->performaInvoice()
                      ->get();

        $consignments = $lc->consignment()
                          ->get();
        //return $performa;
        return view('profiles.lc', compact('lc', 'performa', 'consignments'));
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
