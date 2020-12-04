<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index() {
        $customers = Customer::all();
        return response()->json([
           'success' => true,
           'data' => $customers,
        ]);
    }

    public function show($id) {
        $customer = Customer::find($id);
        if(!$customer) {
            return response()->json([
               'success' => false,
               'message' => 'Customer not found'
            ], 400);
        }

        return response()->json([
           'success' => true,
           'data' => $customer->toArray()
        ], 400);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        if($customer->save()){
            return response()->json([
               'success' => true,
               'data' => $customer->toArray()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Customer could not be added'
            ]);
        }
    }

    public function update(Request $request, $id) {
        $customer = Customer::find($id);
        if(!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found'
            ], 400);
        }
        $updated = $customer->fill($request->all())->save();
        if($updated){
            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Customer could not be updated'
            ], 500);
        }
    }

    public function destroy($id) {
        $customer = Customer::find($id);
        if(!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found'
            ], 400);
        }
        if($customer->delete()) {
            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Customer could not be deleted'
            ], 500);
        }
    }
}
