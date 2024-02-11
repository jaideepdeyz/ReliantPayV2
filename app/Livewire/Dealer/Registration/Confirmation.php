<?php

namespace App\Livewire\Dealer\Registration;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Mail\DealerRegistrationSubmissionMail;
use App\Mail\MerchantAddedByAdminConfirmationMail;
use App\Models\AffiliateMerchantCode;
use App\Models\MerchantPasswordChangeLogs;
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
    public $status;
    public $remarks;
    public $userID;
    public $isApproved = 'No'; // 'Yes' or 'No

    private $smsService;


    public function boot(){
        $this->smsService = new TrueDialogSmsService();
    }

    public function mount($orgID)
    {
        $this->orgID = $orgID;
        $org = Organization::find($this->orgID);
        $this->userID = $org->user_id;
    }

    public function save()
    {
        try {
            DB::beginTransaction();
            $org = Organization::find($this->orgID);
            $isAddedByAffiliate = AffiliateMerchantCode::where('user_id', auth()->user()->id)->first();
            if ($isAddedByAffiliate) {
                $org->update([
                    'affiliate_id' => $isAddedByAffiliate->affiliate_id,
                ]);
            } else {
                // default ORGANIC Affliate
                if(auth()->user()->role == RoleEnum::ADMIN->value)
                {
                    $this->status = StatusEnum::APPROVED->value;
                    $this->remarks = 'Registration Approved';
                    $org->update([
                        'affiliate_id' => 1,
                        'status' => $this->status,
                    ]);
                    $this->userID = $org->user_id;
                    $this->isApproved = 'Yes';

                    //storing transaction log
                    TransactionLog::create([
                        'organization_id' => $org->id,
                        'user_id' => $org->user_id,
                        'updated_by' => auth()->user()->id,
                        'sales_id' => null,
                        'type' => 'Registration',
                        'status' => $this->status,
                        'remarks' => $this->remarks,
                    ]);
                } else {
                    $this->status = StatusEnum::SUBMITTED->value;
                    $this->remarks = 'Registration Submitted';
                    $org->update([
                        'affiliate_id' => 2,
                        'status' => $this->status,
                    ]);
                    $this->userID = auth()->user()->id;
                    $this->isApproved = 'No';

                    //storing transaction log
                    TransactionLog::create([
                        'organization_id' => $org->id,
                        'user_id' => $org->user_id,
                        'updated_by' => auth()->user()->id,
                        'sales_id' => null,
                        'type' => 'Registration',
                        'status' => $this->status,
                        'remarks' => $this->remarks,
                    ]);
                }
            }



            $user = User::find($this->userID);
            $user->update([
                'organization_id' => $this->orgID,
                'is_approved' => $this->isApproved,
            ]);

            if(auth()->user()->role == RoleEnum::ADMIN->value)
            {
                $mailData = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => 'Merchant@123#',
                ];

                $passwordChangeLog = MerchantPasswordChangeLogs::create([
                    'user_id' => $user->id,
                    'first_password_changed' => 'No',
                ]);

                Mail::to($user->email)->send(new MerchantAddedByAdminConfirmationMail($mailData));
                $this->smsService->sendSms('+1'.$user->phone_number, 'Thank you for registering! Your application is APPROVED and CREDENTIALS have been intimated over email. Questions? Contact support@reliantpay.com');
            } else {
                Mail::to($user->email)->send(new DealerRegistrationSubmissionMail($user->name));
                $this->smsService->sendSms('+1'.$user->phone_number, 'Thank you for registering! Your application is under review. We will intimate you via email upon approval. Questions? Contact support@reliantpay.com');
            }
            DB::commit();
            return redirect()->route('dashboard');
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
