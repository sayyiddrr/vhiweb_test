<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $validator = Validator::make($request->all(), [
            "company_name" => "required",
            "address" => "required",
            "phone" => "required"
        ]);

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            $response = [
                'status'  => false,
                'message' => $errorMessage,
            ];
            return response()->json($response, 401);
        }

        $vendor = Vendor::create([
            'user_id' => $request->user()->id,
            'company_name' => $request->company_name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return response()->json([
            $vendor,
            'message' => $request->company_name . ' Successfully Registered'
        ]);
    }

}
