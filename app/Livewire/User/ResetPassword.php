<?php

namespace App\Livewire\User;

use App\Mail\EmailOtp;
use App\Models\EmailPhoneOtp;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class ResetPassword extends Component
{
    public $email;
    public $email_otp;
    public $is_email_otp_sent = false;
    public $is_email_verified = false;
    public $password;
    public $resendEmailCounter=0;
    public $resendEmailCountdown = 60;

    public function sendEmailOtp()
    {
        $this->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Please enter your email',
            'email.email' => 'Please enter valid email',
        ]);

        try {
            $user = User::where('email', $this->email)->first();
            if (!$user) {
                $this->dispatch('notify', [
                    'message' => 'Email not found',
                    'type' => 'error',
                ]);
                return;
            }
            $this->resendEmailCounter++;
            $email_otp = rand(100000, 999999);
            // Log::info('email otp is '.$email_otp);
            $this->startEmailCountdown();

            EmailPhoneOtp::updateOrCreate(
                ['email' => $this->email],
                [
                    'otp' => $email_otp,
                    'type' => 'email',
                ]
            );

            Mail::to($this->email)->send(new EmailOtp($email_otp));
            $this->is_email_otp_sent = true;


            $this->dispatch('notify', [
                'message' => 'Email OTP Sent, please check your email',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'message' => $e->getMessage(),
                'type' => 'error',
            ]);
        }
    }

    public function verifyEmailOtp()
    {
        $this->validate([
            'email_otp' => 'required',
        ], [
            'email_otp.required' => 'Please enter the OTP received on your email',
        ]);

        $email_otp = EmailPhoneOtp::where('email', $this->email)->where('otp', $this->email_otp)->first();
        if ($email_otp) {
            $this->is_email_verified = true;
            $this->dispatch('notify', [
                'message' => 'Email Verified',
                'type' => 'success',
            ]);
        } else {
            $this->is_email_verified = false;
            $this->dispatch('notify', [
                'message' => 'Email OTP does not match',
                'type' => 'error',
            ]);
        }
    }

    public function resetPassword()
    {
        $this->validate([
            'password' => 'required|min:8',
        ], [
            'password.required' => 'Please enter your password',
            'password.min' => 'Password must be at least 8 characters',
        ]);

        try {
            DB::beginTransaction();
            $user = User::where('email', $this->email)->first();
            if (!$user) {
                $this->dispatch('notify', [
                    'message' => 'Email not found',
                    'type' => 'error',
                ]);
                return;
            }
            $user->password = Hash::make($this->password);
            $user->save();
            DB::commit();
            return redirect()->route('login');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('notify', [
                'message' => $e->getMessage(),
                'type' => 'error',
            ]);
        }
    }

    public function resendEmailOtp()
    {
        if ($this->resendEmailCounter ==2) {
            $this->dispatch('notify', [
                'message' => 'You have reached maximum resend limit',
                'type' => 'error',
            ]);
            return;

        }
        $this->sendEmailOtp();
    }

    private function startEmailCountdown()
    {
        $this->resendEmailCountdown=60;
        $this->dispatch('startEmailCountdown', $this->resendEmailCountdown);
    }

    public function render()
    {
        return view('livewire.user.reset-password')->layout('layouts.guest-base');
    }
}
