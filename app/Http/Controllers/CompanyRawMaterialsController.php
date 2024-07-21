<?php

namespace App\Http\Controllers;

use App\Models\CompanyRawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
     *          "id": "1dfd-4tfv-4gdgr",
     *          "company_name": "Company A",
     *          "total_pallet": 10,
     *          "bag_per_pallet": 20,
     *          "total_bag": 200,
     *          "weight_per_bag": 50,
     *          "total_weight": 10000,
     *          "supplier_name": "Supplier A",
     *          "purchase_order_no": "PO12345",
     *          "sales_order_no": "SO12345",
     *          "description_of_goods": "Description of goods",
     *          "qty": 100,
     *          "weight_per_pcs": 10,
     *          "payment_terms": "Net 30",
     *          "invoice_date": "2023-06-25",
     *          "status": "Received",
     *          "received_date": "2023-06-26"
     *      },
     *      ...
     *  ]
     * }
     */
    public function index()
    {
        $companyRawMaterials = CompanyRawMaterial::select(
            'id',
            'company_name',
            'total_pallet',
            'bag_per_pallet',
            'total_bag',
            'weight_per_bag',
            'total_weight',
            'supplier_name',
            'purchase_order_no',
            'sales_order_no',
            'description_of_goods',
            'qty',
            'weight_per_pcs',
            'payment_terms',
            'invoice_date',
            'status',
            'received_date'
        )->get()->toArray();
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
     * @bodyParam supplier_name string required The name of the supplier. Example: Supplier A
     * @bodyParam purchase_order_no string required The purchase order number. Example: PO12345
     * @bodyParam sales_order_no string required The sales order number. Example: SO12345
     * @bodyParam description_of_goods string required The description of goods. Example: Description of goods
     * @bodyParam qty numeric required The quantity of goods. Example: 100
     * @bodyParam weight_per_pcs numeric required The weight per piece. Example: 10
     * @bodyParam payment_terms string required The payment terms. Example: Net 30
     * @bodyParam invoice_date date required The invoice date. Example: 2023-06-25
     * @bodyParam status string required The status of the raw materials. Example: Received
     * @bodyParam received_date date required The received date. Example: 2023-06-26
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
     *      "total_weight": ["Total Weight is required", "Total Weight must be numeric"],
     *      "supplier_name": ["Supplier Name is required"],
     *      "purchase_order_no": ["Purchase Order No is required"],
     *      "sales_order_no": ["Sales Order No is required"],
     *      "description_of_goods": ["Description Of Goods is required"],
     *      "qty": ["Quantity is required"],
     *      "weight_per_pcs": ["Weight Per Piece is required"],
     *      "payment_terms": ["Payment Terms are required"],
     *      "invoice_date": ["Invoice Date is required"],
     *      "status": ["Status is required"],
     *      "received_date": ["Received Date is required"]
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
                'supplier_name' => 'required',
                'purchase_order_no' => 'required',
                'sales_order_no' => 'required',
                'description_of_goods' => 'required',
                'qty' => 'required',
                'weight_per_pcs' => 'required',
                'payment_terms' => 'required',
                'invoice_date' => 'required',
                'status' => 'required',
                'received_date' => 'required',
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
                'supplier_name' => 'Supplier Name',
                'purchase_order_no' => 'Purchase Order No',
                'sales_order_no' => 'Sales Order No',
                'description_of_goods' => 'Description Of Goods',
                'qty' => 'Quantity',
                'weight_per_pcs' => 'Weight Per Piece',
                'payment_terms' => 'Payment Terms',
                'invoice_date' => 'Invoice Date',
                'status' => 'Status',
                'received_date' => 'Received Date',
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
            'supplier_name' => $request->supplier_name,
            'purchase_order_no' => $request->purchase_order_no,
            'sales_order_no' => $request->sales_order_no,
            'description_of_goods' => $request->description_of_goods,
            'qty' => $request->qty,
            'weight_per_pcs' => $request->weight_per_pcs,
            'payment_terms' => $request->payment_terms,
            'invoice_date' => Carbon::parse($request->invoice_date)->toDateString(),
            'status' => $request->status,
            'received_date' => Carbon::parse($request->received_date)->toDateString(),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Company Raw Materials are stored'
        ], 200);
    }

    /**
     * Update Raw Material
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
     * @bodyParam supplier_name string required The name of the supplier. Example: Supplier A
     * @bodyParam purchase_order_no string required The purchase order number. Example: PO12345
     * @bodyParam sales_order_no string required The sales order number. Example: SO12345
     * @bodyParam description_of_goods string required The description of goods. Example: Description of goods
     * @bodyParam qty numeric required The quantity of goods. Example: 100
     * @bodyParam weight_per_pcs numeric required The weight per piece. Example: 10
     * @bodyParam payment_terms string required The payment terms. Example: Net 30
     * @bodyParam invoice_date date required The invoice date. Example: 2023-06-25
     * @bodyParam status string required The status of the raw materials. Example: Received
     * @bodyParam received_date date required The received date. Example: 2023-06-26
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Company Raw Material updated successfully"
     * }
     * @response 404 {
     *  "message": "Raw Material not found"
     * }
     * @response 422 {
     *  "errors": {
     *      "company_name": ["Company Name is required"],
     *      "total_pallet": ["Total Pallet is required", "Total Pallet must be numeric"],
     *      "bag_per_pallet": ["Bag Per Pallet is required", "Bag Per Pallet must be numeric"],
     *      "total_bag": ["Total Bag is required", "Total Bag must be numeric"],
     *      "weight_per_bag": ["Weight Per Bag is required", "Weight Per Bag must be numeric"],
     *      "total_weight": ["Total Weight is required", "Total Weight must be numeric"],
     *      "supplier_name": ["Supplier Name is required"],
     *      "purchase_order_no": ["Purchase Order No is required"],
     *      "sales_order_no": ["Sales Order No is required"],
     *      "description_of_goods": ["Description Of Goods is required"],
     *      "qty": ["Quantity is required"],
     *      "weight_per_pcs": ["Weight Per Piece is required"],
     *      "payment_terms": ["Payment Terms are required"],
     *      "invoice_date": ["Invoice Date is required"],
     *      "status": ["Status is required"],
     *      "received_date": ["Received Date is required"]
     *  }
     * }
     */
    public function update(Request $request, $id)
    {
        $companyRawMaterial = CompanyRawMaterial::find($id);

        if (!$companyRawMaterial) {
            return response()->json(['message' => 'Raw Material not found'], 404);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'company_name' => 'required',
                'total_pallet' => 'required|numeric',
                'bag_per_pallet' => 'required|numeric',
                'total_bag' => 'required|numeric',
                'weight_per_bag' => 'required|numeric',
                'total_weight' => 'required|numeric',
                'supplier_name' => 'required',
                'purchase_order_no' => 'required',
                'sales_order_no' => 'required',
                'description_of_goods' => 'required',
                'qty' => 'required',
                'weight_per_pcs' => 'required',
                'payment_terms' => 'required',
                'invoice_date' => 'required',
                'status' => 'required',
                'received_date' => 'required',
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
                'supplier_name' => 'Supplier Name',
                'purchase_order_no' => 'Purchase Order No',
                'sales_order_no' => 'Sales Order No',
                'description_of_goods' => 'Description Of Goods',
                'qty' => 'Quantity',
                'weight_per_pcs' => 'Weight Per Piece',
                'payment_terms' => 'Payment Terms',
                'invoice_date' => 'Invoice Date',
                'status' => 'Status',
                'received_date' => 'Received Date',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $companyRawMaterial->update([
            'company_name' => $request->company_name,
            'total_pallet' => $request->total_pallet,
            'bag_per_pallet' => $request->bag_per_pallet,
            'total_bag' => $request->total_bag,
            'weight_per_bag' => $request->weight_per_bag,
            'total_weight' => $request->total_weight,
            'supplier_name' => $request->supplier_name,
            'purchase_order_no' => $request->purchase_order_no,
            'sales_order_no' => $request->sales_order_no,
            'description_of_goods' => $request->description_of_goods,
            'qty' => $request->qty,
            'weight_per_pcs' => $request->weight_per_pcs,
            'payment_terms' => $request->payment_terms,
            'invoice_date' => Carbon::parse($request->invoice_date)->toDateString(),
            'status' => $request->status,
            'received_date' => Carbon::parse($request->received_date)->toDateString(),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Company Raw Material updated successfully'
        ], 200);
    }

    /**
     * Delete Raw Material
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
     *  "message": "Company Raw Material deleted successfully"
     * }
     * @response 404 {
     *  "message": "Raw Material not found"
     * }
     */
    public function destroy($id)
    {
        $companyRawMaterial = CompanyRawMaterial::find($id);

        if (!$companyRawMaterial) {
            return response()->json(['message' => 'Raw Material not found'], 404);
        }

        $companyRawMaterial->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Company Raw Material deleted successfully'
        ], 200);
    }
}
