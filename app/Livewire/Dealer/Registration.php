<?php

namespace App\Livewire\Dealer;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Registration extends Component
{
    use WithFileUploads;

    //organization details
    public $business_name;
    public $business_address;
    public $business_website;
    public $business_email;
    public $business_phone;
    public $business_product_services;
    //compliances
    public $business_PCI_DSS_compliance_status;
    public $business_HTTPS_compliance_status;
    //banking details
    public $business_bank_account_name;
    public $business_bank_account_address;
    public $business_bank_name;
    public $business_bank_address;
    public $business_bank_IBAN;
    public $business_bank_IFSC;
    public $business_bank_SWIFT_code;
    public $business_bank_routing_code;
    //authorized person details 
    public $authorized_persons_name;
    public $authorized_persons_email;
    public $password;
    public $password_confirmation;
    //fileuploads
    public $business_scan_signed_contract;
    public $business_scan_EIN;
    public $business_scan_PAN;
    public $business_scan_registration_document;
    public $business_scan_bank_statement;
    public $business_scan_utility_bills;
    public $business_scan_business_tax_returns;
    public $business_premises_external_pictures;
    public $business_premises_internal_pictures;
    public $orgID;

    public function registerDealer()
    {
        // $this->dispatch('showModal', ['alias' => 'modals.services-offered']);
        dd($this->business_product_services);
        
        $this->validate([
            'business_name' => 'required',
            'business_address' => 'required',
            'business_website' => 'required',
            'business_email' => 'required|email',
            'business_phone' => 'required',
            'business_product_services' => 'required',
            'business_PCI_DSS_compliance_status' => 'required',
            'business_HTTPS_compliance_status' => 'required',
            'business_bank_account_name' => 'required',
            'business_bank_account_address' => 'required',
            'business_bank_name' => 'required',
            'business_bank_address' => 'required',
            'business_bank_IBAN' => 'required',
            'business_bank_IFSC' => 'required',
            'business_bank_SWIFT_code' => 'required',
            'business_bank_routing_code' => 'required',
            'authorized_persons_name' => 'required',
            'authorized_persons_email' => 'required|email',
            'password' => 'required|confirmed',
            'business_scan_signed_contract' => 'required|file',
            'business_scan_EIN' => 'required|file',
            'business_scan_PAN' => 'required|file',
            'business_scan_registration_document' => 'required|file',
            'business_scan_bank_statement' => 'required|file',
            'business_scan_utility_bills' => 'required|file',
            'business_scan_business_tax_returns' => 'required|file',
            'business_premises_external_pictures' => 'required|file',
            'business_premises_internal_pictures' => 'required|file',
        ]);

        $org = Organization::create([
            'business_name' => $this->business_name,
            'business_address' => $this->business_address,
            'business_website' => $this->business_website,
            'business_email' => $this->business_email,
            'business_phone' => $this->business_phone,
            'business_PCI_DSS_compliance_status' => $this->business_PCI_DSS_compliance_status,
            'business_HTTPS_compliance_status' => $this->business_HTTPS_compliance_status,
            'business_bank_account_name' => $this->business_bank_account_name,
            'business_bank_account_address' => $this->business_bank_account_address,
            'business_bank_name' => $this->business_bank_name,
            'business_bank_address' => $this->business_bank_address,
            'business_bank_IBAN' => $this->business_bank_IBAN,
            'business_bank_IFSC' => $this->business_bank_IFSC,
            'business_bank_SWIFT_code' => $this->business_bank_SWIFT_code,
            'business_bank_routing_code' => $this->business_bank_routing_code,
            'authorized_persons_name' => $this->authorized_persons_name,
            'authorized_persons_email' => $this->authorized_persons_email,
            'password' => Hash::make($this->password),
        ]);

        $this->render();
    }

   

    public function render()
    {
        return view('livewire.dealer.registration')->layout('layouts.guest-base');
    }
}
