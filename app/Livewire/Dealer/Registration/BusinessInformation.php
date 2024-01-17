<?php

namespace App\Livewire\Dealer\Registration;

use App\Models\Organization;
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

    public function mount()
    {
        $org = Organization::where('user_id', auth()->user()->id)->first();
        if($org) {
            $this->business_name = $org->business_name;
            $this->business_address = $org->business_address;
            $this->business_website = $org->business_website;
            $this->business_email = $org->business_email;
            $this->business_phone = $org->business_phone;
        }
    }

    public function storeBusinessInfo()
    {
        $this->validate([
            'business_name' => 'required',
            'business_address' => 'required',
            'business_website' => 'required',
            'business_email' => 'required',
            'business_phone' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $org = Organization::updateOrCreate(
                ['user_id' => auth()->user()->id],
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
