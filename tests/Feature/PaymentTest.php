<?php

namespace Tests\Feature;

use App\Service\PaymentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    protected $paymentService;
    public function setUp(): void
    {
        
        parent::setUp();
        $this->paymentService = new PaymentService();
    }

    public function test_example(): void
    {
        
        $this->paymentService->stepOnePay();
        $reponse = $this->paymentService->stepOnePay();
       
        try {
            $this->assertEquals(100, $reponse->status(), $reponse->body()); // 100 means payment processed successfully
        } catch (\Exception $e) {
            $this->fail($e->getMessage() . ' with status ' . $reponse->status(). ' and body ' . $reponse->body());

        }
    }
}
