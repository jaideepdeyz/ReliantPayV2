<x-dashboard-layout>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                        <li class="breadcrumb-item">Agent Dashboard</li>
                        <li class="breadcrumb-item">Flight Booking</li>
                        <li class="breadcrumb-item active">Booking Summary</li>
                    </ol>
                </div>
                <h4 class="page-title">AIRLINE Booking Summary</h4>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <span>
                        @switch($bookingDetails->app_status)
                        @case(StatusEnum::AUTHORIZED->value)
                        @case(StatusEnum::PAYMENT_DONE->value)
                        @case(StatusEnum::CANCELLATION_REQUESTED->value)
                        @case(StatusEnum::TICKET_CANCELLED->value)
                        @case(StatusEnum::REFUND_REQUESTED->value)
                        @case(StatusEnum::REFUNDED->value)
                                <a href="{{ Storage::Url($bookingDetails->authorizationForm->signed_document) }}" target="_blank" class="btn btn-info">Signed Authorization Form</a>
                                <a href="{{ Storage::Url($bookingDetails->authorizationForm->completion_certificate) }}"
                                    target="_blank" class="btn btn-primary">Completion Certificate</a>
                                {{-- <a href="{{ route('payment.stepOnePay', $bookingDetails->id) }}" target="_blank" class="btn btn-success">Charge Card</a> --}}
                            @break
                            @default
                                <a href="{{ route('authorizationForm', $bookingDetails->id) }}" class="btn btn-success"><i class="ri-mail-send-line font-13"></i> View Authorizaton Form</a>
                                @break
                        @endswitch
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                            Details
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <td><strong>Booking ID:</strong></td>
                                    <td>{{ $bookingDetails->id }}</td>
                                    <td class="table-info"><strong>Agent Name:</strong></td>
                                    <td class="table-info">{{ $bookingDetails->agent->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Service Type:</strong></td>
                                    <td>{{ $bookingDetails->service->service_name }}</td>
                                    <td class="table-success"><strong>Booking Status:</strong></td>
                                    <td class="table-success">{{ $bookingDetails->app_status }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Customer's Name:</strong></td>
                                    <td>{{ $bookingDetails->customer_name }}</td>
                                    <td><strong>Customer's Phone & Email:</strong></td>
                                    <td>{{ $bookingDetails->customer_phone }} | {{ $bookingDetails->customer_email }}</td>
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
                                <td><strong>Airline Name:</strong></td>
                                <td>{{ $flightDetails->airline_name }}</td>
                                <td><strong>Confirmation #:</strong></td>
                                <td>{{ $flightDetails->confirmation_number }}</td>
                                <td><strong>Departure:</strong></td>
                                <td>{{ $flightDetails->departureAirport->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Destination:</strong></td>
                                <td>{{ $flightDetails->destinationAirport->name }}</td>
                                <td><strong>One Way or Round Trip:</strong></td>
                                <td>{{ $flightDetails->oneway_or_roundtrip }}</td>
                                <td><strong>Departure Date:</strong></td>
                                <td>{{ $flightDetails->departure_date }}</td>
                            </tr>
                            <tr>
                                <td><strong>Return Date (if any):</strong></td>
                                <td>{{ $flightDetails->return_date }}</td>
                                <td><strong>Remarks (if any):</strong></td>
                                <td colspan="2">{{ $flightDetails->comments }}</td>
                            </tr>
                            @if($flightDetails->itenary != null)
                            <tr>
                                <td><b>Uploaded Itenary</b></td>
                                <td colspan=4>
                                    <button class="btn" type="button"
                                    onclick="Livewire.dispatch('showModal', {'data': {'alias' : 'modals.pdf-reader','params' :{
                                   'url':'{{ $flightDetails->itenary->document_filepath }}',
                                   'title':'Itenary Preview For Booking ID: {{ $bookingDetails->id }}',
                                   'type':'image'
                                    }}})">
                                   <span>
                                       <i class="mdi mdi-desktop-mac me-2"></i> Preview itinerary
                                   </span>
                               </button>
                                  
                                </td>
                            </tr>
                            @endif
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
                                    <th>Does the passenger have any Disability?</th>
                                    <th>Type of Disability</th>
                                    <th>Passenger requires assistance?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($passengerDetails as $passenger)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $passenger->full_name }}</td>
                                        <td>{{ $passenger->gender }}</td>
                                        <td>{{ $passenger->dob }}</td>
                                        <td>{{ $passenger->relationship_to_card_holder }}</td>
                                        <td>{{ $passenger->is_disabled }}</td>
                                        <td>{{ $passenger->disability_type ?? 'NA' }}</td>
                                        <td>{{ $passenger->requires_assistance ?? 'NA' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                        Billing Details
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <tr>
                                <td><strong>Card Holder's Name:</strong></td>
                                <td>{{ $billingDetails->cc_name }}</td>
                                <td><strong>Phone:</strong></td>
                                <td>{{ $billingDetails->cc_phone }}</td>
                                <td><strong>Email:</strong></td>
                                <td>{{ $billingDetails->cc_email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Card Holders DoB:</strong></td>
                                <td>{{ $billingDetails->cc_dob }}</td>
                                <td><strong>Card Type:</strong></td>
                                <td>{{ $billingDetails->cc_type }}</td>
                                <td><strong>CC #:</td>
                                <td>{{ $billingDetails->cc_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>Expiration Date:</strong></td>
                                <td>{{ $billingDetails->cc_expiration_date }}</td>
                                <td><strong>CVC:</strong></td>
                                <td>{{ $billingDetails->cc_cvc }}</td>
                                <td><strong>Amount Charged:</strong></td>
                                <td>{{ $billingDetails->amount_charged }}</td>
                            </tr>
                            <tr>
                                <td><strong>Billing Address:</strong></td>
                                <td colspan="3">
                                    {{ $billingDetails->cc_billing_address_street }} ,
                                    {{ $billingDetails->cc_billing_address_city }} ,
                                    {{ $billingDetails->cc_billing_address_state }} ,
                                    {{ $billingDetails->cc_billing_address_zip }}
                                </td>
                                <td>
                                    @if($billingDetails->primary_passenger_id_doc != null)
                                    <a href="{{ Storage::URL($billingDetails->primary_passenger_id_doc) }}"
                                        class="btn btn-sm btn-primary" target="_blank">Customer's ID</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Comments / Remarks :</strong></td>
                                <td colspan="3">{{ $billingDetails->comments }}</td>
                            </tr>

                        </table>
                    </div>
{{--
                    @if (!$bookingDetails->authorizationForm)
                        <a href="{{ route('authorizeAndSend', $bookingDetails->id) }}"class="btn btn-success"><i
                                class="ri-mail-send-line font-13"></i> Send
                            Authorization Email</a>
                    @endif --}}
                </div>
            </div>
        </div>

        {{-- @if ($bookingDetails->authorizationForm)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <ol>
                            <li><a href="{{ Storage::Url($bookingDetails->authorizationForm->signed_document) }}"
                                    target="_blank">Signed Authorization Form</a></li>
                            <li><a href="{{ Storage::Url($bookingDetails->authorizationForm->completion_certificate) }}"
                                    target="_blank">Completion Certificate</a></li>
                        </ol>
                    </div>
                </div>

            </div>
        @endif --}}

    </div>
</x-dashboard-layout>
