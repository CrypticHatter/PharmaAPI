<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Medication::select('id', 'name', 'description', 'quantity')->get();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:128',
            'description' => 'required|string',
            'quantity' => 'required|integer'
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 400);

        $data = Medication::create([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'id' => $data->id,
            'name' => $data->name,
            'description' => $data->description,
            'quantity' => $data->quantity,
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:128',
            'description' => 'required|string',
            'quantity' => 'required|integer'
        ]);

        if ($validator->fails())
            return response()->json(['errors' => $validator->errors()], 400);

        $data = Medication::find($id);
        $data->name = $request->name;
        $data->description = $request->description;
        $data->quantity = $request->quantity;
        $data->save();


        return response()->json([
            'id' => $data->id,
            'name' => $data->name,
            'description' => $data->description,
            'quantity' => $data->quantity
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Medication::find($id);
        if (!$customer)
            return response()->json(['success' => false, 'message' => 'Medication not found']);

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
        $customer = Medication::withTrashed()->find($id);
        if (!$customer)
            return response()->json(['success' => false, 'message' => 'Medication not found']);

        $customer->forceDelete();
        return response()->json([
            'success' => true
        ]);
    }
}
