<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authorization Form</title>
    @include('pdf.partials.css')
</head>
<body>
    <div id="watermark">
        <img src="{{ $background }}" height="100%" width="100%" />
    </div>

    <div class="container-fluid">
        <div class="row" style="padding-top:130px;">
            <div class="col-md-12" style="text-align:center; font-size:14px;">
                <b>PAYMENT AUTHORIZATION FOR {{$type}} RESERVATION WITH {{ $carrier }} , {{$data->oneway_or_roundtrip}}, {{ Carbon\Carbon::parse($data->departure_date)->format('F j, Y')}} CURATED BY RESERVATION ASSISTANCE</b>
            </div><br><br>
        </div>
        <div class="col-md-12" style="font-size:14px; padding-top:20px;">
            Dear <b>{{ $saleBooking->customer->customer_name }}</b>,
            <br><br>
        </div>

        <div class="col-md-12">
            <p style="font-size:12px; color:black;">
                Thank you for choosing Reservation Assistance LLC for your travel arrangements. We are delighted to assist you in planning your upcomming trip. 
            </p>
            <p style="font-size:12px; color:black;">
                As per your recent enquiry, we have prepared a detailed itenary for your {{$type}} reservation. Please find attached the itenary document outlining your travel details, including the proposed itenerary and associated charges.
            </p>
        </div>

        <div class="col-md-12">
            <p style="font-size:12px; color:black;">
                <b>Customer Information (Person who has contacted Reservation Assistance to book this ticket):</b>
            </p>
            <p>
                <ul style="font-size:12px; color:black;">
                    <li><b>Name:</b> {{ $saleBooking->customer->customer_name }}</li>
                    <li><b>Contact Number:</b> {{ $saleBooking->customer_phone }}</li>
                    <li><b>Email Address:</b> {{ $saleBooking->customer->customer_email }}</li>
                    <li><b>Customer's relationship with the Card Holder:</b> {{$saleBooking->relationship_to_card_holder}}</li>
                </ul>
            </p>
        </div>

        <div class="col-md-12" style="page-break-after: always;">
            <p style="font-size:12px; color:black;">
                <b>{{$type}} Information:</b>
            </p>
            <p style="font-size:12px; color:black;">
                <ul style="font-size:12px; color:black;">
                    <li><b>Departure Date:</b> {{ Carbon\Carbon::parse($data->departure_date)->format('F j, Y') }}</li>
                    <li><b>Departure Time:</b> {{ $data->departure_hour }} : {{ $data->departure_minute }}</li>
                    <li><b>Departure Airport/Station/Port:</b> {{$departureLocation}}</li>
                    <li><b>Arrival Date:</b> {{ Carbon\Carbon::parse($data->departure_eta_date)->format('F j, Y') }}</li>
                    <li><b>Arrival Time:</b> {{ $data->departure_eta_hour }} : {{ $data->departure_eta_minute }}</li>
                    <li><b>Arrival Airport/Station/Port:</b> {{ $destinationLocation }}</li>
                    <li><b>Airline/Carrier Name:</b> {{ $carrier }}</li>
                    {{-- <li><b>Flight / Train Number:</b> </li>
                    <li><b>Class:</b> </li> --}}
                </ul>
            </p>
            {{-- add travel iternary here --}}
            <p>
                <img src="{{$itenary}}" alt="" width="100%">
            </p>
        </div>
        <div class="col-md-12" style="padding-top:130px; margin-bottom:0px;">
            <p style="font-size:12px; color:black;">
                <b>Passengers (As per booking request):</b>
            </p>
            <table class="table" style="font-size:12px; color:black;">
                <thead style="font-size:12px; color:black;">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody style="font-size:12px; color:black;">
                    @foreach($passengers as $passenger)
                        <tr style="text-align:center;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $passenger->full_name }}</td>
                            <td>{{ $passenger->gender }}</td>
                            <td>
                                @php
                                    $dob = Carbon\Carbon::parse($passenger->dob);
                                    $age = $dob->diffInYears(Carbon\Carbon::now());
                                    $isAdult = $age > 16 ? 'Adult' : 'Minor';
                                @endphp
                                {{ $isAdult }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12" style="margin-bottom:0px;">
            <p style="font-size:12px; color:black;">
                <b>Total Amount:</b>
            </p>
            <p style="font-size:12px; color:black;">
                <ol style="font-size:12px; color:black;">
                    @foreach($charges as $charge)
                        <li><b>{{$charge->charge_type}}</b> : $ {{ $charge->amount }}</li>
                    @endforeach
                </ol>
            </p>
        </div>
        
        <div class="col-md-12" style="margin-bottom:0px;">
            <p style="font-size:12px; color:black;">
                <b>Payment Method:</b>
            </p>
            <p style="font-size:12px; color:black;">
                <ul style="font-size:12px; color:black;">
                    <li><b>Last 4 Digits of Card</b> : {{ str_repeat('X', max(0, strlen($paymentDetails->cc_number) - 4)) . substr($paymentDetails->cc_number, -4) }}</li>
                    <li><b>Card Holder's Name</b>: {{ $paymentDetails->cc_name}}</li>
                    <li>
                        <b>Card Holder's Address</b> : {{$paymentDetails->cc_billing_address_street }},
                        {{$paymentDetails->cc_billing_address_city }},
                        {{$paymentDetails->cc_billing_address_state }},
                        {{$paymentDetails->cc_billing_address_zip }}
                    </li>
                </ul>
            </p>
        </div>
        <div class="col-md-12">
            <p style="font-size:12px; color:black;">
                <b>Refund Procedure:</b>
            </p>
            <p style="font-size:12px; color:black;">
                <ul style="font-size:12px; color:black;">
                    <li><b>Cancellation within 24 Hours :</b>  If you choose to cancel your reservation within 24 hours of booking, you will be eligible for a full refund to the original payment method used for the transaction.</li>
                    <li><b>Cancellation beyond 24 Hours :</b>  For cancellations made beyond the 24 Hour window, we will isse a credit equivalent to the amount paid, which can be applied towards future travel bookings made through Reservation Assistance LLC</li>
                </ul>
            </p>
        </div>
        <div class="col-md-12">
            <p style="font-size:12px; color:black;">
                By replying to this email, you confirm your authorization for the total amount indicated above to be charged to the payment methood provided.
            </p>
            <p style="font-size:12px; color:black;">
                We kindly request your confirmation of the itenerary details and authorization for payment. This step ensures that you have reviewed the proposed itenerary, understand the total amount to be charged and agree to our terms and conditions before finalizing your reservation.
            </p>
        </div>
        <div class="col-md-12">
            <img src="{{ $signature }}" width="80%" />
        </div>
</body>
</html>
