<?php

namespace App\Livewire\Modals;

use App\Enums\RoleEnum;
use App\Livewire\Agents\AddAgent;
use App\Mail\AgentCreationMail;
use App\Models\AgentPasswordChangeLogs;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
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
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
        ]);

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make('Agent@123#'),
                'role' => RoleEnum::AGENT,
                'organization_id' => $this->orgID,
                'is_active' => 'Yes',
                'is_approved' => 'Yes',
            ]);

            $agentLogs = AgentPasswordChangeLogs::create([
                'user_id' => $user->id,
                'first_password_changed' => 'No',
                'last_login_from' => Request::ip(),
            ]);

            DB::commit();
            $mailData = [
                'name' => $user->name,
                'email' => $user->email,
                'organization_name' => $user->organization->business_name,
            ];

            Mail::to($user->email)->send(new AgentCreationMail($mailData));
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
