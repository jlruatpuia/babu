@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-info">
                    <div class="card-header">
                        {{ __('Transactions') }}
                        <span class="text-info">({{ formatDate(\Carbon\Carbon::now()) }})</span>
                        <a href="{{ route('transaction.create') }}" class="btn btn-primary float-right">Add New</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($transactions as $key => $transaction)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $transaction->customer->name }}</td>
                                    <td>&#x20B9; {{ $transaction->debit }}</td>
                                    <td>&#x20B9; {{ $transaction->credit }}</td>
                                    <td>&#x20B9; {{ $transaction->balance }}</td>
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
