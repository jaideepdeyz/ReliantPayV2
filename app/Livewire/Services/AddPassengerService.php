<?php

namespace App\Livewire\Services;

use App\Models\Passenger;
use App\Models\SaleBooking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddPassengerService extends Component
{
    public $appID;
    public $full_name;
    public $gender;
    public $dob;
    public $relationship_to_card_holder;
    public $passengers = [];
    public $passengerID;

    public function mount($appID)
    {
        $this->appID = $appID;
        $this->passengers = Passenger::where('app_id', $this->appID)->get();
    }

    public function storePassenger()
    {
        // dd('yaay');
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
            $this->reset(['full_name', 'gender', 'dob', 'relationship_to_card_holder']);
            $this->passengers = Passenger::where('app_id', $this->appID)->get();
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
            $this->passengers = Passenger::where('app_id', $this->appID)->get();
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

        return view('livewire.services.add-passenger-service')->layout('layouts.dashboard-layout');
    }
}
