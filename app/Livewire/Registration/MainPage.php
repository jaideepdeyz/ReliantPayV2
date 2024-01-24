<?php

namespace App\Livewire\Registration;

use App\Enums\RoleEnum;
use App\Models\EmailOtp;
use App\Models\EmailPhoneOtp;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Providers\RouteServiceProvider;
use App\Service\TrueDialogSmsService;
use Livewire\Attributes\Validate;

class MainPage extends Component
{

    private $smsService;
    public $step = 1;
    #[Validate('required|min:3')]
    public $name;
    #[Validate('required|min:6')]
    public $password;
    #[Validate('required|min:6|same:password')]
    public $password_confirmation;
    #[Validate('required|email|unique:users,email')]
    public $email;
    #[Validate('required')]
    public $email_otp;
    public $is_email_otp_sent = false;
    public $is_email_verified = false;
    #[Validate('required|numeric|unique:users,phone_number,digits:10')]
    public $phone;
    #[Validate('required')]
    public $phone_otp;
    public $is_phone_otp_sent = false;
    public $is_phone_verified = false;
    public $resendEmailCounter=0;
    public $resendEmailCountdown = 60;
    public $resendPhoneCounter=0;
    public $resendPhoneCountdown = 60;
    public function boot()
    {
        $this->smsService = new TrueDialogSmsService();
    }
    public function gotoNextStep()
    {
        $currentStep = $this->step;
        if ($currentStep == 1) {
            $this->validate([
                'name' => 'required|min:3',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|min:6|same:password',
            ]);
            $this->step = $currentStep + 1;
            return;
        }
        if ($currentStep == 2) {
            if (!$this->is_email_verified) {
                return;
            }
            $this->step = $currentStep + 1;
            return;
        }
        if ($currentStep == 3) {
            if (!$this->is_phone_verified) {
                return;
            }
            $this->step = $currentStep + 1;
            return;
        }
    }
    public function gotoPreviousStep()
    {
        $this->step = $this->step - 1;
    }


    public function render()
    {
        return view('livewire.registration.main-page')->layout('layouts.guest-base');
    }
    public function sendEmailOtp()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        try {
            
           
            $this->resendEmailCounter++;
            $email_otp = rand(100000, 999999);
            Log::info('email otp is '.$email_otp);
            $this->startEmailCountdown();

            EmailPhoneOtp::updateOrCreate(
                ['email' => $this->email],
                [
                    'otp' => $email_otp,
                    'type' => 'email',
                ]
            );
            Mail::to($this->email)->send(new \App\Mail\EmailOtp($email_otp));
            $this->is_email_otp_sent = true;
            
            
            $this->dispatch('notify', [
                'message' => 'Email OTP Sent,please check your email',
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
        ]);
        $email_otp = EmailPhoneOtp::where('email', $this->email)->where('otp', $this->email_otp)->first();
        if ($email_otp) {
            $this->is_email_verified = true;
            $this->dispatch('notify', [
                'message' => 'Email Verified',
                'type' => 'success',
            ]);
            $this->gotoNextStep();
        } else {
            $this->is_email_verified = false;
            $this->dispatch('notify', [
                'message' => 'Email OTP does not match',
                'type' => 'error',
            ]);
        }
    }
    public function sendPhoneOtp()
    {


        $this->validate([
            'phone' => 'required|numeric|unique:users,phone_number',
        ]);

        try {
            $this->resendPhoneCounter++;
            $phone_otp = rand(100000, 999999);
            $this->startPhoneCountdown();
            Log::info('phone otp is '.$phone_otp);

            EmailPhoneOtp::updateOrCreate(
                ['phone' => $this->phone],
                [
                    'otp' => $phone_otp,
                    'type' => 'phone',
                ]
            );
            $this->smsService->sendSms('+1' . $this->phone, 'Your phone OTP for registration is ' . $phone_otp);
            $this->is_phone_otp_sent = true;
            $this->dispatch('notify', [
                'message' => 'Phone OTP Sent,please check your phone',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'message' => $e->getMessage(),
                'type' => 'error',
            ]);
        }
    }
    public function verifyPhoneOtp()
    {
        $this->validate([
            'phone_otp' => 'required',
        ]);
        $phone_otp = EmailPhoneOtp::where('phone', $this->phone)->where('otp', $this->phone_otp)->first();
        if ($phone_otp) {
            $this->is_phone_verified = true;
            $this->dispatch('notify', [
                'message' => 'Phone Verified',
                'type' => 'success',
            ]);
            $this->gotoNextStep();
        } else {
            $this->is_phone_verified = false;
            $this->dispatch('notify', [
                'message' => 'Phone OTP does not match',
                'type' => 'error',
            ]);
        }
    }

    public function register()
    {
        $this->validate([
            'name' => 'required|min:3',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone_number',
        ]);
        try {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone_number' => $this->phone,
                'password' => Hash::make($this->password),
                'is_active' => 'Yes',
                'is_approved' => 'No',
                'role' => RoleEnum::DEALER,
            ]);
            event(new Registered($user));
            Auth::login($user);
            return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
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
    public function resendPhoneOtp()
    {
        if ($this->resendPhoneCounter ==2) {
            $this->dispatch('notify', [
                'message' => 'You have reached maximum resend limit',
                'type' => 'error',
            ]);
            return;
           
        }
        $this->sendPhoneOtp();
    }
    private function startPhoneCountdown()
    {
        $this->resendPhoneCountdown=60;
        $this->dispatch('startPhoneCountdown', $this->resendPhoneCountdown);
    }
   
}
