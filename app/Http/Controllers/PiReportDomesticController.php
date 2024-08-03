<?php

namespace App\Http\Controllers;

use App\Models\PiReportDomestic;
use App\Models\PiReportDomesticPrduct;
use Illuminate\Http\Request;

class PiReportDomesticController extends Controller
{
    /**
     * @group PI Reports Domestic
     *
     * Display the get all PI Report Domestic resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @response 200 {
     *     "status": "success",
     *     "piReportsExport": [
     *      {
     *         "id": 1xv5-545g7-5tgr,
     *         "pi_no": "PI001",
     *         "date": "2023-01-01",
     *         "buyer_order_no": "BO123",
     *         "buyer_order_date": "2022-12-15",
     *         "supplier_name": "Supplier Inc.",
     *         "supplier_address": "123 Supplier St.",
     *         "supplier_pan": "ABCDE1234F",
     *         "supplier_gst": "29ABCDE1234F1Z5",
     *         "exporter_gst": "27ABCDE1234F1Z1",
     *         "supplier_mail": "supplier@example.com",
     *         "supplier_contact_person": "John Doe",
     *         "supplier_contact_no": "1234567890",
     *         "consignee_name": "Consignee Ltd.",
     *         "consignee_address": "456 Consignee Rd.",
     *         "consignee_pan": "FGHIJ5678K",
     *         "consignee_iec": "0306060070",
     *         "consignee_gst": "24FGHIJ5678K1Z2",
     *         "consignee_mail": "consignee@example.com",
     *         "consignee_contact_person": "Jane Smith",
     *         "consignee_contact_no": "0987654321",
     *         "igst": 18,
     *         "sgst": 9,
     *         "cgst": 9,
     *         "total_fob_value": 10000.00,
     *         "amount_in_words": "Ten Thousand Only",
     *         "bank_name": "Bank of Export",
     *         "bank_address": "789 Bank St.",
     *         "bank_account_no": "123456789012",
     *         "bank_ifsc_code": "BKID0001234",
     *         "bank_ad_code": "AD1234567890",
     *         "bank_swift_code": "BKIDINBBXXX",
     *         "payment_terms": "Net 30 days",
     *         "payment_delivery_time": "2024-08-25 14:16:56",
     *         "payment_delivery_terms": "FOB",
     *         "notes": "Urgent delivery required.",
     *         "piReportProducts": [
     *             {
     *                 "id": 1,
     *                 "pi_report_domestic_id": 1,
     *                 "description": "Product A",
     *                 "hsn_code": "1001",
     *                 "no_of_box": 10,
     *                 "quantity": 100,
     *                 "unit": 5,  // Number of units
     *                 "rate": 100.00,
     *                 "amount": 10000.00
     *             }
     *         ]
     *     },
     *      ...
     *     ]
     * }
     */
    public function index()
    {
        $piReports = PiReportDomestic::where('created_by', auth()->user()->id)
            ->with([
                'piReportProducts' => function ($q) {
                    $q->select(['id', 'pi_report_domestic_id', 'description', 'hsn_code', 'no_of_box', 'quantity', 'unit', 'rate','amount']);
                }
            ])
            ->select([
                'id',
                'pi_no',
                'date',
                'buyer_order_no',
                'buyer_order_date',
                'supplier_name',
                'supplier_address',
                'supplier_pan',
                'supplier_gst',
                'exporter_gst',
                'supplier_mail',
                'supplier_contact_person',
                'supplier_contact_no',
                'consignee_name',
                'consignee_address',
                'consignee_pan',
                'consignee_iec',
                'consignee_gst',
                'consignee_mail',
                'consignee_contact_person',
                'consignee_contact_no',
                'igst',
                'sgst',
                'cgst',
                'total_fob_value',
                'amount_in_words',
                'bank_name',
                'bank_address',
                'bank_account_no',
                'bank_ifsc_code',
                'bank_ad_code',
                'bank_swift_code',
                'payment_terms',
                'payment_delivery_time',
                'payment_delivery_terms',
                'notes',
            ])
            ->get();

        return response()->json(['status' => 'success', 'piReportsExport' => $piReports], 200);
    }


