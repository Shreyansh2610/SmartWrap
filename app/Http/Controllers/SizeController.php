<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    /**
     * Sizes list
     *
     * Get a list of all sizes available in system.
     *
     * @group Sizes
     *
     * @response 200 {
     *  "status": "success",
     *  "sizes": [
     *      {
     *          "id": 1dfn4k5-43tn4gkn-434,
     *          "size_in_cm": "50",
     *          "size_in_mm": "550",
     *          "product_name": "Product A",
     *          "hsn_code": "9035",
     *          "thickness": "15mm",
     *          "micron": "500",
     *          "grade": null,
     *          "width": null,
     *      },
     *      ...
     *  ]
     * }
     */
    public function index()
    {
        $sizes = Size::select('id', 'size_in_cm', 'size_in_mm', 'product_name', 'hsn_code', 'thickness', 'micron', 'grade', 'width')->get()->toArray();
        return response()->json([
            'status' => 'success',
            'products' => $sizes,
        ], 200);
    }


    /**
     * Create Size
     *
     * It store a newly created size in the system.
     * This endpoint allows you to store size details. The variables should be provided in the request body.
     *
     * @group Sizes
     *
     * @bodyParam size_in_cm string required The size in centimeters. Example: 100
     * @bodyParam size_in_mm string required The size in millimeters. Example: 1000
     * @bodyParam product_name string required The name of the product. Example: Product A
     * @bodyParam hsn_code string required The HSN code of the product. Example: 1234
     * @bodyParam thickness string required The thickness of the product. Example: 5mm
     * @bodyParam micron string required The micron value of the product. Example: 50
     * @bodyParam grade string required The grade of the product. Example: Grade A
     * @bodyParam width string required The width of the product. Example: 200
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Product details are stored"
     * }
     *
     * @response 422 {
     *  "status": "error",
     *  "message": "Validation error"
     * }
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'size_in_cm' => 'required|numeric',
                'size_in_mm' => 'required|numeric',
                'product_name' => 'required',
                'hsn_code' => 'required',
                'thickness' => 'required',
                'micron' => 'required|numeric',
            ],
            [
                'required' => ':attribute is required',
                'numeric' => ':attribute must be numeric',
            ],[
                'size_in_cm' => 'Size in centimeters',
                'size_in_mm' => 'Size in millimeters',
                'product_name' => 'Product Name',
                'hsn_code' => 'HSN code',
                'thickness' => 'Thickness',
                'micron' => 'Micron',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Size::create([
            'size_in_cm' => $request->size_in_cm,
            'size_in_mm' => $request->size_in_mm,
            'product_name' => $request->product_name,
            'hsn_code' => $request->hsn_code,
            'thickness' => $request->thickness,
            'micron' => $request->field,
            'grade' => $request->grade,
            'width' => $request->width,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Size details are stored'
        ], 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
