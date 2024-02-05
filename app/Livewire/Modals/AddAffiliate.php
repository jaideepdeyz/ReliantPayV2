<?php

namespace App\Livewire\Modals;

use App\Enums\RoleEnum;
use App\Livewire\Admin\ManageAffiliates;
use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AddAffiliate extends Component
{

    public $name;
    public $email;
    public $phone;
    public $id;
    public function mount($id = null)
    {
        Log::info('id: ' . $id);
        if ($id) {
            $this->id = $id;
            $affiliate = Affiliate::where('id', $id)->first();
            $this->name = $affiliate->affiliate_name;
            $this->email = $affiliate->affiliate_email;
            $this->phone = $affiliate->affiliate_phone;
        }
    }

    public function addAffiliate()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);
        try {
            DB::beginTransaction();
            if ($this->id) {
                $affiliate = Affiliate::where('id', $this->id)->first();
                $affiliate->update([
                    'affiliate_name' => $this->name,
                    'affiliate_email' => $this->email,
                    'affiliate_phone' => $this->phone
                ]);
            } else {
                $user= User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone_number' => $this->phone,
                    'password' => Hash::make('Affilate@123#'),
                    'role' => RoleEnum::AFFILIATE,
                    'is_active' => 'Yes',
                    'is_approved' => 'Yes',
                ]);
                Affiliate::create([
                    'affiliate_name' => $this->name,
                    'affiliate_email' => $this->email,
                    'affiliate_phone' => $this->phone,
                    'affiliate_code' => 'AFL' . $user->id, 
                    'user_id' => $user->id
                ]);
            }

            $this->dispatch('updated');
            $this->dispatch('message', heading:'success',text:'Affilate added successfully')->to(ManageAffiliates::class);
            $this->dispatch('hideModal');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->dispatch('error', 'Something went wrong!');
        }
    }




    public function render()
    {
        return view('livewire.modals.add-affiliate');
    }
}
