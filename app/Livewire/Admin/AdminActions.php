<?php

namespace App\Livewire\Admin;

use App\Enums\StatusEnum;
use App\Mail\DealerRegistrationApprovalMail;
use App\Mail\DealerRegistrationRejectionMail;
use App\Models\Organization;
use App\Models\OrganizationServiceMap;
use App\Models\RegistrationUpload;
use App\Models\TransactionLog;
use App\Models\User;
use App\Service\TrueDialogSmsService;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class AdminActions extends Component
{
    public $orgID;
    public $org;
    public $remarks;
    public $status;
    public $docs;
    public $services;
    public $action;

    private $smsService;

    public function boot(){
        $this->smsService = new TrueDialogSmsService();
    }

    public function mount($orgID)
    {
        $this->orgID = $orgID;
        $this->org = Organization::find($this->orgID);
        $this->docs = RegistrationUpload::where('organization_id', $this->orgID)->get();
        $this->services = OrganizationServiceMap::where('organization_id', $this->orgID)->get();

    }

    public function openPdf($url, $title)
    {
        $this->dispatch('showModal', ['alias' => 'modals.pdf-reader', 'params' => ['url' => $url, 'title' => $title]]);
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function approve()
    {
        try {
            DB::beginTransaction();
            $this->status = StatusEnum::APPROVED;
            $this->remarks = 'Approved by Admin';
            $this->org->update(['status' => $this->status]);
            $user = User::find($this->org->user_id);
            $user->update([
                'is_active' => 'Yes',
                'is_approved' => 'Yes',
            ]);
            $this->transactionLog();
            DB::commit();
            $mailData = [
                'name' => $user->name,
                'email' => $user->email,
            ];
            Mail::to($user->email)->send(new DealerRegistrationApprovalMail($mailData));
            $this->smsService->sendSms('+1'.$user->phone_number, 'Your application for merchant registration on the ReliantPay platform is Approved. Questions? Contact support@reliantpay.com');
            session()->flash('message', ['heading' => 'success', 'text' => 'Organization Approved']);
            return redirect()->route('manageOrganizations');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }

    }

    public function rejectOrganization()
    {
        $this->validate([
            'remarks' => 'required',
        ], [
            'remarks.required' => 'Please enter reason for rejection',
        ]);

        try {
            DB::beginTransaction();
            $this->status = StatusEnum::REJECTED;
            $this->transactionLog();
            $this->org->update(['status' => $this->status]);
            $user = User::find($this->org->user_id);
            $user->update([
                'is_active' => 'No',
                'is_approved' => 'No',
            ]);
            DB::commit();
            $mailData = [
                'name' => $user->name,
                'organization_name' => $user->organization->business_name,
                'reason' => $this->remarks,
            ];
            Mail::to($user->email)->send(new DealerRegistrationRejectionMail($mailData));
            $this->smsService->sendSms('+1'.$user->phone_number, 'Your application for merchant registration on the ReliantPay platform is Rejected. Questions? Contact support@reliantpay.com');
            session()->flash('message', ['heading' => 'success', 'text' => 'Organization rejected']);
            return redirect()->route('manageOrganizations');
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
        }
    }

    public function deactivate()
    {
        try {
            DB::beginTransaction();
            $this->status = StatusEnum::INACTIVE;
            $this->remarks = 'Deactivated by Admin';
            $users = User::where('organization_id', $this->org->id)->get();
            foreach($users as $user)
            {
                $user->update([
                    'is_active' => 'No',
                ]);
            }
            $this->transactionLog();
            DB::commit();
            session()->flash('message', ['heading' => 'success', 'text' => 'Organization accounts deactivated']);
            return redirect()->route('manageOrganizations');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }

    }

    public function activate()
    {
        try {
            DB::beginTransaction();
            $this->status = StatusEnum::ACTIVE;
            $this->remarks = 'Activated by Admin';
            $users = User::where('organization_id', $this->org->id)->get();
            foreach($users as $user)
            {
                $user->update([
                    'is_active' => 'Yes',
                ]);
            }
            $this->transactionLog();
            DB::commit();
            session()->flash('message', ['heading' => 'success', 'text' => 'Organization accounts activated']);
            return redirect()->route('manageOrganizations');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
    }

    public function transactionLog()
    {
            TransactionLog::create([
                'organization_id' => $this->org->id,
                'user_id' => $this->org->user_id,
                'updated_by' => auth()->user()->id,
                'sales_id' => null,
                'type' => 'Registration',
                'status' => $this->status,
                'remarks' => $this->remarks,
            ]);
    }

    public function render()
    {
        return view('livewire.admin.admin-actions')->layout('layouts.admin');
    }
}
