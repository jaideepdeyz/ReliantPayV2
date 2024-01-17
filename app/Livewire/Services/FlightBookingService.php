<?php

namespace App\Livewire\Services;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\Country;
use App\Models\FlightBooking;
use App\Models\SaleBooking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Reactive;
use Livewire\WithPagination;

class FlightBookingService extends Component
{
    use WithPagination;
    public $appID;

    public $departureCountry;
    public $destinationCountry;
    public $departure_country_name;
    public $destination_country_name;

    // public $airports = [];
    // public $destinationAirports = [];
    public $isRoundTrip = 'No';

    //flight details
    public $airline_name;
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

    public $departureAirport;
    public $destinationAirport;
    public $searchCountry;

    // dropdown search
    public $query;
    public $departureQuery;
    public $destinationQuery;
    public $airlines = [];
    public $departureAirports = [];
    public $destinationAirports = [];




    // #[On('depAirport')]
    // public function depAirport($airportID)
    // {
    //     $this->departure_location = $airportID;
    //     $airport = Airport::find($airportID);
    //     $this->departureAirport = $airport->name;
    // }

    // #[On('destAirport')]
    // public function destAirport($airportID)
    // {
    //     $this->destination_location = $airportID;
    //     $airport = Airport::find($airportID);
    //     $this->destinationAirport = $airport->name;
    // }
    // #[On('depCountry')]
    // public function depCountry($code)
    // {
    //     $this->departureCountry = $code;
    //     $country = Country::where('code', $code)->first();
    //     $this->departure_country_name = $country->name;
    //     $this->departure_location = null;
    //     $this->departureAirport = null;

    // }
    // #[On('destCountry')]
    // public function destCountry($code)
    // {
    //     $this->destinationCountry = $code;
    //     $country = Country::where('code', $code)->first();
    //     $this->destination_country_name = $country->name;
    //     $this->destination_location = null;
    //     $this->destinationAirport = null;
    // }

    public function mount($appID)
    {
        $this->appID = $appID;
        $flightBooking = FlightBooking::where('app_id', $this->appID)->first();
        if ($flightBooking) {
            $this->airline_name = $flightBooking->airline_name;
            // $this->confirmation_number = $flightBooking->confirmation_number;
            $this->departureCountry = $flightBooking->departure_country;
            $this->departure_location = $flightBooking->departure_location;
            $this->departure_date = $flightBooking->departure_date;
            $this->destination_location = $flightBooking->destination_location;
            $this->destinationCountry = $flightBooking->destination_country;
            $this->tripType = $flightBooking->oneway_or_roundtrip;
            $this->return_date = $flightBooking->return_date;
            // $this->no_days_hotel_car = $flightBooking->no_days_hotel_car;
            $this->comments = $flightBooking->comments;
            // $this->departure_country_name = Country::where('code', $this->departureCountry)->first()->name;
            $this->departure_country_name = $flightBooking->departure_country;
            // $this->destination_country_name = Country::where('code', $this->destinationCountry)->first()->name;
            $this->destination_country_name = $flightBooking->destination_country;
            $this->departureAirport = Airport::find($this->departure_location)->name;
            $this->destinationAirport = Airport::find($this->destination_location)->name;
            $this->departureHour = $flightBooking->departure_hour;
            $this->departureMinute = $flightBooking->departure_minute;

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

    public function updatedQuery()
    {
        if($this->query == '')
        {
            $this->airlines = [];
        } else {
            $this->airlines = Airline::where('name', 'like', '%'.$this->query.'%')->get();
        }
    }

    public function updatedDepartureQuery()
    {
        if($this->departureQuery == '')
        {
            $this->departureAirports = [];
        } else {
            $this->departureAirports = Airport::where('code', 'like', '%'.$this->departureQuery.'%')
            ->orWhere('city', 'like', '%'.$this->departureQuery.'%')
            ->orWhere('name', 'like', '%'.$this->departureQuery.'%')
            ->get();
        }
    }

    public function updatedDestinationQuery()
    {
        if($this->destinationQuery == '')
        {
            $this->destinationAirports = [];
        } else {
            $this->destinationAirports = Airport::where('code', 'like', '%'.$this->destinationQuery.'%')
            ->orWhere('city', 'like', '%'.$this->destinationQuery.'%')
            ->orWhere('name', 'like', '%'.$this->destinationQuery.'%')
            ->get();
        }
    }

    public function setAirline($airlineName)
    {
        // dd($airlineName);
        $this->airline_name = $airlineName;
        $this->query = $airlineName;
        $this->airlines = [];
    }

    public function setDepartureAirport($airportName)
    {
        $airport = Airport::find($airportName);
        $this->departure_location = $airportName;
        $this->departureCountry = $airport->country;
        $this->departureQuery = $airport->name;
        $this->departureAirports = [];
    }

    public function setDestinationAirport($airportName)
    {
        $airport = Airport::find($airportName);
        $this->destination_location = $airportName;
        $this->destinationCountry = $airport->country;
        $this->destinationQuery = $airport->name;
        $this->destinationAirports = [];
    }




    public function storeFlightBooking()
    {
        try {
            DB::beginTransaction();
            FlightBooking::updateOrCreate(
                ['app_id' => $this->appID],
                [
                    'airline_name' => $this->airline_name,
                    // 'confirmation_number' => $this->confirmation_number,
                    'departure_country' => $this->departureCountry,
                    'departure_location' => $this->departure_location,
                    'departure_date' => $this->departure_date,
                    'destination_country' => $this->destinationCountry,
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

    public function getDepartureAirports()
    {
        if ($this->departureCountry) {
            $this->dispatch('showModal', ['alias' => 'modals.airport-selection', 'params' => ['countryID' => $this->departureCountry, 'type' => 'Departure']]);
        } else {
            Session::flash('message', ['heading' => 'error', 'text' => 'Please select Departure Country']);
            return;
        }
    }
    public function getDestinationAirports(){
        if ($this->destinationCountry) {
            $this->dispatch('showModal', ['alias' => 'modals.airport-selection', 'params' => ['countryID' => $this->destinationCountry, 'type' => 'Destination']]);
        } else {
            Session::flash('message', ['heading' => 'error', 'text' => 'Please select Destination Country']);
            return;
        }
    }
    public function getCountries($type){
        $this->dispatch('showModal', ['alias' => 'modals.country-selection', 'params' => ['type' => $type]]);
    }

    public function render()
    {
        // $countries = Country::orderByRaw("FIELD(code,'MX','CA','US') DESC,name ASC")->get();
        $bookingDetails = SaleBooking::find($this->appID);
        $airlines = Airline::all();
        return view('livewire.services.flight-booking-service', compact('bookingDetails', 'airlines'))->layout('layouts.dashboard-layout');
    }
}
