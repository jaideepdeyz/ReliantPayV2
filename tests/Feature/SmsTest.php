<?php

namespace Tests\Feature;

use App\Service\TrueDialogSmsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SmsTest extends TestCase
{
    protected $smsService;
    public function setUp(): void
    {
        
        parent::setUp();
        $this->smsService = new TrueDialogSmsService();    
    }
    public function test_example(): void
    {
        $reponse = $this->smsService->sendSms('+16692373340', 'Test Message 2 for True Dialog from Lungdsuo');
        try {
            $this->assertTrue($reponse); 
        } catch (\Exception $e) {
            $this->fail($e->getMessage() . ' with status ' . $reponse->status(). ' and body ' . $reponse->body());

        }
    }
}
