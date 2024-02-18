<?php

namespace App\Livewire\Modals;

use App\Enums\RoleEnum;
use App\Livewire\Admin\ManageOrganizations;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddMerchantByAdmin extends Component
{
    public $name;
    public $email;
    public $mobile;

    public function createUser()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|unique:users,phone_number',
        ], [
            'name.required' => 'The Merchants Username is required.',
            'email.required' => 'The Merchants Email is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email provided has already been taken.',
            'mobile.required' => 'The Merchants Mobile is required.',
            'mobile.numeric' => 'The mobile must be a valid number.',
            'mobile.unique' => 'The mobile provided has already been taken.',
        ]);

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make('Merchant@123#'),
                'role' => RoleEnum::DEALER,
                'is_active' => 'No', // This will be approved by the admin when he completes the fill up the other details
                'is_approved' => 'No', // This will be approved by the admin when he fills up the other details
                'phone_number' => $this->mobile,
            ]);
            DB::commit();
            $this->dispatch('hideModal');
            return redirect()->route('registrationByAdmin', [
                'userID' => $user->id,
                // 'viewOnly' => 'No',
            ]);
        } catch(\Exception $e) {
            DB::rollback();
            $this->dispatch('updated');
            $this->dispatch('message', heading:'error', text:'Email or Mobile is already in use')->to(ManageOrganizations::class);
            $this->dispatch('hideModal');
            return;
        }
    }
    public function render()
    {
        return view('livewire.modals.add-merchant-by-admin');
    }
}
