<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\SaleBooking;
use App\Models\SuccessfulPaymentResponse;
use App\Service\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
            $salebooking = SaleBooking::find($id);
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
            $gwResponse = Xml::decode($response);
            if ($gwResponse['result'] == "1") {
                $salebooking = SaleBooking::where('order_id', $gwResponse['order-id'])->first();
                $salebooking->update([
                    'app_status' => StatusEnum::PAYMENT_DONE,
                ]);
                $successfulPaymentResponse = SuccessfulPaymentResponse::create([
                    'sale_booking_id' => $salebooking->id,
                    'order-id' => $gwResponse['order-id'],
                    'result' => $gwResponse['result'],
                    'result-code' => $gwResponse['result-code'],
                    'result-text' => $gwResponse['result-text'],
                    'authorization-code' => $gwResponse['authorization-code'],
                    'transaction-id' => $gwResponse['transaction-id'],
                    'amount' => $gwResponse['amount'],
                ]);
            }

            return view('payment.payment-response', compact('gwResponse', 'response', 'salebooking'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function generatePaymentLink($id)
    {

        $base64EncodedId = base64_encode($id);
        $url = route('paymentLink', $base64EncodedId);
        Session::flash('generatedpaymenturl', 'Payment link generated successfully');
        return redirect()->back()->with('generatedpaymenturl', $url);

    }
    public function paymentLink($id)
    {
        $decodedId = base64_decode($id);
        $salebooking = SaleBooking::find($decodedId);
        return view('payment.payment-link', compact('salebooking','decodedId'));
    }
    public function makePaymentLinkPayment(Request $request)
    {
        $_token=$request['_token'];
        $decodedId = $request['decodedId'];
        $payment_token=$request['payment_token'];
        $response=$this->paymentService->payUsingTransactApi($payment_token,$decodedId);
        if($response['response']==1){
            $salebooking = SaleBooking::where('order_id', $response['orderid'])->first();
            $salebooking->update([
                'app_status' => StatusEnum::PAYMENT_DONE,
            ]);
            return view('payment.payment-link-response', compact('response'));
        }else{
            return redirect()->back()->with('error', $response['responsetext']);
        }
    }
}
