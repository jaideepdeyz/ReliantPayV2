<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AMTRAK BOOKING AUTHORIZATION</title>
    <!-- <link rel="stylesheet" href="dashboardAssets/vendor/bootstrap/css/bootstrap.css" /> -->
    @include('pdf.partials.css')
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <img src="{{ $logo }}" alt="" width="80">
                <hr>
                <div>
                    <p><b>Dear {{ $saleBooking->customer_name }}, </p>
                    <p>Greetings of the day !</p>
                    <p><b>New Reservation- Reservation Authorization</b></p>
                    <p>We would like you to go through your itinerary carefully. Please reply to this email as "I Authorize or I Agree" only when you have checked all the information and are completely satisfied with the itinerary and price. </p>

                    <p><b>As per our conversation and as agreed, we have made changes to your itinerary as follows : </b></p>
                    <p>Total price for all passenger(s) including taxes and fees: <b>${{$paymentDetails->amount_charged}} USD </b> (Total for all passengers) and the same amount would be charged on your {{$paymentDetails->cc_type}} card ending with
                        <b>{{ str_repeat('X', max(0, strlen($paymentDetails->cc_number) - 4)) . substr($paymentDetails->cc_number, -4) }}.</b></p>
                    <p><b>Note:</b> Your credit card may be billed in multiple charges not exceeding the above-mentioned total amount.</p>

                    <p>On your bank statement, the following charges will be shown, from Reservation Assistance for a total of <b>USD {{$paymentDetails->amount_charged}}. </b></p><br>

                        @foreach($charges as $charge)
                        <p><b>CHARGE {{$loop->iteration }} : RESERVATION ASSISTANCE : ${{$charge->amount}}</b></p>
                        @endforeach
                        <br><br>
                    <p><b>PLEASE VERIFY THE PASSENGER(S) INFORMATION BELOW</b></p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="style=font-size:12;">#</th>
                                <th style="style=font-size:12;">Passenger's Name</th>
                                <th style="style=font-size:12;">Gender</th>
                                <th style="style=font-size:12;">Date of Birth</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($passengers as $passenger)
                            <tr>
                                <td style="style=font-size:10;">{{$loop->iteration}}</td>
                                <td style="style=font-size:10;">{{$passenger->full_name}}</td>
                                <td style="style=font-size:10;">{{$passenger->gender}}</td>
                                <td style="style=font-size:10;">{{ Carbon\Carbon::parse($passenger->dob)->format('F j, Y')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br><br>


                    <p><b>PLEASE VERIFY THE AMTRAK(S) INFORMATION BELOW</b></p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="font-size:12px;">JOURNEY</th>
                                <th style="font-size:12px;">FROM</th>
                                <th style="font-size:12px;">TO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>ONWARD JOURNEY</b></td>
                                <td>
                                    <b>
                                    {{$amtrakDetails->departureStation->station_location}},
                                    </b>
                                </td>
                                <td>
                                    <b>
                                    {{$amtrakDetails->destinationStation->station_location}},
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <p>
                                        Date: {{ Carbon\Carbon::parse($amtrakDetails->departure_date)->format('F j, Y')}}</p>
                                    <p>
                                        Time: {{$amtrakDetails->departure_hour}} :{{$amtrakDetails->departure_minute}}
                                    </p>
                                </td>
                                <td>
                                    <p>Date: {{ Carbon\Carbon::parse($amtrakDetails->departure_eta_date)->format('F j, Y')}}</p>
                                    <p>
                                        Time: {{$amtrakDetails->departure_eta_hour}} :{{$amtrakDetails->departure_eta_minute}}
                                    </p>
                                </td>
                            </tr>
                            @if($amtrakDetails->oneway_or_roundtrip == 'Round Trip')
                            <tr>
                                <td><b>RETURN JOURNEY</b></td>
                                <td>
                                    <b>
                                    {{$amtrakDetails->destinationStation->station_location}},
                                </td>
                                <td>
                                    <b>
                                    {{$amtrakDetails->destinationStation->station_location}},
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <p>
                                        Date: {{ Carbon\Carbon::parse($amtrakDetails->return_date)->format('F j, Y')}}</p>
                                    <p>
                                        Time: {{$amtrakDetails->return_hour}} :{{$amtrakDetails->return_minute}}
                                    </p>
                                </td>
                                <td>
                                    <p>Date: {{ Carbon\Carbon::parse($amtrakDetails->return_eta_date)->format('F j, Y')}}</p>
                                    <p>
                                        Time: {{$amtrakDetails->return_eta_hour}} :{{$amtrakDetails->return_eta_minute}}
                                    </p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <br><br><br><br>
                    <p><b>PLEASE VERIFY THE AMTRAK(S) ITENARY :</b></p>
                    <p>
                        <img src="{{$itenary}}" alt="" width="100%">
                    </p>
                    <br>
                    <p><b>CARD INFORMATION ON FILE </b></p>
                    <p><b>Card Holder's Name:</b> {{$paymentDetails->cc_name}}</p>
                    <p><b>Card Type:</b> {{$paymentDetails->cc_type}}</p>
                    <p><b>Card Number:</b> <b>{{ str_repeat('X', max(0, strlen($paymentDetails->cc_number) - 4)) . substr($paymentDetails->cc_number, -4) }}</b></p>
                    <p><b>Expiration Date:</b> {{$paymentDetails->cc_expiration_date}}</p>
                    <p><b>Billing Address:</b>
                        {{$paymentDetails->cc_billing_address_street }},
                        {{$paymentDetails->cc_billing_address_city }},
                        {{$paymentDetails->cc_billing_address_state }},
                        {{$paymentDetails->cc_billing_address_zip }}
                    </p>

                    <br>

                    <p><b>TERMS & CONDITIONS</b></p>
                    <ol style="font-size:12px;">
                        <li>By agreeing to this authorization, you officially authorize that the charges on your CREDIT/DEBIT card be done through your chosen AIRLINE/PASSENGER RAIL SERVICE PROVIDER solely for tickets and related services on today's date through RESERVATION ASSISTANCE.</li>
                        <li>By agreeing to this authorization, you understand that your card details are not saved or recorded for any future purchase by RESERVATION ASSISTANCE. You would have to provide the details again to pay for any other service.</li>
                        <li>By agreeing to this authorization, you confirm that you have initiated contact with the customer service representative of RESERVATION ASSISTANCE via phone and provided all necessary information for the reservation and billing process. You understand and acknowledge that the charges will be processed following the agreed-upon terms and conditions. You confirm and understand that these charges are non-refundable and non-reversible as per standard Terms of Service.</li>
                    </ol>

                    <br>

                    <p><b>IMPORTANT INFORMATION</b></p>
                    <ol style="font-size:12px;">
                        <li>For any query call us on 844-314-1008 or write to us at clients@reservationassistance.com</li>
                        <li>Additional Services are subject to credit card approval at the time of ticketing. Additional Services may appear on multiple accompanied documents as a matter of reference.</li>

                       <li>If you have purchased a NON-REFUNDABLE fare, the itinerary must be cancelled before the ticketed departure time of the first unused coupon or
                            the ticket has NO VALUE. If the fare allows changes, a fee may be assessed for changes and restrictions may apply.</li>
                        <li>Reservations are non-transferable and non-refundable. Some tickets, depending on fare rules, can be refunded and/or used (for a limited time)
                            towards future travel or can be refunded; however, all applicable penalties will apply (Airline/Passenger Rail Provider charges and/or service
                            fees). Refunds are not permissible for partially used tickets.</li>
                        <li>Traveller’s Name: Traveller’s First name and Last name must be entered during the time of reservation exactly as it appears on your
                            government-issued identification, be it your passport, Driving License or other acceptable forms of identification depending on your type of
                            journey (Domestic/International). The name once entered will not be changed. Some Typo (Name Correction) however, is allowed, depending on
                            Airline/Passenger Rail Provider Terms of Use, & charges would be applied according to airline policy.</li>
                        <li>We are a travel agency and not an Airline/Passenger Rail Service Provider. We offer various travel related services including ticketing through its
                            business partner RESERVATION ASSISTANCE.</li>
                        <li>RESERVATION ASSISTANCE do not claim to be authorised representatives of any Airline/Passenger Rail Service Provider.</li>
                        <li>The customer service representative may provide you with special discounts on ticketing assistance charges, on your request, if you are booking
                            your tickets more than 07 (Seven) days in advance from the travel date. In such cases, your card may be charged immediately and the
                            confirmed ticket will be issued 07 (Seven) days before your date of journey. In such cases:</li>
                        <li>You confirm that you understand issuance of a deferred ticket is not a policy of any AIRLINE/PASSENGER RAIL SERVICE PROVIDER but a special
                            arrangement of RESERVATION ASSISTANCE to provide you with attractive low-cost services.</li>
                            <li>You confirm that you are aware that tickets are issued immediately on payment by any AIRLINE/PASSENGER RAIL SERVICE PROVIDER, however,
                            you have wilfully chosen to receive your ticket 07 (Seven) days before your journey to lower your ticketing assistance costs.</li>
                            <li>You will get a full refund of your payment from RESERVATION ASSISTANCE if the confirmed ticket is not issued before your journey.</li>
                            <li>You may reply to this mail or call us to enquire about your ticket status if you do not receive your ticket at least 06 (Six) days before your
                            journey.</li>
                            <li>We are happy to help you with any questions or concerns you may have. All customers are advised to verify travel documents (transit visa/entry
                            visa) for the country through which they are transiting and/or entering. We will not be responsible if proper travel documents are not available
                            and you are denied entry or transit into a Country. We request you consult the embassy of the country(s) you are visiting or transiting through.</li>
                            <li>The policy for travelling with Emotional Support and Service animals has changed. Visit your chosen Airline’s/ Passenger Rail Service Provider’s
                            website for policy on travelling with animals for more information.</li>
                    </ol>

                    <br>

                    <p><b>NOTICE OF INCORPORATED TERMS OF CONTRACT</b></p>
                    <p>Air Transportation, whether it is domestic or international (including domestic portions of international journeys), is subject to the individual terms of
                        the transporting air carriers/passenger rail service providers, which are herein incorporated by reference and made part of the contract of carriage.
                        Other carriers on which you may be ticketed may have different conditions of carriage. International air transportation, including the carrier's liability,
                        may also be governed by applicable tariffs on file with the U.S. and other governments and by the Warsaw Convention, as amended, or by the
                        Montreal Convention. Incorporated terms may include, but are not restricted to:</p>
                        <ol style="font-size:12px;">
                            <li> Rules and limits on liability for personal injury or death,</li>
                            <li>Rules and limits on liability for baggage, including fragile or perishable goods, and availability of excess valuation charges,</li>
                            <li>Claim restrictions, including time periods in which passengers must file a claim or bring an action against the air carrier,</li>
                            <li>Rights on the air carrier to change terms of the contract,</li>
                            <li>Rules on reconfirmation of reservations, check-in times and refusal to carry,</li>
                            <li>Rights of the air carrier and limits on liability for delay or failure to perform service, including schedule changes, substitution of alternate air
                                carriers or aircraft and rerouting.</li>
                        </ol>

                        <p>
                            You can obtain additional information on items 1 through 6 above at any U.S. location where the transporting air carrier's/passenger rail service provider’s tickets are sold. You have the right to inspect the full text of each transporting air carrier's terms at its airports/stations and city ticket offices/websites. You also have the right, upon request, to receive (free of charge) the full text of the applicable terms incorporated by reference from each of the transporting air carriers / Passenger Rail Providers. Information on ordering the full text of each air carrier's/ Passenger Rail Provider’s terms is available at any U.S. location where the air carrier's/ Passenger Rail Provider’s tickets are sold or can be found on the e-tickets.
                        </p>

                        <p>
                            NOTICE: This email and any information, files or attachments are for the exclusive and confidential use of the intended recipient. This message contains confidential and proprietary information (such as customer and business data) that may not be read, searched, distributed or otherwise used by anyone other than the intended recipient. If you are not an intended recipient, do not read, distribute, or take action in reliance upon this message. Do you think you received this email by mistake? If so, please forward this email to us with an explanation.
                        </p>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
