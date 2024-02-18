<?php

namespace App\Livewire\Dealer\Registration;

use App\Enums\StatusEnum;
use App\Mail\MerchantAddedByAdminConfirmationMail;
use App\Models\MerchantPasswordChangeLogs;
use App\Models\Organization;
use App\Models\OrganizationServiceMap;
use App\Models\ProductService;
use App\Models\ServiceMaster;
use App\Models\User;
use App\Service\TrueDialogSmsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class RegistrationByAdmin extends Component
{
    public $userID;
    public $business_name;
    public $business_product_services = [];
    public $productsServices = [];
    public $orgProductsServices = [];

    private $smsService;


    public function boot(){
        $this->smsService = new TrueDialogSmsService();
    }

    public function mount($userID)
    {
        $this->userID = $userID;

        $org = Organization::where('user_id', $this->userID)->first();
        if($org) {
            $this->business_name = $org->business_name;

        }
    }

    public function save()
    {
        $this->validate([
            'business_name' => 'required',
        ]);

        try
        {
            DB::beginTransaction();
            $org = Organization::updateOrCreate(
                ['user_id' => $this->userID],
                [
                    'business_name' => $this->business_name,
                    'status' => StatusEnum::APPROVED->value,
                ]
            );

            // Storing Services and Products of an Organization
            $existingServices = OrganizationServiceMap::where('organization_id', $org->id)->get();
            foreach($existingServices as $existingService)
            {
                $existingService->delete();
            }

            //storing Services and Products of an Organization
            foreach($this->business_product_services as $key=> $service)
            {
                if($service == true)
                {
                    $service = ServiceMaster::where('service_name', $key)->first();
                    OrganizationServiceMap::create([
                        'organization_id' => $org->id,
                        'service_name' => $service->service_name,
                        'service_id' => $service->id,
                    ]);
                }
            }

            $user = User::where('id', $this->userID)->first();
            $user->update([
                'is_active' => 'Yes',
                'is_approved' => 'Yes',
                'organization_id' => $org->id,
            ]);

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

            DB::commit();
            return redirect()->route('manageOrganizations');
        }
        catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }



    public function render()
    {
        $services = ProductService::all();
        return view('livewire.dealer.registration.registration-by-admin',[
            'services' => $services
        ])->layout('layouts.dashboard-layout');
    }
}
