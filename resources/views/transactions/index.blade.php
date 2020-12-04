@extends('layouts.app')
@section('title', 'Transactions')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-info">
                    <div class="card-header">
                        {{ __('Transactions') }}
                        <a href="{{ route('transaction.create') }}" class="btn btn-sm btn-info float-right"><i class="fa fa-plus"></i> Add New</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('transactions.date') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="transaction_date" class="col-sm-2 col-form-label">Date : </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="transaction_date" name="transaction_date" value="{{ formatDate($dt) }}" required>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-outline-primary">Go</button>
                                </div>
                            </div>
                        </form>
                        <br />
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Customer Name</th>
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
                                    <td>{{ $transaction->customer->name }}</td>
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
