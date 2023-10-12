<?php

namespace App\Livewire\Dealer;

use App\Enums\StatusEnum;
use App\Models\Organization;
use App\Models\OrganizationServiceMap;
use App\Models\ProductService;
use App\Models\RegistrationUpload;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public $business_product_services = [];
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
    public $orgID=null;

    public function registerDealer()
    {
        // $this->dispatch('showModal', ['alias' => 'modals.services-offered']);
        // dd($this->business_product_services);

        $this->validate([
            'business_name' => 'required',
            'business_address' => 'required',
            'business_website' => 'required',
            'business_email' => 'required|email|unique:App\Models\Organization,business_email',
            'business_phone' => 'required',
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
            'business_scan_signed_contract' => 'required|mimes:pdf',
            'business_scan_EIN' => 'required|mimes:pdf',
            'business_scan_PAN' => 'required|mimes:pdf',
            'business_scan_registration_document' => 'required|mimes:pdf',
            'business_scan_bank_statement' => 'required|mimes:pdf',
            'business_scan_utility_bills' => 'required|mimes:pdf',
            'business_scan_business_tax_returns' => 'required|mimes:pdf',
            'business_premises_external_pictures' => 'required|mimes:pdf',
            'business_premises_internal_pictures' => 'required|mimes:pdf',
        ]);

        try{
            DB::beginTransaction();
            $org = Organization::create(
                [
                'user_id' => Auth::user()->id,
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
                'status' => StatusEnum::SUBMITTED,
            ]);

            //storing Services and Products of an Organization

            foreach($this->business_product_services as $service){
                OrganizationServiceMap::create([
                    'organization_id' => $org->id,
                    'service_name' => $service
                ]);
            }

            // store org id in user table
            $user = User::find(Auth::user()->id)->update([
                'organization_id' => $org->id,

            ]);

            $this->orgID = $org->id;
            //storing registration file uploads of an organization
            $this->storeFile($this->business_scan_signed_contract, 'Signed Contract');
            $this->storeFile($this->business_scan_EIN, 'EIN');
            $this->storeFile($this->business_scan_PAN, 'PAN');
            $this->storeFile($this->business_scan_registration_document, 'Registration Document');
            $this->storeFile($this->business_scan_bank_statement, 'Bank Statement');
            $this->storeFile($this->business_scan_utility_bills, 'Utility Bills');
            $this->storeFile($this->business_scan_business_tax_returns, 'Tax Returns');
            $this->storeFile($this->business_premises_external_pictures, 'External Pictures');
            $this->storeFile($this->business_premises_internal_pictures, 'Internal Pictures');

            DB::commit();
            return redirect()->route('dashboard');
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
        }
    }

    public function storeFile($file, $docName)
    {
        $file = RegistrationUpload::create([
            'organization_id' => $this->orgID,
            'document_name' => $docName,
            'document_filepath' => $file->storeAs('public/Registrations/'.$this->orgID, $docName.'.'.$file->getClientOriginalExtension()),
        ]);
    }


    public function render()
    {
        $services = ProductService::all();
        return view('livewire.dealer.registration', compact('services'))->layout('layouts.guest-base');
    }
}
