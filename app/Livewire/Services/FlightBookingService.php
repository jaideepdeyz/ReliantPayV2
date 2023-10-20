<?php

namespace App\Livewire\Services;

use App\Models\Airport;
use App\Models\Country;
use App\Models\FlightBooking;
use App\Models\SaleBooking;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FlightBookingService extends Component
{
    public $appID;
    public $departureCountry;
    public $destinationCountry;
    public $airports = [];
    public $destinationAirports = [];

    public $airline_name;
    public $confirmation_number;
    public $departure_location;
    public $departure_date;
    public $destination_location;
    public $oneway_or_roundtrip;
    public $return_date;
    public $no_days_hotel_car;
    public $comments;

    public function mount($appID)
    {
        $this->appID = $appID;

    }

    public function updatedDepartureCountry($value)
    {
        $this->departureCountry = $value;
        $this->airports = Airport::where('iso_country', $this->departureCountry)->get();
    }

    public function updatedDestinationCountry($value)
    {
        $this->destinationCountry = $value;
        $this->destinationAirports = Airport::where('iso_country', $this->destinationCountry)->get();
    }

    public function storeFlightBooking()
    {
        // dd($this->airline_name);
        // $this->validate([
        //     // 'airline_name' => 'required',
        //     'confirmation_number' => 'required',
        //     // 'departure_location' => 'required',
        //     'departure_date' => 'required',
        //     'destination_location' => 'required',
        //     'oneway_or_roundtrip' => 'required',
        //     'no_days_hotel_car' => 'required',
        //     'comments' => 'required',
        // ]);

        try {
            DB::beginTransaction();
            FlightBooking::updateOrCreate(
                ['app_id' => $this->appID],
                [
                    'airline_name' => $this->airline_name,
                    'confirmation_number' => $this->confirmation_number,
                    'departure_location' => $this->departure_location,
                    'departure_date' => $this->departure_date,
                    'destination_location' => $this->destination_location,
                    'oneway_or_roundtrip' => $this->oneway_or_roundtrip,
                    'return_date' => $this->return_date,
                    'no_days_hotel_car' => $this->no_days_hotel_car,
                    'comments' => $this->comments,
                ]
            );
            DB::commit();
            return redirect()->route('addPassengers', ['appID' => $this->appID]);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }

    }

    public function render()
    {
        $countries = Country::all();
        $bookingDetails = SaleBooking::find($this->appID);
        $flightBooking = FlightBooking::where('app_id', $this->appID)->first();
        if($flightBooking)
        {
            $this->airline_name = $flightBooking->airline_name;
            $this->confirmation_number = $flightBooking->confirmation_number;
            $this->departure_location = $flightBooking->departure_location;
            $this->departure_date = $flightBooking->departure_date;
            $this->destination_location = $flightBooking->destination_location;
            $this->oneway_or_roundtrip = $flightBooking->oneway_or_roundtrip;
            $this->return_date = $flightBooking->return_date;
            $this->no_days_hotel_car = $flightBooking->no_days_hotel_car;
            $this->comments = $flightBooking->comments;
        } else {
            $this->reset(['airline_name', 'confirmation_number', 'departure_location', 'departure_date', 'destination_location', 'oneway_or_roundtrip', 'return_date', 'no_days_hotel_car', 'comments']);
        }
        return view('livewire.services.flight-booking-service', compact('countries', 'bookingDetails'))->layout('layouts.dashboard-layout');
    }
}
