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
            'sizes' => $sizes,
        ], 200);
    }


    /**
     * Create Size
     *
     * Store a newly created size in the database.
     * This endpoint allows you to store size details. The variables should be provided in the request body.
     *
     * @group Sizes
     *
     * @bodyParam size_in_cm numeric required The size in centimeters. Example: 100
     * @bodyParam size_in_mm numeric required The size in millimeters. Example: 1000
     * @bodyParam product_name string required The name of the product. Example: Product A
     * @bodyParam hsn_code string required The HSN code of the product. Example: 1234
     * @bodyParam thickness string required The thickness of the product. Example: 5
     * @bodyParam micron numeric required The micron value of the product. Example: 50
     * @bodyParam grade string The grade of the product. Example: Grade A
     * @bodyParam width string The width of the product. Example: 200
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Size details are stored"
     * }
     * @response 422 {
     *  "errors": {
     *      "size_in_cm": [
     *          "Size in centimeters is required",
     *          "Size in centimeters must be numeric"
     *      ],
     *      "size_in_mm": [
     *          "Size in millimeters is required",
     *          "Size in millimeters must be numeric"
     *      ],
     *      "product_name": [
     *          "Product Name is required"
     *      ],
     *      "hsn_code": [
     *          "HSN code is required"
     *      ],
     *      "thickness": [
     *          "Thickness is required"
     *      ],
     *      "micron": [
     *          "Micron is required",
     *          "Micron must be numeric"
     *      ]
     *  }
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
            ],
            [
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
            'micron' => $request->micron,
            'grade' => $request->grade,
            'width' => $request->width,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Size details are stored'
        ], 200);
    }


    /**
     * Update Size
     *
     * Update the specified size in the database.
     * This endpoint allows you to update size details by providing the size ID and the updated information.
     *
     * @group Sizes
     *
     * @urlParam id string required The ID of the size to update. Example: 1
     * @bodyParam size_in_cm numeric required The size in centimeters. Example: 100
     * @bodyParam size_in_mm numeric required The size in millimeters. Example: 1000
     * @bodyParam product_name string required The name of the product. Example: Product A
     * @bodyParam hsn_code string required The HSN code of the product. Example: 1234
     * @bodyParam thickness string required The thickness of the product. Example: 5
     * @bodyParam micron numeric required The micron value of the product. Example: 50
     * @bodyParam grade string The grade of the product. Example: Grade A
     * @bodyParam width string The width of the product. Example: 200
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Size details are updated"
     * }
     * @response 422 {
     *  "errors": {
     *      "size_in_cm": [
     *          "Size in centimeters is required",
     *          "Size in centimeters must be numeric"
     *      ],
     *      "size_in_mm": [
     *          "Size in millimeters is required",
     *          "Size in millimeters must be numeric"
     *      ],
     *      "product_name": [
     *          "Product Name is required"
     *      ],
     *      "hsn_code": [
     *          "HSN code is required"
     *      ],
     *      "thickness": [
     *          "Thickness is required"
     *      ],
     *      "micron": [
     *          "Micron is required",
     *          "Micron must be numeric"
     *      ]
     *  }
     * }
     */
    public function update(Request $request, string $id)
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
            ],
            [
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

        Size::findOrFail($id)->update([
            'size_in_cm' => $request->size_in_cm,
            'size_in_mm' => $request->size_in_mm,
            'product_name' => $request->product_name,
            'hsn_code' => $request->hsn_code,
            'thickness' => $request->thickness,
            'micron' => $request->micron,
            'grade' => $request->grade,
            'width' => $request->width,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Size details are updated'
        ], 200);
    }

    /**
     * Delete Size
     *
     * Remove the specified size from the database.
     * This endpoint allows you to delete a size by providing its ID.
     *
     * @group Sizes
     *
     * @urlParam id string required The ID of the size to delete. Example: 1fkj58-4nci34-fk48i
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Size is deleted"
     * }
     * @response 404 {
     *  'status': 'error',
     *  "message": "No records found"
     * }
     */
    public function destroy(string $id)
    {
        if (Size::where('id', $id)->exists()) {
            Size::findOrFail($id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Size is deleted'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No records found'
            ], 404);
        }

    }
}
