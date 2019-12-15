<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        $customers = Customer::all();

        return view('customers',['customers'=>$customers]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

          return view('new_customer');
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
//          'Name' => 'required|string',
//          'Address' => 'required|string',
//          'Phone' => 'required|numeric|digits_between:7,12',
//          'Notes' => 'string|nullable',
//        ]);
//
//        if($validator->fails())
//        {
//          return redirect('customers/create')
//                  ->withErrors($validator)
//                  ->withInput();
//        }
        //ALLOCATE
        $customer = new Customer;


        //INITIAZE
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->notes = $request->notes;

        //STORE
        $customer->save();

        $response = array();
        $response['status'] = 'success';
        $response['customer_id'] = $customer->id;

        return $response;
        //return redirect('/customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
      $query = OrderController::QUERY. ' WHERE customer_id='.$customer->id;

      $ret =  DB::select($query);

      $payments = DB::select('SELECT P.*
                               FROM payments P INNER JOIN orders O ON P.Order_num = O.Order_num
                                                INNER JOIN customers C ON O.customer_id = C.id 
                               WHERE O.customer_id='.$customer->id.'
                               ORDER BY P.created_at DESC
                               LIMIT 10');
//
        return view('partials.rows.customer', compact('customer', 'ret', 'payments'));
    }

    public function apiShow(Request $request){

      $id = $request->customer;
      $customer = Customer::find($id);
      return $customer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //

        $customer->name = $request->inputCustomerName;
        $customer->address = $request->inputAddress;
        $customer->phone = $request->inputPhone;
        $customer->notes = $request->inputNotes;

        $customer->save();


        return redirect ("/customers/".$customer->id);
    }

  public function apiUpdate(Request $request)
  {
    //
    $customer = Customer::find($request->customer);
    $customer->name = $request->name;
    $customer->address = $request->address;
    $customer->phone = $request->phone;
    $customer->notes = $request->notes;

    $customer->save();


    return array('status' => 'success');
    //return redirect ("/customers/".$customer->id);
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
