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

class MainPage extends Component
{

    private $smsService;
    public $step = 1;
    public $name;
    public $password;
    public $password_confirmation;
    public $email;
    public $email_otp;
    public $is_email_otp_sent = false;
    public $is_email_verified = false;
    public $phone;
    public $phone_otp;
    public $is_phone_otp_sent = false;
    public $is_phone_verified = false;
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
    public function gotoPreviousStep(){
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
            $email_otp = rand(100000, 999999);

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
                'message' => 'Email Otp Sent,please check your email',
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
                'message' => 'Email Otp does not match',
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
            $phone_otp = rand(100000, 999999);

            EmailPhoneOtp::updateOrCreate(
                ['phone' => $this->phone],
                [
                    'otp' => $phone_otp,
                    'type' => 'phone',
                ]
            );
            $this->smsService->sendSms('+1' . $this->phone, 'Your phone otp for registration is ' . $phone_otp);
            $this->is_phone_otp_sent = true;
            $this->dispatch('notify', [
                'message' => 'Phone Otp Sent,please check your phone',
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
                'message' => 'Phone Otp does not match',
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
}
