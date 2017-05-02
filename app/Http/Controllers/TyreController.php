<?php

namespace App\Http\Controllers;

use App\Tyre;
use Illuminate\Http\Request;

class TyreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tyres = Tyre::all();

        //return view('tyres',['tyres'=>$tyres]);
        return view('tyres',compact('tyres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('new_tyre');
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

        $tyre = new Tyre;
        $tyre->tyre_brand = $request->inputBrand;
        $tyre->tyre_size = $request->inputSize;
        $tyre->tyre_pattern = $request->inputPattern;

        $tyre->save();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tyre  $tyre
     * @return \Illuminate\Http\Response
     */
    public function show(Tyre $tyre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tyre  $tyre
     * @return \Illuminate\Http\Response
     */
    public function edit(Tyre $tyre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tyre  $tyre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tyre $tyre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tyre  $tyre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tyre $tyre)
    {
        //
    }
}
