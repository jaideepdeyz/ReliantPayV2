<?php

namespace App\Livewire\Services;

use App\Enums\ServiceEnum;
use App\Models\ChargeDetails;
use App\Models\SaleBooking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ChargeDetailService extends Component
{

    public $appID;
    public $charge_type;
    public $amount;
    public $saleBooking;
    public $totalCharges;
    public $chargeID;

    public function mount($appID)
    {
        $this->appID = $appID;
        $this->saleBooking = SaleBooking::find($this->appID);
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
        Session::flash('message', ['heading'=>'success','text'=>'Billing / Charges Details Saved Successfully']);
        return redirect()->route('billingDetails', ['appID' => $this->appID]);
    }

    public function previousStep()
    {
        Session::flash('message', ['heading'=>'success','text'=>'Billing / Charges Details Saved Successfully']);
        return redirect()->route('addPassengers', ['appID' => $this->appID]);
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
        $this->totalCharges = $charges->sum('amount');
        return view('livewire.services.charge-detail-service', [
            'charges' => $charges,
        ])->layout('layouts.dashboard-layout');
    }
}
