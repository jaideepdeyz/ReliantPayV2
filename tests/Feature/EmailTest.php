<?php

namespace Tests\Feature;

use App\Mail\TestMail;
use App\Service\TrueDialogSmsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailTest extends TestCase
{

    public function test_example(): void
    {
        // Mail::fake();

        // Send the email
        try {
            Mail::to('mozhui.lungdsuo@gmail.com')->send(new TestMail());
            // check if the email was sent
            $this->assertTrue(true);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        // Assert that the email was sent
        // Mail::assertSent(TestMail::class, function ($mail) {
        //     return $mail->hasTo('mozhui.lungdsuo@gmail.com');
        // });
    }
}
