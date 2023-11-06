<?php

namespace App\Livewire\Services;

use App\Models\Airport;
use App\Models\Country;
use App\Models\FlightBooking;
use App\Models\SaleBooking;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Session;

class FlightBookingService extends Component
{
    public $appID;
    public $departureCountry;
    public $destinationCountry;
    public $airports = [];
    public $destinationAirports = [];
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

    //passenger details
    public $full_name;
    public $gender;
    public $dob;
    public $relationship_to_card_holder;

    public function mount($appID)
    {
        $this->appID = $appID;
        $flightBooking = FlightBooking::where('app_id', $this->appID)->first();
        if($flightBooking)
        {
            $this->airline_name = $flightBooking->airline_name;
            $this->confirmation_number = $flightBooking->confirmation_number;
            $this->departureCountry = $flightBooking->departure_country;
            $this->departure_location = $flightBooking->departure_location;
            $this->departure_date = $flightBooking->departure_date;
            $this->destination_location = $flightBooking->destination_location;
            $this->destinationCountry = $flightBooking->destination_country;
            $this->tripType = $flightBooking->oneway_or_roundtrip;
            $this->return_date = $flightBooking->return_date;
            $this->no_days_hotel_car = $flightBooking->no_days_hotel_car;
            $this->comments = $flightBooking->comments;
            $this->updatedDepartureCountry($this->departureCountry);
            $this->updatedDestinationCountry($this->departureCountry);
        }

    }

    public function updatedTripType($value)
    {
        if($value == 'One Way')
        {
            $this->isRoundTrip = 'No';
        }
        else
        {
            $this->isRoundTrip = 'Yes';
        }
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
        try {
            DB::beginTransaction();
            FlightBooking::updateOrCreate(
                ['app_id' => $this->appID],
                [
                    'airline_name' => $this->airline_name,
                    'confirmation_number' => $this->confirmation_number,
                    'departure_country' => $this->departureCountry,
                    'departure_location' => $this->departure_location,
                    'departure_date' => $this->departure_date,
                    'destination_country' => $this->destinationCountry,
                    'destination_location' => $this->destination_location,
                    'oneway_or_roundtrip' => $this->tripType,
                    'return_date' => $this->return_date,
                    'no_days_hotel_car' => $this->no_days_hotel_car,
                    'comments' => $this->comments,
                ]
            );
            DB::commit();
            Session::flash('message', ['heading'=>'success','text'=>'Flight Booking Details Saved Successfully']);
            return redirect()->route('addPassengers', ['appID' => $this->appID]);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function render()
    {
        $countries = Country::orderBy('name', 'ASC')->get();
        $bookingDetails = SaleBooking::find($this->appID);

        return view('livewire.services.flight-booking-service', compact('countries', 'bookingDetails'))->layout('layouts.dashboard-layout');
    }
}
