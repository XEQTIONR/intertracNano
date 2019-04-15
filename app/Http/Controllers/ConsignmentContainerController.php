<?php

namespace App\Http\Controllers;

use App\Consignment;
use Illuminate\Http\Request;

use App\Consignment_container;
use App\Lc;
use App\Tyre;

class ConsignmentContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $containers = Consignment_container::all();

        return view('consignment_containers', compact('containers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

      $lc_num="";

      $lcs = Lc::orderBy('created_at', 'desc')->get();
      $tyres = Tyre::all();

      $consignments = Consignment::with('containers.contents.tyre')->get();

      foreach($tyres as $tyre)
      {
        $tyre->qty = 0;
        $tyre->unit_price = 0;
        $tyre->total_tax = 0;
        $tyre->total_weight = 0;
      }

      return view ('new_container', compact('lc_num', 'tyres', 'lcs', 'consignments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $container = new Consignment_container;

        $container->Container_num = $request->inputContainerNum;
        $container->BOL = $request->inputBOL;

        $container->save();

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consignment_container  $consignment_container
     * @return \Illuminate\Http\Response
     */
    public function show(Consignment_container $consignment_container)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consignment_container  $consignment_container
     * @return \Illuminate\Http\Response
     */
    public function edit(Consignment_container $consignment_container)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consignment_container  $consignment_container
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consignment_container $consignment_container)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consignment_container  $consignment_container
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consignment_container $consignment_container)
    {
        //
    }
}