    /**
     * Store the specified PI Report.
     *
     * This endpoint stores the details of a specific PI Report.
     *
     * @group PI Reports Domestic
     *
     * @urlParam id string required The ID of the PI Report. Example: 15fjl5-4f45t-5g456y-g5t
     *
     * @bodyParam pi_no string required The PI number. Example: PI001
     * @bodyParam date string required The date of the PI report in YYYY-MM-DD format. Example: 2023-01-01
     * @bodyParam buyer_order_no string required The buyer order number. Example: BO123
     * @bodyParam buyer_order_date string required The date of the buyer order in YYYY-MM-DD format. Example: 2022-12-15
     * @bodyParam supplier_name string required The name of the supplier. Example: Supplier Inc.
     * @bodyParam supplier_address string required The address of the supplier. Example: 123 Supplier St.
     * @bodyParam supplier_pan string required The PAN number of the supplier. Example: ABCDE1234F
     * @bodyParam supplier_gst string required The GST number of the supplier. Example: 29ABCDE1234F1Z5
     * @bodyParam supplier_mail string required The email of the supplier. Example: supplier@example.com
     * @bodyParam supplier_contact_person string required The contact person of the supplier. Example: John Doe
     * @bodyParam supplier_contact_no string required The contact number of the supplier. Example: 1234567890
     * @bodyParam consignee_name string required The name of the consignee. Example: Consignee Ltd.
     * @bodyParam consignee_address string required The address of the consignee. Example: 456 Consignee Rd.
     * @bodyParam consignee_pan string required The PAN number of the consignee. Example: FGHIJ5678K
     * @bodyParam consignee_iec string required The IEC code of the consignee. Example: 0306060070
     * @bodyParam consignee_gst string required The GST number of the consignee. Example: 24FGHIJ5678K1Z2
     * @bodyParam consignee_mail string required The email of the consignee. Example: consignee@example.com
     * @bodyParam consignee_contact_person string required The contact person of the consignee. Example: Jane Smith
     * @bodyParam consignee_contact_no string required The contact number of the consignee. Example: 0987654321
     * @bodyParam igst string required The IGST percentage. Example: 18
     * @bodyParam sgst string required The SGST percentage. Example: 9
     * @bodyParam cgst string required The CGST percentage. Example: 9
     * @bodyParam total_fob_value numeric required The total FOB value of the report. Example: 10000.00
     * @bodyParam amount_in_words string required The total amount in words. Example: Ten Thousand Only
     * @bodyParam bank_name string required The name of the bank. Example: Bank of Export
     * @bodyParam bank_address string required The address of the bank. Example: 789 Bank St.
     * @bodyParam bank_account_no string required The bank account number. Example: 123456789012
     * @bodyParam bank_ifsc_code string required The bank IFSC code. Example: BKID0001234
     * @bodyParam bank_ad_code string required The bank AD code. Example: AD1234567890
     * @bodyParam bank_swift_code string required The bank SWIFT code. Example: BKIDINBBXXX
     * @bodyParam payment_terms string required The payment terms. Example: Net 30 days
     * @bodyParam payment_delivery_time string required The delivery time. Example: 2024-05-11 14:15:03
     * @bodyParam payment_delivery_terms string required The delivery terms. Example: FOB
     * @bodyParam notes string optional Any additional notes. Example: Urgent delivery required.
     * @bodyParam products array required List of products included in the report. Example: [{"description": "Product A", "hsn_code": "1001", "no_of_box": 10, "quantity": 100, "unit": 5, "rate_in_usd": 100.00, "amount": 10000.00}]

     *
     * @response 200 {
     *  "status": "success",
     *  "message": "PI Report Export added successfully"
     * }
     */
    public function store(Request $request)
    {
        $piReportDomestic = PiReportDomestic::firstOrCreate([
            'pi_no' => $request->pi_no,
            'date' => $request->date,
            'buyer_order_no' => $request->buyer_order_no,
            'buyer_order_date' => $request->buyer_order_date,
            'supplier_name' => $request->supplier_name,
            'supplier_address' => $request->supplier_address,
            'supplier_pan' => $request->supplier_pan,
            'supplier_gst' => $request->supplier_gst,
            'supplier_mail' => $request->supplier_mail,
            'supplier_contact_person' => $request->supplier_contact_person,
            'supplier_contact_no' => $request->supplier_contact_no,
            'consignee_name' => $request->consignee_name,
            'consignee_address' => $request->consignee_address,
            'consignee_pan' => $request->consignee_pan,
            'consignee_iec' => $request->consignee_iec,
            'consignee_gst' => $request->consignee_gst,
            'consignee_mail' => $request->consignee_mail,
            'consignee_contact_person' => $request->consignee_contact_person,
            'consignee_contact_no' => $request->consignee_contact_no,
            'igst' => $request->igst,
            'sgst' => $request->sgst,
            'cgst' => $request->cgst,
            'total_fob_value' => $request->total_fob_value,
            'amount_in_words' => $request->amount_in_words,
            'bank_name' => $request->bank_name,
            'bank_address' => $request->bank_address,
            'bank_account_no' => $request->bank_account_no,
            'bank_ifsc_code' => $request->bank_ifsc_code,
            'bank_ad_code' => $request->bank_ad_code,
            'bank_swift_code' => $request->bank_swift_code,
            'payment_terms' => $request->payment_terms,
            'payment_delivery_time' => $request->payment_delivery_time,
            'payment_delivery_terms' => $request->payment_delivery_terms,
            'notes' => !empty($request->notes) ? json_encode($request->notes) : null,
        ]);

        PiReportDomesticPrduct::where('pi_report_export_id', $piReportDomestic->id)->delete();
        foreach ($request->products as $key => $product) {
            PiReportDomesticPrduct::firstOrCreate([
                'pi_report_domestic_id' => $piReportDomestic->id,
                'description' => $request->description,
                'hsn_code' => $request->hsn_code,
                'no_of_box' => $request->no_of_box,
                'quantity' => $request->quantity,
                'unit' => $request->unit,
                'rate' => $request->rate_in_usd,
                'amount' => $request->amount,
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'PI Report Domestic added successfully'], 200);
    }

    /**
     * @group PI Reports Domestic
     *
     * Display the specified PI Report Domestic resource.
     *
     * @bodyParam pi_no string to get value. Example: PI654
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @response 200 {
     *     "status": "success",
     *     "piReportsExport": {
     *         "id": 1xv5-545g7-5tgr,
     *         "pi_no": "PI001",
     *         "date": "2023-01-01",
     *         "buyer_order_no": "BO123",
     *         "buyer_order_date": "2022-12-15",
     *         "supplier_name": "Supplier Inc.",
     *         "supplier_address": "123 Supplier St.",
     *         "supplier_pan": "ABCDE1234F",
     *         "supplier_gst": "29ABCDE1234F1Z5",
     *         "exporter_gst": "27ABCDE1234F1Z1",
     *         "supplier_mail": "supplier@example.com",
     *         "supplier_contact_person": "John Doe",
     *         "supplier_contact_no": "1234567890",
     *         "consignee_name": "Consignee Ltd.",
     *         "consignee_address": "456 Consignee Rd.",
     *         "consignee_pan": "FGHIJ5678K",
     *         "consignee_iec": "0306060070",
     *         "consignee_gst": "24FGHIJ5678K1Z2",
     *         "consignee_mail": "consignee@example.com",
     *         "consignee_contact_person": "Jane Smith",
     *         "consignee_contact_no": "0987654321",
     *         "igst": 18,
     *         "sgst": 9,
     *         "cgst": 9,
     *         "total_fob_value": 10000.00,
     *         "amount_in_words": "Ten Thousand Only",
     *         "bank_name": "Bank of Export",
     *         "bank_address": "789 Bank St.",
     *         "bank_account_no": "123456789012",
     *         "bank_ifsc_code": "BKID0001234",
     *         "bank_ad_code": "AD1234567890",
     *         "bank_swift_code": "BKIDINBBXXX",
     *         "payment_terms": "Net 30 days",
     *         "payment_delivery_time": "2024-08-25 14:16:56",
     *         "payment_delivery_terms": "FOB",
     *         "notes": "Urgent delivery required.",
     *         "piReportProducts": [
     *             {
     *                 "id": 1,
     *                 "pi_report_domestic_id": 1,
     *                 "description": "Product A",
     *                 "hsn_code": "1001",
     *                 "no_of_box": 10,
     *                 "quantity": 100,
     *                 "unit": 5,  // Number of units
     *                 "rate": 100.00,
     *                 "amount": 10000.00
     *             }
     *         ]
     *     }
     * }
     */
    public function show(Request $request, $id)
    {
        $piReports = PiReportDomestic::where('created_by', auth()->user()->id)->where('pi_no', $request->pi_no)
            ->with([
                'piReportProducts' => function ($q) {
                    $q->select(['id', 'pi_report_domestic_id', 'description', 'hsn_code', 'no_of_box', 'quantity', 'unit', 'rate','amount']);
                }
            ])
            ->select([
                'id',
                'pi_no',
                'date',
                'buyer_order_no',
                'buyer_order_date',
                'supplier_name',
                'supplier_address',
                'supplier_pan',
                'supplier_gst',
                'exporter_gst',
                'supplier_mail',
                'supplier_contact_person',
                'supplier_contact_no',
                'consignee_name',
                'consignee_address',
                'consignee_pan',
                'consignee_iec',
                'consignee_gst',
                'consignee_mail',
                'consignee_contact_person',
                'consignee_contact_no',
                'igst',
                'sgst',
                'cgst',
                'total_fob_value',
                'amount_in_words',
                'bank_name',
                'bank_address',
                'bank_account_no',
                'bank_ifsc_code',
                'bank_ad_code',
                'bank_swift_code',
                'payment_terms',
                'payment_delivery_time',
                'payment_delivery_terms',
                'notes',
            ])
            ->first();

        return response()->json(['status' => 'success', 'piReportsExport' => $piReports], 200);
    }


    /**
     * Update the specified PI Report.
     *
     * This endpoint updates the details of a specific PI Report by its ID.
     *
     * @group PI Reports Domestic
     *
     * @urlParam id string required The ID of the PI Report. Example: 15fjl5-4f45t-5g456y-g5t
     *
     * @bodyParam pi_no string required The PI number. Example: PI001
     * @bodyParam date string required The date of the PI report in YYYY-MM-DD format. Example: 2023-01-01
     * @bodyParam buyer_order_no string required The buyer order number. Example: BO123
     * @bodyParam buyer_order_date string required The date of the buyer order in YYYY-MM-DD format. Example: 2022-12-15
     * @bodyParam supplier_name string required The name of the supplier. Example: Supplier Inc.
     * @bodyParam supplier_address string required The address of the supplier. Example: 123 Supplier St.
     * @bodyParam supplier_pan string required The PAN number of the supplier. Example: ABCDE1234F
     * @bodyParam supplier_gst string required The GST number of the supplier. Example: 29ABCDE1234F1Z5
     * @bodyParam supplier_mail string required The email of the supplier. Example: supplier@example.com
     * @bodyParam supplier_contact_person string required The contact person of the supplier. Example: John Doe
     * @bodyParam supplier_contact_no string required The contact number of the supplier. Example: 1234567890
     * @bodyParam consignee_name string required The name of the consignee. Example: Consignee Ltd.
     * @bodyParam consignee_address string required The address of the consignee. Example: 456 Consignee Rd.
     * @bodyParam consignee_pan string required The PAN number of the consignee. Example: FGHIJ5678K
     * @bodyParam consignee_iec string required The IEC code of the consignee. Example: 0306060070
     * @bodyParam consignee_gst string required The GST number of the consignee. Example: 24FGHIJ5678K1Z2
     * @bodyParam consignee_mail string required The email of the consignee. Example: consignee@example.com
     * @bodyParam consignee_contact_person string required The contact person of the consignee. Example: Jane Smith
     * @bodyParam consignee_contact_no string required The contact number of the consignee. Example: 0987654321
     * @bodyParam igst string required The IGST percentage. Example: 18
     * @bodyParam sgst string required The SGST percentage. Example: 9
     * @bodyParam cgst string required The CGST percentage. Example: 9
     * @bodyParam total_fob_value numeric required The total FOB value of the report. Example: 10000.00
     * @bodyParam amount_in_words string required The total amount in words. Example: Ten Thousand Only
     * @bodyParam bank_name string required The name of the bank. Example: Bank of Export
     * @bodyParam bank_address string required The address of the bank. Example: 789 Bank St.
     * @bodyParam bank_account_no string required The bank account number. Example: 123456789012
     * @bodyParam bank_ifsc_code string required The bank IFSC code. Example: BKID0001234
     * @bodyParam bank_ad_code string required The bank AD code. Example: AD1234567890
     * @bodyParam bank_swift_code string required The bank SWIFT code. Example: BKIDINBBXXX
     * @bodyParam payment_terms string required The payment terms. Example: Net 30 days
     * @bodyParam payment_delivery_time string required The delivery time. Example: 2024-05-11 14:15:03
     * @bodyParam payment_delivery_terms string required The delivery terms. Example: FOB
     * @bodyParam notes string optional Any additional notes. Example: Urgent delivery required.
     * @bodyParam products array required List of products included in the report. Example: [{"description": "Product A", "hsn_code": "1001", "no_of_box": 10, "quantity": 100, "unit": 5, "rate_in_usd": 100.00, "amount": 10000.00}]

     *
     * @response 200 {
     *  "status": "success",
     *  "message": "PI Report Export updated successfully"
     * }
     */
    public function update(Request $request, string $id)
    {
        $piReportDomestic = PiReportDomestic::firstOrCreate([
            'pi_no' => $request->pi_no,
            'date' => $request->date,
            'buyer_order_no' => $request->buyer_order_no,
            'buyer_order_date' => $request->buyer_order_date,
            'supplier_name' => $request->supplier_name,
            'supplier_address' => $request->supplier_address,
            'supplier_pan' => $request->supplier_pan,
            'supplier_gst' => $request->supplier_gst,
            'supplier_mail' => $request->supplier_mail,
            'supplier_contact_person' => $request->supplier_contact_person,
            'supplier_contact_no' => $request->supplier_contact_no,
            'consignee_name' => $request->consignee_name,
            'consignee_address' => $request->consignee_address,
            'consignee_pan' => $request->consignee_pan,
            'consignee_iec' => $request->consignee_iec,
            'consignee_gst' => $request->consignee_gst,
            'consignee_mail' => $request->consignee_mail,
            'consignee_contact_person' => $request->consignee_contact_person,
            'consignee_contact_no' => $request->consignee_contact_no,
            'igst' => $request->igst,
            'sgst' => $request->sgst,
            'cgst' => $request->cgst,
            'total_fob_value' => $request->total_fob_value,
            'amount_in_words' => $request->amount_in_words,
            'bank_name' => $request->bank_name,
            'bank_address' => $request->bank_address,
            'bank_account_no' => $request->bank_account_no,
            'bank_ifsc_code' => $request->bank_ifsc_code,
            'bank_ad_code' => $request->bank_ad_code,
            'bank_swift_code' => $request->bank_swift_code,
            'payment_terms' => $request->payment_terms,
            'payment_delivery_time' => $request->payment_delivery_time,
            'payment_delivery_terms' => $request->payment_delivery_terms,
            'notes' => !empty($request->notes) ? json_encode($request->notes) : null,
        ]);

        PiReportDomesticPrduct::where('pi_report_domestic_id', $piReportDomestic->id)->delete();
        foreach ($request->products as $key => $product) {
            PiReportDomesticPrduct::firstOrCreate([
                'pi_report_domestic_id' => $piReportDomestic->id,
                'description' => $request->description,
                'hsn_code' => $request->hsn_code,
                'no_of_box' => $request->no_of_box,
                'quantity' => $request->quantity,
                'unit' => $request->unit,
                'rate' => $request->rate_in_usd,
                'amount' => $request->amount,
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'PI Report Domestic updated successfully'], 200);
    }

    /**
     * Remove the specified PI Report.
     *
     * This endpoint deletes a specific PI Report by its ID.
     *
     * @group PI Reports Export
     *
     * @urlParam id string required The ID of the PI Report. Example: 15fjl5-4f45t-5g456y-g5t
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "PI Report Domestic deleted successfully"
     * }
     */
    public function destroy(string $id)
    {
        PiReportDomestic::where('id', $id)->delete();
        PiReportDomesticPrduct::where('pi_report_domestic_id', $id)->delete();

        return response()->json(['status' => 'success', 'message' => 'PI Report Domestic deleted successfully'], 200);
    }
}
