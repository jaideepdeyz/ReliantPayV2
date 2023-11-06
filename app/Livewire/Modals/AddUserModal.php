<?php

namespace App\Livewire\Modals;

use App\Enums\RoleEnum;
use App\Livewire\Agents\AddAgent;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AddUserModal extends Component
{
    public $orgID;
    public $name;
    public $email;

    public function mount($orgID)
    {
        $this->orgID = $orgID;
    }

    public function addAgent()
    {
        $this->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);

        try {
            DB::beginTransaction();
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make('Agent@123#'),
                'role' => RoleEnum::AGENT,
                'organization_id' => $this->orgID,
                'is_active' => 'Yes',
                'is_approved' => 'Yes',
            ]);
            DB::commit();
            $this->dispatch('hideModal');
            $this->dispatch('updatedAgent');
            $this->dispatch('message', heading:'success',text:'Agent added successfully')->to(AddAgent::class);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->dispatch('error', 'Something went wrong!');
            return;
        }

    }

    public function render()
    {
        return view('livewire.modals.add-user-modal');
    }
}
