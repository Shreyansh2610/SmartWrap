<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;

class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Get company profile details.
     *  variable is like small case and replace space with underscore. Use "/upload/file_name" path for company logo and signature.
     * @group Company Profile
     *
     * @response 200 {
     *  "status": "success",
     *  "comapny_profile":[
     *      {
     *          "id": 1dkjvskj-dnjdj-xnxskj,
     *          "company_name": "Sample Company Ltd.",
     *          "contact_person_name":"Ashish Patel",
     *          "otp_mobile_phone":"08796543210",
     *          "mobile":"08796543210",
     *          "email":"abc@gmail.com",
     *          "phone_no":"7896513",
     *          "fax_no":"08796543210",
     *          "website":"http://www.samplecompany.com",
     *          "company_register":"Register123",
     *          "address":"Rajkot, Gujarat, India - 360004.",
     *          "portal_address":"http://portal.samplecompany.com",
     *          "company_type":"Private Limited",
     *          "gst_no":"GSTIN123456789",
     *          "lut_no":"LUT12345",
     *          "cin":"CIN123456789",
     *          "gst_circular_no":"CIRC123456789",
     *          "state_code":"SC",
     *          "lei_no":"LEI1234567890",
     *          "field_3":"Value3",
     *          "pan_no":"PAN123456789",
     *          "lut_expiry":"2025-12-31",
     *          "rcmc_no": "RCMC123456",
     *          "date_of_filling_rex_number": "2024-06-25",
     *          "field_1": "Value1",
     *          "field_4": "Value4",
     *          "iec_no": "IEC123456789",
     *          "bin_no": "BIN123456",
     *          "rcmc_expiry": "2026-12-31",
     *          "circular_no": "CIRC789456123",
     *          "aeo_no": "AEO123456",
     *          "field_2": "Value2",
     *          "field_5": "Value5",
     *          "pre_carriage_by": "Road",
     *          "state_of_origin": "Sample State",
     *          "delivery_period": "30 days",
     *          "terms_of_delivery": "FOB",
     *          "place_of_receipt": "Sample Port",
     *          "part_of_loading": "Loading Dock A",
     *          "partial_shipement": "No",
     *          "district_of_origin": "Sample District",
     *          "trans_shipement": "No",
     *          "variety_of_quality": "Premium",
     *          "company_logo": "sample_logo.png",
     *          "signature_upload": "signature.png",
     *          "range": "Range 1",
     *          "division": "Division A",
     *          "commissionerate": "Commissionerate 1",
     *          "location_code": "LOC123",
     *          "annexure_remark": "N/A",
     *          "shipper_name": "Sample Shipper",
     *          "method_used_for_vgm": "Weighbridge",
     *          "weighbridge_slip_no": "WS123456",
     *          "bank_id":"fbdj54-fvd-g45bbf-5tgr4",
     *      },
     * ]
     * }
     */
    public function show()
    {
        $companyProfile = CompanyProfile::first();
        // dd($companyProfile);
        return response()->json(['type' => 'success', 'comapny_profile' => $companyProfile], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update company profile details.
     *
     * This endpoint allows you to update the company profile details. The variables are in snake_case and should be provided in the request body. company_logo and signature_upload both send direct file only, don't refer example for both.
     *
     * @group Company Profile
     *
     *
     * @bodyParam id string required The unique identifier for the company profile. Example: 1dkjvskj-dnjdj-xnxskj
     * @bodyParam company_name string required The name of the company. Example: Sample Company Ltd.
     * @bodyParam contact_person_name string required The name of the contact person. Example: Ashish Patel
     * @bodyParam otp_mobile_phone string required The OTP mobile phone number. Example: 08796543210
     * @bodyParam mobile string required The mobile phone number. Example: 08796543210
     * @bodyParam email string required The email address. Example: abc@gmail.com
     * @bodyParam phone_no string The phone number. Example: 7896513
     * @bodyParam fax_no string The fax number. Example: 08796543210
     * @bodyParam website string The company website URL. Example: http://www.samplecompany.com
     * @bodyParam company_register string The company registration number. Example: Register123
     * @bodyParam address string The company address. Example: Rajkot, Gujarat, India - 360004.
     * @bodyParam portal_address string The company portal address. Example: http://portal.samplecompany.com
     * @bodyParam company_type string The type of the company. Example: Private Limited
     * @bodyParam gst_no string The GST number. Example: GSTIN123456789
     * @bodyParam lut_no string The LUT number. Example: LUT12345
     * @bodyParam cin string The CIN number. Example: CIN123456789
     * @bodyParam gst_circular_no string The GST circular number. Example: CIRC123456789
     * @bodyParam state_code string The state code. Example: SC
     * @bodyParam lei_no string The LEI number. Example: LEI1234567890
     * @bodyParam field_3 string Additional field 3. Example: Value3
     * @bodyParam pan_no string The PAN number. Example: PAN123456789
     * @bodyParam lut_expiry date The LUT expiry date. Example: 2025-12-31
     * @bodyParam rcmc_no string The RCMC number. Example: RCMC123456
     * @bodyParam date_of_filling_rex_number date The date of filling REX number. Example: 2024-06-25
     * @bodyParam field_1 string Additional field 1. Example: Value1
     * @bodyParam field_4 string Additional field 4. Example: Value4
     * @bodyParam iec_no string The IEC number. Example: IEC123456789
     * @bodyParam bin_no string The BIN number. Example: BIN123456
     * @bodyParam rcmc_expiry date The RCMC expiry date. Example: 2026-12-31
     * @bodyParam circular_no string The circular number. Example: CIRC789456123
     * @bodyParam aeo_no string The AEO number. Example: AEO123456
     * @bodyParam field_2 string Additional field 2. Example: Value2
     * @bodyParam field_5 string Additional field 5. Example: Value5
     * @bodyParam pre_carriage_by string The mode of pre-carriage. Example: Road
     * @bodyParam state_of_origin string The state of origin. Example: Sample State
     * @bodyParam delivery_period string The delivery period. Example: 30 days
     * @bodyParam terms_of_delivery string The terms of delivery. Example: FOB
     * @bodyParam place_of_receipt string The place of receipt. Example: Sample Port
     * @bodyParam part_of_loading string The part of loading. Example: Loading Dock A
     * @bodyParam partial_shipement string Indicates if partial shipment is allowed. Example: No
     * @bodyParam district_of_origin string The district of origin. Example: Sample District
     * @bodyParam trans_shipement string Indicates if trans-shipment is allowed. Example: No
     * @bodyParam variety_of_quality string The variety of quality. Example: Premium
     * @bodyParam company_logo file The company logo file. Example: null
     * @bodyParam signature_upload file The signature upload file. Example: null
     * @bodyParam range string The range. Example: Range 1
     * @bodyParam division string The division. Example: Division A
     * @bodyParam commissionerate string The commissionerate. Example: Commissionerate 1
     * @bodyParam location_code string The location code. Example: LOC123
     * @bodyParam annexure_remark string The annexure remark. Example: N/A
     * @bodyParam shipper_name string The name of the shipper. Example: Sample Shipper
     * @bodyParam method_used_for_vgm string The method used for VGM. Example: Weighbridge
     * @bodyParam weighbridge_slip_no string The weighbridge slip number. Example: WS123456
     * @bodyParam bank_id string The bank identifier. Example: fbdj54-fvd-g45bbf-5tgr4
     *
     * @response 200 {
     *      "status":"success",
     *      "message":"Company Profile updated successfully"
     * }
     */
    public function update(Request $request)
    {
        $companyProfile = CompanyProfile::first()->first();
        if (isset($request->company_logo)) {
            $fileName = Str::random(6);
            $file = $request->file('company_logo');
            $fileExt = $file->getClientOriginalExtension();
            $fileSaved = $fileName . '.' . $fileExt;
            $request->company_logo->move(public_path('/upload/'), $fileSaved);
            $request['company_logo'] = public_path('/upload/') . $fileSaved;
        }
        if (isset($request->signature_upload)) {
            $fileName = Str::random(6);
            $file = $request->file('signature_upload');
            $fileExt = $file->getClientOriginalExtension();
            $fileSaved = $fileName . '.' . $fileExt;
            $request->signature_upload->move(public_path('/upload/'), $fileSaved);
            $request['signature_upload'] = public_path('/upload/') . $fileSaved;
        }
        $companyProfile->update($request->all());
        return response()->json(['status' => 'success', 'message' => 'Company Profile updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
