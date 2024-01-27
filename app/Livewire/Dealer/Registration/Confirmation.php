<?php

namespace App\Livewire\Dealer\Registration;

use App\Enums\StatusEnum;
use App\Mail\DealerRegistrationSubmissionMail;
use App\Models\Organization;
use App\Models\TransactionLog;
use App\Models\User;
use App\Service\TrueDialogSmsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Confirmation extends Component
{
    public $orgID;
    private $smsService;

    public function boot(){
        $this->smsService = new TrueDialogSmsService();
    }

    public function mount($orgID)
    {
        $this->orgID = $orgID;
    }

    public function save()
    {
        try {
            DB::beginTransaction();
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

            Mail::to($user->email)->send(new DealerRegistrationSubmissionMail($user->name));
            $this->smsService->sendSms($user->phone_number, 'Thank you for registering! Your application is under review. We will intimate you via email upon approval. Questions? Contact support@reliantpay.com');
            DB::commit();


        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }


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
