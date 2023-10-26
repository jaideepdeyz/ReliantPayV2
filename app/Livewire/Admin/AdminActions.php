<?php

namespace App\Livewire\Admin;

use App\Enums\StatusEnum;
use App\Models\Organization;
use App\Models\OrganizationServiceMap;
use App\Models\RegistrationUpload;
use App\Models\TransactionLog;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
            return redirect()->route('manageorganizations');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }

    }

    public function rejectOrganization()
    {
        $this->validate([
            'remarks' => 'required',
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
            return redirect()->route('manageorganizations');
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
            $user = User::find($this->org->user_id);
            $user->update([
                'is_active' => 'No',
            ]);
            $this->transactionLog();
            DB::commit();
            return redirect()->route('manageorganizations');
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
            $user = User::find($this->org->user_id);
            $user->update([
                'is_active' => 'Yes',
            ]);
            $this->transactionLog();
            DB::commit();
            return redirect()->back();
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
