<?php

namespace App\Livewire\Modals;

use App\Livewire\Admin\ManageUsers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddUserByAdmin extends Component
{

    public $name;
    public $email;
    public $role;
    public $phone;

    public function addUser()
    {
        $this->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'role' => 'required',
            'phone' => 'required|numeric|digits:10'
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'role.required' => 'Role is required',
            'phone.required' => 'Phone Number is required',
            'phone.numeric' => 'Phone Number must be numeric',
            'phone.digits' => 'Phone Number must be 10 digits',
        ]);

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make('User@123#'),
                'role' => $this->role,
                'phone_number' => $this->phone,
                // 'organization_id' => $this->orgID,
                'is_active' => 'Yes',
                'is_approved' => 'Yes',
            ]);

            // $agentLogs = AgentPasswordChangeLogs::updateOrCreate([
            //     'user_id' => $user->id,
            // ],[
            //     'first_password_changed' => 'No',
            //     'last_login_from' => Request::ip(),
            // ]);

            DB::commit();
            // $mailData = [
            //     'name' => $user->name,
            //     'email' => $user->email,
            //     'organization_name' => $user->organization->business_name,
            // ];

            // Mail::to($user->email)->send(new AgentCreationMail($mailData));
            $this->dispatch('hideModal');
            $this->dispatch('operationComplete');
            $this->dispatch('message', heading:'success',text:'User added successfully')->to(ManageUsers::class);
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage());
            $this->dispatch('error', 'Something went wrong!');
            return;
        }

    }

    public function render()
    {
        return view('livewire.modals.add-user-by-admin');
    }
}
