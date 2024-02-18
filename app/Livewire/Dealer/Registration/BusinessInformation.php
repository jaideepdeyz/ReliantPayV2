<?php

namespace App\Livewire\Dealer\Registration;

use App\Enums\RoleEnum;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BusinessInformation extends Component
{
    //organization details
    public $business_name;
    public $business_address;
    public $business_website;
    public $business_email;
    public $business_phone;
    public $viewOnly = 'No';

    public $userID;

    public function mount($userID = null, $viewOnly = null)
    {
        $this->userID = $userID;
        if($userID != null)
        {
            $this->userID = $userID;
        }

        $org = Organization::where('user_id', $this->userID)->first();
        if($org) {
            $this->business_name = $org->business_name;
            $this->business_address = $org->business_address;
            $this->business_website = $org->business_website;
            $this->business_email = $org->business_email;
            $this->business_phone = $org->business_phone;
        }

        $this->viewOnly = $viewOnly;
        if($this->viewOnly == 'view')
        {
            $this->viewOnly = 'Yes';
        } else {
            $this->viewOnly = 'No';
        }

    }

    public function storeBusinessInfo()
    {
        if(Auth::User()->role != RoleEnum::ADMIN->value)
        {
            $this->validate([
                'business_name' => 'required',
                'business_address' => 'required',
                'business_website' => 'required',
                'business_email' => 'required',
                'business_phone' => 'required',
            ]);
        } else {
            $this->validate([
                'business_name' => 'required',
            ]);
        }
        
    

        try {
            DB::beginTransaction();
            switch(auth()->user()->role)
            {
                case RoleEnum::ADMIN->value:
                    $userID = $this->userID;
                    break;
                default:
                    $userID = auth()->user()->id;
                    break;
            }
            $org = Organization::updateOrCreate(
                ['user_id' => $userID],
                [
                    'business_name' => $this->business_name,
                    'business_address' => $this->business_address,
                    'business_website' => $this->business_website,
                    'business_email' => $this->business_email,
                    'business_phone' => $this->business_phone,
                ]
            );
            DB::commit();
            return redirect()->route('dealerServicesCompliances', ['orgID' => $org->id]);
        } catch(\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.dealer.registration.business-information')->layout('layouts.dashboard-layout');
    }
}
