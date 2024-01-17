<?php

namespace App\Livewire\Dealer\Registration;

use App\Enums\StatusEnum;
use App\Models\Organization;
use App\Models\TransactionLog;
use App\Models\User;
use Livewire\Component;

class Confirmation extends Component
{
    public $orgID;

    public function mount($orgID)
    {
        $this->orgID = $orgID;
    }

    public function save()
    {
        $org = Organization::find($this->orgID);
        //storing transaction log
        TransactionLog::create([
            'organization_id' => $org->id,
            'user_id' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
            'sales_id' => null,
            'type' => 'Registration',
            'status' => StatusEnum::SUBMITTED,
            'remarks' => 'Registration Submitted',
        ]);

        $user = User::find(auth()->user()->id);
        $user->update([
            'organization_id' => $this->orgID,
            'is_approved' => 'No',
        ]);

        return redirect()->route('dashboard');
    }

    public function decreaseStep()
    {
        return redirect()->route('dealerDocs', ['orgID' => $this->orgID]);
    }


    public function render()
    {
        return view('livewire.dealer.registration.confirmation')->layout('layouts.dashboard-layout');
    }
}
