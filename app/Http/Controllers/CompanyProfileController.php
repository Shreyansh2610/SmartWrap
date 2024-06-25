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
     *  variable is like small case and replace space with underscore
     * @group Company Profile
     *
     * @response 200 {
     *  "status": "success",
     *  "comapny_profile": [
     *      {
     *          "id": 1,
     *          "company_name": "SmartWrap",
     *      },
     *      ...
     *  ]
     * }
     */
    public function show()
    {
        $companyProfile = CompanyProfile::first();
        // dd($companyProfile);
        return response()->json(['type'=>'success','comapny_profile'=>$companyProfile],200);
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
    public function update(Request $request)
    {
        $companyProfile = CompanyProfile::first()->first();
        if (isset($request->company_logo)) {
            $fileName = Str::random(6);
            $file = $request->file('company_logo');
            $fileExt = $file->getClientOriginalExtension();
            $fileSaved = $fileName . '.' . $fileExt;
            $request->company_logo->move(public_path('/upload/'), $fileSaved);
            $request['company_logo'] = public_path('/upload/'). $fileSaved;
        }
        if (isset($request->signature_upload)) {
            $fileName = Str::random(6);
            $file = $request->file('signature_upload');
            $fileExt = $file->getClientOriginalExtension();
            $fileSaved = $fileName . '.' . $fileExt;
            $request->signature_upload->move(public_path('/upload/'), $fileSaved);
            $request['signature_upload'] = public_path('/upload/'). $fileSaved;
        }
        $companyProfile->update($request->all());
        return response()->json(['type'=>'success','message'=>'Company Profile updated successfully'],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
