<?php

namespace App\Livewire\Services;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\Country;
use App\Models\FlightBooking;
use App\Models\SaleBooking;
use App\Models\TravelItenaryUpload;
use App\Models\Cancellation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Reactive;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class FlightBookingService extends Component
{
    use WithPagination, WithFileUploads;
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
    // public $departureHour;
    // public $departureMinute;
    public $destination_location;
    public $tripType;
    public $return_date;
    // public $returnHour;
    // public $returnMinute;
    public $no_days_hotel_car;
    public $comments;
    public $itenary_screenshot;

    public $departure_eta_date;
    // public $departureETAHour;
    // public $departureETAMinute;

    public $return_eta_date;
    // public $returnETAHour;
    // public $returnETAMinute;

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

    public $saleType;
    public $transport_number;
    public $travel_class;

    public function mount($appID)
    {
        $this->appID = $appID;
        $flightBooking = FlightBooking::where('app_id', $this->appID)->first();
        $booking = SaleBooking::where('id', $this->appID)->first();
        $this->saleType = $booking->sale_type;
        if ($flightBooking) {
            // $this->airline_name = $flightBooking->airline_name;
            $this->query = $flightBooking->airline_name;
            $this->airline_name = $flightBooking->airline_name;
            $this->departureQuery = $flightBooking->departureAirport->name;
            $this->destinationQuery = $flightBooking->destinationAirport->name;
            $this->confirmation_number = $flightBooking->confirmation_number;
            $this->departureCountry = $flightBooking->departure_country;
            $this->departure_location = $flightBooking->departure_location;
            $this->departure_date = $flightBooking->departure_date;
            $this->destination_location = $flightBooking->destination_location;
            $this->destinationCountry = $flightBooking->destination_country;
            $this->tripType = $flightBooking->oneway_or_roundtrip;
            $this->transport_number = $flightBooking->transport_number;
            $this->travel_class = $flightBooking->travel_class;
            if($this->tripType == 'Round Trip')
            {
                $this->isRoundTrip = 'Yes';
                $this->return_date = $flightBooking->return_date;
                // $this->returnHour = $flightBooking->return_hour;
                // $this->returnMinute = $flightBooking->return_minute;
                $this->return_eta_date = $flightBooking->return_eta_date;
                // $this->returnETAHour = $flightBooking->return_eta_hour;
                // $this->returnETAMinute = $flightBooking->return_eta_minute;
            }
            // $this->no_days_hotel_car = $flightBooking->no_days_hotel_car;
            $this->comments = $flightBooking->comments;
            // $this->departure_country_name = Country::where('code', $this->departureCountry)->first()->name;
            $this->departure_country_name = $flightBooking->departure_country;
            // $this->destination_country_name = Country::where('code', $this->destinationCountry)->first()->name;
            $this->destination_country_name = $flightBooking->destination_country;
            $this->departureAirport = Airport::find($this->departure_location)->name;
            $this->destinationAirport = Airport::find($this->destination_location)->name;
            // $this->departureHour = $flightBooking->departure_hour;
            // $this->departureMinute = $flightBooking->departure_minute;
            $this->departure_eta_date = $flightBooking->departure_eta_date;
            // $this->departureETAHour = $flightBooking->departure_eta_hour;
            // $this->departureETAMinute = $flightBooking->departure_eta_minute;
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
        if ($this->query == '') {
            $this->airlines = [];
        } else {
            $this->airlines = Airline::where('name', 'like', '%' . $this->query . '%')->get();
            if($this->airlines->count() == 0)
            {
                $this->addError('query', 'No Airlines Found. Please enter a valid Airline Name');
            }else{
                $this->resetValidation('query');

            }
        }
    }

    public function updatedDepartureQuery()
    {
        if ($this->departureQuery == '') {
            $this->departureAirports = [];
        } else {
            $this->departureAirports = Airport::where('code', 'like', '%' . $this->departureQuery . '%')
                // ->orWhere('city', 'like', '%' . $this->departureQuery . '%')
                // ->orWhere('name', 'like', '%' . $this->departureQuery . '%')
                ->get();
             if($this->departureAirports->count() == 0)
            {
                $this->addError('departureQuery', 'No Airports Found. Please enter a valid Airport Code');
            }else{
                $this->resetValidation('departureQuery');

            }
        }
    }

    public function updatedDestinationQuery()
    {
        if ($this->destinationQuery == '') {
            $this->destinationAirports = [];
        } else {
            $this->destinationAirports = Airport::where('code', 'like', '%' . $this->destinationQuery . '%')
                // ->orWhere('city', 'like', '%' . $this->destinationQuery . '%')
                // ->orWhere('name', 'like', '%' . $this->destinationQuery . '%')
                ->get();
            if($this->destinationAirports->count() == 0){
                $this->addError('destinationQuery', 'No Airports Found. Please enter a valid Airport Code');
            }else{
                $this->resetValidation('destinationQuery');

            }
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
        $this->validate([
            'airline_name' => 'required',
            // 'confirmation_number' => 'required',
            'departureCountry' => 'required',
            'departure_location' => 'required',
            'departure_date' => 'required',
            'destinationCountry' => 'required',
            'destination_location' => 'required',
            'tripType' => 'required',
            // 'no_days_hotel_car' => 'required',
            // 'comments' => 'required',
            // 'departureHour' => 'required|numeric|between:00,24',
            // 'departureMinute' => 'required|numeric|between:00,59',
            'departure_eta_date' => 'required',
            // 'departureETAHour' => 'required|numeric|between:00,24',
            // 'departureETAMinute' => 'required|numeric|between:00,59',

        ], [
            'airline_name.required' => 'Airline Name is required',
            // 'confirmation_number.required' => 'Confirmation Number is required',
            'departureCountry.required' => 'Departure Country is required',
            'departure_location.required' => 'Departure Location is required',
            'departure_date.required' => 'Departure Date is required',
            'destinationCountry.required' => 'Destination Country is required',
            'destination_location.required' => 'Destination Location is required',
            'tripType.required' => 'Trip Type is required',
            // 'no_days_hotel_car.required' => 'Number of Days for Hotel/Car is required',
            // 'comments.required' => 'Comments is required',
            // 'departureHour.required' => 'Departure Hour is required',
            // 'departureHour.numeric' => 'Departure Hour should be a number',
            // 'departureHour.between' => 'Departure Hour should be between 00 and 24',
            // 'departureMinute.required' => 'Departure Minute is required',
            // 'departureMinute.numeric' => 'Departure Minute should be a number',
            // 'departureMinute.between' => 'Departure Minute should be between 00 and 59',
            'departure_eta_date.required' => 'Departure ETA Date is required',
            // 'departureETAHour.required' => 'Departure ETA Hour is required',
            // 'departureETAHour.numeric' => 'Departure ETA Hour should be a number',
            // 'departureETAHour.between' => 'Departure ETA Hour should be between 00 and 24',
            // 'departureETAMinute.required' => 'Departure ETA Minute is required',
            // 'departureETAMinute.numeric' => 'Departure ETA Minute should be a number',
            // 'departureETAMinute.between' => 'Departure ETA Minute should be between 00 and 59',
        ]);

        if($this->saleType == 'Cancellation')
        {
            $this->validate([
                'confirmation_number' => 'required',
                'transport_number' => 'required',
                'travel_class' => 'required',
            ], [
                'confirmation_number.required' => 'Confirmation Number is required for Cancellation Service',
                'transport_number.required' => 'Train Number is required for Cancellation Service',
                'travel_class.required' => 'Travel Class is required for Cancellation Service',
            ]);

        }

        $itenary = TravelItenaryUpload::where('app_id', $this->appID)->first();
        if (!$itenary) {
            if($this->saleType != 'Cancellation')
            {
                $this->validate([
                    'itenary_screenshot' => 'required|mimes:jpeg,jpg,png|max:5098',
                ], [
                    'itenary_screenshot.required' => 'Please select a intenary to upload',
                    'itenary_screenshot.mimes' => 'Please select a valid file type (jpeg, jpg, png)',
                    'itenary_screenshot.max' => 'File size should not exceed 5MB',
                ]);
            }
        }

        try {
            DB::beginTransaction();

            $app = FlightBooking::find($this->appID);

            FlightBooking::updateOrCreate(
                ['app_id' => $this->appID],
                [
                    'airline_name' => $this->airline_name,
                    'departure_country' => $this->departureCountry,
                    'departure_location' => $this->departure_location,
                    'departure_date' => $this->departure_date,
                    'destination_country' => $this->destinationCountry,
                    'destination_location' => $this->destination_location,
                    'oneway_or_roundtrip' => $this->tripType,
                    'return_date' => $this->return_date,
                    // 'no_days_hotel_car' => $this->no_days_hotel_car,
                    'comments' => $this->comments,
                    // 'departure_hour' => $this->departureHour,
                    // 'departure_minute' => $this->departureMinute,
                    // 'departure_eta_hour' => $this->departureETAHour,
                    // 'departure_eta_minute' => $this->departureETAMinute,
                    // 'return_eta_hour' => $this->returnETAHour,
                    // 'return_eta_minute' => $this->returnETAMinute,
                    'departure_eta_date' => $this->departure_eta_date,
                    'return_eta_date' => $this->return_eta_date,
                    'transport_number' => $this->transport_number,
                    'travel_class' => $this->travel_class,
                ]
            );



            if($this->saleType == 'Cancellation')
            {
                $booking = SaleBooking::where('id', $this->appID)->first();
                $booking->update([
                    'confirmation_number' => $this->confirmation_number,
                ]);
            }

            if ($this->itenary_screenshot) {
                $this->storeFile($this->itenary_screenshot, 'Flight Itenary');
            }

            DB::commit();
            Session::flash('message', ['heading' => 'success', 'text' => 'Flight Booking Details Saved Successfully']);
            return redirect()->route('addPassengers', ['appID' => $this->appID]);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function storeFile($file, $docName)
    {
        $file = TravelItenaryUpload::updateOrCreate(
            [
                'app_id' => $this->appID,
            ],
            [

                'document_name' => $docName,
                'document_filepath' => $file->storeAs('public/Itenary/' . $this->appID, $docName . '.' . $file->getClientOriginalExtension()),
            ]
        );
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
    public function getDestinationAirports()
    {
        if ($this->destinationCountry) {
            $this->dispatch('showModal', ['alias' => 'modals.airport-selection', 'params' => ['countryID' => $this->destinationCountry, 'type' => 'Destination']]);
        } else {
            Session::flash('message', ['heading' => 'error', 'text' => 'Please select Destination Country']);
            return;
        }
    }
    public function getCountries($type)
    {
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
