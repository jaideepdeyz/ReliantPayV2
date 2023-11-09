<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        try {
            Log::info($request->all());
            $validator = Validator::make($request->all(), [
                'phone_number' => 'required|numeric|digits_between:10,12',
                // 'country_code' => 'required|numeric|digits_between:1,5',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first(),
                ], 422);
            }
            $user = User::where('phone_number', $request->phone_number)->first();
            if ($user) {
                return response()->json([
                    'message' => 'Phone number already exists',
                ], 422);
            }
            // $otp = rand(100000, 999999);
            $otp = 123456;
            $message = "Your OTP is: $otp";
            $otpModel = Otp::create([
                'phone_number' => $request->phone_number,
                'otp' => $otp,
                'expiration_time' => now()->addMinutes(5),
                'country_code' => '+91'
            ]);

            // $this->sendSMS($request->country_code . $request->phone_number, $message);

            return response()->json([
                'message' => 'OTP sent successfully',
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|numeric|digits_between:10,12',
            'otp' => 'required|numeric|digits_between:6,6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
            ], 422);
        }
        $otpModel = Otp::where('phone_number', $request->phone_number)->where('otp', $request->otp)->first();
        if (!$otpModel) {
            return response()->json([
                'message' => 'Invalid OTP',
            ], 422);
        }
        if ($otpModel->expiration_time < now()) {
            return response()->json([
                'message' => 'OTP expired',
            ], 422);
        }
        $otpModel->is_verified = true;
        $otpModel->verified_at = now();
        $otpModel->save();
        return response()->json([
            'message' => 'OTP verified successfully',
        ], 200);
    }
}
