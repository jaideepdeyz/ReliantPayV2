<?php

namespace App\Livewire\Dealer\Registration;

use App\Models\RegistrationUpload;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Monolog\Handler\NullHandler;

class DocumentUploads extends Component
{
    use WithFileUploads;

    public $orgID;
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

    public $uploadedDocs = [];

    public $viewOnly = 'No';

    public function mount($orgID, $viewOnly = null)
    {
        $this->orgID = $orgID;

        $this->viewOnly = $viewOnly;
        if($viewOnly != null)
        {
            $this->viewOnly = 'Yes';
            $this->uploadedDocs = RegistrationUpload::where('organization_id', $this->orgID)->get();
        }
    }

    public function save()
    {

        $this->validate([
            'business_scan_signed_contract' => 'required|mimes:pdf|max:5120',
            'business_scan_EIN' => 'required|mimes:pdf|max:5120',
            'business_scan_PAN' => 'required|mimes:pdf|max:5120',
            'business_scan_registration_document' => 'required|mimes:pdf|max:5120',
            'business_scan_bank_statement' => 'required|mimes:pdf|max:5120',
            'business_scan_utility_bills' => 'required|mimes:pdf|max:5120',
            'business_scan_business_tax_returns' => 'required|mimes:pdf|max:5120',
            'business_premises_external_pictures' => 'required|mimes:pdf|max:5120',
            'business_premises_internal_pictures' => 'required|mimes:pdf|max:5120'
        ], [
            'business_scan_signed_contract.required' => 'Signed Contract is required',
            'business_scan_signed_contract.mimes' => 'Signed Contract must be a pdf file',
            'business_scan_signed_contract.max' => 'Signed Contract should not be greater than 5MB',
            'business_scan_EIN.required' => 'EIN is required',
            'business_scan_EIN.mimes' => 'EIN must be a pdf file',
            'business_scan_EIN.max' => 'EIN should not be greater than 5MB',
            'business_scan_PAN.required' => 'PAN is required',
            'business_scan_PAN.mimes' => 'PAN must be a pdf file',
            'business_scan_PAN.max' => 'PAN should not be greater than 5MB',
            'business_scan_registration_document.required' => 'Registration Document is required',
            'business_scan_registration_document.mimes' => 'Registration Document must be a pdf file',
            'business_scan_registration_document.max' => 'Registration Document should not be greater than 5MB',
            'business_scan_bank_statement.required' => 'Bank Statement is required',
            'business_scan_bank_statement.mimes' => 'Bank Statement must be a pdf file',
            'business_scan_bank_statement.max' => 'Bank Statement should not be greater than 5MB',
            'business_scan_utility_bills.required' => 'Utility Bills is required',
            'business_scan_utility_bills.mimes' => 'Utility Bills must be a pdf file',
            'business_scan_utility_bills.max' => 'Utility Bills should not be greater than 5MB',
            'business_scan_business_tax_returns.required' => 'Tax Returns is required',
            'business_scan_business_tax_returns.mimes' => 'Tax Returns must be a pdf file',
            'business_scan_business_tax_returns.max' => 'Tax Returns should not be greater than 5MB',
            'business_premises_external_pictures.required' => 'External Pictures is required',
            'business_premises_external_pictures.mimes' => 'External Pictures must be a pdf file',
            'business_premises_external_pictures.max' => 'External Pictures should not be greater than 5MB',
            'business_premises_internal_pictures.required' => 'Internal Pictures is required',
            'business_premises_internal_pictures.mimes' => 'Internal Pictures must be a pdf file',
        ]);

        try {
            DB::beginTransaction();
            $this->storeFile($this->business_scan_signed_contract, 'Signed Contract', $this->orgID);
            $this->storeFile($this->business_scan_EIN, 'EIN', $this->orgID);
            $this->storeFile($this->business_scan_PAN, 'PAN', $this->orgID);
            $this->storeFile($this->business_scan_registration_document, 'Registration Document', $this->orgID);
            $this->storeFile($this->business_scan_bank_statement, 'Bank Statement', $this->orgID);
            $this->storeFile($this->business_scan_utility_bills, 'Utility Bills', $this->orgID);
            $this->storeFile($this->business_scan_business_tax_returns, 'Tax Returns', $this->orgID);
            $this->storeFile($this->business_premises_external_pictures, 'External Pictures', $this->orgID);
            $this->storeFile($this->business_premises_internal_pictures, 'Internal Pictures', $this->orgID);
            DB::commit();
            return redirect()->route('confirmation', ['orgID' => $this->orgID]);
        } catch(\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function storeFile($file, $docName, $orgID)
    {
        $file = RegistrationUpload::updateOrCreate(
            ['organization_id' => $this->orgID, 'document_name' => $docName],
            [
            'document_name' => $docName,
            'document_filepath' => $file->storeAs('public/Registrations/'.$this->orgID, $docName.'.'.$file->getClientOriginalExtension()),
        ]);
    }

    public function decreaseStep()
    {
        return redirect()->route('dealerBankingDetails', ['orgID' => $this->orgID]);
    }

    public function render()
    {
        return view('livewire.dealer.registration.document-uploads')->layout('layouts.dashboard-layout');
    }
}
