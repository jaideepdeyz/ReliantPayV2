<?php

namespace App\Service;

use Bmatovu\LaravelXml\Support\ArrayToXml;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    public $api_key;
    public $post_url;


    public function __construct()
    {
        $this->api_key = 'K759TMMNX823rt39442c2Chy9VzPx6Mg';
        $this->post_url = 'https://secure.nationalprocessinggateway.com/api/v2/three-step';
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
            'redirect-url' => 'http://localhost:8000/payment/step-two',
            'amount' => '100.00',
            'ip-address' => '127.0.0.1',
            'currency' => 'USD',
            'order-id' => '1234',
            'order-description' => 'Small Order',
            'merchant-defined-field-1' => 'Red',
            'merchant-defined-field-2' => 'Medium',
            'tax-amount' => '0.00',
            'shipping-amount' => '0.00',
            'billing' => $billing,
            'shipping' => $shipping

        ];
        $dataVO = ArrayToXml::convert($sale, 'sale');
       
        $response = Http::send('POST', $this->post_url, [
            'Content-Type' => 'application/xml',
            'Accept' => 'application/xml',
        ], $dataVO);
        return $response;
    }
}
