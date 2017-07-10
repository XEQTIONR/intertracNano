<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Container_content;
use App\Consignment_container;
use App\Tyre;
use Illuminate\Http\Request;
use Validator;

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
        $bol="";
        $tyres = Tyre::all();
        return view('new_container_content', compact('tyres','bol'));
    }

    public function createGivenBOL($bol)
    {
      $tyres = Tyre::all();
      return view('new_container_content', compact('tyres','bol'));

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
        $validator=Validator::make($request->all(),[
          'inputContainerNum' => 'required|string',
          'inputBOL' => 'required|string',

        ]);

        if($validator->fails())
        {
          return redirect('container_contents/create')
                  ->withErrors($validator)
                  ->withInput();
        }

        else
        {



        $container_content_records = array();
        //$container = Consignment_container::find($request->inputContainer);

        DB::beginTransaction();

        $container = new Consignment_container;

        $container->Container_num = $request->inputContainerNum;
        $container->BOL = $request->inputBOL;

        $container->save();
        //dd($container);
        //echo $container->Container_num;
        //echo $request->inputContainer;
        //echo $container->BOL;
      //  echo "inputBOL";
        //echo $request->inputBOL;

        for ($i=0; $i<$request->numItems; $i++)
        {

          //echo "forloop<br>"
          //echo $request->inputBOL;
          $container_content_records[$i] = new Container_content;


          $container_content_records[$i]->tyre_id = $request->tyre[$i];
          $container_content_records[$i]->qty = $request->qty[$i];
          $container_content_records[$i]->unit_price = $request->price[$i];

          $container_content_records[$i]->total_tax = $request->tax[$i];
          $container_content_records[$i]->total_weight = $request->weight[$i];

          $container_content_records[$i]->Container_num = $request->inputContainerNum;
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

          DB::commit();
          $base = "/consignments/";
          $url = $base . $request->inputBOL;
          //dd($url);
          return redirect($url);
          //$this.index();
        }
        //$invoiceRecord->save();
        //ONLY WORKS FOR SINGLE RECORDS
    }
  }



    /**
     * Display the specified resource.
     *
     * @param  \App\Container_contents  $container_contents
     * @return \Illuminate\Http\Response
     */
    public function show($bol)
    {
        $contents = Container_content::where('BOL',$bol)
                                      ->get();
        return $contents;
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
