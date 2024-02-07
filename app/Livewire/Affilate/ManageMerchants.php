<?php

namespace App\Livewire\Affilate;

use App\Mail\MerchantInviteMail;
use App\Models\AffiliateMerchantCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class ManageMerchants extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $email;

    public function sendInvite()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email'
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.'
        ]);

        try {
            DB::beginTransaction();
            $merchant = AffiliateMerchantCode::create([
                'affiliate_id' => auth()->user()->id,
                'merchant_name' => $this->name,
                'merchant_email' => $this->email,
                'merchant_code' => strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8))
            ]);
            DB::commit();
            $mailData = [
                'name' => $this->name,
                'code' => $merchant->merchant_code,
                'affiliate_name' => auth()->user()->name,
            ];
            Mail::to($this->email)->send(new MerchantInviteMail($mailData));
            $this->dispatch('message', heading:'success',text:'Merchant Invite Sent successfully');
            $this->closeModal();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('message', heading:'error',text:'Email is already registered');
            $this->closeModal();
        }

    }

    public function closeModal()
    {
        $this->resetPage();
        $this->dispatch('close-modal');
    }

    public function deleteInvite($id)
    {
        try {
            DB::beginTransaction();
            $merchant = AffiliateMerchantCode::find($id);
            $merchant->delete();
            DB::commit();
            $this->dispatch('message', heading:'success', text:'Merchant Invite Deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('message', heading:'error', text: $e->getMessage());
        }

    }

    public function resendInvite($id)
    {
        try {
            DB::beginTransaction();
            $merchant = AffiliateMerchantCode::find($id);

            $newInvite = AffiliateMerchantCode::create([
                'affiliate_id' => auth()->user()->id,
                'merchant_name' => $merchant->merchant_name,
                'merchant_email' => $merchant->merchant_email,
                'merchant_code' => strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8))
            ]);

            $mailData = [
                'name' => $newInvite->merchant_name,
                'code' => $newInvite->merchant_code,
                'affiliate_name' => auth()->user()->name,
            ];
            Mail::to($newInvite->merchant_email)->send(new MerchantInviteMail($mailData));

            $merchant->delete();
            DB::commit();
            $this->dispatch('message', heading:'success', text:'Merchant Invite Resent successfully');
        } catch(\Exception $e) {
            DB::rollBack();
            $this->dispatch('message', heading:'error', text: $e->getMessage());
        }

    }

    public function render()
    {
        $merchants = AffiliateMerchantCode::where('affiliate_id', auth()->user()->id)->paginate(10);
        return view('livewire.affilate.manage-merchants', [
            'merchants' => $merchants
        ])->layout('layouts.dashboard-layout');
    }
}
