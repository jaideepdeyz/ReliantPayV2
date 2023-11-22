<?php

namespace App\Service;

use Bmatovu\LaravelXml\Support\ArrayToXml;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    public $api_key;
    public $post_url;


    public function __construct()
    {
        // $this->api_key = '78WVbrs25G7HGy5nE52FKHSenetRrm6j';
        $this->api_key = 'K759TMMNX823rt39442c2Chy9VzPx6Mg';
        $this->post_url = 'https://secure.nationalprocessinggateway.com/api/v2/three-step';
        // $this->post_url = 'https://integratepayments.transactiongateway.com/api/v2/three-step';
    }
    public function stepOnePay()
    {

        $billing = [
            'first-name' => 'John',
            'last-name' => 'Doe',
            'address1' => '123 Main St.',
            'city' => 'Los Angeles',
            'state' => 'CA',
            'postal' => '90001',
            'country' => 'US',
            'phone' => '555-555-5555',
            'email' => 'abc@gmail.com'
        ];
        $shipping = [
            'first-name' => 'John',
            'last-name' => 'Doe',
            'address1' => '123 Main St.',
            'city' => 'Los Angeles',
            'state' => 'CA',
            'postal' => '90001',
            'country' => 'US',
            'phone' => '555-555-5555',
            'company' => 'ABC Company',
            'address2' => 'Suite 101'
        ];
        $sale = [
            'api-key' => $this->api_key,
            'redirect-url' => 'https://reliant.yellowberry.in/payment/stepThreePay',
            'amount' => '100.00',
            'ip-address' => '127.0.0.1',
            'currency' => 'USD',
            'order-id' => '1234',
            'po-number' => '1234',
            'tax-amount' => '0.00',
            'shipping-amount' => '0.00',
            'billing' => $billing,
            'shipping' => $shipping

        ];
        $dataVO = ArrayToXml::convert($sale, 'sale');
        $response = $this->sendXMLviaCurl($dataVO, $this->post_url);
        return $response;
    }
    public function stepThreePay($token_id)
    {
        $complete_action = [
            'api-key' => $this->api_key,
            'token-id' => $token_id,
        ];
        $dataVO = ArrayToXml::convert($complete_action, 'complete-action');
        $response = $this->sendXMLviaCurl($dataVO, $this->post_url);
        return $response;
    }


    public function sendXMLviaCurl($xmlString, $gatewayURL)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $gatewayURL);
        $headers = array();
        $headers[] = "Content-type: text/xml";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PORT, 443);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlString);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        // This should be unset in production use. With it on, it forces the ssl cert to be valid
        // before sending info.
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        if (!($data = curl_exec($ch))) {
            print  "curl error =>" . curl_error($ch) . "\n";
            throw new Exception(" CURL ERROR :" . curl_error($ch));
        }
        curl_close($ch);
        return $data;
    }
}
