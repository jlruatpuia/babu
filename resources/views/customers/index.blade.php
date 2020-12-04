@extends('layouts.app')
@section('title', 'Customers')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-info">
                <div class="card-header">
                  {{ __('Customers') }}
                  <a href="{{ route('customers.create') }}" class="btn btn-sm btn-info float-right"><i class="fa fa-plus"></i> Add New</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($customers as $key => $customer)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="{{ route('transaction.show', $customer->id) }}">{{ $customer->name }}</a></td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>
{{--                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">--}}
                                    <a class="btn btn-sm btn-secondary" href="{{ route('customers.edit', $customer->id) }}" role="button"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="post" style="display: inline-block">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                                        </form>

{{--                                    </div>--}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                  No customers..
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
