<?php

namespace App\Livewire\Agents;

use App\Enums\StatusEnum;
use App\Models\Airport;
use App\Models\Country;
use App\Models\Sale;
use App\Models\TransactionLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BookSales extends Component
{
    public $travel_category;
    public $primary_passenger_phone;
    public $primary_passenger_email;
    public $transport_name;
    public $confirmation_number;
    public $departure_location;
    public $departure_date;
    public $destination_location;
    public $oneway_or_roundtrip;
    public $return_date;
    public $no_days_hotel_car;
    public $signed_authorization_doc;
    public $primary_passenger_id_doc;
    public $cc_name;
    public $cc_phone;
    public $cc_email;
    public $cc_dob;
    public $cc_number;
    public $cc_type;
    public $cc_expiration_date;
    public $cc_cvc;
    public $cc_billing_address;
    public $amount_charged;
    public $comments;

    //additional controls 
    public $departureCountry;
    public $destinationCountry;
    public $airports =[];
    public $sale;
    public $status;
    public $remarks;

    public function updatedDepartureCountry($value)
    {
        $this->departureCountry = $value;
        $this->airports = Airport::where('iso_country', $this->departureCountry)->get();
    }

    public function updatedDestinationCountry($value)
    {
        $this->destinationCountry = $value;
        $this->airports = Airport::where('iso_country', $this->destinationCountry)->get();
    }

    public function storeSalesForm()
    {
        $this->validate([
            'travel_category' => 'required',
            'primary_passenger_phone' => 'required',
            'primary_passenger_email' => 'required',
            'transport_name' => 'required',
            'confirmation_number' => 'required',
            'departure_location' => 'required',
            'departure_date' => 'required',
            'destination_location' => 'required',
            'oneway_or_roundtrip' => 'required',
            'return_date' => 'required',
            'cc_name' => 'required',
            'cc_phone' => 'required',
            'cc_email' => 'required',
            'cc_dob' => 'required',
            'cc_number' => 'required',
            'cc_type' => 'required',
            'cc_expiration_date' => 'required',
            'cc_cvc' => 'required',
            'cc_billing_address' => 'required',
            'amount_charged' => 'required',
            'comments' => 'required',
            // 'no_days_hotel_car' => 'required',
            // 'signed_authorization_doc' => 'required',
            // 'primary_passenger_id_doc' => 'required',
        ]);

        try {
            DB::beginTransaction();

            switch($this->travel_category){
                case 'Flights':
                    $this->travel_category = 'Flights';
                    break;
                case 'Hotels':
                case 'Car Rentals':
                case 'Packages':
                case 'AmTrak':
                    $startDate = Carbon::parse($this->departure_date);
                    $endDate = Carbon::parse($this->return_date);
                    $this->no_days_hotel_car = $startDate->diffInDays($endDate);
                    break;
                default:
                    $this->travel_category = 'Other';
            }
            $this->sale = Sale::create([
                'agent_id' => auth()->user()->id,
                'travel_category' => $this->travel_category,
                'primary_passenger_phone' => $this->primary_passenger_phone,
                'primary_passenger_email' => $this->primary_passenger_email,
                'transport_name' => $this->transport_name,
                'confirmation_number' => $this->confirmation_number,
                'departure_location' => $this->departure_location,
                'departure_date' => $this->departure_date,
                'destination_location' => $this->destination_location,
                'oneway_or_roundtrip' => $this->oneway_or_roundtrip,
                'return_date' => $this->return_date,
                'cc_name' => $this->cc_name,
                'cc_phone' => $this->cc_phone,
                'cc_email' => $this->cc_email,
                'cc_dob' => $this->cc_dob,
                'cc_number' => $this->cc_number,
                'cc_type' => $this->cc_type,
                'cc_expiration_date' => $this->cc_expiration_date,
                'cc_cvc' => $this->cc_cvc,
                'cc_billing_address' => $this->cc_billing_address,
                'amount_charged' => $this->amount_charged,
                'comments' => $this->comments,
                'no_days_hotel_car' => $this->no_days_hotel_car,
                // 'signed_authorization_doc' => $this->signed_authorization_doc,
                // 'primary_passenger_id_doc' => $this->primary_passenger_id_doc,
            ]);
            $this->status = StatusEnum::PENDING;
            $this->remarks = 'New Sale Added';
            $this->transactionLog();

            DB::commit();
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }

    }

    public function transactionLog()
    {
            TransactionLog::create([
                'organization_id' => auth()->user()->organization_id,
                'user_id' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
                'sales_id' => $this->sale->id,
                'type' => 'Sales',
                'status' => $this->status,
                'remarks' => $this->remarks,
            ]);
    }

    public function render()
    {
        $countries = Country::all();
        return view('livewire.agents.book-sales', compact('countries'))->layout('layouts.dashboard-layout');
    }
}
