<?php

namespace App\Http\Controllers;

use App\Models\CompanyRawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyRawMaterialsController extends Controller
{
    /**
     * Raw Materials list
     *
     * Display a listing of the company raw materials.
     * This endpoint returns a list of all company raw materials.
     *
     * @group Company Raw Materials
     *
     * @response 200 {
     *  "status": "success",
     *  "company_raw_materials": [
     *      {
     *          "id": 1dfd-4tfv-4gdgr,
     *          "company_name": "Company A",
     *          "total_pallet": 10,
     *          "bag_per_pallet": 20,
     *          "total_bag": 200,
     *          "weight_per_bag": 50,
     *          "total_weight": 10000
     *      },
     *      ...
     *  ]
     * }
     */
    public function index()
    {
        $companyRawMaterials = CompanyRawMaterial::select('id','company_name','total_pallet','bag_per_pallet','total_bag','weight_per_bag','total_weight')->get()->toArray();
        return response()->json([
            'status' => 'success',
            'company_raw_materials' => $companyRawMaterials,
        ], 200);
    }

    /**
     * Create Raw Material
     *
     * Store a newly created company raw material in storage.
     * This endpoint allows you to create a new company raw material.
     *
     * @group Company Raw Materials
     *
     * @bodyParam company_name string required The name of the company. Example: Company A
     * @bodyParam total_pallet numeric required The total number of pallets. Example: 10
     * @bodyParam bag_per_pallet numeric required The number of bags per pallet. Example: 20
     * @bodyParam total_bag numeric required The total number of bags. Example: 200
     * @bodyParam weight_per_bag numeric required The weight per bag. Example: 50
     * @bodyParam total_weight numeric required The total weight. Example: 10000
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Company Raw Materials are stored"
     * }
     * @response 422 {
     *  "errors": {
     *      "company_name": ["Company Name is required"],
     *      "total_pallet": ["Total Pallet is required", "Total Pallet must be numeric"],
     *      "bag_per_pallet": ["Bag Per Pallet is required", "Bag Per Pallet must be numeric"],
     *      "total_bag": ["Total Bag is required", "Total Bag must be numeric"],
     *      "weight_per_bag": ["Weight Per Bag is required", "Weight Per Bag must be numeric"],
     *      "total_weight": ["Total Weight is required", "Total Weight must be numeric"]
     *  }
     * }
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'company_name' => 'required',
                'total_pallet' => 'required|numeric',
                'bag_per_pallet' => 'required|numeric',
                'total_bag' => 'required|numeric',
                'weight_per_bag' => 'required|numeric',
                'total_weight' => 'required|numeric',
            ],
            [
                'required' => ':attribute is required',
                'numeric' => ':attribute must be numeric',
            ],
            [
                'company_name' => 'Company Name',
                'total_pallet' => 'Total Pallet',
                'bag_per_pallet' => 'Bag Per Pallet',
                'total_bag' => 'Total bag',
                'weight_per_bag' => 'Weight Per Bag',
                'total_weight' => 'Total Weight',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        CompanyRawMaterial::create([
            'company_name' => $request->company_name,
            'total_pallet' => $request->total_pallet,
            'bag_per_pallet' => $request->bag_per_pallet,
            'total_bag' => $request->total_bag,
            'weight_per_bag' => $request->weight_per_bag,
            'total_weight' => $request->total_weight,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Company Raw Materials are stored'
        ], 200);
    }

    /**
     * Update Raw Mateial
     *
     * Update the specified company raw material in storage.
     * This endpoint allows you to update an existing company raw material by providing its ID and the updated information.
     *
     * @group Company Raw Materials
     *
     * @urlParam id string required The ID of the company raw material to update. Example: 1
     * @bodyParam company_name string required The name of the company. Example: Company A
     * @bodyParam total_pallet numeric required The total number of pallets. Example: 10
     * @bodyParam bag_per_pallet numeric required The number of bags per pallet. Example: 20
     * @bodyParam total_bag numeric required The total number of bags. Example: 200
     * @bodyParam weight_per_bag numeric required The weight per bag. Example: 50
     * @bodyParam total_weight numeric required The total weight. Example: 10000
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Company Raw Materials are updated"
     * }
     * @response 422 {
     *  "errors": {
     *      "company_name": ["Company Name is required"],
     *      "total_pallet": ["Total Pallet is required", "Total Pallet must be numeric"],
     *      "bag_per_pallet": ["Bag Per Pallet is required", "Bag Per Pallet must be numeric"],
     *      "total_bag": ["Total Bag is required", "Total Bag must be numeric"],
     *      "weight_per_bag": ["Weight Per Bag is required", "Weight Per Bag must be numeric"],
     *      "total_weight": ["Total Weight is required", "Total Weight must be numeric"]
     *  }
     * }
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'company_name' => 'required',
                'total_pallet' => 'required|numeric',
                'bag_per_pallet' => 'required|numeric',
                'total_bag' => 'required|numeric',
                'weight_per_bag' => 'required|numeric',
                'total_weight' => 'required|numeric',
            ],
            [
                'required' => ':attribute is required',
                'numeric' => ':attribute must be numeric',
            ],
            [
                'company_name' => 'Company Name',
                'total_pallet' => 'Total Pallet',
                'bag_per_pallet' => 'Bag Per Pallet',
                'total_bag' => 'Total Bag',
                'weight_per_bag' => 'Weight Per Bag',
                'total_weight' => 'Total Weight',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        CompanyRawMaterial::findOrFail($id)->update([
            'company_name' => $request->company_name,
            'total_pallet' => $request->total_pallet,
            'bag_per_pallet' => $request->bag_per_pallet,
            'total_bag' => $request->total_bag,
            'weight_per_bag' => $request->weight_per_bag,
            'total_weight' => $request->total_weight,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Company Raw Materials are updated'
        ], 200);
    }

    /**
     * Delete Raw Materials
     *
     * Remove the specified company raw material from storage.
     * This endpoint allows you to delete a company raw material by providing its ID.
     *
     * @group Company Raw Materials
     *
     * @urlParam id string required The ID of the company raw material to delete. Example: 1
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Raw material is deleted"
     * }
     * @response 404 {
     *  "status": "error",
     *  "message": "No records found"
     * }
     */
    public function destroy(string $id)
    {
        if (CompanyRawMaterial::where('id', $id)->exists()) {
            CompanyRawMaterial::findOrFail($id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Raw material is deleted'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No records found'
            ], 404);
        }
    }
}
