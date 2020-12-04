<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionsController extends Controller
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
    public function index($dt = null)
    {
        if($dt == null) {
            $dt = Carbon::now();
        }
        $transactions = Transaction::whereDate('transaction_date', '=', $dt)->get();
        return view('transactions.index')
            -> with('transactions', $transactions)
            -> with('dt', $dt);
    }

    public function indexDate(Request $request) {
        $dt = setDateFromDDMMYYYY($request->transaction_date);
        $transactions = Transaction::whereDate('transaction_date', '=', $dt)->get();
        return view('transactions.index')
            -> with('transactions', $transactions)
            -> with('dt', $dt);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('transactions.create') -> with('customers', $customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'transaction_date' => 'required',
            'customer_id' => 'required',
        ]);
        //dd($request->all());
        $trans = new Transaction();
        $trans->transaction_date = setDateFromDDMMYYYY($request->transaction_date);
        $trans->customer_id = $request->customer_id;
        $trans->debit = $request->debit;
        $trans->credit = $request->credit;
        $dr = getDebit($request->customer_id) + $request->debit;
        $cr = getCredit($request->customer_id) + $request->credit;
        $trans->balance = $dr - $cr;
        $trans->save();
        return redirect()->route('transactions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transactions = Transaction::where('customer_id', '=', $id)->get();
        return view('transactions.show') -> with('transactions', $transactions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
