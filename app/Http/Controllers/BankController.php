<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Get a list of all banks.
     *
     * @group Bank Management
     *
     * @response 200 {
     *  "status": "success",
     *  "banks": [
     *      {
     *          "id": 1,
     *          "bank_name": "Bank of America",
     *          "bank_address": "123 Main St, New York, NY",
     *          "account_name": "John Doe",
     *          "account_no": "1234567890",
     *          "ifsc_code": "BOFAUS3N",
     *          "swift_code": "BOFAUS3NXXX",
     *          "bank_ad_code_no": "AD12345678",
     *          "iban_no": "GB82WEST12345698765432"
     *      },
     *      ...
     *  ]
     * }
     */
    public function index()
    {
        $banks = Bank::where('created_by', auth()->user()->id)->get()->select('id', 'bank_name', 'bank_address', 'account_name', 'account_no', 'ifsc_code', 'swift_code', 'bank_ad_code_no', 'iban_no')->toArray();
        return response()->json([
            'status' => 'success',
            'banks' => $banks,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created bank in the database.
     *
     * @group Bank Management
     *
     * @bodyParam bank_name string required The name of the bank. Example: Bank of America
     * @bodyParam bank_address string required The address of the bank. Example: 123 Main St, New York, NY
     * @bodyParam account_name string required The name of the account holder. Example: John Doe
     * @bodyParam account_no string required The bank account number. Example: 1234567890
     * @bodyParam ifsc_code string required The IFSC code of the bank. Example: BOFAUS3N
     * @bodyParam swift_code string The SWIFT code of the bank. Example: BOFAUS3NXXX
     * @bodyParam bank_ad_code_no string The bank AD code number. Example: AD12345678
     * @bodyParam iban_no string The IBAN number of the bank account. Example: GB82WEST12345698765432
     *
     * @response 200 {
     *  "status": "success",
     *  "message": "Bank details is stored"
     * }
     *
     * @response 422 {
     *  "status": "error",
     *  "message": "Validation error"
     * }
     */

    public function store(Request $request)
    {
        $bank = Bank::create([
            'bank_name' => $request->bank_name,
            'bank_address' => $request->bank_address,
            'account_name' => $request->account_name,
            'account_no' => $request->account_no,
            'ifsc_code' => $request->ifsc_code,
            'swift_code' => $request->swift_code,
            'bank_ad_code_no' => $request->bank_ad_code_no,
            'iban_no' => $request->iban_no,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Bank details is stored'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
