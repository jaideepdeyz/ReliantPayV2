<div class="btn-group dropdown">
    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs"
        data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
        <div class="dropdown-menu dropdown-menu-end" style="">
            @switch($bookingStatus)
                @case(StatusEnum::DRAFT->value)
                    <a class="dropdown-item" href="#" wire:click="viewBooking({{ $sale->id }})"><i class="mdi mdi-pencil me-2 text-success vertical-middle"></i>Complete Booking</a>

                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#alertModal" wire:click='selectId({{ $sale->id }})'><i class="mdi mdi-delete me-2 text-danger vertical-middle"></i>Delete</a>
                @break

                @case(StatusEnum::SENT_FOR_AUTH->value)
                    @if($sale->service->service_name == ServiceEnum::FLIGHTS->value)
                        <a class="dropdown-item" href="{{ route('airlineBooking.show', $sale->id) }}"><i class="mdi mdi-eye me-2 text-success vertical-middle"></i>View</a>
                    @elseif($sale->service->service_name == ServiceEnum::AMTRAK->value)
                        <a class="dropdown-item" href="{{ route('amtrakBookingDetails.show', $sale->id) }}"><i class="mdi mdi-eye me-2 text-success vertical-middle"></i>View</a>
                    @endif
                    <a class="dropdown-item" href="#" wire:click="$dispatch('showModal', {data: {'alias' : 'modals.cancel-booking','params' :{'appID': $sale->id}}})"><i class="mdi mdi-delete me-2 text-danger vertical-middle"></i>Cancel Booking</a>
                @break

                @case(StatusEnum::AUTHORIZED->value)
                    <a class="dropdown-item" href="{{ route('payment.stepOnePay', $sale->id) }}"><i class="mdi mdi-currency-usd me-2 text-danger vertical-middle"></i>Charge Card</a>
                    @if($sale->service->service_name == ServiceEnum::FLIGHTS->value)
                        <a class="dropdown-item" href="{{ route('airlineBooking.show', $sale->id) }}"><i class="mdi mdi-eye me-2 text-success vertical-middle"></i>View</a>
                    @elseif($sale->service->service_name == ServiceEnum::AMTRAK->value)
                        <a class="dropdown-item" href="{{ route('amtrakBookingDetails.show', $sale->id) }}"><i class="mdi mdi-eye me-2 text-success vertical-middle"></i>View</a>
                    @endif
                    <a class="dropdown-item" href="#" wire:click="$dispatch('showModal', {data: {'alias' : 'modals.cancel-booking','params' :{'appID': $sale->id}}})"><i class="mdi mdi-delete me-2 text-danger vertical-middle"></i>Cancel Booking</a>
                @break

                @case(StatusEnum::PAYMENT_DONE->value)
                    @if(Auth::User()->role == RoleEnum::AGENT->value)
                        @switch($sale->ticketBooking->bookedThroughReservationAssistance)
                            @case('No')
                            <a class="dropdown-item"
                                href="{{ route('uploadTicket', $sale->id) }}"><i
                                    class="mdi mdi-upload me-2 text-primary vertical-middle"></i>Upload Ticket</a>
                            @break
                            @default
                        @endswitch
                    @endif
                    @if($sale->service->service_name == ServiceEnum::FLIGHTS->value)
                        <a class="dropdown-item" href="{{ route('airlineBooking.show', $sale->id) }}"><i class="mdi mdi-eye me-2 text-success vertical-middle"></i>View</a>
                    @elseif($sale->service->service_name == ServiceEnum::AMTRAK->value)
                        <a class="dropdown-item" href="{{ route('amtrakBookingDetails.show', $sale->id) }}"><i class="mdi mdi-eye me-2 text-success vertical-middle"></i>View</a>
                    @endif
                    <a class="dropdown-item" href="#" wire:click="$dispatch('showModal', {data: {'alias' : 'modals.cancel-booking','params' :{'appID': $sale->id}}})"><i class="mdi mdi-delete me-2 text-danger vertical-middle"></i>Cancel Booking</a>
                @break

                @case(StatusEnum::TICKET_ISSUED->value)
                    @if($sale->service->service_name == ServiceEnum::FLIGHTS->value)
                        <a class="dropdown-item" href="{{ route('airlineBooking.show', $sale->id) }}"><i class="mdi mdi-eye me-2 text-success vertical-middle"></i>View Details</a>
                    @elseif($sale->service->service_name == ServiceEnum::AMTRAK->value)
                        <a class="dropdown-item" href="{{ route('amtrakBookingDetails.show', $sale->id) }}"><i class="mdi mdi-eye me-2 text-success vertical-middle"></i>View Details</a>
                    @endif
                    <a class="dropdown-item" href="{{route('showTicket', $sale->id)}}"><i class="mdi mdi-eye me-2 text-primary vertical-middle"></i>View Ticket</a>
                    <a class="dropdown-item" href="#"><i class="mdi mdi-delete me-2 text-danger vertical-middle" wire:click="showCancellationModal({{$sale->id}})"></i>Cancel Booking</a>
                @break

                @default
                    @if($sale->service->service_name == ServiceEnum::FLIGHTS->value)
                        <a class="dropdown-item" href="{{ route('airlineBooking.show', $sale->id) }}"><i class="mdi mdi-eye me-2 text-success vertical-middle"></i>View Details</a>
                    @elseif($sale->service->service_name == ServiceEnum::AMTRAK->value)
                        <a class="dropdown-item" href="{{ route('amtrakBookingDetails.show', $sale->id) }}"><i class="mdi mdi-eye me-2 text-success vertical-middle"></i>View Details</a>
                    @endif
                @break
            @endswitch
        </div>

    {{-- Confirm Deletion Modal --}}
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="rejectionModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="dripicons-warning h1 text-warning"></i>
                    <p>Are you sure you want to delete this booking?</p>
                    <button class="btn btn-warning text-uppercase" wire:click="deleteSaleBooking()"
                        data-bs-dismiss="modal">Yes delete</button>
                </div>
            </div>
        </div>
    </div>
</div>