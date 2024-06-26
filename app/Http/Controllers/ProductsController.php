<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Products list
     *
     * Get a list of all products available in system.
     *
     * @group Products
     *
     * @response 200 {
     *  "status": "success",
     *  "products": [
     *      {
     *          "id": 1dfn4k5-43tn4gkn-434,
     *          "hsn_code": "1234",
     *          "product_name": "Product A",
     *          "sales": 100,
     *          "purchase": 90,
     *          "water_absorption": "5%",
     *          "field": "Field A"
     *      },
     *      ...
     *  ]
     * }
     */
    public function index()
    {
        $products = Product::select('id', 'hsn_code', 'product_name', 'sales', 'purchase', 'water_absorption', 'field')->get()->toArray();
        return response()->json([
            'status' => 'success',
            'products' => $products,
        ], 200);
    }

    /**
     * Create Product
     *
     * It store a newly created product in the system.
     *
     * @group Products
     *
     * @bodyParam hsn_code string required The HSN code of the product. Example: 1234
     * @bodyParam product_name string required The name of the product. Example: Product A
     * @bodyParam sales number required The sales price of the product. Example: 100
     * @bodyParam purchase number required The purchase price of the product. Example: 90
     * @bodyParam water_absorption string The water absorption rate of the product. Example: 5
     * @bodyParam field string The field of the product. Example: Field A
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
        Product::create([
            'hsn_code' => $request->hsn_code,
            'product_name' => $request->product_name,
            'sales' => $request->sales,
            'purchase' => $request->purchase,
            'water_absorption' => $request->water_absorption,
            'field' => $request->field,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Product details are stored'
        ], 200);
    }

    /**
     * Product Update
     *
     * It update the specified product in the system.
     *
     * @group Products
     *
     * @urlParam id string required The ID of the product to update. Example: 1
     * @bodyParam hsn_code string required The HSN code of the product. Example: 1234
     * @bodyParam product_name string required The name of the product. Example: Product A
     * @bodyParam sales number required The sales price of the product. Example: 100
     * @bodyParam purchase number required The purchase price of the product. Example: 90
     * @bodyParam water_absorption string The water absorption rate of the product. Example: 10
     * @bodyParam field string The field of the product. Example: Field A
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Product details are updated"
     * }
     *
     * @response 422 {
     *  "status": "error",
     *  "message": "Validation error"
     * }
     */
    public function update(Request $request, string $id)
    {
        Product::findOrFail($id)->update([
            'hsn_code' => $request->hsn_code,
            'product_name' => $request->product_name,
            'sales' => $request->sales,
            'purchase' => $request->purchase,
            'water_absorption' => $request->water_absorption,
            'field' => $request->field,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Product details are updated'
        ], 200);
    }

    /**
     * Delete Product
     *
     * It remove the specified product from the system.
     *
     * @group Products
     *
     * @urlParam id string required The ID of the product to delete. Example: 1453mk-545tmkm4-3tvekvek
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Product details are deleted"
     * }
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Product details are deleted'
        ], 200);
    }
}

