<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Mail\AuthorizationMail;
use App\Models\SaleBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function authorizationMail($appID)
    {
        $app = SaleBooking::find($appID);
        try {
            DB::beginTransaction();
            $app->update([
                'app_status' => StatusEnum::PENDING,
            ]);
            DB::commit();

            $mailData = [
                'title' => 'Payment Authorization Mail',
                'body' => 'This is for testing email using smtp',
                'file_path' => 'http://localhost:8000/authorizePayment/' . $app->id,
            ];

            Mail::to($app->customer_email)->send(new AuthorizationMail($mailData));

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }
}
