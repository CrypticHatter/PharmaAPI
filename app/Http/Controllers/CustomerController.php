<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Customer::select('id', 'name', 'email', 'address')->get();
        if (!$data)
            return response()->json(['message' => 'No customers']);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:128',
            'email' => 'required|email|unique:customers',
            'address' => 'string|nullable'
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 400);

        $data = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return response()->json([
            'id' => $data->id,
            'name' => $data->name,
            'email' => $data->email,
            'address' => $data->address
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'max:128',
            'email' => 'email|unique:customers',
            'address' => 'string|nullable'
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 400);

        $data = Customer::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->save();


        return response()->json([
            'id' => $data->id,
            'name' => $data->name,
            'email' => $data->email,
            'address' => $data->address
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        if (!$customer)
            return response()->json(['success' => false, 'message' => 'Customer not found']);

        $customer->delete();
        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage permanantly.
     */
    public function force(string $id)
    {
        $customer = Customer::withTrashed()->find($id);
        if (!$customer)
            return response()->json(['success' => false, 'message' => 'Customer not found']);

        $customer->forceDelete();
        return response()->json([
            'success' => true
        ]);
    }
}
