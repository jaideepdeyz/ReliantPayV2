<?php

namespace App\Livewire\Dealer\Registration;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Mail\DealerRegistrationSubmissionMail;
use App\Mail\MerchantAddedByAdminConfirmationMail;
use App\Models\AffiliateMerchantCode;
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
            $isAddedByAffiliate = AffiliateMerchantCode::where('user_id', auth()->user()->id)->first();
            if ($isAddedByAffiliate) {
                $org->update([
                    'affiliate_id' => $isAddedByAffiliate->affiliate_id,
                ]);
            } else {
                // default ORGANIC Affliate
                switch(auth()->user()->role)
                {
                    case RoleEnum::ADMIN->value:
                        $status = StatusEnum::APPROVED;
                        $remarks = 'Registration Approved';
                        $org->update([
                            'affiliate_id' => 1,
                            'status' => $status,
                        ]);
                        $userID = $org->user_id;
                        $isApproved = 'Yes';
                        break;
                    default:
                        $status = StatusEnum::SUBMITTED;
                        $remarks = 'Registration Submitted';
                        $org->update([
                            'affiliate_id' => 2,
                            'status' => $status,
                        ]);
                        $userID = auth()->user()->id;
                        $isApproved = 'No';

                }
            }

            //storing transaction log
            TransactionLog::create([
                'organization_id' => $org->id,
                'user_id' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
                'sales_id' => null,
                'type' => 'Registration',
                'status' => $status,
                'remarks' => $remarks,
            ]);

            $user = User::find($userID);
            $user->update([
                'organization_id' => $this->orgID,
                'is_approved' => $isApproved,
            ]);

            if(auth()->user()->role == RoleEnum::ADMIN->value)
            {
                $mailData = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => 'Merchant@123#',
                ];

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
