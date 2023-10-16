<?php

namespace App\Livewire\Modals;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AddUserModal extends Component
{
    public $orgID;

    public function mount($orgID)
    {
        Log::info('orgID: ' . $orgID);
        $this->orgID = $orgID;
    }

    public function render()
    {
        return view('livewire.modals.add-user-modal');
    }
}
