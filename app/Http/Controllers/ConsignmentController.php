<?php

namespace App\Http\Controllers;

use App\Consignment;
use Illuminate\Http\Request;

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

        $consignments = Consignment::all();

        return view('consignments', compact('consignments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view ('new_consignment');
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
        $consignment = new Consignment;


        //INITIALIZE
        $consignment->BOL = $request->inputBOL;
        $consignment->lc = $request->inputLCnum;
        $consignment->value = $request->inputValue;
        $consignment->tax = $request->inputTax;
        $consignment->land_date = $request->inputLandDate;


        //STORE
        $consignment->save();

        //REDIRECT
        return redirect('/consignments');
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
