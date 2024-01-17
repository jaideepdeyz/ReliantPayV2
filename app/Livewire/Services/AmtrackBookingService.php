<?php

namespace App\Livewire\Services;

use App\Models\AmtrakBooking;
use App\Models\SaleBooking;
use App\Models\TrainStation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class AmtrackBookingService extends Component
{
    use WithPagination;
    public $appID;

    // public $airports = [];
    // public $destinationAirports = [];
    public $isRoundTrip = 'No';

    //amtrak details
    public $confirmation_number;
    public $departure_location;
    public $departure_date;
    public $destination_location;
    public $tripType;
    public $return_date;
    public $no_days_hotel_car;
    public $comments;
    public $departureHour;
    public $departureMinute;

    //passenger details
    public $full_name;
    public $gender;
    public $dob;
    public $relationship_to_card_holder;

    public $departureStation;
    public $destinationStation;

    // dropdown search
    public $query;
    public $departureQuery;
    public $destinationQuery;
    public $departureStations = [];
    public $destinationStations = [];

    public function mount($appID)
    {
        $this->appID = $appID;
        $amtrakBooking = AmtrakBooking::where('app_id', $this->appID)->first();
        if ($amtrakBooking) {
            // $this->confirmation_number = $flightBooking->confirmation_number;
            $this->departure_location = $amtrakBooking->departure_location;
            $this->departure_date = $amtrakBooking->departure_date;
            $this->destination_location = $amtrakBooking->destination_location;
            $this->tripType = $amtrakBooking->oneway_or_roundtrip;
            $this->return_date = $amtrakBooking->return_date;
            // $this->no_days_hotel_car = $flightBooking->no_days_hotel_car;
            $this->comments = $amtrakBooking->comments;
            $this->departureStation = TrainStation::find($this->departure_location)->name;
            $this->destinationStation = TrainStation::find($this->destination_location)->name;
            $this->departureHour = $amtrakBooking->departure_hour;
            $this->departureMinute = $amtrakBooking->departure_minute;
            $this->departureQuery = $amtrakBooking->departureStation->station_location;
            $this->destinationQuery = $amtrakBooking->destinationStation->station_location;

        }
    }

    public function updatedTripType($value)
    {
        if ($value == 'One Way') {
            $this->isRoundTrip = 'No';
        } else {
            $this->isRoundTrip = 'Yes';
        }
    }


    public function updatedDepartureQuery()
    {
        if($this->departureQuery == '')
        {
            $this->departureStations = [];
        } else {
            $this->departureStations = TrainStation::where('station_code', 'like', '%'.$this->departureQuery.'%')
            ->orWhere('station_location', 'like', '%'.$this->departureQuery.'%')
            ->get();
        }
    }

    public function updatedDestinationQuery()
    {
        if($this->destinationQuery == '')
        {
            $this->destinationStations = [];
        } else {
            $this->destinationStations = TrainStation::where('station_code', 'like', '%'.$this->destinationQuery.'%')
            ->orWhere('station_location', 'like', '%'.$this->destinationQuery.'%')
            ->get();
        }
    }

    public function setDepartureStation($stationName)
    {
        $station = TrainStation::find($stationName);
        $this->departure_location = $stationName;
        $this->departureQuery = $station->station_location;
        $this->departureStations = [];
    }

    public function setDestinationStation($stationName)
    {
        $station = TrainStation::find($stationName);
        $this->destination_location = $stationName;
        $this->destinationQuery = $station->station_location;
        $this->destinationStations = [];
    }

    public function storeAmtrakBooking()
    {
        try {
            DB::beginTransaction();
            AmtrakBooking::updateOrCreate(
                ['app_id' => $this->appID],
                [
                    // 'confirmation_number' => $this->confirmation_number,
                    'departure_location' => $this->departure_location,
                    'departure_date' => $this->departure_date,
                    'destination_location' => $this->destination_location,
                    'oneway_or_roundtrip' => $this->tripType,
                    'return_date' => $this->return_date,
                    // 'no_days_hotel_car' => $this->no_days_hotel_car,
                    'comments' => $this->comments,
                    'departure_hour' => $this->departureHour,
                    'departure_minute' => $this->departureMinute,
                ]
            );
            DB::commit();
            Session::flash('message', ['heading' => 'success', 'text' => 'Flight Booking Details Saved Successfully']);
            return redirect()->route('addPassengers', ['appID' => $this->appID]);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function render()
    {
        $bookingDetails = SaleBooking::find($this->appID);
        return view('livewire.services.amtrack-booking-service', compact('bookingDetails'))
        ->layout('layouts.dashboard-layout');
    }
}
