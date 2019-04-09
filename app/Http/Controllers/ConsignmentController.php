<?php

namespace App\Http\Controllers;

use App\Consignment;
use App\Tyre;
use App\Consignment_container;
use App\Lc;
use Illuminate\Http\Request;
use Validator;

class ConsignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $containers = array();
        $contents = array();
        $consignments = Consignment::all();

        foreach($consignments as $consignment)
        {
          $somecontainers = $consignment->containers()
                                      ->get();
          array_push($containers, $somecontainers);

          foreach($somecontainers as $somecontainer)
          {
            $somecontents = $somecontainer->containerContents()
                                          ->get();
            array_push($contents, $somecontents);
          }
        }


        //return $contents;
        //return $containers;
        //return $containers;
        return view('consignments', compact('consignments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Pass a blank lc_num so we cant re-use the same code as below.
        $lc_num="";

        $lcs = Lc::orderBy('created_at', 'desc')->get();
        $tyres = Tyre::all();

        foreach($tyres as $tyre)
        {
          $tyre->qty = 0;
          $tyre->unit_price = 0;
          $tyre->total_tax = 0;
          $tyre->total_weight = 0;
        }

        return view ('new_consignment', compact('lc_num', 'tyres', 'lcs'));
    }

    public function createGivenLC($lc_num)
    {
      return view('new_consignment', compact('lc_num'));
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
        'inputBOL' => 'required|alpha_num',
        'inputLCnum' => 'required|numeric|digits:12',
        'inputValue' => 'required|numeric|min:0',
        'inputExchangeRate' => 'required|numeric|min:0',
        'inputTax' => 'required|numeric|min:0',
        'inputLandDate' => 'required|date',
      ]);

      if($validator->fails())
      {
        return redirect('consignments/create')
                ->withErrors($validator)
                ->withInput();
      }

      else
      {
        //ALLOCATE
        $consignment = new Consignment;


        //INITIALIZE
        $consignment->BOL = $request->inputBOL;
        $consignment->lc = $request->inputLCnum;
        $consignment->value = $request->inputValue;
        $consignment->exchange_rate = $request->inputExchangeRate;
        $consignment->tax = $request->inputTax;
        $consignment->land_date = $request->inputLandDate;


        //STORE
        $consignment->save();

        //REDIRECT
        return redirect('/consignments/'.$consignment->BOL);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consignment  $consignment
     * @return \Illuminate\Http\Response
     */
    public function show(Consignment $consignment)
    {
        //
      /*  $containers = $consignment->container()
                                  ->get();
        $contents = array();

        foreach ($containers as $container)
        {
          $content = $container->containerContents()
                              ->get();
          array_push($contents, $content);
        }*/



        //$containers = array();
        $contents = array();


          $containers = $consignment->containers()
                                      ->get();
          //array_push($containers, $somecontainers);

          foreach($containers as $somecontainer)
          {
            $somecontents = $somecontainer->containerContents()
                                          ->get();
            array_push($contents, $somecontents);
          }

          $expenses = $consignment->expenses()
                                  ->get();

        return view('profiles.consignment', compact('consignment', 'containers','contents', 'expenses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consignment  $consignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Consignment $consignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consignment  $consignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consignment $consignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consignment  $consignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consignment $consignment)
    {
        //
    }
}
