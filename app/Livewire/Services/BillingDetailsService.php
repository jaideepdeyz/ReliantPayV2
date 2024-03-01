<?php

namespace App\Livewire\Services;

use App\Enums\ServiceEnum;
use App\Models\ChargeDetails;
use App\Models\Payment;
use App\Models\SaleBooking;
use App\Models\TicketBookingMode;
use App\Models\UsCityState;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class BillingDetailsService extends Component
{
    use WithFileUploads;

    //billing details
    public $appID;
    public $cc_name;
    public $cc_phone;
    public $cc_email;
    public $cc_dob;
    public $cc_number;
    public $cc_type="Mastercard";
    public $cc_expiration_date;
    public $cc_cvc;



    public $cc_billing_address_street;
    public $cc_billing_address_city;
    public $cc_billing_address_state;
    public $cc_billing_address_zip;

    public $amount_charged;
    public $billingComments;
    public $primary_passenger_id_doc;

    public $saleBooking;
    public $showIdUpload = 'No';

    public $bookedThroughReservationAssistance;

    // dropdown search
    public $cityQuery;
    public $stateQuery;
    public $cities = [];
    public $states = [];

    public function mount($appID)
    {
        $this->appID = $appID;
        $this->saleBooking = SaleBooking::find($this->appID);
        // charges calculation
        $charges = ChargeDetails::where('app_id', $this->appID)->get();
        $this->amount_charged = $charges->sum('amount');

        // checking if ID is required, commented out for now till further clarity is received
        // if($this->amount_charged >= 500)
        // {
        //     $this->showIdUpload = 'Yes';
        // }

        if($this->saleBooking->relationship_to_card_holder == 'Self')
        {
            $this->cc_name = $this->saleBooking->passenger->first_name.' '.$this->saleBooking->passenger->last_name;
            $this->cc_phone = $this->saleBooking->passenger->phone;
            $this->cc_email = $this->saleBooking->passenger->email;
            $this->cc_dob = $this->saleBooking->passenger->dob;
        }

        $billingDetails = Payment::where('app_id', $this->appID)->first();
        if($billingDetails)
        {
            $this->cc_name = $billingDetails->cc_name;
            $this->cc_phone = $billingDetails->cc_phone;
            $this->cc_email = $billingDetails->cc_email;
            $this->cc_dob = $billingDetails->cc_dob;
            $this->cc_number = $billingDetails->cc_number;
            $this->cc_type = $billingDetails->cc_type;
            $this->cc_expiration_date = $billingDetails->cc_expiration_date;
            $this->cc_cvc = $billingDetails->cc_cvc;
            $this->cc_billing_address_street = $billingDetails->cc_billing_address_street;
            $this->cityQuery = $billingDetails->cc_billing_address_city;
            $this->stateQuery = $billingDetails->cc_billing_address_state;
            $this->cc_billing_address_zip = $billingDetails->cc_billing_address_zip;
            $this->amount_charged = $billingDetails->amount_charged;
            $this->billingComments = $billingDetails->comments;
            // $this->stateQuery = $billingDetails->cc_billing_address_state;
            // $this->cityQuery = $billingDetails->cc_billing_address_city;
            $this->cc_billing_address_city = $billingDetails->cc_billing_address_state;
            $this->cc_billing_address_state = $billingDetails->cc_billing_address_city;
            $this->bookedThroughReservationAssistance = $billingDetails->ticketBookingMode->bookedThroughReservationAssistance;
        }
    }



    public function updatedCityQuery()
    {
        if ($this->cityQuery == '') {
            $this->cities = [];
        } else {
            $this->cities = UsCityState::where('city', 'like', '%' . $this->cityQuery . '%')->get();
        }
    }

    public function updatedStateQuery()
    {
        if ($this->stateQuery == '') {
            $this->states = [];
        } else {
            $this->states = UsCityState::distinct('state_name')
            ->where('state_name', 'like', '%' . $this->stateQuery . '%')
            ->get();
        }
    }

    public function setCity($city)
    {
        $selectedCity = UsCityState::find($city);
        $this->cityQuery = $selectedCity->city;
        $this->cc_billing_address_city = $selectedCity->city;
        $this->cities = [];
    }

    public function setState($state)
    {
        $selectedState = UsCityState::find($state);
        $this->stateQuery = $selectedState->state_name;
        $this->cc_billing_address_state = $selectedState->state_code;
        $this->states = [];
    }

    public function saveBillingDetails()
    {
        $this->validate([
            'cc_name' => 'required',
            'cc_phone' => 'required',
            'cc_email' => 'required',
            'cc_dob' => 'required',
            'cc_number' => 'required',
            'cc_type' => 'required',
            'cc_expiration_date' => 'required',
            'cc_cvc' => 'required',
            'cc_billing_address_street' => 'required',
            'cc_billing_address_city' => 'required',
            'cc_billing_address_state' => 'required',
            'cc_billing_address_zip' => 'required|numeric|digits:5',
            'amount_charged' => 'required|numeric',
            'bookedThroughReservationAssistance' => 'required',
        ], [
            'cc_name.required' => 'Card Holders Name is required',
            'cc_phone.required' => 'Card Holders Phone Number is required',
            'cc_email.required' => 'Card Holders Email is required',
            'cc_dob.required' => 'Card Holders Date of Birth is required',
            'cc_number.required' => 'Credit Card Number is required',
            'cc_type.required' => 'Credit Card Type is required',
            'cc_expiration_date.required' => 'Credit Card Expiration Date is required',
            'cc_cvc.required' => 'CVC is required',
            'cc_billing_address_street.required' => 'Street Address is required',
            'cc_billing_address_city.required' => 'City is required',
            'cc_billing_address_state.required' => 'State is required',
            'cc_billing_address_zip.required' => 'Zip is required',
            'cc_billing_address_zip.numeric' => 'Zip must be a number',
            'cc_billing_address_zip.digits' => 'Zip must be 5 digits',
            'amount_charged.required' => 'Amount Charged is required',
            'amount_charged.numeric' => 'Amount Charged must be a number',
            'bookedThroughReservationAssistance.required' => 'Whether Ticket is Booked Through Reservation Assistance is required',
        ]);

        try {
            DB::beginTransaction();
            $payment = Payment::updateOrCreate(
                ['app_id' => $this->appID],
                [
                'app_id' => $this->appID,
                'cc_name' => $this->cc_name,
                'cc_phone' => $this->cc_phone,
                'cc_email' => $this->cc_email,
                'cc_dob' => $this->cc_dob,
                'cc_number' => str_replace('-','',$this->cc_number),
                'cc_type' => $this->cc_type,
                'cc_expiration_date' => str_replace('/','',$this->cc_expiration_date),
                'cc_cvc' => $this->cc_cvc,
                'cc_billing_address_street' => $this->cc_billing_address_street,
                'cc_billing_address_city' => $this->cc_billing_address_city,
                'cc_billing_address_state' => $this->cc_billing_address_state,
                'cc_billing_address_zip' => $this->cc_billing_address_zip,
                'amount_charged' => $this->amount_charged,
                'comments' => $this->billingComments,
                ]
            );

            if($this->primary_passenger_id_doc)
            {
                $payment->update([
                'primary_passenger_id_doc' => $this->primary_passenger_id_doc->storeAs('public/PaymentOrders/'.$this->appID.'/passengerID_doc.'.$this->primary_passenger_id_doc->getClientOriginalExtension()),
                ]);
            }

            $booking = SaleBooking::find($this->appID);
            switch($booking->service->service_name)
            {
                case ServiceEnum::FLIGHTS->value:
                    $carrier = $booking->flightBooking->airline_name;
                    $departureDate = $booking->flightBooking->departure_date;
                    $departureTime = $booking->flightBooking->departure_hour.":".$booking->flightBooking->departure_minute;
                    break;
                case ServiceEnum::AMTRAK->value:
                    $carrier = 'Train';
                    $departureDate = $booking->amtrakBooking->departure_date;
                    $departureTime = $booking->amtrakBooking->departure_hour.":".$booking->amtrakBooking->departure_minute;
                    break;
                default:
                    break;
            }

            $ticketBookingMode = TicketBookingMode::updateOrCreate(
                ['app_id' => $this->appID],
                [
                'bookedThroughReservationAssistance' => $this->bookedThroughReservationAssistance,
                'departure_date' => $departureDate,
                'departure_time' => $departureTime,
                'carrier' => $carrier,
                ]
            );

            DB::commit();
            Session::flash('message', ['heading'=>'success','text'=>'Billing Details Saved Successfully']);
            switch($this->saleBooking->service->service_name)
            {
                case ServiceEnum::FLIGHTS->value:
                    return redirect()->route('airlineBooking.show', $this->appID);
                case ServiceEnum::AMTRAK->value:
                    return redirect()->route('amtrakBookingDetails.show', $this->appID);
                default:
                    return redirect()->back();
            }

        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function previousStep()
    {
        return redirect()->route('addChargeDetails', ['appID' => $this->appID]);
    }

    public function render()
    {
        $saleBooking = SaleBooking::find($this->appID);
        return view('livewire.services.billing-details-service', [
            'saleBooking' => $saleBooking,
        ])->layout('layouts.dashboard-layout');
    }
}
