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

        $validator=Validator::make($request->all(),[
          'Brand' => 'required|alpha_num',
          'Size' => 'required|string',
          'Pattern' => 'required|string',
        ]);

        if($validator->fails())
        {
          return redirect('tyres/create')
                  ->withErrors($validator)
                  ->withInput();
        }

        else
        {
          //ALLOCATE
          $tyre = new Tyre;

          //INITIALIZE
          $tyre->brand = Str::upper($request->Brand);
          $tyre->size = Str::upper($request->Size);
          $tyre->lisi = Str::upper($request->Lisi);
          $tyre->pattern = Str::upper($request->Pattern);

          //STORE
          $tyre->save();

          //REDIRECT
          return redirect('/tyres/'.$tyre->tyre_id);
        }

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
