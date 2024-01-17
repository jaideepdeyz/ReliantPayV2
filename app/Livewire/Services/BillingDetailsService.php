<?php

namespace App\Livewire\Services;

use App\Enums\ServiceEnum;
use App\Models\ChargeDetails;
use App\Models\Payment;
use App\Models\SaleBooking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class BillingDetailsService extends Component
{
    use WithFileUploads;

    //billing details
    public $appID;
    public $cc_name;
    public $cc_phone;
    public $cc_email;
    public $cc_dob;
    public $cc_number;
    public $cc_type;
    public $cc_expiration_date;
    public $cc_cvc;
    public $cc_billing_address;
    public $amount_charged;
    public $billingComments;
    public $primary_passenger_id_doc;

    public $saleBooking;
    public $showIdUpload = 'No';

    public function mount($appID)
    {
        $this->appID = $appID;
        $this->saleBooking = SaleBooking::find($this->appID);
        // charges calculation
        $charges = ChargeDetails::where('app_id', $this->appID)->get();
        $this->amount_charged = $charges->sum('amount');

        // checking if ID is required
        if($this->amount_charged >= 500)
        {
            $this->showIdUpload = 'Yes';
        }

        $billingDetails = Payment::where('app_id', $this->appID)->first();
        if($billingDetails)
        {
            $this->cc_name = $billingDetails->cc_name;
            $this->cc_phone = $billingDetails->cc_phone;
            $this->cc_email = $billingDetails->cc_email;
            $this->cc_dob = $billingDetails->cc_dob;
            $this->cc_number = $billingDetails->cc_number;
            $this->cc_type = $billingDetails->cc_type;
            $this->cc_expiration_date = $billingDetails->cc_expiration_date;
            $this->cc_cvc = $billingDetails->cc_cvc;
            $this->cc_billing_address = $billingDetails->cc_billing_address;
            $this->amount_charged = $billingDetails->amount_charged;
            $this->billingComments = $billingDetails->comments;
        }
    }

    public function saveBillingDetails()
    {
        // $this->validate([
        //     'cc_name' => 'required',
        //     'cc_phone' => 'required',
        //     'cc_email' => 'required',
        //     'cc_dob' => 'required',
        //     'cc_number' => 'required',
        //     'cc_type' => 'required',
        //     'cc_expiration_date' => 'required',
        //     'cc_cvc' => 'required',
        //     'cc_billing_address' => 'required',
        //     'amount_charged' => 'required',
        //     // 'billingComments' => 'required',
        //     // 'primary_passenger_id_doc' => 'required|mimes:pdf',
        // ]);

        try {
            DB::beginTransaction();
            $payment = Payment::updateOrCreate(
                ['app_id' => $this->appID],
                [
                'app_id' => $this->appID,
                'cc_name' => $this->cc_name,
                'cc_phone' => $this->cc_phone,
                'cc_email' => $this->cc_email,
                'cc_dob' => $this->cc_dob,
                'cc_number' => $this->cc_number,
                'cc_type' => $this->cc_type,
                'cc_expiration_date' => $this->cc_expiration_date,
                'cc_cvc' => $this->cc_cvc,
                'cc_billing_address' => $this->cc_billing_address,
                'amount_charged' => $this->amount_charged,
                'comments' => $this->billingComments,
                ]
            );

            if($this->primary_passenger_id_doc)
            {
                $payment->update([
                'primary_passenger_id_doc' => $this->primary_passenger_id_doc->storeAs('public/PaymentOrders/'.$this->appID.'/passengerID_doc.'.$this->primary_passenger_id_doc->getClientOriginalExtension()),
                ]);
            }

            DB::commit();
            Session::flash('message', ['heading'=>'success','text'=>'Billing Details Saved Successfully']);
            switch($this->saleBooking->service->service_name)
            {
                case ServiceEnum::FLIGHTS->value:
                    return redirect()->route('airlineBooking.show', $this->appID);
                case ServiceEnum::AMTRAK->value:
                    return redirect()->route('amtrakBookingDetails.show', $this->appID);
                default:
                    return redirect()->back();
            }

        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function previousStep()
    {
        return redirect()->route('addChargeDetails', ['appID' => $this->appID]);
    }

    public function render()
    {
        $saleBooking = SaleBooking::find($this->appID);
        return view('livewire.services.billing-details-service', [
            'saleBooking' => $saleBooking,
        ])->layout('layouts.dashboard-layout');
    }
}
