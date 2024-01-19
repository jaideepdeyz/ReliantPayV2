<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function authorizationForm()
    {
        $pdf = \PDF::loadView('pdf.authorization-form');
        return $pdf->download('authorization-form.pdf');
    }
}
