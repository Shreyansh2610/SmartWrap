<?php

namespace App\Http\Controllers;

use App\Models\FinishGoods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class FinishGoodsController extends Controller
{
    /**
     * Display a listing of the finish goods.
     *
     * This endpoint returns a list of all finish goods with their associated product and size details for the authenticated user.
     *
     * @group Finish Goods
     *
     * @response 200 {
     *  "status": "success",
     *  "finishGoods": [
     *      {
     *          "id": "15fjl5-4f45t-5g456y-g5t",
     *          "product_id": "1g5l67-54yb6-8u567-65g",
     *          "size_id": "1g5l67-54yb6-8u567-65g5",
     *          "kg_per_roll": 100,
     *          "roll_quantity": 10,
     *          "total_kg": 1000,
     *          "number_of_pallet": "Pallet 1",
     *          "pallet_number": "Pallet A",
     *          "details": "Details of finish goods",
     *          "boxes": 5,
     *          "production_date": "2023-06-25",
     *          "good_details": "Details about the goods",
     *          "company": "Company A",
     *          "description_of_goods": "Description of goods",
     *          "qty_in_storage_start": 50,
     *          "qty_issued": 10,
     *          "qty_in_storage_end": 40,
     *          "qty_returned": 5,
     *          "wastage": 2,
     *          "actual_qty_consumed": 8,
     *          "product": {
     *              "id": "1g5l67-54yb6-8u567-65g",
     *              "product_name": "Product A"
     *          },
     *          "size": {
     *              "id": "1g5l67-54yb6-8u567-65g5",
     *              "size_in_cm": 100,
     *              "size_in_mm": 1000,
     *              "micron": 50
     *          }
     *      }
     *  ]
     * }
     */
    public function index()
    {
        $finishGoods = FinishGoods::where(['created_by'=>auth()->user()->id])->first()->with([
            'product:id,product_name',
            'size:id,size_in_cm,size_in_mm,micron'
        ])
            ->select('id', 'product_id', 'size_id', 'kg_per_roll', 'roll_quantity', 'total_kg', 'number_of_pallet', 'pallet_number', 'details', 'boxes','production_date','good_details','company','description_of_goods','qty_in_storage_start','qty_issued','qty_in_storage_end','qty_returned','wastage','actual_qty_consumed')
            ->get()->toArray();

        return response()->json([
            'status' => 'success',
            'finishGoods' => $finishGoods
        ], 200);
    }

    /**
     * Store a newly created finish good in storage.
     *
     * This endpoint allows you to create a new finish good.
     *
     * @group Finish Goods
     *
     * @bodyParam product_id int required The ID of the product. Example: 15fjl5-4f45t-5g456y-g5t
     * @bodyParam size_id int required The ID of the size. Example: 1g5l67-54yb6-8u567-65g5
     * @bodyParam kg_per_roll numeric required The kilograms per roll. Example: 100
     * @bodyParam roll_quantity numeric required The quantity of rolls. Example: 10
     * @bodyParam total_kg numeric required The total kilograms. Example: 1000
     * @bodyParam number_of_pallet string required The number of pallets. Example: Pallet 1
     * @bodyParam pallet_number string required The name of the pallet. Example: Pallet A
     * @bodyParam details string required The details of the finish goods. Example: Details of finish goods
     * @bodyParam boxes numeric required The number of boxes. Example: 5
     * @bodyParam production_date date required The production date. Example: 2023-06-15
     * @bodyParam good_details string required The details of the goods. Example: "Good details"
     * @bodyParam company string required The name of the company. Example: "Company A"
     * @bodyParam description_of_goods string required The description of the goods. Example: "Description of goods"
     * @bodyParam qty_in_storage_start numeric required The quantity in storage at the start. Example: 100
     * @bodyParam qty_issued numeric required The quantity issued. Example: 10
     * @bodyParam qty_in_storage_end numeric required The quantity in storage at the end. Example: 90
     * @bodyParam qty_returned numeric required The quantity returned. Example: 5
     * @bodyParam wastage numeric required The wastage quantity. Example: 2
     * @bodyParam actual_qty_consumed numeric required The actual quantity consumed. Example: 8
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Finish Goods is saved"
     * }
     * @response 422 {
     *  "errors": {
     *      "product_id": ["Product is required"],
     *      "size_id": ["Size is required"],
     *      "kg_per_roll": ["Kg Per Roll is required", "Kg Per Roll must be numeric"],
     *      "roll_quantity": ["Roll Quantity is required", "Roll Quantity must be numeric"],
     *      "total_kg": ["Total Kg is required", "Total Kg must be numeric"],
     *      "number_of_pallet": ["Pallet is required"],
     *      "pallet_number": ["Pallet Name is required"],
     *      "details": ["Details is required"],
     *      "boxes": ["Boxes is required", "Boxes must be numeric"]
     *  }
     * }
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'product_id' => 'required',
                'size_id' => 'required',
                // 'kg_per_roll' => 'required|numeric',
                // 'roll_quantity' => 'required|numeric',
                // 'total_kg' => 'required|numeric',
                // 'number_of_pallet' => 'required',
                // 'pallet_number' => 'required',
                // 'details' => 'required',
                // 'boxes' => 'required|numeric',
                // 'production_date' => 'required|date',
                // 'good_details' => 'required',
                // 'company' => 'required',
                // 'description_of_goods' => 'required',
                // 'qty_in_storage_start' => 'required',
                // 'qty_issued' => 'required',
                // 'qty_in_storage_end' => 'required',
                // 'qty_returned' => 'required',
                // 'wastage' => 'required',
                // 'actual_qty_consumed' => 'required',
            ],
            [
                'required' => ':attribute is required',
                'numeric' => ':attribute must be numeric',
            ],
            [
                'product_id' => 'Product',
                'size_id' => 'Size',
                // 'kg_per_roll' => 'Sqm Per Roll',
                // 'roll_quantity' => 'Roll Quantity',
                // 'total_kg' => 'Total Sqm',
                // 'number_of_pallet' => 'Pallet',
                // 'pallet_number' => 'Pallet Name',
                // 'details' => 'Details',
                // 'boxes' => 'Boxes',
                // 'production_date' => 'Order Purchase Date',
                // 'good_details' => 'Goods Details',
                // 'company' => 'Company',
                // 'description_of_goods' => 'Description Of Goods',
                // 'qty_in_storage_start' => 'Quantity In Storage Start',
                // 'qty_issued' => 'Quantity Issued',
                // 'qty_in_storage_end' => 'Quantity In Storage End',
                // 'qty_returned' => 'Quantity Returned',
                // 'wastage' => 'Wastage',
                // 'actual_qty_consumed' => 'Actual Quantity Consumed',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        FinishGoods::create([
            'product_id' => $request->product_id,
            'size_id' => $request->size_id,
            'kg_per_roll' => $request->kg_per_roll ?? null,
            'roll_quantity' => $request->roll_quantity ?? null,
            'total_kg' => $request->total_kg ?? null,
            'number_of_pallet' => $request->number_of_pallet ?? null,
            'pallet_number' => $request->pallet_number ?? null,
            'details' => $request->details ?? null,
            'boxes' => $request->boxes ?? null,
            'production_date' => !empty($request->production_date)? Carbon::parse($request->production_date)->toDateString() : null,
            'good_details' => $request->good_details ?? null,
            'company' => $request->company ?? null,
            'description_of_goods' => $request->description_of_goods ?? null,
            'qty_in_storage_start' => $request->qty_in_storage_start ?? null,
            'qty_issued' => $request->qty_issued ?? null,
            'qty_in_storage_end' => $request->qty_in_storage_end ?? null,
            'qty_returned' => $request->qty_returned ?? null,
            'wastage' => $request->wastage ?? null,
            'actual_qty_consumed' => $request->actual_qty_consumed ?? null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Finish Goods is saved'
        ], 200);
    }

    /**
     * Update the specified finish good in storage.
     *
     * This endpoint allows you to update an existing finish good.
     *
     * @group Finish Goods
     *
     * @urlParam id int required The ID of the finish good. Example: 15fjl5-4f45t-5g456y-g5t
     *
     * @bodyParam product_id int required The ID of the product. Example: 15fjl5-4f45t-5g456y-g5t
     * @bodyParam size_id int required The ID of the size. Example: 1g5l67-54yb6-8u567-65g5
     * @bodyParam kg_per_roll numeric required The square meters per roll. Example: 100
     * @bodyParam roll_quantity numeric required The quantity of rolls. Example: 10
     * @bodyParam total_kg numeric required The total square meters. Example: 1000
     * @bodyParam number_of_pallet string required The number_of_pallet information. Example: Pallet 1
     * @bodyParam pallet_number string required The name of the pallet. Example: Pallet A
     * @bodyParam details string required The details of the finish goods. Example: Details of finish goods
     * @bodyParam boxes numeric required The number of boxes. Example: 5
     * @bodyParam production_date date required The order purchase date. Example: 2023-06-15
     * @bodyParam good_details string required The details of the goods. Example: "Good details"
     * @bodyParam company string required The name of the company. Example: "Company A"
     * @bodyParam description_of_goods string required The description of the goods. Example: "Description of goods"
     * @bodyParam qty_in_storage_start numeric required The quantity in storage at the start. Example: 100
     * @bodyParam qty_issued numeric required The quantity issued. Example: 10
     * @bodyParam qty_in_storage_end numeric required The quantity in storage at the end. Example: 90
     * @bodyParam qty_returned numeric required The quantity returned. Example: 5
     * @bodyParam wastage numeric required The wastage quantity. Example: 2
     * @bodyParam actual_qty_consumed numeric required The actual quantity consumed. Example: 8
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Finish Goods is updated"
     * }
     * @response 422 {
     *  "errors": {
     *      "product_id": ["Product is required"],
     *      "size_id": ["Size is required"],
     *      "kg_per_roll": ["Sqm Per Roll is required", "Sqm Per Roll must be numeric"],
     *      "roll_quantity": ["Roll Quantity is required", "Roll Quantity must be numeric"],
     *      "total_kg": ["Total Sqm is required", "Total Sqm must be numeric"],
     *      "number_of_pallet": ["Pallet is required"],
     *      "pallet_number": ["Pallet Name is required"],
     *      "details": ["Details is required"],
     *      "boxes": ["Boxes is required", "Boxes must be numeric"]
     *  }
     * }
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'product_id' => 'required',
                'size_id' => 'required',
                // 'kg_per_roll' => 'required|numeric',
                // 'roll_quantity' => 'required|numeric',
                // 'total_kg' => 'required|numeric',
                // 'number_of_pallet' => 'required',
                // 'pallet_number' => 'required',
                // 'details' => 'required',
                // 'boxes' => 'required|numeric',
                // 'production_date' => 'required|date',
                // 'good_details' => 'required',
                // 'company' => 'required',
                // 'description_of_goods' => 'required',
                // 'qty_in_storage_start' => 'required',
                // 'qty_issued' => 'required',
                // 'qty_in_storage_end' => 'required',
                // 'qty_returned' => 'required',
                // 'wastage' => 'required',
                // 'actual_qty_consumed' => 'required',
            ],
            [
                'required' => ':attribute is required',
                'numeric' => ':attribute must be numeric',
            ],
            [
                'product_id' => 'Product',
                'size_id' => 'Size',
                // 'kg_per_roll' => 'Sqm Per Roll',
                // 'roll_quantity' => 'Roll Quantity',
                // 'total_kg' => 'Total Sqm',
                // 'number_of_pallet' => 'Pallet',
                // 'pallet_number' => 'Pallet Name',
                // 'details' => 'Details',
                // 'boxes' => 'Boxes',
                // 'production_date' => 'Order Purchase Date',
                // 'good_details' => 'Goods Details',
                // 'company' => 'Company',
                // 'description_of_goods' => 'Description Of Goods',
                // 'qty_in_storage_start' => 'Quantity In Storage Start',
                // 'qty_issued' => 'Quantity Issued',
                // 'qty_in_storage_end' => 'Quantity In Storage End',
                // 'qty_returned' => 'Quantity Returned',
                // 'wastage' => 'Wastage',
                // 'actual_qty_consumed' => 'Actual Quantity Consumed',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $finishGood = FinishGoods::findOrFail($id);

        $finishGood->update([
            'product_id' => $request->product_id,
            'size_id' => $request->size_id,
            'kg_per_roll' => $request->kg_per_roll ?? null,
            'roll_quantity' => $request->roll_quantity ?? null,
            'total_kg' => $request->total_kg ?? null,
            'number_of_pallet' => $request->number_of_pallet ?? null,
            'pallet_number' => $request->pallet_number ?? null,
            'details' => $request->details ?? null,
            'boxes' => $request->boxes ?? null,
            'production_date' => !empty($request->production_date) ? Carbon::parse($request->production_date)->toDateString() : null,
            'good_details' => $request->good_details ?? null,
            'company' => $request->company ?? null,
            'description_of_goods' => $request->description_of_goods ?? null,
            'qty_in_storage_start' => $request->qty_in_storage_start ?? null,
            'qty_issued' => $request->qty_issued ?? null,
            'qty_in_storage_end' => $request->qty_in_storage_end ?? null,
            'qty_returned' => $request->qty_returned ?? null,
            'wastage' => $request->wastage ?? null,
            'actual_qty_consumed' => $request->actual_qty_consumed ?? null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Finish Goods is updated'
        ], 200);
    }

    /**
     * Remove the specified finish good from storage.
     *
     * This endpoint allows you to delete a finish good by its ID.
     *
     * @group Finish Goods
     *
     * @urlParam id int required The ID of the finish good. Example: 15fjl5-4f45t-5g456y-g5t
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Finish Goods is deleted"
     * }
     * @response 404 {
     *  "message": "Finish Goods not found"
     * }
     */
    public function destroy($id)
    {
        $finishGood = FinishGoods::find($id);

        if (!$finishGood) {
            return response()->json([
                'message' => 'Finish Goods not found'
            ], 404);
        }

        $finishGood->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Finish Goods is deleted'
        ], 200);
    }

    /**
     * Finish Goods Calculation
     *
     * Calculate the totals for micron, square meters per roll, roll quantity, total square meters, and boxes.
     * This endpoint calculates the sum of various properties of finish goods created on a specific date.
     * The properties include micron count, square meters per roll count, roll quantity count, total square meters count, and boxes count.
     *
     * @group Finish Goods
     *
     * @bodyParam date_filter string required The date filter to calculate totals for the specified date (2023-06-15 or 15-06-2023). Example: 2023-06-15
     *
     * @response 200 {
     *  "status": "success",
     *  "finishGoods": [
     *      {
     *          "id": 1,
     *          "product_id": 1dvm4i-4fh48-34jf84-4jci4,
     *          "size_id": 5j5m4i-4fh48-34jf84-4jci4,
     *          "kg_per_roll": 100,
     *          "roll_quantity": 10,
     *          "total_kg": 1000,
     *          "number_of_pallet": "Pallet 1",
     *          "pallet_number": "Pallet A",
     *          "details": "Details of finish goods",
     *          "boxes": 5,
     *          "product": {
     *              "id": 1dvm4i-4fh48-34jf84-4jci4,
     *              "product_name": "Product A"
     *          },
     *          "size": {
     *              "id": 5j5m4i-4fh48-34jf84-4jci4,
     *              "size_in_cm": 100,
     *              "size_in_mm": 1000,
     *              "micron": 50
     *          }
     *      }
     *  ],
     *  "micronCount": 50,
     *  "kgPerRollCount": 100,
     *  "rollQuantityCount": 10,
     *  "totalKgCount": 1000,
     *  "boxesCount": 5
     * }
     */
    public function calculation(Request $request)
    {
        $micronCount = 0;
        $kgPerRollCount = 0;
        $rollQuantityCount = 0;
        $totalKgCount = 0;
        $boxesCount = 0;
        $finishGoods = FinishGoods::with([
            'product:id,product_name',
            'size:id,size_in_cm,size_in_mm,micron'
        ])->where('created_at', 'LIKE', '%' . Carbon::parse($request->date_filter)->toDateString() . '%')
            ->where(['created_by'=>auth()->user()->id])
            ->select('id', 'product_id', 'size_id', 'kg_per_roll', 'roll_quantity', 'total_kg', 'number_of_pallet', 'pallet_number', 'details', 'boxes')
            ->get()->each(function ($finishGood) use (&$micronCount, &$kgPerRollCount, &$rollQuantityCount, &$totalKgCount, &$boxesCount) {
                $micronCount = $micronCount + ($finishGood->size->micron ?? 0);
                $kgPerRollCount = $kgPerRollCount + ($finishGood->kg_per_roll ?? 0);
                $rollQuantityCount = $rollQuantityCount + ($finishGood->roll_quantity ?? 0);
                $totalKgCount = $totalKgCount + ($finishGood->total_kg ?? 0);
                $boxesCount = $boxesCount + ($finishGood->boxes ?? 0);
                return $finishGood;
            });

        return response()->json([
            'status' => 'success',
            'finishGoods' => $finishGoods,
            'micronCount' => $micronCount,
            'kgPerRollCount' => $kgPerRollCount,
            'rollQuantityCount' => $rollQuantityCount,
            'totalKgCount' => $totalKgCount,
            'boxesCount' => $boxesCount,
        ], 200);
    }
}
