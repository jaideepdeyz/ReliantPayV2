<?php

namespace App\Livewire\Services;

use App\Models\Airport;
use App\Models\Country;
use Livewire\Component;

class FlightBooking extends Component
{
    public $appID;
    public $departureCountry;
    public $destinationCountry;
    public $airports = [];
    public $destinationAirports = [];

    public $departure_location;
    public $destination_location;
    public $oneway_or_roundtrip;

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

    public function render()
    {
        $countries = Country::all();
        return view('livewire.services.flight-booking', compact('countries'))->layout('layouts.dashboard-layout');
    }
}
