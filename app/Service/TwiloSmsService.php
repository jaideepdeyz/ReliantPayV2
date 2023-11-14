<?php

namespace App\Service;

use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class TwiloSmsService
{
    protected $sid;
    protected $token;
    public function __construct()
    {
        $this->sid = 'asdasd';
        $this->token = 'asdsad';
    }
    public function sendSms($to, $message)
    {
        $client = new Client($this->sid, $this->token);
        $msg = $client->messages->create(
            $to,
            [
                'from' => '+12345678901',
                'body' => $message,
            ]
        );
        Log::info('SMS sent to ' . $to . ' with message ' . $message);
        
        
    }
}
