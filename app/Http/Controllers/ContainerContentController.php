<?php

namespace App\Http\Controllers;

use App\Container_content;
use App\Consignment_container;
use App\Tyre;
use Illuminate\Http\Request;

class ContainerContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $contents = Container_content::all();

        return view('container_contents', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tyres = Tyre::all();
        return view('new_container_content', compact('tyres'));
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

        global $container_content_records, $i;
        $container = Consignment_container::find($request->inputContainer);


        for ($i=0; $i<$request->numItems; $i++)
        {

          $container_content_records[$i] = new Container_content;


          $container_content_records[$i]->tyre_id = $request->tyre[$i];
          $container_content_records[$i]->qty = $request->qty[$i];
          $container_content_records[$i]->unit_price = $request->price[$i];

          $container_content_records[$i]->Container_num = $request->inputContainer;
          $container_content_records[$i]->BOL = $request->inputBOL;
        }

        if(is_null($container_content_records))
        {
          //return redirect('/tyres');
          echo "this is null";
          //echo $invoiceRecord[0];
        }
        else
        {
          $container->containerContents()->saveMany($container_content_records);

          return redirect('/container_contents');
          //$this.index();
        }
        //$invoiceRecord->save();
        //ONLY WORKS FOR SINGLE RECORDS
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Container_contents  $container_contents
     * @return \Illuminate\Http\Response
     */
    public function show(Container_contents $container_contents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Container_contents  $container_contents
     * @return \Illuminate\Http\Response
     */
    public function edit(Container_contents $container_contents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Container_contents  $container_contents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Container_contents $container_contents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Container_contents  $container_contents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Container_contents $container_contents)
    {
        //
    }
}
