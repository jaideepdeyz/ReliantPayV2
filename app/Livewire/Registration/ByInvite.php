<?php

namespace App\Livewire\Registration;

use App\Enums\RoleEnum;
use App\Models\AffiliateMerchantCode;
use App\Models\EmailPhoneOtp;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Service\TrueDialogSmsService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ByInvite extends Component
{
    private $smsService;
    public $merchantName;
    public $merchantEmail;


    public $name;
    #[Validate('required|min:6')]
    public $password;
    #[Validate('required|min:6|same:password')]
    public $password_confirmation;
    #[Validate('required|email|unique:users,email')]

    public $phone;
    #[Validate('required')]
    public $phone_otp;
    public $is_phone_otp_sent = false;
    public $is_phone_verified = false;

    public $resendPhoneCounter=0;
    public $resendPhoneCountdown = 60;

    public function boot()
    {
        $this->smsService = new TrueDialogSmsService();
    }

    public function mount($code)
    {
        $merchant = AffiliateMerchantCode::where('merchant_code', $code)->first();
        $this->merchantName = $merchant->merchant_name;
        $this->merchantEmail = $merchant->merchant_email;
    }

    public function sendPhoneOtp()
    {


        $this->validate([
            'phone' => 'required|numeric|unique:users,phone_number',
        ], [
            'phone.required' => 'Please enter your phone number',
            'phone.numeric' => 'Please enter valid phone number',
            'phone.unique' => 'Phone number is already registered',
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
                'message' => 'Phone OTP Sent, please check your phone',
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
        ], [
            'phone_otp.required' => 'Please enter your OTP received on your phone',
        ]);
        $phone_otp = EmailPhoneOtp::where('phone', $this->phone)->where('otp', $this->phone_otp)->first();
        if ($phone_otp) {
            $this->is_phone_verified = true;
            $this->dispatch('notify', [
                'message' => 'Phone Verified',
                'type' => 'success',
            ]);
        } else {
            $this->is_phone_verified = false;
            $this->dispatch('notify', [
                'message' => 'Phone OTP does not match',
                'type' => 'error',
            ]);
        }
    }

    private function startPhoneCountdown()
    {
        $this->resendPhoneCountdown=60;
        $this->dispatch('startPhoneCountdown', $this->resendPhoneCountdown);
    }

    public function register()
    {
        $this->validate([
            'name' => 'required|min:3',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
            // 'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone_number',
        ]);
        try {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->merchantEmail,
                'phone_number' => $this->phone,
                'password' => Hash::make($this->password),
                'is_active' => 'Yes',
                'is_approved' => 'No',
                'role' => RoleEnum::DEALER,
            ]);

            $invite = AffiliateMerchantCode::where('merchant_email', $this->merchantEmail)->first();
            $invite->update(
                [
                    'user_id' => $user->id,
                ]);
            event(new Registered($user));
            Auth::login($user);
            return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->dispatch('notify', [
                'message' => $e->getMessage(),
                'type' => 'error',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.registration.by-invite')->layout('layouts.guest-base');
    }
}
