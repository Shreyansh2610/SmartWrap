<?php

namespace App\Http\Controllers;

use App\Models\FinishGoods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FinishGoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        FinishGoods::with([
            'product:id,product_name',
            'size:id,size_in_cm,size_in_mm,micron'
        ])
            ->select('id', 'product_id', 'size_id', 'sqm_per_roll', 'roll_quantity', 'total_sqm', 'pallet', 'pallet_name', 'details', 'boxes')->get()->toArray();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'product_id' => 'required',
                'size_id' => 'required',
                'sqm_per_roll' => 'required|numeric',
                'roll_quantity' => 'required|numeric',
                'total_sqm' => 'required|numeric',
                'pallet' => 'required',
                'pallet_name' => 'required',
                'details' => 'required',
                'boxes' => 'required|numeric',
            ],
            [
                'required' => ':attribute is required',
                'numeric' => ':attribute must be numeric',
            ],
            [
                'product_id' => 'Product',
                'size_id' => 'Size',
                'sqm_per_roll' => 'Sqm Per Roll',
                'roll_quantity' => 'Roll Quantity',
                'total_sqm' => 'Total Sqm',
                'pallet' => 'Pallet',
                'pallet_name' => 'Pallet Name',
                'details' => 'Details',
                'boxes' => 'Boxes',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        FinishGoods::create([
            'product_id' => $request->product_id,
            'size_id' => $request->size_id,
            'sqm_per_roll' => $request->sqm_per_roll,
            'roll_quantity' => $request->roll_quantity,
            'total_sqm' => $request->total_sqm,
            'pallet' => $request->pallet,
            'pallet_name' => $request->pallet_name,
            'details' => $request->details,
            'boxes' => $request->boxes,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Finish Goods is saved'
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'product_id' => 'required',
                'size_id' => 'required',
                'sqm_per_roll' => 'required|numeric',
                'roll_quantity' => 'required|numeric',
                'total_sqm' => 'required|numeric',
                'pallet' => 'required',
                'pallet_name' => 'required',
                'details' => 'required',
                'boxes' => 'required|numeric',
            ],
            [
                'required' => ':attribute is required',
                'numeric' => ':attribute must be numeric',
            ],
            [
                'product_id' => 'Product',
                'size_id' => 'Size',
                'sqm_per_roll' => 'Sqm Per Roll',
                'roll_quantity' => 'Roll Quantity',
                'total_sqm' => 'Total Sqm',
                'pallet' => 'Pallet',
                'pallet_name' => 'Pallet Name',
                'details' => 'Details',
                'boxes' => 'Boxes',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        FinishGoods::findOrFail($id)->update([
            'product_id' => $request->product_id,
            'size_id' => $request->size_id,
            'sqm_per_roll' => $request->sqm_per_roll,
            'roll_quantity' => $request->roll_quantity,
            'total_sqm' => $request->total_sqm,
            'pallet' => $request->pallet,
            'pallet_name' => $request->pallet_name,
            'details' => $request->details,
            'boxes' => $request->boxes,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Finish Goods is updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (FinishGoods::where('id', $id)->exists()) {
            FinishGoods::findOrFail($id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Finish Goods is deleted'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No records found'
            ], 404);
        }
    }
}
