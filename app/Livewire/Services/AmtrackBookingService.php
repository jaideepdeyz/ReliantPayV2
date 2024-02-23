<?php

namespace App\Livewire\Services;

use App\Models\AmtrakBooking;
use App\Models\SaleBooking;
use App\Models\TrainStation;
use App\Models\Cancellation;
use App\Models\TravelItenaryUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class AmtrackBookingService extends Component
{
    use WithPagination, WithFileUploads;
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
    public $no_days_hotel_car;
    public $comments;
    public $departureHour;
    public $departureMinute;
    public $itenary_screenshot;

    public $departure_eta_date;
    public $departureETAHour;
    public $departureETAMinute;

    public $return_date;
    public $returnHour;
    public $returnMinute;

    public $return_eta_date;
    public $returnETAHour;
    public $returnETAMinute;

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

    public $saleType;
    public $transport_number;
    public $travel_class;

    public function mount($appID)
    {
        $this->appID = $appID;
        $booking = SaleBooking::where('id', $this->appID)->first();
        $this->saleType = $booking->sale_type;

        $amtrakBooking = AmtrakBooking::where('app_id', $this->appID)->first();
        if ($amtrakBooking) {
            $this->confirmation_number = $amtrakBooking->confirmation_number;
            $this->departure_location = $amtrakBooking->departure_location;
            $this->departure_date = $amtrakBooking->departure_date;
            $this->destination_location = $amtrakBooking->destination_location;
            $this->tripType = $amtrakBooking->oneway_or_roundtrip;
            $this->transport_number = $amtrakBooking->transport_number;
            $this->travel_class = $amtrakBooking->travel_class;
            if($this->tripType == 'Round Trip')
            {
                $this->isRoundTrip = 'Yes';
                $this->return_date = $amtrakBooking->return_date;
                $this->returnHour = $amtrakBooking->return_hour;
                $this->returnMinute = $amtrakBooking->return_minute;
                $this->return_eta_date = $amtrakBooking->return_eta_date;
                $this->returnETAHour = $amtrakBooking->return_eta_hour;
                $this->returnETAMinute = $amtrakBooking->return_eta_minute;
            }
            // $this->no_days_hotel_car = $flightBooking->no_days_hotel_car;
            $this->comments = $amtrakBooking->comments;
            $this->departureStation = TrainStation::find($this->departure_location)->name;
            $this->destinationStation = TrainStation::find($this->destination_location)->name;
            $this->departureHour = $amtrakBooking->departure_hour;
            $this->departureMinute = $amtrakBooking->departure_minute;
            $this->departureQuery = $amtrakBooking->departureStation->station_location;
            $this->destinationQuery = $amtrakBooking->destinationStation->station_location;
            $this->departure_eta_date = $amtrakBooking->departure_eta_date;
            $this->departureETAHour = $amtrakBooking->departure_eta_hour;
            $this->departureETAMinute = $amtrakBooking->departure_eta_minute;

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
            // ->orWhere('station_location', 'like', '%'.$this->departureQuery.'%')
            ->get();
            if($this->departureStations->count() == 0)
            {
                // trigger a validation error for departureQuery
                $this->addError('departureQuery', 'No Stations Found, Please Search using valid Station Code');
            } else {
                $this->resetValidation('departureQuery');
            }
        }
    }

    public function updatedDestinationQuery()
    {
        if($this->destinationQuery == '')
        {
            $this->destinationStations = [];
        } else {
            $this->destinationStations = TrainStation::where('station_code', 'like', '%'.$this->destinationQuery.'%')
            // ->orWhere('station_location', 'like', '%'.$this->destinationQuery.'%')
            ->get();
            if($this->destinationStations->count() == 0)
            {
                // trigger a validation error for destinationQuery
                $this->addError('destinationQuery', 'No Stations Found, Please Search using valid Station Code');
            } else {
                $this->resetValidation('destinationQuery');
            }
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
        $this->validate([
            // 'confirmation_number' => 'required',
            'departure_location' => 'required',
            'destination_location' => 'required',
            'tripType' => 'required',
            // 'no_days_hotel_car' => 'required',
            // 'comments' => 'required',
            'departure_date' => 'required',
            'departureHour' => 'required|numeric|between:00,24',
            'departureMinute' => 'required|numeric|between:00,59',
            'departure_eta_date' => 'required',
            'departureETAHour' => 'required|numeric|between:00,24',
            'departureETAMinute' => 'required|numeric|between:00,59',
        ], [
            // 'confirmation_number.required' => 'Confirmation Number is required',
            'departure_location.required' => 'Departure Location is required',
            'departure_date.required' => 'Departure Date is required',
            'destination_location.required' => 'Destination Location is required',
            'tripType.required' => 'Trip Type is required',
            // 'no_days_hotel_car.required' => 'Number of Days Hotel Car is required',
            // 'comments.required' => 'Comments is required',
            'departureHour.required' => 'Departure Hour is required',
            'departureHour.numeric' => 'Departure Hour must be numeric',
            'departureHour.between' => 'Departure Hour must be between 00 and 24',
            'departureMinute.required' => 'Departure Minute is required',
            'departureMinute.numeric' => 'Departure Minute must be numeric',
            'departureMinute.between' => 'Departure Minute must be between 00 and 59',
            'departure_eta_date.required' => 'Departure ETA Date is required',
            'departureETAHour.required' => 'Departure ETA Hour is required',
            'departureETAHour.numeric' => 'Departure ETA Hour must be numeric',
            'departureETAHour.between' => 'Departure ETA Hour must be between 00 and 24',
            'departureETAMinute.required' => 'Departure ETA Minute is required',
            'departureETAMinute.numeric' => 'Departure ETA Minute must be numeric',
            'departureETAMinute.between' => 'Departure ETA Minute must be between 00 and 59',
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
            AmtrakBooking::updateOrCreate(
                ['app_id' => $this->appID],
                [
                    'departure_location' => $this->departure_location,
                    'destination_location' => $this->destination_location,
                    'oneway_or_roundtrip' => $this->tripType,
                    // 'no_days_hotel_car' => $this->no_days_hotel_car,
                    'comments' => $this->comments,
                    'departure_date' => $this->departure_date,
                    'departure_hour' => $this->departureHour,
                    'departure_minute' => $this->departureMinute,
                    'departure_eta_date' => $this->departure_eta_date,
                    'departure_eta_hour' => $this->departureETAHour,
                    'departure_eta_minute' => $this->departureETAMinute,
                    'return_date' => $this->return_date,
                    'return_hour' => $this->returnHour,
                    'return_minute' => $this->returnMinute,
                    'return_eta_date' => $this->return_eta_date,
                    'return_eta_hour' => $this->returnETAHour,
                    'return_eta_minute' => $this->returnETAMinute,
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
                $this->storeFile($this->itenary_screenshot, 'AMTRAK Itenary');
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

    public function render()
    {
        $bookingDetails = SaleBooking::find($this->appID);
        return view('livewire.services.amtrack-booking-service', compact('bookingDetails'))
        ->layout('layouts.dashboard-layout');
    }
}
