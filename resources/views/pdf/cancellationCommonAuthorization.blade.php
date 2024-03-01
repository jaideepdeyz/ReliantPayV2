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
                <b>PAYMENT AUTHORIZATION FOR CANCELLATION OF {{$type}} RESERVATION WITH {{ $carrier }} , {{$data->oneway_or_roundtrip}}, {{ Carbon\Carbon::parse($data->departure_date)->format('F j, Y')}} CURATED BY RESERVATION ASSISTANCE</b>
            </div><br><br>
        </div>
        <div class="col-md-12" style="font-size:14px; padding-top:20px;">
            Dear <b>{{ $saleBooking->customer_name }}</b>,
            <br><br>
        </div>

        <div class="col-md-12">
            <p style="font-size:12px; color:black;">
                Thank you for choosing Reservation Assistance LLC for your travel arrangements. We are delighted to assist you in cancelling your ticket for the planned trip.
            </p>
            <p style="font-size:12px; color:black;">
                As per your recent enquiry, we have prepared a detailed itenary for cancellation of your {{$type}} reservation. Please find attached the itenary document outlining your travel details, including the proposed itenerary and associated charges.
            </p>
        </div>

        <div class="col-md-12">
            <p style="font-size:12px; color:black;">
                <b>Customer Information (Person who has contacted Reservation Assistance to cancel this ticket):</b>
            </p>
            <p>
                <ul style="font-size:12px; color:black;">
                    <li><b>Name:</b> {{ $saleBooking->customer_name }}</li>
                    <li><b>Contact Number:</b> {{ $saleBooking->customer_phone }}</li>
                    <li><b>Email Address:</b> {{ $saleBooking->customer_email }}</li>
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
                    <li><b>Departure Time:</b> {{ Carbon\Carbon::parse($data->departure_date)->format('h:i:sa') }} </li>
                    <li><b>Departure Airport/Station/Port:</b> {{$departureLocation}}</li>
                    <li><b>Arrival Date:</b> {{ Carbon\Carbon::parse($data->departure_eta_date)->format('F j, Y') }}</li>
                    <li><b>Arrival Time:</b> {{ Carbon\Carbon::parse($data->departure_eta_date)->format('h:i:sa') }}</li>
                    <li><b>Arrival Airport/Station/Port:</b> {{ $destinationLocation }}</li>
                    <li><b>Airline/Carrier Name:</b> {{ $carrier }}</li>
                    <li><b>Flight / Train Number:</b> {{ $data->transport_number }}</li>
                    <li><b>Class:</b> {{ $data->travel_class }}</li>
                    <li><b>Confirmation Number:</b> {{ $saleBooking->confirmation_number }}</li>
                </ul>
            </p>
            {{-- add travel iternary here
            <p>
                <img src="{{$itenary}}" alt="" width="100%">
            </p> --}}
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
                We kindly request your confirmation of the itenerary details and authorization for payment. This step ensures that you have reviewed the proposed itenerary, understand the total amount to be charged and agree to our terms and conditions before cancelling your reservation.
            </p>
        </div>
        <div class="col-md-12" style="page-break-after:always;">
            <img src="{{ $signature }}" width="90%" />
        </div>
        <div class="col-md-12" style="font-size:12px; color:black; padding-top:130px; margin-bottom:0px;">
            <b>Terms and Conditions:</b>
            <ul style="font-size:12px; color:black;">
                <li>Reservation Confirmation: Upon receiving your authorization for payment, Reservation Assistance LLC will
                    proceed to confirm your reservation with the respective airlines, train operators, cruise lines, or other service
                    providers. Your reservation is subject to availability and the terms and conditions set forth by these providers.</li>
                <li>Payment Policy: Payment for your travel reservation is required to secure your booking. The total amount indicated in your itinerary will be charged to the payment method provided by you. In the case of multiple
                    payments, each installment will be charged according to the specified schedule.</li>
                <li>Cancellation and Refund Policy: Cancellation policies vary depending on the service provider and type of reservation. It is essential to review the cancellation terms outlined by each provider before confirming your
                    booking. Reservation Assistance LLC will assist you in processing cancellations and refunds in accordance with the
                    policies of the respective service providers.</li>
                <li>Change Policy: Changes to your reservation, including modifications to travel dates, routes, or passenger details, may be subject to additional fees and availability restrictions imposed by the service providers. Reservation Assistance LLC will facilitate these changes to the best of our ability but cannot guarantee availability or waive any
                    fees imposed by the providers.</li>
                <li>Travel Documents: It is your responsibility to ensure that you possess the necessary travel documents, including passports, visas, and other permits required for your journey. Reservation Assistance LLC will not be liable for any issues arising from inadequate or expired travel documents.</li>
                <li>Travel Insurance: We strongly recommend purchasing travel insurance to protect yourself against unforeseen
                    circumstances, including trip cancellations, medical emergencies, and travel disruptions. Reservation Assistance
                    LLC can assist you in obtaining suitable travel insurance coverage upon request.</li>
                <li>Liability Disclaimer: While Reservation Assistance LLC endeavors to provide accurate and reliable information, we cannot guarantee the accuracy, completeness, or timeliness of the content provided by third-party service
                    providers. We shall not be liable for any errors, omissions, or discrepancies in the information provided, nor for
                    any losses, damages, or inconveniences incurred because of reliance on such information.</li>
                <li>The credit issued for cancellations beyond the 24-hour window will be valid for a specified period, as determined
                    by Reservation Assistance LLC.</li>
                <li>To redeem your credit, simply contact our customer service team when making your next reservation, and we will
                    apply the credit towards the total cost of your booking.</li>
                <li>Please be aware that refunds or credits are subject to the terms and conditions of the respective service providers,
                    including airlines, train operators, cruise lines, and other travel suppliers.</li>
                <li>Certain fees and charges may apply based on the policies of the service providers, and these will be deducted
                    from the refund amount or credit issued, as applicable.</li>
            </ul>
        </div>
        <div class="col-md-12" style="margin-top:0px; font-size:12px; color:black;">
            <p>As your trusted travel agency, Reservation Assistance LLC is committed to ensuring your travel experience is smooth, safe, and enjoyable. To assist you in planning your trip effectively, we would like to bring the following warnings and notices to your attention:</p>
            <ol style="font-size:12px; color:black;">
                <li>
                    <b>Travel Restrictions and Requirements:</b>
                    Please be aware of any travel restrictions, entry requirements, and quarantine regulations imposed by your destination country or region. It is your responsibility to stay informed about any travel advisories issued by relevant authorities.
                </li>
                <li>
                    <b>Health and Safety Measures:</b>
                    Due to the ongoing COVID-19 pandemic, additional health and safety measures may be in place at airports, train stations, cruise ports, and other travel hubs. We strongly advise you to adhere to these guidelines and regulations for your safety and the safety of others.
                </li>
                <li>
                    <b>Weather and Natural Disasters:</b>
                    Keep abreast of weather forecasts and potential natural disasters that may affect your travel plans. In case of adverse weather conditions or unforeseen events, be prepared for possible flight delays, cancellations, or itinerary changes.
                </li>
                <li>
                    <b>Travel Insurance:</b>
                    We highly recommend purchasing comprehensive travel insurance to safeguard your trip against unexpected events, including trip cancellations, medical emergencies, and travel disruptions. Please review your insurance coverage carefully to ensure it meets your needs.
                </li>
                <li>
                    <b>Documentation and Identification:</b>
                    Ensure that you possess the necessary travel documents, including passports, visas, and any required permits. Additionally, carry valid identification and keep copies of essential documents in a secure location during your travels.
                </li>
                <li style="page-break-after: always;">
                    <b>Baggage Regulations:</b>
                    Familiarize yourself with baggage allowances, restrictions, and regulations enforced by airlines, train operators, and cruise lines. Pack your belongings accordingly to avoid any additional fees or inconvenience at the airport or port.
                </li>
                <li style="padding-top:130px; margin-bottom:0px;">
                    <b>Financial Protection:</b>
                    Be cautious when making payments or providing financial information online. Only use secure and reputable payment methods when booking your travel reservations. Reservation Assistance LLC will never request sensitive financial details via email or phone.
                </li>
                <li>
                    <b>Scams and Fraudulent Activities:</b>
                    Beware of fraudulent schemes, phishing attempts, and scam emails claiming to be from Reservation Assistance LLC or other travel agencies. Exercise caution and verify the authenticity of any communication before providing personal or financial information.
                </li>'
                <li>
                    <b>Terms and Conditions:</b>
                    Review the terms and conditions associated with your travel reservation carefully, including cancellation policies, refund procedures, and any applicable fees or charges. By proceeding with your booking, you acknowledge and agree to abide by these terms and conditions.
                </li>
            </ol>
        </div>

        <div class="col-md-12" style="font-size:12px; color:black; border-style: solid;">
            <p style="text-align: center;"><b><u>Legal Binding Notice</u></b></p>
            <p style="padding-left:20px;">
                By proceeding with your travel reservation and providing authorization for payment, you acknowledge and agree that:
            </p>
            <p>
                <ol style="font-size:12px; color:black;">
                    <li>
                        <b>Legal Binding Agreement:</b>
                            This email, along with any attached documents or communications related to your travel reservation, constitutes a legally binding agreement between you (the customer) and Reservation Assistance LLC (the travel agency).
                    </li>
                    <li>
                        <b>Payment Authorization:</b>
                            Your authorization for payment confirms your acceptance of the total amount indicated for your travel reservation. By providing payment authorization, you acknowledge your obligation to fulfill the payment as outlined in the provided itinerary and payment details.
                    </li>
                    <li>
                        <b>Dispute Resolution:</b>
                            In the event of a payment dispute or disagreement regarding your travel reservation, you agree to first contact Reservation Assistance LLC to attempt to resolve the issue amicably. We are committed to addressing any concerns or discrepancies promptly and fairly.
                    </li>
                    <li>
                        <b>Legal Recourse:</b>
                            If you initiate a payment dispute without first contacting Reservation Assistance LLC to seek resolution, you acknowledge and agree that Reservation Assistance LLC reserves the right to pursue legal action to recover the disputed amount, as well as any associated legal fees and costs incurred.
                    </li>
                </ol>
            </p>
        </div>

        <div class="col-md-12" style="font-size:12px; color:black; border-style: solid; margin-top:20px;">
            <p style="text-align: center;"><b><u>Notice of Legal Action</u></b></p>
            <p style="padding-left:20px;">
                Please be advised that Reservation Assistance LLC takes payment disputes seriously and will not hesitate to pursue legal recourse to protect our interests and enforce the terms of our agreement. By proceeding with your travel reservation and providing payment authorization, you affirm your understanding of the legal implications outlined in this notice.
            </p>
            <p style="padding-left:20px;">
                Should you have any questions or concerns regarding this legal binding notice or require assistance with your travel reservation, please do not hesitate to contact our customer service team. We are here to assist you and ensure a seamless travel experience.
            </p>
        </div>
        <div class="col-md-12" style="font-size:12px; color:black;">
            <p style="padding-left:20px;">
                Thank you for your attention to this matter. We appreciate your cooperation and look forward to serving you
            </p>
        </div>
</body>
</html>
