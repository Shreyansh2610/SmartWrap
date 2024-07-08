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
     * This endpoint returns a list of all finish goods with their associated product and size details.
     *
     * @group Finish Goods
     *
     * @response 200 {
     *  "status": "success",
     *  "finishGoods": [
     *      {
     *          "id": 15fjl5-4f45t-5g456y-g5t,
     *          "product_id": 1g5l67-54yb6-8u567-65g,
     *          "size_id": 1g5l67-54yb6-8u567-65g5,
     *          "sqm_per_roll": 100,
     *          "roll_quantity": 10,
     *          "total_sqm": 1000,
     *          "pallet": "Pallet 1",
     *          "pallet_name": "Pallet A",
     *          "details": "Details of finish goods",
     *          "boxes": 5,
     *          "product": {
     *              "id": 1g5l67-54yb6-8u567-65g,
     *              "product_name": "Product A"
     *          },
     *          "size": {
     *              "id": 1g5l67-54yb6-8u567-65g5,
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
        $finishGoods = FinishGoods::with([
            'product:id,product_name',
            'size:id,size_in_cm,size_in_mm,micron'
        ])
            ->select('id', 'product_id', 'size_id', 'sqm_per_roll', 'roll_quantity', 'total_sqm', 'pallet', 'pallet_name', 'details', 'boxes')->get()->toArray();

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
     * @bodyParam sqm_per_roll numeric required The square meters per roll. Example: 100
     * @bodyParam roll_quantity numeric required The quantity of rolls. Example: 10
     * @bodyParam total_sqm numeric required The total square meters. Example: 1000
     * @bodyParam pallet string required The pallet information. Example: Pallet 1
     * @bodyParam pallet_name string required The name of the pallet. Example: Pallet A
     * @bodyParam details string required The details of the finish goods. Example: Details of finish goods
     * @bodyParam boxes numeric required The number of boxes. Example: 5
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Finish Goods is saved"
     * }
     * @response 422 {
     *  "errors": {
     *      "product_id": ["Product is required"],
     *      "size_id": ["Size is required"],
     *      "sqm_per_roll": ["Sqm Per Roll is required", "Sqm Per Roll must be numeric"],
     *      "roll_quantity": ["Roll Quantity is required", "Roll Quantity must be numeric"],
     *      "total_sqm": ["Total Sqm is required", "Total Sqm must be numeric"],
     *      "pallet": ["Pallet is required"],
     *      "pallet_name": ["Pallet Name is required"],
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
     * Update the specified finish good in storage.
     *
     * This endpoint allows you to update an existing finish good by providing its ID and the updated information.
     *
     * @group Finish Goods
     *
     * @urlParam id string required The ID of the finish good to update. Example: 1dlfgl5-5rth-5fhfgh-b56-gthf
     * @bodyParam product_id int required The ID of the product. Example: 1dlfgl5-5rth-5fhfgh-b56-gthft
     * @bodyParam size_id int required The ID of the size. Example: 154dlfgl5-5rth-5fhfgh-b56-gthft
     * @bodyParam sqm_per_roll numeric required The square meters per roll. Example: 100
     * @bodyParam roll_quantity numeric required The quantity of rolls. Example: 10
     * @bodyParam total_sqm numeric required The total square meters. Example: 1000
     * @bodyParam pallet string required The pallet information. Example: Pallet 1
     * @bodyParam pallet_name string required The name of the pallet. Example: Pallet A
     * @bodyParam details string required The details of the finish goods. Example: Details of finish goods
     * @bodyParam boxes numeric required The number of boxes. Example: 5
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Finish Goods is updated"
     * }
     * @response 422 {
     *  "errors": {
     *      "product_id": ["Product is required"],
     *      "size_id": ["Size is required"],
     *      "sqm_per_roll": ["Sqm Per Roll is required", "Sqm Per Roll must be numeric"],
     *      "roll_quantity": ["Roll Quantity is required", "Roll Quantity must be numeric"],
     *      "total_sqm": ["Total Sqm is required", "Total Sqm must be numeric"],
     *      "pallet": ["Pallet is required"],
     *      "pallet_name": ["Pallet Name is required"],
     *      "details": ["Details is required"],
     *      "boxes": ["Boxes is required", "Boxes must be numeric"]
     *  }
     * }
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
     * Remove the specified finish good from storage.
     *
     * This endpoint allows you to delete a finish good by providing its ID.
     *
     * @group Finish Goods
     *
     * @urlParam id string required The ID of the finish good to delete. Example: tghtyjh67-54-gt-6-344
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Finish Goods is deleted"
     * }
     * @response 404 {
     *  "status": "error",
     *  "message": "No records found"
     * }
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
     *          "sqm_per_roll": 100,
     *          "roll_quantity": 10,
     *          "total_sqm": 1000,
     *          "pallet": "Pallet 1",
     *          "pallet_name": "Pallet A",
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
     *  "sqmPerRollCount": 100,
     *  "rollQuantityCount": 10,
     *  "totalSqmCount": 1000,
     *  "boxesCount": 5
     * }
     */
    public function calculation(Request $request)
    {
        $micronCount = 0;
        $sqmPerRollCount = 0;
        $rollQuantityCount = 0;
        $totalSqmCount = 0;
        $boxesCount = 0;
        $finishGoods = FinishGoods::with([
            'product:id,product_name',
            'size:id,size_in_cm,size_in_mm,micron'
        ])->where('created_at', 'LIKE', '%' . Carbon::parse($request->date_filter)->toDateString() . '%')
            ->select('id', 'product_id', 'size_id', 'sqm_per_roll', 'roll_quantity', 'total_sqm', 'pallet', 'pallet_name', 'details', 'boxes')
            ->get()->each(function ($finishGood) use (&$micronCount, &$sqmPerRollCount, &$rollQuantityCount, &$totalSqmCount, &$boxesCount) {
                $micronCount = $micronCount + $finishGood->size->micron;
                $sqmPerRollCount = $sqmPerRollCount + $finishGood->sqm_per_roll;
                $rollQuantityCount = $rollQuantityCount + $finishGood->roll_quantity;
                $totalSqmCount = $totalSqmCount + $finishGood->total_sqm;
                $boxesCount = $boxesCount + $finishGood->boxes;
                return $finishGood;
            });

        return response()->json([
            'status' => 'success',
            'finishGoods' => $finishGoods,
            'micronCount' => $micronCount,
            'sqmPerRollCount' => $sqmPerRollCount,
            'rollQuantityCount' => $rollQuantityCount,
            'totalSqmCount' => $totalSqmCount,
            'boxesCount' => $boxesCount,
        ], 200);
    }
}
