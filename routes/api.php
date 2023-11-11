<?php

use App\Http\Controllers\API\MiscApiController;
use App\Http\Controllers\OtpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('sendOtp', [OtpController::class, 'sendOtp'])->name('sendOtp');
Route::post('verifyOtp', [OtpController::class, 'verifyOtp'])->name('verifyOtp');
Route::get('getAirportsByCountry', [MiscApiController::class, 'getAirportsByCountry'])->name('getAirportsByCountry');