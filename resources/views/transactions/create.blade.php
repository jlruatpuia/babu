@extends('layouts.app')
@section('title', 'Create Transaction')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-info">
                    <div class="card-header">
                        {{ __('Add Transaction') }}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transaction.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="transaction_date">Transaction Date</label>
                                <input type="text" class="form-control @error('transaction_date') is-invalid @enderror"
                                       id="transaction_date" name="transaction_date" value="{{ formatDate(\Carbon\Carbon::now()) }}" required autofocus>
                                @error('transaction_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="customer_id">Customer Name</label>
                                <select id="customer_id" name="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required>
                                    <option value=""> --  SELECT -- </option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                @error('transaction_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="debit">Debit</label>
                                    <input type="number" class="form-control @error('debit') is-invalid @enderror"
                                           id="debit" name="debit" value="0" step="any" required>
                                    @error('debit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="credit">Credit</label>
                                    <input type="number" class="form-control @error('credit') is-invalid @enderror"
                                           id="credit" name="credit" value="0" step="any" required>
                                    @error('credit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css-after')
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('js-after')
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#customer_id').select2({
                theme: "bootstrap"
            });
            $('#transaction_date').datepicker({
                format: "dd-mm-yyyy",
                autoclose: true,
                startDate: '0d',
                todayHighlight: true,
            });
        });
    </script>
@endsection

