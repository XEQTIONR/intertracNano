<?php

namespace App\Http\Controllers;

use App\Consignment_expense;
use Illuminate\Http\Request;

class ConsignmentExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $expenses = Consignment_expense::all();

        return view('consignment_expenses', compact('expenses'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('new_expense');
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
        $expense = new Consignment_expense;

        $expense->BOL = $request->inputBOL;
        $expense->expense_foreign = $request->inputExpenseForeign;
        $expense->expense_local = $request->inputExpenseLocal;
        $expense->expense_notes = $request->inputNote;

        $expense->save();

        return redirect('/consignment_expenses');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consignment_expense  $consignment_expense
     * @return \Illuminate\Http\Response
     */
    public function show(Consignment_expense $consignment_expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consignment_expense  $consignment_expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Consignment_expense $consignment_expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consignment_expense  $consignment_expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consignment_expense $consignment_expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consignment_expense  $consignment_expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consignment_expense $consignment_expense)
    {
        //
    }
}
