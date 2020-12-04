<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

function formatDate($dt){
    return Carbon::parse($dt)->format('d-m-Y');
}

function setDate($yy, $mm, $dd){
    return Carbon::create($yy, $mm, $dd, 0, 0, 0, 'Asia/Kolkata');
}

function setDateFromDDMMYYYY($date){
    $dt = explode('-', $date);
    return Carbon::create($dt[2], $dt[1], $dt[0], 0, 0, 0, 'Asia/Kolkata');
}

function getDebit($customer_id){
    return DB::table('transactions')
        -> where('customer_id', $customer_id)
        -> sum('debit');
}

function getCredit($customer_id){
    return DB::table('transactions')
        -> where('customer_id', $customer_id)
        -> sum('credit');
}

function getBalance($customer_id){
    return abs(getDebit($customer_id) - getCredit($customer_id));
}
