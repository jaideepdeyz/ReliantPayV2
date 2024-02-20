<?php

namespace App\Livewire\Services;

use App\Enums\ServiceEnum;
use App\Models\ChargeDetails;
use App\Models\SaleBooking;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ChargeDetailService extends Component
{

    public $appID;
    public $charge_type;
    public $transactionDetail;
    public $amount;
    public $saleBooking;
    public $totalTransactionCharges;
    public $totalCharges = 0;
    public $chargeID;

    public function mount($appID)
    {
        $this->appID = $appID;
        $this->saleBooking = SaleBooking::find($this->appID);
        $this->transactionDetail = TransactionDetail::where('sale_booking_id', $this->appID)->first();

    }

    public function storeCharge()
    {
        $this->validate([
            'charge_type' => 'required',
            'amount' => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();
            ChargeDetails::create([
                'app_id' => $this->appID,
                'charge_type' => $this->charge_type,
                'amount' => $this->amount,
            ]);

            DB::commit();
            $this->dispatch('message', heading:'success',text:'Charges/Billing added');
            $this->reset(['charge_type','amount']);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }


    public function nextStep()
    {
        $chargeCheck = ChargeDetails::where('app_id', $this->appID)->get();
        if($chargeCheck->count() < 1){
            $this->dispatch('message', heading:'error',text:'Please add atleast one Charges against this booking');
            return;
        }
        // checking if total tranasaction charges is equal to the sum of charges added
        if($this->totalTransactionCharges != $this->totalCharges){
            $this->dispatch('message', heading:'error',text:'Sum of Total Charges added should be equal to Total Transaction Charges');
            return;
        }

        Session::flash('message', ['heading'=>'success','text'=>'Billing / Charges Details Saved Successfully']);
        return redirect()->route('billingDetails', ['appID' => $this->appID]);
    }

    public function previousStep()
    {
        Session::flash('message', ['heading'=>'success','text'=>'Billing / Charges Details Saved Successfully']);
        return redirect()->route('addTransactionDetails', ['appID' => $this->appID]);
    }

    public function selectId($id)
    {
        $this->chargeID = $id;
    }

    public function deleteCharge()
    {
        try {
            DB::beginTransaction();
            ChargeDetails::find($this->chargeID)->delete();
            DB::commit();
            $this->dispatch('message', heading:'success',text:'Charges removed');
            $this->reset('chargeID');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function render()
    {
        $charges = ChargeDetails::where('app_id', $this->appID)->get();
        $this->totalTransactionCharges = $this->transactionDetail->total_amount;
        $this->totalCharges = ChargeDetails::where('app_id', $this->appID)->sum('amount');
        return view('livewire.services.charge-detail-service', [
            'charges' => $charges,
        ])->layout('layouts.dashboard-layout');
    }
}
