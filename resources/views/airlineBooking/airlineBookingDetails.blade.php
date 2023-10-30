<x-dashboard-layout>
    <div class="row">
        <div class="col-md-12">
            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                Booking Summary
                <span class="float-right"> <a href="{{route('authorizeAndSend', $bookingDetails->id)}}" class="btn btn-sm btn-primary">Send Authorization Link</a></span>
            </h5>

            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                        Details
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <tr>
                                <td>Booking ID:</td>
                                <td>{{ $bookingDetails->id}}</td>
                                <td>Agent Name:</td>
                                <td>{{ $bookingDetails->agent->name}}</td>
                            </tr>
                            <tr>
                                <td>Service Type:</td>
                                <td>{{ $bookingDetails->service->service_name}}</td>
                                <td>Booking Status:</td>
                                <td>{{ $bookingDetails->app_status}}</td>
                            </tr>
                            <tr>
                                <td>Customer's Name:</td>
                                <td>{{ $bookingDetails->customer_name}}</td>
                                <td>Customer's Phone & Email:</td>
                                <td>{{ $bookingDetails->customer_phone}} | {{ $bookingDetails->customer_email}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                        Flight Details
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <tr>
                                <td>Airline Name:</td>
                                <td>{{ $flightDetails->airline_name}}</td>
                                <td>Confirmation #:</td>
                                <td>{{ $flightDetails->confirmation_number}}</td>
                                <td>Departure:</td>
                                <td>{{ $flightDetails->departureAirport->name}}</td>
                            </tr>
                            <tr>
                                <td>Destination:</td>
                                <td>{{ $flightDetails->destinationAirport->name}}</td>
                                <td>One Way or Round Trip:</td>
                                <td>{{ $flightDetails->oneway_or_roundtrip}}</td>
                                <td>Departure Date:</td>
                                <td>{{ $flightDetails->departure_date}}</td>
                            </tr>
                            <tr>
                                <td>Return Date (if any):</td>
                                <td>{{ $flightDetails->return_date}}</td>
                                <td>Remarks (if any):</td>
                                <td colspan="2">{{ $flightDetails->comments}}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                        Passenger Details
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Passenger Name</th>
                                    <th>Gender</th>
                                    <th>DOB</th>
                                    <th>Relation to Card Holder</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($passengerDetails as $passenger)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $passenger->full_name}}</td>
                                    <td>{{ $passenger->gender}}</td>
                                    <td>{{ $passenger->dob}}</td>
                                    <td>{{ $passenger->relationship_to_card_holder}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if($bookingDetails->authorizationForm)
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ol>
                        <li><a href="{{Storage::Url($bookingDetails->authorizationForm->signed_document)}}" target="_blank">Signed Authorization Form</a></li>
                        <li><a href="{{Storage::Url($bookingDetails->authorizationForm->completion_certificate)}}" target="_blank">Completion Certificate</a></li>
                    </ol>
                </div>
            </div>

        </div>
        @else

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                        Billing Details
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <tr>
                                <td>Card Holder's Name:</td>
                                <td>{{ $billingDetails->cc_name}}</td>
                                <td>Phone:</td>
                                <td>{{ $billingDetails->cc_phone}}</td>
                                <td>Email:</td>
                                <td>{{ $billingDetails->cc_email}}</td>
                            </tr>
                            <tr>
                                <td>Card Holders DoB:</td>
                                <td>{{ $billingDetails->cc_dob}}</td>
                                <td>Card Type:</td>
                                <td>{{ $billingDetails->cc_type}}</td>
                                <td>CC #:</td>
                                <td>{{ $billingDetails->cc_number}}</td>
                            </tr>
                            <tr>
                                <td>Expiration Date:</td>
                                <td>{{ $billingDetails->cc_expiration_date}}</td>
                                <td>CVC:</td>
                                <td>{{ $billingDetails->cc_cvc}}</td>
                                <td>Amount Charged:</td>
                                <td>{{ $billingDetails->amount_charged}}</td>
                            </tr>
                            <tr>
                                <td>Billing Address:</td>
                                <td colspan="3">{{ $billingDetails->cc_billing_address}}</td>
                                <td><a href="{{ Storage::URL($billingDetails->primary_passenger_id_doc) }}" class="btn btn-sm btn-primary" target="_blank">Customer's ID</a></td>
                            </tr>
                            <tr>
                                <td>Comments / Remarks :</td>
                                <td colspan="3">{{$billingDetails->comments}}</td>
                            </tr>

                        </table>
                    </div>

                    <a href="{{route('authorizeAndSend', $bookingDetails->id)}}"class="btn btn-sm btn-success">Send Authorization Link</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</x-dashboard-layout>
