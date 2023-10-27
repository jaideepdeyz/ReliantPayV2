<?php

namespace App\Livewire\Services;

use App\Models\Passenger;
use App\Models\SaleBooking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class AddPassengerService extends Component
{
    public $appID;
    public $full_name;
    public $gender = '';
    public $dob = '';
    public $relationship_to_card_holder = '';
    public $passengerID = '';

    public function mount($appID)
    {
        $this->appID = $appID;
    }

    public function storePassenger()
    {
        $this->validate([
            'full_name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'relationship_to_card_holder' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Passenger::create([
                'app_id' => $this->appID,
                'full_name' => $this->full_name,
                'gender' => $this->gender,
                'dob' => Carbon::parse($this->dob)->format('Y-m-d'),
                'relationship_to_card_holder' => $this->relationship_to_card_holder,
            ]);
            DB::commit();
            $this->reset(['full_name','gender', 'dob', 'relationship_to_card_holder']);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function deletePassenger($passengerID)
    {
        try {
            DB::beginTransaction();
            $this->passengerID = $passengerID;
            Passenger::find($this->passengerID)->delete();
            DB::commit();
            $this->reset('passengerID');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function nextStep()
    {
        return redirect()->route('billingDetails', ['appID' => $this->appID]);
    }

    public function previousStep()
    {
        return redirect()->route('flightBooking', ['appID' => $this->appID]);
    }

    public function render()
    {
        // $this->reset();
        $passengers = Passenger::where('app_id', $this->appID)->get();
        return view('livewire.services.add-passenger-service',[
            'passengers' => $passengers,
        ])->layout('layouts.dashboard-layout');
    }
}
