<?php

namespace App\Http\Controllers;

use App\Enums\ServiceEnum;
use App\Models\AuthorizationForm;
use App\Models\ChargeDetails;
use App\Models\Passenger;
use App\Models\Payment;
use App\Models\SaleBooking;
use App\Models\TravelItenaryUpload;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Storage;

class PdfController extends Controller
{
    public function authorizationForm($bookingID)
    {

        $saleBooking = SaleBooking::find($bookingID);
        $logo = public_path('auth/images/adminlogo/admin-logo-light.png');

        // itenary
        $itenaryUpload = TravelItenaryUpload::where('app_id', $bookingID)->first();
        $url = Storage::URL($itenaryUpload->document_filepath);
        $path = public_path($url);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $itenary = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $paymentDetails = Payment::where('app_id', $bookingID)->first();
        $charges = ChargeDetails::where('app_id', $bookingID)->get();
        $passengers = Passenger::where('app_id', $bookingID)->get();
        switch($saleBooking->service->service_name)
        {
            case ServiceEnum::FLIGHTS->value:
                $pdf = Pdf::loadView('pdf.flightAuthorization', compact('logo', 'saleBooking', 'paymentDetails', 'charges', 'passengers', 'itenary'));
                break;
            case ServiceEnum::AMTRAK->value:
                $pdf = Pdf::loadView('pdf.amtrakAuthorization', compact('logo', 'saleBooking', 'paymentDetails', 'charges', 'passengers', 'itenary'));
                break;
            default:
                break;
        }
        $content = $pdf->download()->getOriginalContent();
        $file = Storage::put('public/Unsigned/authorization'.$saleBooking->id.'.pdf', $content);
        $authFile = AuthorizationForm::updateOrCreate(
            ['app_id' => $bookingID,],
            [
                'unsigned_document' => 'public/Unsigned/authorization'.$saleBooking->id.'.pdf',
            ]);

        return view('pdf.showAuthFile', compact('authFile'));

    }
}
