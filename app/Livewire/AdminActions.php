<?php

namespace App\Livewire;

use App\Enums\StatusEnum;
use App\Models\Organization;
use App\Models\User;
use Livewire\Component;

class AdminActions extends Component
{
    public $orgID;
    public $org;

    public function mount($orgID)
    {
        $this->orgID = $orgID;
        $this->org = Organization::find($this->orgID);

    }

    public function approve()
    {
        $this->org->update(['status' => StatusEnum::APPROVED]);

        $user = User::find($this->org->user_id);
        $user->update([
            'is_active' => 'Yes',
            'is_approved' => 'Yes',
        ]);
        return redirect()->route('dashboard');
    }

    public function reject()
    {
        $this->org->update(['status' => StatusEnum::REJECTED]);
        $user = User::find($this->org->user_id);
        $user->update([
            'is_active' => 'No',
            'is_approved' => 'No',
        ]);
        return redirect()->route('dashboard');
    }

    public function deactivate()
    {
        $user = User::find($this->org->user_id);
        $user->update([
            'is_active' => 'No',
        ]);
        return redirect()->route('dashboard');
    }

    public function activate()
    {
        $user = User::find($this->org->user_id);
        $user->update([
            'is_active' => 'Yes',
        ]);
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.admin-actions');
    }
}
