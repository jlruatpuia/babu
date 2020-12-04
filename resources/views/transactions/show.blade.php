@extends('layouts.app')
@section('title', 'Transactions')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-info">
                    <div class="card-header">
                        @if($transactions->count() > 0)
                        Transaction details for <span class="text-info">{{ $transactions->first()->customer->name }}</span>
                        @else
                            Transaction details
                        @endif
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($transactions as $key => $transaction)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ formatDate($transaction->transaction_date) }}</td>
                                    <td>&#x20B9; {{ $transaction->debit }}</td>
                                    <td>&#x20B9; {{ $transaction->credit }}</td>
                                    <td>&#x20B9; {{ $transaction->balance }}</td>
                                    <td>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        No transactions..
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css-after')
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('js-after')
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#transaction_date').datepicker({
                format: "dd-mm-yyyy",
                autoclose: true
            });
        });
    </script>
@endsection
