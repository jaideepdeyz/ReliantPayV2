<div class="row mb-5">
    <!-- start page title -->
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item active">Ticketer Dashboard</li>
                </ol>
            </div>
            <h4 class="page-title">Ticketer Dashboard</h4>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="d-inline header-title mb-0">Manage Tickets</h5>
                <button type="button" data-bs-toggle="modal" data-bs-target="#newBookingModal"
                    class="btn btn-blue float-right"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                        fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                    </svg> Create new
                    Booking</button>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-9">
                        <div class="form-floating">
                            <input wire:model.live.debounce.800ms="search" class="form-control">
                            <label for="">Search by Name, Email or Phone</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select wire:model.live.debounce.800ms="statusSearch" class="form-select">
                                <option value="" class="select">Select Status</option>
                                <option value="{{StatusEnum::DRAFT->value}}">Draft</option>
                                <option value="{{StatusEnum::PENDING->value}}">{{StatusEnum::PENDING->value}}</option>
                            </select>
                            <label for="">Search by Status</label>
                        </div>
                    </div>

                </div>

                {{-- <div class="table-responsive"> --}}
                    <table class="table table-striped table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Sale ID</th>
                                <th>Departure Date</th>
                                <th>Departure Time</th>
                                <th>Carrier</th>
                                <th>Confirmation Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($confirmedBookings as $booking)
                            <tr>
                                <td>{{ $booking->saleBooking->id}}</td>
                                @switch($booking->saleBooking->service->id)
                                    @case(ServiceEnum::FLIGHTS->value)
                                        <td>{{ $booking->flightBooking->departure_date }}</td>
                                        <td>{{ $booking->flightBooking->departure_hour}}:{{ $booking->flightBooking->departure_minute}} </td>
                                        @break
                                    @case(ServiceEnum::AMTRAK->value)
                                        <td>{{ $booking->amtrakBooking->departure_date }}</td>
                                        <td>{{ $booking->amtrakBooking->departure_hour}}:{{ $booking->amtrakBooking->departure_minute}} </td>
                                        @break
                                    @default
                                @endswitch
                                <td>

                                </td>
                                <td>
                                    @if ($booking->confirmation_number == null)
                                        <span class="badge badge-outline-danger ">Ticket Not Booked</span>
                                    @else
                                        <span class="badge badge-outline-success">Ticket Issued</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <a href="javascript: void(0);"
                                            class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="mdi mdi-dots-horizontal"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                             @if ($booking->ticket_upload == null)
                                             <a class="dropdown-item"
                                             href="{{ route('uploadTicket', $booking->id) }}"><i
                                                 class="mdi mdi-upload me-2 text-primary vertical-middle"></i>Upload Ticket</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $confirmedBookings->links() }}
                {{-- </div> --}}
            </div>
        </div>
    </div>
</div>
