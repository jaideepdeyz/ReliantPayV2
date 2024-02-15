<?php

namespace App\Livewire\Services;

use App\Enums\ServiceEnum;
use App\Models\Passenger;
use App\Models\SaleBooking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

class AddPassengerService extends Component
{
    public $appID;
    public $full_name;
    public $gender ;
    public $dob;
    // public $relationship_to_card_holder;
    public $passengerID;
    public $saleBooking;

    public $is_disabled;
    public $disability_type;
    public $requires_assistance;
    public $pwdType=0;

    public function mount($appID)
    {
        $this->appID = $appID;
        $this->saleBooking = SaleBooking::find($this->appID);

    }

    public function updatedIsDisabled()
    {
        if($this->is_disabled == 'Yes'){
            $this->pwdType = 1;
        }else{
            $this->pwdType = 0;
        }
    }

    public function storePassenger()
    {
        $this->validate([
            'full_name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            // 'relationship_to_card_holder' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Passenger::create([
                'app_id' => $this->appID,
                'full_name' => $this->full_name,
                'gender' => $this->gender,
                'dob' => Carbon::parse($this->dob)->format('Y-m-d'),
                // 'relationship_to_card_holder' => $this->relationship_to_card_holder,
                'is_disabled' => $this->is_disabled,
                'disability_type' => $this->disability_type,
                'requires_assistance' => $this->requires_assistance,
            ]);
            DB::commit();
            $this->dispatch('message', heading:'success',text:'Passenger added');
            $this->reset(['full_name','gender', 'dob']);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function deletePassenger()
    {
        try {
            DB::beginTransaction();
            Passenger::find($this->passengerID)->delete();
            DB::commit();
            $this->dispatch('message', heading:'success',text:'Passenger removed');
            $this->reset('passengerID');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function selectId($id)
    {
        $this->passengerID = $id;
    }

    public function nextStep()
    {
        $passengerCheck = Passenger::where('app_id', $this->appID)->get();
        if($passengerCheck->count() < 1){
            $this->dispatch('message', heading:'error',text:'Please add atleast one passenger');
            return;
        }
        Session::flash('message', ['heading'=>'success','text'=>'Passenger Details Saved Successfully']);
        return redirect()->route('addChargeDetails', ['appID' => $this->appID]);
    }

    public function previousStep()
    {
        switch($this->saleBooking->service->service_name)
        {
            case ServiceEnum::FLIGHTS->value:
                return redirect()->route('flightBooking', ['appID' => $this->appID]);
                break;
            case ServiceEnum::AMTRAK->value:
                return redirect()->route('amtrakBooking', ['appID' => $this->appID]);
                break;
            default:
                return redirect()->back();
                break;
        }
    }

    public function render()
    {
        $passengers = Passenger::where('app_id', $this->appID)->get();
        return view('livewire.services.add-passenger-service',[
            'passengers' => $passengers,
        ])->layout('layouts.dashboard-layout');
    }
}
