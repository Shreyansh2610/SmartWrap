<?php

namespace App\Http\Controllers;

use App\Models\PoReport;
use App\Models\PoReportProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PoReportController extends Controller
{
    /**
     * Display a listing of the PO Reports.
     *
     * This endpoint returns a list of all PO Reports created by the authenticated user,
     * including associated product details.
     *
     * @group PO Reports
     *
     * @response 200 {
     *  "status": "success",
     *  "poReports": [
     *      {
     *          "id": "15fjl5-4f45t-5g456y-g5t",
     *          "po_no": "PO12345",
     *          "po_date": "2023-06-25",
     *          "quotation_no": "Q12345",
     *          "quotation_date": "2023-06-20",
     *          "buyer_name": "Buyer A",
     *          "buyer_address": "123 Street, City, Country",
     *          "buyer_pan": "ABCDE1234F",
     *          "buyer_iec": "IEC1234567",
     *          "buyer_gst": "GST123456",
     *          "buyer_mail": "buyer@example.com",
     *          "buyer_contact_person": "John Doe",
     *          "buyer_contact_no": "1234567890",
     *          "created_by": 1,
     *          "igst": 18,
     *          "sgst": 9,
     *          "cgst": 9,
     *          "total_value": 1000,
     *          "amount_in_words": "One Thousand",
     *          "notes_1": "Note 1",
     *          "notes_2": "Note 2",
     *          "notes_3": "Note 3",
     *          "notes_4": "Note 4",
     *          "poReportProducts": [
     *              {
     *                  "id": "12345jl5-4f45t-5g45",
     *                  "po_report_id": "15fjl5-4f45t-5g456y-g5t",
     *                  "product_description": "Product A",
     *                  "hsn_code": "1234",
     *                  "quantity": 10,
     *                  "unit": "pcs",
     *                  "rate": 100,
     *                  "amount": 1000
     *              }
     *          ]
     *      }
     *  ]
     * }
     */
    public function index(Request $request)
    {
        $poReports = PoReport::where('created_by', auth()->user()->id)
            ->with([
                'poReportProducts' => function ($q) {
                    $q->select(['id', 'po_report_id', 'product_description', 'hsn_code', 'quantity', 'unit', 'rate', 'amount']);
                }
            ])
            ->select([
                'id',
                'po_no',
                'po_date',
                'quotation_no',
                'quotation_date',
                'buyer_name',
                'buyer_address',
                'buyer_pan',
                'buyer_iec',
                'buyer_gst',
                'buyer_mail',
                'buyer_contact_person',
                'buyer_contact_no',
                'created_by',
                'igst',
                'sgst',
                'cgst',
                'total_value',
                'amount_in_words',
                'notes_1',
                'notes_2',
                'notes_3',
                'notes_4',
            ])
            ->get();

        return response()->json(['status' => 'success', 'poReports' => $poReports], 200);
    }

    /**
     * Show the form for creating a new PO Report.
     *
     * This endpoint displays a form for creating a new PO Report.
     *
     * @group PO Reports
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Form displayed successfully."
     * }
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created PO Report in storage.
     *
     * This endpoint allows for the creation of a new PO Report along with its associated product details.
     *
     * @group PO Reports
     *
     * @bodyParam po_no string required The PO number.
     * @bodyParam po_date date required The date of the PO.
     * @bodyParam quotation_no string required The quotation number.
     * @bodyParam quotation_date date required The date of the quotation.
     * @bodyParam buyer_name string required The name of the buyer.
     * @bodyParam buyer_address string required The address of the buyer.
     * @bodyParam buyer_pan string required The PAN of the buyer.
     * @bodyParam buyer_iec string required The IEC of the buyer.
     * @bodyParam buyer_gst string required The GST number of the buyer.
     * @bodyParam buyer_mail string required The email of the buyer.
     * @bodyParam buyer_contact_person string required The contact person of the buyer.
     * @bodyParam buyer_contact_no string required The contact number of the buyer.
     * @bodyParam igst numeric required The IGST amount.
     * @bodyParam sgst numeric required The SGST amount.
     * @bodyParam cgst numeric required The CGST amount.
     * @bodyParam total_value numeric required The total value of the PO.
     * @bodyParam amount_in_words string required The total value in words.
     * @bodyParam notes_1 string optional Additional notes 1.
     * @bodyParam notes_2 string optional Additional notes 2.
     * @bodyParam notes_3 string optional Additional notes 3.
     * @bodyParam notes_4 string optional Additional notes 4.
     * @bodyParam products array required The array of product details.
     * @bodyParam products.*.product_description string required The description of the product.
     * @bodyParam products.*.hsn_code string required The HSN code of the product.
     * @bodyParam products.*.quantity numeric required The quantity of the product.
     * @bodyParam products.*.unit string required The unit of the product.
     * @bodyParam products.*.rate numeric required The rate of the product.
     * @bodyParam products.*.amount numeric required The amount of the product.
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "PO Report added successfully."
     * }
     *
     * @response 422 {
     *  "status": "error",
     *  "errors": {
     *      "po_no": ["The PO number is required."],
     *      "po_date": ["The PO date is required."],
     *      ...
     *  }
     * }
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'po_no' => 'required',
                'po_date' => 'required',
                'quotation_no' => 'required',
                'quotation_date' => 'required',
                'buyer_name' => 'required',
                'buyer_address' => 'required',
                'buyer_pan' => 'required',
                'buyer_iec' => 'required',
                'buyer_gst' => 'required',
                'buyer_mail' => 'required',
                'buyer_contact_person' => 'required',
                'buyer_contact_no' => 'required',
                'igst' => 'required',
                'sgst' => 'required',
                'cgst' => 'required',
                'total_value' => 'required',
                'amount_in_words' => 'required',
                'products.*.product_description' => 'required',
                'products.*.hsn_code' => 'required',
                'products.*.quantity' => 'required',
                'products.*.unit' => 'required',
                'products.*.rate' => 'required',
                'products.*.amount' => 'required',
            ],
            [
                'required' => ':attribute is required',
                'numeric' => ':attribute must be numeric',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $poReport = PoReport::firstOrCreate([
            'po_no' => $request->po_no,
            'po_date' => $request->po_date,
            'quotation_no' => $request->quotation_no,
            'quotation_date' => $request->quotation_date,
            'buyer_name' => $request->buyer_name,
            'buyer_address' => $request->buyer_address,
            'buyer_pan' => $request->buyer_pan,
            'buyer_iec' => $request->buyer_iec,
            'buyer_gst' => $request->buyer_gst,
            'buyer_mail' => $request->buyer_mail,
            'buyer_contact_person' => $request->buyer_contact_person,
            'buyer_contact_no' => $request->buyer_contact_no,
            'igst' => $request->igst,
            'sgst' => $request->sgst,
            'cgst' => $request->cgst,
            'total_value' => $request->total_value,
            'amount_in_words' => $request->amount_in_words,
            'notes_1' => $request->notes_1,
            'notes_2' => $request->notes_2,
            'notes_3' => $request->notes_3,
            'notes_4' => $request->notes_4,
            'created_by' => auth()->user()->id,
        ]);

        foreach ($request->products as $key => $product) {
            PoReportProduct::firstOrCreate([
                'po_report_id' => $poReport->id,
                'product_description' => $product['product_description'],
                'hsn_code' => $product['hsn_code'],
                'quantity' => $product['quantity'],
                'unit' => $product['unit'],
                'rate' => $product['rate'],
                'amount' => $product['amount'],
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'PO Report added successfully'], 200);
    }

    /**
     * Display the specified PO Report.
     *
     * This endpoint returns the details of a specific PO Report by its PO number,
     * including associated product details.
     *
     * @group PO Reports
     *
     * @queryParam po_no string required The PO number of the PO Report.
     *
     * @response 200 {
     *  "status": "success",
     *  "poReports": {
     *      "id": "15fjl5-4f45t-5g456y-g5t",
     *      "po_no": "PO12345",
     *      "po_date": "2023-06-25",
     *      "quotation_no": "Q12345",
     *      "quotation_date": "2023-06-20",
     *      "buyer_name": "Buyer A",
     *      "buyer_address": "123 Street, City, Country",
     *      "buyer_pan": "ABCDE1234F",
     *      "buyer_iec": "IEC1234567",
     *      "buyer_gst": "GST123456",
     *      "buyer_mail": "buyer@example.com",
     *      "buyer_contact_person": "John Doe",
     *      "buyer_contact_no": "1234567890",
     *      "created_by": 1,
     *      "igst": 18,
     *      "sgst": 9,
     *      "cgst": 9,
     *      "total_value": 1000,
     *      "amount_in_words": "One Thousand",
     *      "notes_1": "Note 1",
     *      "notes_2": "Note 2",
     *      "notes_3": "Note 3",
     *      "notes_4": "Note 4",
     *      "poReportProducts": [
     *          {
     *              "id": "12345",
     *              "po_report_id": "15fjl5-4f45t-5g456y-g5t",
     *              "product_description": "Product A",
     *              "hsn_code": "1234",
     *              "quantity": 10,
     *              "unit": "pcs",
     *              "rate": 100,
     *              "amount": 1000
     *          }
     *      ]
     *  }
     * }
     */
    public function show(Request $request)
    {
        $poReports = PoReport::where(['created_by' => auth()->user()->id, 'po_no' => $request->po_no])
            ->with([
                'poReportProducts' => function ($q) {
                    $q->select(['id', 'po_report_id', 'product_description', 'hsn_code', 'quantity', 'unit', 'rate', 'amount']);
                }
            ])
            ->select([
                'id',
                'po_no',
                'po_date',
                'quotation_no',
                'quotation_date',
                'buyer_name',
                'buyer_address',
                'buyer_pan',
                'buyer_iec',
                'buyer_gst',
                'buyer_mail',
                'buyer_contact_person',
                'buyer_contact_no',
                'created_by',
                'igst',
                'sgst',
                'cgst',
                'total_value',
                'amount_in_words',
                'notes_1',
                'notes_2',
                'notes_3',
                'notes_4',
            ])
            ->first();

        return response()->json(['status' => 'success', 'poReports' => $poReports], 200);
    }

    /**
     * Show the form for editing the specified PO Report.
     *
     * This endpoint displays a form for editing a specific PO Report by its ID.
     *
     * @group PO Reports
     *
     * @urlParam id string required The ID of the PO Report.
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Form displayed successfully."
     * }
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified PO Report in storage.
     *
     * This endpoint allows for updating a specific PO Report by its ID,
     * including associated product details.
     *
     * @group PO Reports
     *
     * @urlParam id string required The ID of the PO Report.
     *
     * @bodyParam po_no string required The PO number.
     * @bodyParam po_date date required The date of the PO.
     * @bodyParam quotation_no string required The quotation number.
     * @bodyParam quotation_date date required The date of the quotation.
     * @bodyParam buyer_name string required The name of the buyer.
     * @bodyParam buyer_address string required The address of the buyer.
     * @bodyParam buyer_pan string required The PAN of the buyer.
     * @bodyParam buyer_iec string required The IEC of the buyer.
     * @bodyParam buyer_gst string required The GST number of the buyer.
     * @bodyParam buyer_mail string required The email of the buyer.
     * @bodyParam buyer_contact_person string required The contact person of the buyer.
     * @bodyParam buyer_contact_no string required The contact number of the buyer.
     * @bodyParam igst numeric required The IGST amount.
     * @bodyParam sgst numeric required The SGST amount.
     * @bodyParam cgst numeric required The CGST amount.
     * @bodyParam total_value numeric required The total value of the PO.
     * @bodyParam amount_in_words string required The total value in words.
     * @bodyParam notes_1 string optional Additional notes 1.
     * @bodyParam notes_2 string optional Additional notes 2.
     * @bodyParam notes_3 string optional Additional notes 3.
     * @bodyParam notes_4 string optional Additional notes 4.
     * @bodyParam products array required The array of product details.
     * @bodyParam products.*.product_description string required The description of the product.
     * @bodyParam products.*.hsn_code string required The HSN code of the product.
     * @bodyParam products.*.quantity numeric required The quantity of the product.
     * @bodyParam products.*.unit string required The unit of the product.
     * @bodyParam products.*.rate numeric required The rate of the product.
     * @bodyParam products.*.amount numeric required The amount of the product.
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "PO Report updated successfully."
     * }
     *
     * @response 422 {
     *  "status": "error",
     *  "errors": {
     *      "po_no": ["The PO number is required."],
     *      "po_date": ["The PO date is required."],
     *      ...
     *  }
     * }
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'po_no' => 'required',
                'po_date' => 'required',
                'quotation_no' => 'required',
                'quotation_date' => 'required',
                'buyer_name' => 'required',
                'buyer_address' => 'required',
                'buyer_pan' => 'required',
                'buyer_iec' => 'required',
                'buyer_gst' => 'required',
                'buyer_mail' => 'required',
                'buyer_contact_person' => 'required',
                'buyer_contact_no' => 'required',
                'igst' => 'required',
                'sgst' => 'required',
                'cgst' => 'required',
                'total_value' => 'required',
                'amount_in_words' => 'required',
                'products.*.product_description' => 'required',
                'products.*.hsn_code' => 'required',
                'products.*.quantity' => 'required',
                'products.*.unit' => 'required',
                'products.*.rate' => 'required',
                'products.*.amount' => 'required',
            ],
            [
                'required' => ':attribute is required',
                'numeric' => ':attribute must be numeric',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $poReport = PoReport::find($id)->update([
            'po_no' => $request->po_no,
            'po_date' => $request->po_date,
            'quotation_no' => $request->quotation_no,
            'quotation_date' => $request->quotation_date,
            'buyer_name' => $request->buyer_name,
            'buyer_address' => $request->buyer_address,
            'buyer_pan' => $request->buyer_pan,
            'buyer_iec' => $request->buyer_iec,
            'buyer_gst' => $request->buyer_gst,
            'buyer_mail' => $request->buyer_mail,
            'buyer_contact_person' => $request->buyer_contact_person,
            'buyer_contact_no' => $request->buyer_contact_no,
            'igst' => $request->igst,
            'sgst' => $request->sgst,
            'cgst' => $request->cgst,
            'total_value' => $request->total_value,
            'amount_in_words' => $request->amount_in_words,
            'notes_1' => $request->notes_1,
            'notes_2' => $request->notes_2,
            'notes_3' => $request->notes_3,
            'notes_4' => $request->notes_4,
        ]);

        PoReportProduct::where(['po_report_id' => $poReport->id])->delete();
        foreach ($request->products as $key => $product) {
            PoReportProduct::firstOrCreate([
                'po_report_id' => $poReport->id,
                'product_description' => $product['product_description'],
                'hsn_code' => $product['hsn_code'],
                'quantity' => $product['quantity'],
                'unit' => $product['unit'],
                'rate' => $product['rate'],
                'amount' => $product['amount'],
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'PO Report updated successfully'], 200);
    }

    /**
     * Remove the specified PO Report from storage.
     *
     * This endpoint deletes a specific PO Report by its ID,
     * including associated product details.
     *
     * @group PO Reports
     *
     * @urlParam id string required The ID of the PO Report.
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "PO Report deleted successfully."
     * }
     */
    public function destroy(string $id)
    {
        PoReportProduct::where(['po_report_id' => $id])->delete();
        PoReport::find($id)->delete();

        return response()->json(['status' => 'success', 'message' => 'PO Report deleted successfully'], 200);
    }
}
