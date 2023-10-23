<?php

namespace App\Http\Controllers;

use App\Mail\AuthorizationMail;
use App\Models\SaleBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function authorizationMail($appID)
    {
        $app = SaleBooking::find($appID);
        $mailData = [
            'title' => 'Payment Authorization Mail',
            'body' => 'This is for testing email using smtp',
            'file_path' => 'http://localhost:8000/authorizePayment/' . $app->id,
        ];

        Mail::to('yanger@g.com')->send(new AuthorizationMail($mailData));

        return redirect()->back();
    }
}
