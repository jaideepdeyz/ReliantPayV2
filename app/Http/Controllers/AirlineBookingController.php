<?php

namespace App\Http\Controllers;

use App\Models\FlightBooking;
use App\Models\Passenger;
use App\Models\Payment;
use App\Models\SaleBooking;
use Illuminate\Http\Request;

class AirlineBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bookingDetails = SaleBooking::find($id);
        $flightDetails = FlightBooking::where('app_id', $id)->first();
        $passengerDetails = Passenger::where('app_id', $id)->get();
        $billingDetails = Payment::where('app_id', $id)->first();

        return view('airlineBooking.airlineBookingDetails', compact('bookingDetails', 'flightDetails', 'passengerDetails', 'billingDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
