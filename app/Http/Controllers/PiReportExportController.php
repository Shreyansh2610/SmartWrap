<?php

namespace App\Http\Controllers;

use App\Models\PiReportExport;
use App\Models\PiReportExportProduct;
use Illuminate\Http\Request;

class PiReportExportController extends Controller
{
    /**
     * Display a listing of the PI Reports.
     *
     * This endpoint retrieves a list of PI Reports created by the authenticated user,
     * along with their associated product details.
     *
     * @group PI Reports Export
     *
     * @response 200 {
     *  "status": "success",
     *  "piReportsExport": [
     *      {
     *          "id": "15fjl5-4f45t-5g456y-g5t",
     *          "pi_no": "PI12345",
     *          "date": "2023-06-25",
     *          "buyer_order_no": "BO12345",
     *          "buyer_order_date": "2023-06-20",
     *          "exporter_name": "Exporter A",
     *          "exporter_address": "123 Street, City, Country",
     *          "exporter_pan": "ABCDE1234F",
     *          "exporter_iec": "IEC1234567",
     *          "exporter_gst": "GST123456",
     *          "exporter_mail": "exporter@example.com",
     *          "exporter_contact_person": "John Doe",
     *          "exporter_contact_no": "1234567890",
     *          "consignee_name": "Consignee A",
     *          "consignee_address": "456 Avenue, City, Country",
     *          "consignee_country": "Country B",
     *          "consignee_mail": "consignee@example.com",
     *          "consignee_contact_person": "Jane Doe",
     *          "consignee_contact_no": "0987654321",
     *          "port_of_loading": "Port A",
     *          "port_of_discharge": "Port B",
     *          "final_destination_port": "Port C",
     *          "country_of_origin_of_goods": "Country A",
     *          "country_of_final_destination": "Country B",
     *          "total_fob_value": 1000,
     *          "freight_charges": 50,
     *          "total_cfr_value": 1050,
     *          "insurance_charges": 20,
     *          "total_cif_value": 1070,
     *          "amount_in_words": "One Thousand Seventy",
     *          "bank_name": "Bank A",
     *          "bank_address": "789 Boulevard, City, Country",
     *          "bank_account_no": "123456789012",
     *          "bank_ifsc_code": "IFSC12345",
     *          "bank_ad_code": "AD12345",
     *          "bank_swift_code": "SWIFT12345",
     *          "payment_terms": "30 days",
     *          "payment_delivery_time": "2024-05-13 17:05:06",
     *          "payment_delivery_terms": "FOB",
     *          "notes": "Special instructions",
     *          "piReportProducts": [
     *              {
     *                  "id": "12345",
     *                  "pi_report_export_id": "15fjl5-4f45t-5g456y-g5t",
     *                  "size": "Medium",
     *                  "type": "Type A",
     *                  "packaging_description": "Box",
     *                  "rolls_pallet": 10,
     *                  "no_of_pallets": 5,
     *                  "total_rolls": 50,
     *                  "container": "Container A",
     *                  "quanity": 100,
     *                  "unit": "pcs",
     *                  "rate_in_usd": 10,
     *                  "amount_in_usd": 1000
     *              }
     *          ]
     *      }
     *  ]
     * }
     */
    public function index()
    {
        $piReports = PiReportExport::where('created_by', auth()->user()->id)
            ->with([
                'piReportProducts' => function ($q) {
                    $q->select(['id', 'pi_report_export_id', 'size', 'type', 'packaging_description', 'rolls_pallet', 'no_of_pallets', 'total_rolls','container','quanity','unit','rate_in_usd','amount_in_usd']);
                }
            ])
            ->select([
                'id',
                'pi_no',
                'date',
                'buyer_order_no',
                'buyer_order_date',
                'exporter_name',
                'exporter_address',
                'exporter_pan',
                'exporter_iec',
                'exporter_gst',
                'exporter_mail',
                'exporter_contact_person',
                'exporter_contact_no',
                'consignee_name',
                'consignee_address',
                'consignee_country',
                'consignee_mail',
                'consignee_contact_person',
                'consignee_contact_no',
                'port_of_loading',
                'port_of_discharge',
                'final_destination_port',
                'country_of_origin_of_goods',
                'country_of_final_destination',
                'total_fob_value',
                'freight_charges',
                'total_cfr_value',
                'insurance_charges',
                'total_cif_value',
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
     * Show the form for creating a new PI Report.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created PI Report.
     *
     * This endpoint creates a new PI Report with the specified details and associated products.
     *
     * @group PI Reports Export
     *
     * @bodyParam pi_no string required The PI number. Example: PI12345
     * @bodyParam date date required The date of the PI. Example: 2023-06-25
     * @bodyParam buyer_order_no string required The buyer's order number. Example: BO12345
     * @bodyParam buyer_order_date date required The buyer's order date. Example: 2023-06-20
     * @bodyParam exporter_name string required The name of the exporter. Example: Exporter A
     * @bodyParam exporter_address string required The address of the exporter. Example: 123 Street, City, Country
     * @bodyParam exporter_pan string required The PAN of the exporter. Example: ABCDE1234F
     * @bodyParam exporter_iec string required The IEC of the exporter. Example: IEC1234567
     * @bodyParam exporter_gst string required The GST of the exporter. Example: GST123456
     * @bodyParam exporter_mail string required The email of the exporter. Example: exporter@example.com
     * @bodyParam exporter_contact_person string required The contact person of the exporter. Example: John Doe
     * @bodyParam exporter_contact_no string required The contact number of the exporter. Example: 1234567890
     * @bodyParam consignee_name string required The name of the consignee. Example: Consignee A
     * @bodyParam consignee_address string required The address of the consignee. Example: 456 Avenue, City, Country
     * @bodyParam consignee_country string required The country of the consignee. Example: Country B
     * @bodyParam consignee_mail string required The email of the consignee. Example: consignee@example.com
     * @bodyParam consignee_contact_person string required The contact person of the consignee. Example: Jane Doe
     * @bodyParam consignee_contact_no string required The contact number of the consignee. Example: 0987654321
     * @bodyParam port_of_loading string required The port of loading. Example: Port A
     * @bodyParam port_of_discharge string required The port of discharge. Example: Port B
     * @bodyParam final_destination_port string required The final destination port. Example: Port C
     * @bodyParam country_of_origin_of_goods string required The country of origin of the goods. Example: Country A
     * @bodyParam country_of_final_destination string required The country of final destination. Example: Country B
     * @bodyParam total_fob_value float required The total FOB value. Example: 1000.00
     * @bodyParam freight_charges float required The freight charges. Example: 50.00
     * @bodyParam total_cfr_value float required The total CFR value. Example: 1050.00
     * @bodyParam insurance_charges float required The insurance charges. Example: 20.00
     * @bodyParam total_cif_value float required The total CIF value. Example: 1070.00
     * @bodyParam amount_in_words string required The amount in words. Example: One Thousand Seventy
     * @bodyParam bank_name string required The name of the bank. Example: Bank A
     * @bodyParam bank_address string required The address of the bank. Example: 789 Boulevard, City, Country
     * @bodyParam bank_account_no string required The account number of the bank. Example: 123456789012
     * @bodyParam bank_ifsc_code string required The IFSC code of the bank. Example: IFSC12345
     * @bodyParam bank_ad_code string required The AD code of the bank. Example: AD12345
     * @bodyParam bank_swift_code string required The SWIFT code of the bank. Example: SWIFT12345
     * @bodyParam payment_terms string required The payment terms. Example: 30 days
     * @bodyParam payment_delivery_time string required The payment delivery time. Example: 2024-05-13 17:05:06
     * @bodyParam payment_delivery_terms string required The payment delivery terms. Example: FOB
     * @bodyParam notes string optional Any additional notes. Example: Special instructions
     * @bodyParam products array required The list of products associated with the PI Report.
     * @bodyParam products.*.size string required The size of the product. Example: Medium
     * @bodyParam products.*.type string required The type of the product. Example: Type A
     * @bodyParam products.*.packaging_description string required The packaging description. Example: Box
     * @bodyParam products.*.rolls_pallet integer required The number of rolls per pallet. Example: 10
     * @bodyParam products.*.no_of_pallets integer required The number of pallets. Example: 5
     * @bodyParam products.*.total_rolls integer required The total number of rolls. Example: 50
     * @bodyParam products.*.container string required The container. Example: Container A
     * @bodyParam products.*.quanity integer required The quantity. Example: 100
     * @bodyParam products.*.unit string required The unit of measurement. Example: pcs
     * @bodyParam products.*.rate_in_usd float required The rate in USD. Example: 10.00
     * @bodyParam products.*.amount_in_usd float required The amount in USD. Example: 1000.00
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "PI Report Export added successfully"
     * }
     */
    public function store(Request $request)
    {
        $piReportExport = PiReportExport::firstOrCreate([
            'pi_no' => $request->pi_no,
            'date' => $request->date,
            'buyer_order_no' => $request->buyer_order_no,
            'buyer_order_date' => $request->buyer_order_date,
            'exporter_name' => $request->exporter_name,
            'exporter_address' => $request->exporter_address,
            'exporter_pan' => $request->exporter_pan,
            'exporter_iec' => $request->exporter_iec,
            'exporter_gst' => $request->exporter_gst,
            'exporter_mail' => $request->exporter_mail,
            'exporter_contact_person' => $request->exporter_contact_person,
            'exporter_contact_no' => $request->exporter_contact_no,
            'consignee_name' => $request->consignee_name,
            'consignee_address' => $request->consignee_address,
            'consignee_country' => $request->consignee_country,
            'consignee_mail' => $request->consignee_mail,
            'consignee_contact_person' => $request->consignee_contact_person,
            'consignee_contact_no' => $request->consignee_contact_no,
            'port_of_loading' => $request->port_of_loading,
            'port_of_discharge' => $request->port_of_discharge,
            'final_destination_port' => $request->final_destination_port,
            'country_of_origin_of_goods' => $request->country_of_origin_of_goods,
            'country_of_final_destination' => $request->country_of_final_destination,
            'total_fob_value' => $request->total_fob_value,
            'freight_charges' => $request->freight_charges,
            'total_cfr_value' => $request->total_cfr_value,
            'insurance_charges' => $request->insurance_charges,
            'total_cif_value' => $request->total_cif_value,
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

        PiReportExportProduct::where('pi_report_export_id', $piReportExport->id)->delete();
        foreach ($request->products as $key => $product) {
            PiReportExportProduct::firstOrCreate([
                'pi_report_export_id' => $piReportExport->id,
                'size' => $request->size,
                'type' => $request->type,
                'packaging_description' => $request->packaging_description,
                'rolls_pallet' => $request->rolls_pallet,
                'no_of_pallets' => $request->no_of_pallets,
                'total_rolls' => $request->total_rolls,
                'container' => $request->container,
                'quanity' => $request->quanity,
                'unit' => $request->unit,
                'rate_in_usd' => $request->rate_in_usd,
                'amount_in_usd' => $request->amount_in_usd,
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'PI Report Export added successfully'], 200);
    }

    /**
     * Display the specified PI Report.
     *
     * This endpoint retrieves the details of a specific PI Report by its ID, including the associated product details.
     *
     * @group PI Reports Export
     *
     * @urlParam id string required The ID of the PI Report. Example: 15fjl5-4f45t-5g456y-g5t
     *
     * @response 200 {
     *  "status": "success",
     *  "piReportsExport": {
     *      "id": "15fjl5-4f45t-5g456y-g5t",
     *      "pi_no": "PI12345",
     *      "date": "2023-06-25",
     *      "buyer_order_no": "BO12345",
     *      "buyer_order_date": "2023-06-20",
     *      "exporter_name": "Exporter A",
     *      "exporter_address": "123 Street, City, Country",
     *      "exporter_pan": "ABCDE1234F",
     *      "exporter_iec": "IEC1234567",
     *      "exporter_gst": "GST123456",
     *      "exporter_mail": "exporter@example.com",
     *      "exporter_contact_person": "John Doe",
     *      "exporter_contact_no": "1234567890",
     *      "consignee_name": "Consignee A",
     *      "consignee_address": "456 Avenue, City, Country",
     *      "consignee_country": "Country B",
     *      "consignee_mail": "consignee@example.com",
     *      "consignee_contact_person": "Jane Doe",
     *      "consignee_contact_no": "0987654321",
     *      "port_of_loading": "Port A",
     *      "port_of_discharge": "Port B",
     *      "final_destination_port": "Port C",
     *      "country_of_origin_of_goods": "Country A",
     *      "country_of_final_destination": "Country B",
     *      "total_fob_value": 1000,
     *      "freight_charges": 50,
     *      "total_cfr_value": 1050,
     *      "insurance_charges": 20,
     *      "total_cif_value": 1070,
     *      "amount_in_words": "One Thousand Seventy",
     *      "bank_name": "Bank A",
     *      "bank_address": "789 Boulevard, City, Country",
     *      "bank_account_no": "123456789012",
     *      "bank_ifsc_code": "IFSC12345",
     *      "bank_ad_code": "AD12345",
     *      "bank_swift_code": "SWIFT12345",
     *      "payment_terms": "30 days",
     *      "payment_delivery_time": "2024-05-13 17:05:06",
     *      "payment_delivery_terms": "FOB",
     *      "notes": "Special instructions",
     *      "piReportProducts": [
     *          {
     *              "id": "12345",
     *              "pi_report_export_id": "15fjl5-4f45t-5g456y-g5t",
     *              "size": "Medium",
     *              "type": "Type A",
     *              "packaging_description": "Box",
     *              "rolls_pallet": 10,
     *              "no_of_pallets": 5,
     *              "total_rolls": 50,
     *              "container": "Container A",
     *              "quanity": 100,
     *              "unit": "pcs",
     *              "rate_in_usd": 10.00,
     *              "amount_in_usd": 1000.00
     *          }
     *      ]
     *  }
     * }
     */
    public function show(string $id)
    {
        $piReports = PiReportExport::where('created_by', auth()->user()->id)->where('pi_no', $id)
            ->with([
                'piReportProducts' => function ($q) {
                    $q->select(['id', 'pi_report_export_id', 'size', 'type', 'packaging_description', 'rolls_pallet', 'no_of_pallets', 'total_rolls', 'container', 'quanity', 'unit', 'rate_in_usd', 'amount_in_usd']);
                }
            ])
            ->select([
                'id',
                'pi_no',
                'date',
                'buyer_order_no',
                'buyer_order_date',
                'exporter_name',
                'exporter_address',
                'exporter_pan',
                'exporter_iec',
                'exporter_gst',
                'exporter_mail',
                'exporter_contact_person',
                'exporter_contact_no',
                'consignee_name',
                'consignee_address',
                'consignee_country',
                'consignee_mail',
                'consignee_contact_person',
                'consignee_contact_no',
                'port_of_loading',
                'port_of_discharge',
                'final_destination_port',
                'country_of_origin_of_goods',
                'country_of_final_destination',
                'total_fob_value',
                'freight_charges',
                'total_cfr_value',
                'insurance_charges',
                'total_cif_value',
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
     * @group PI Reports Export
     *
     * @urlParam id string required The ID of the PI Report. Example: 15fjl5-4f45t-5g456y-g5t
     *
     * @bodyParam pi_no string required The PI number. Example: PI12345
     * @bodyParam date date required The date of the PI. Example: 2023-06-25
     * @bodyParam buyer_order_no string required The buyer's order number. Example: BO12345
     * @bodyParam buyer_order_date date required The buyer's order date. Example: 2023-06-20
     * @bodyParam exporter_name string required The name of the exporter. Example: Exporter A
     * @bodyParam exporter_address string required The address of the exporter. Example: 123 Street, City, Country
     * @bodyParam exporter_pan string required The PAN of the exporter. Example: ABCDE1234F
     * @bodyParam exporter_iec string required The IEC of the exporter. Example: IEC1234567
     * @bodyParam exporter_gst string required The GST of the exporter. Example: GST123456
     * @bodyParam exporter_mail string required The email of the exporter. Example: exporter@example.com
     * @bodyParam exporter_contact_person string required The contact person of the exporter. Example: John Doe
     * @bodyParam exporter_contact_no string required The contact number of the exporter. Example: 1234567890
     * @bodyParam consignee_name string required The name of the consignee. Example: Consignee A
     * @bodyParam consignee_address string required The address of the consignee. Example: 456 Avenue, City, Country
     * @bodyParam consignee_country string required The country of the consignee. Example: Country B
     * @bodyParam consignee_mail string required The email of the consignee. Example: consignee@example.com
     * @bodyParam consignee_contact_person string required The contact person of the consignee. Example: Jane Doe
     * @bodyParam consignee_contact_no string required The contact number of the consignee. Example: 0987654321
     * @bodyParam port_of_loading string required The port of loading. Example: Port A
     * @bodyParam port_of_discharge string required The port of discharge. Example: Port B
     * @bodyParam final_destination_port string required The final destination port. Example: Port C
     * @bodyParam country_of_origin_of_goods string required The country of origin of the goods. Example: Country A
     * @bodyParam country_of_final_destination string required The country of final destination. Example: Country B
     * @bodyParam total_fob_value float required The total FOB value. Example: 1000.00
     * @bodyParam freight_charges float required The freight charges. Example: 50.00
     * @bodyParam total_cfr_value float required The total CFR value. Example: 1050.00
     * @bodyParam insurance_charges float required The insurance charges. Example: 20.00
     * @bodyParam total_cif_value float required The total CIF value. Example: 1070.00
     * @bodyParam amount_in_words string required The amount in words. Example: One Thousand Seventy
     * @bodyParam bank_name string required The name of the bank. Example: Bank A
     * @bodyParam bank_address string required The address of the bank. Example: 789 Boulevard, City, Country
     * @bodyParam bank_account_no string required The account number of the bank. Example: 123456789012
     * @bodyParam bank_ifsc_code string required The IFSC code of the bank. Example: IFSC12345
     * @bodyParam bank_ad_code string required The AD code of the bank. Example: AD12345
     * @bodyParam bank_swift_code string required The SWIFT code of the bank. Example: SWIFT12345
     * @bodyParam payment_terms string required The payment terms. Example: 30 days
     * @bodyParam payment_delivery_time string required The payment delivery time. Example: 2024-05-13 17:05:06
     * @bodyParam payment_delivery_terms string required The payment delivery terms. Example: FOB
     * @bodyParam notes string optional Any additional notes. Example: Special instructions
     * @bodyParam products array required The list of products associated with the PI Report.
     * @bodyParam products.*.size string required The size of the product. Example: Medium
     * @bodyParam products.*.type string required The type of the product. Example: Type A
     * @bodyParam products.*.packaging_description string required The packaging description. Example: Box
     * @bodyParam products.*.rolls_pallet integer required The number of rolls per pallet. Example: 10
     * @bodyParam products.*.no_of_pallets integer required The number of pallets. Example: 5
     * @bodyParam products.*.total_rolls integer required The total number of rolls. Example: 50
     * @bodyParam products.*.container string required The container. Example: Container A
     * @bodyParam products.*.quanity integer required The quantity. Example: 100
     * @bodyParam products.*.unit string required The unit of measurement. Example: pcs
     * @bodyParam products.*.rate_in_usd float required The rate in USD. Example: 10.00
     * @bodyParam products.*.amount_in_usd float required The amount in USD. Example: 1000.00
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "PI Report Export updated successfully"
     * }
     */
    public function update(Request $request, string $id)
    {
        $piReportExport = PiReportExport::where('id', $id)->update([
            'pi_no' => $request->pi_no,
            'date' => $request->date,
            'buyer_order_no' => $request->buyer_order_no,
            'buyer_order_date' => $request->buyer_order_date,
            'exporter_name' => $request->exporter_name,
            'exporter_address' => $request->exporter_address,
            'exporter_pan' => $request->exporter_pan,
            'exporter_iec' => $request->exporter_iec,
            'exporter_gst' => $request->exporter_gst,
            'exporter_mail' => $request->exporter_mail,
            'exporter_contact_person' => $request->exporter_contact_person,
            'exporter_contact_no' => $request->exporter_contact_no,
            'consignee_name' => $request->consignee_name,
            'consignee_address' => $request->consignee_address,
            'consignee_country' => $request->consignee_country,
            'consignee_mail' => $request->consignee_mail,
            'consignee_contact_person' => $request->consignee_contact_person,
            'consignee_contact_no' => $request->consignee_contact_no,
            'port_of_loading' => $request->port_of_loading,
            'port_of_discharge' => $request->port_of_discharge,
            'final_destination_port' => $request->final_destination_port,
            'country_of_origin_of_goods' => $request->country_of_origin_of_goods,
            'country_of_final_destination' => $request->country_of_final_destination,
            'total_fob_value' => $request->total_fob_value,
            'freight_charges' => $request->freight_charges,
            'total_cfr_value' => $request->total_cfr_value,
            'insurance_charges' => $request->insurance_charges,
            'total_cif_value' => $request->total_cif_value,
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

        PiReportExportProduct::where('pi_report_export_id', $id)->delete();
        foreach ($request->products as $key => $product) {
            PiReportExportProduct::firstOrCreate([
                'pi_report_export_id' => $id,
                'size' => $request->size,
                'type' => $request->type,
                'packaging_description' => $request->packaging_description,
                'rolls_pallet' => $request->rolls_pallet,
                'no_of_pallets' => $request->no_of_pallets,
                'total_rolls' => $request->total_rolls,
                'container' => $request->container,
                'quanity' => $request->quanity,
                'unit' => $request->unit,
                'rate_in_usd' => $request->rate_in_usd,
                'amount_in_usd' => $request->amount_in_usd,
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'PI Report Export updated successfully'], 200);
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
     *  "message": "PI Report Export deleted successfully"
     * }
     */
    public function destroy(string $id)
    {
        PiReportExport::where('id', $id)->delete();
        PiReportExportProduct::where('pi_report_export_id', $id)->delete();

        return response()->json(['status' => 'success', 'message' => 'PI Report Export deleted successfully'], 200);
    }
}
