<?php

namespace App\Livewire\Dealer\Registration;

use App\Enums\RoleEnum;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BankingDetails extends Component
{
    public $orgID;
    //banking details
    public $business_bank_account_name;
    public $business_bank_account_address;
    public $business_bank_name;
    public $business_bank_address;
    public $business_bank_IBAN;
    public $business_bank_IFSC;
    public $business_bank_SWIFT_code;
    public $business_bank_routing_code;
    public $viewOnly = 'No';

    public function mount($orgID, $viewOnly = null)
    {
        $this->orgID = $orgID;
        $org = Organization::find($orgID);
        if($org)
        {
            $this->business_bank_account_name = $org->business_bank_account_name;
            $this->business_bank_account_address = $org->business_bank_account_address;
            $this->business_bank_name = $org->business_bank_name;
            $this->business_bank_address = $org->business_bank_address;
            $this->business_bank_IBAN = $org->business_bank_IBAN;
            $this->business_bank_IFSC = $org->business_bank_IFSC;
            $this->business_bank_SWIFT_code = $org->business_bank_SWIFT_code;
            $this->business_bank_routing_code = $org->business_bank_routing_code;
        }

        $this->viewOnly = $viewOnly;
        if($this->viewOnly != null)
        {
            $this->viewOnly = 'Yes';
        }
    }

    public function save()
    {
        try {
            DB::beginTransaction();
            $org = Organization::where('id', $this->orgID);
            $org->update([
                'business_bank_account_name' => $this->business_bank_account_name,
                'business_bank_account_address' => $this->business_bank_account_address,
                'business_bank_name' => $this->business_bank_name,
                'business_bank_address' => $this->business_bank_address,
                'business_bank_IBAN' => $this->business_bank_IBAN,
                'business_bank_IFSC' => $this->business_bank_IFSC,
                'business_bank_SWIFT_code' => $this->business_bank_SWIFT_code,
                'business_bank_routing_code' => $this->business_bank_routing_code,
            ]);
            DB::commit();
            if(Auth::User()->role == RoleEnum::ADMIN->value)
            {
                return redirect()->route('confirmation', ['orgID' => $this->orgID]);
            } else {
                return redirect()->route('dealerDocs', ['orgID' => $this->orgID]);
            }
        } catch(\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function decreaseStep()
    {
        return redirect()->route('dealerServicesCompliances', ['orgID' => $this->orgID]);
    }


    public function render()
    {
        return view('livewire.dealer.registration.banking-details')->layout('layouts.dashboard-layout');
    }
}
