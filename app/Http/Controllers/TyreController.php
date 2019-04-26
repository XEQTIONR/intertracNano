<?php

namespace App\Http\Controllers;

use App\Tyre;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
class TyreController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

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
        //VALIDATE

//        $validator=Validator::make($request->all(),[
//          'Brand' => 'required|alpha_num',
//          'Size' => 'required|string',
//          'Pattern' => 'required|string',
//        ]);
//
//        if($validator->fails())
//        {
//          return redirect('tyres/create')
//                  ->withErrors($validator)
//                  ->withInput();
//        }
//
//        else
//        {
          //ALLOCATE
          $tyre = new Tyre;

          //INITIALIZE
          $tyre->brand = Str::upper($request->brand);
          $tyre->size = Str::upper($request->size);
          $tyre->lisi = Str::upper($request->lisi);
          $tyre->pattern = Str::upper($request->pattern);

          //STORE
          $tyre->save();

          //REDIRECT
          $response = array();
          $response['status'] = 'success';
          $response['tyre_id'] = $tyre->tyre_id;


          return $response;
//        }

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
        return view('profiles.tyre', compact('tyre'));
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

        $tyre->brand    = $request->inputTyreBrand;
        $tyre->size     = $request->inputTyreSize;
        $tyre->pattern  = $request->inputTyrePattern;

        $tyre->save();

        return redirect("/tyres/".$tyre->id);
        //echo "UPDATE TYRE";
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
