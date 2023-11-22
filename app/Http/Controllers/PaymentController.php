<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use App\Service\PaymentService;
use Illuminate\Http\Request;
use Xml;

class PaymentController extends Controller
{
    protected $paymentService;
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function stepOnePay($id)
    {
        try {
            $response = $this->paymentService->stepOnePay($id);
            $salebooking=SaleBooking::find($id);
            $gwResponse = Xml::decode($response);

            if ($gwResponse['result'] == "1") {
                $formUrl = $gwResponse['form-url'];
                return view('payment.make-payment', compact('formUrl', 'salebooking'));
            } else {
                throw new \Exception($gwResponse->responsetext);
            }
            
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function stepThreePay(Request $request)
    {
        try {
            $response = $this->paymentService->stepThreePay($request['token-id']);
            $gwResponse =Xml::decode($response);
            if($gwResponse['result'] == "1"){
                $salebooking=SaleBooking::where('order_id',$gwResponse['order-id'])->first();
                $salebooking->update([
                    'app_status' => StatusEnum::PAYMENT_DONE,
                ]);
            }
               
            return view('payment.payment-response', compact('gwResponse', 'response'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
