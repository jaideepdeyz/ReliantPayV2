<?php

namespace App\Livewire\Modals;

use Livewire\Component;

class AddUserModal extends Component
{
    public $orgID;

    public function mount($orgID)
    {
        $this->orgID = $orgID;
    }
    
    public function render()
    {
        return view('livewire.modals.add-user-modal');
    }
}
