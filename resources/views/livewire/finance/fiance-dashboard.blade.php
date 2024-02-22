<div class="row mb-3" x:data=''>
    <!-- start page title -->
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item">Finance Dashboard</li>
                    <li class="breadcrumb-item active">Manage Sales</li>
                </ol>
            </div>

        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="d-inline header-title mb-0">Manage Sales Transactions</h5>


                {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#newBookingModal"
                    class="btn btn-blue float-right"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                        fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                    </svg> Create new
                    Booking
                </button> --}}

                {{-- <div class="btn-group mb-2 float-right">

                    <button type="button" class="btn dropdown-toggle btn-success p-2"

                        data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                            fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                        </svg>
                        Create New Transaction <i class="mdi mdi-chevron-down"></i>

                    </button>

                    <div class="dropdown-menu">

                        <a class="dropdown-item btn" href="#" wire:click="$dispatch('showModal', {data: {'alias' : 'modals.new-sale','params' :{'title':'Sale'}}})">
                            New Reservation
                        </a>
                        <a class="dropdown-item btn"  href="#" wire:click="$dispatch('showModal', {data: {'alias' : 'modals.new-sale','params' :{'title':'Cancellation'}}})"
                           >
                            Reservation Cancellation
                        </a>
                    </div>
                </div> --}}
                <!-- /btn-group -->


            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-9">
                        <div class="form-floating">
                            <input wire:model.live.debounce.200ms="search" class="form-control">
                            <label for="">Search by Name, Email, Confirmation # ..</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select wire:model.live.debounce.800ms="statusSearch" class="form-select">
                                <option value="" class="select">Select Status</option>
                                <option value="{{StatusEnum::DRAFT->value}}">Incomplete</option>
                                <option value="{{StatusEnum::SENT_FOR_AUTH->value}}">Authorization Pending</option>
                                <option value="{{StatusEnum::AUTHORIZED->value}}">Authorized</option>
                                <option value="{{StatusEnum::PAYMENT_DONE->value}}">Payment Completed</option>
                                <option value="{{StatusEnum::TICKET_ISSUED->value}}">Ticket Issued</option>
                                <option value="{{StatusEnum::CANCELLATION_REQUESTED->value}}">Cancellation Initiated</option>
                                <option value="{{StatusEnum::TICKET_CANCELLED->value}}">Ticket Cancelled</option>
                                <option value="{{StatusEnum::REFUND_REQUESTED->value}}">Refund Initiated</option>
                                <option value="{{StatusEnum::REFUNDED->value}}">Refunded</option>
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
                                <th>Type</th>
                                <th>Booking Date</th>
                                <th>Service</th>
                                <th>Confirmation #</th>
                                <th>Customer's Name</th>
                                <th>Customer's Phone</th>
                                <th>Customer's Email</th>
                                <th>Service Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookedSales as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->sale_type }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->created_at)->format('F j, Y') }}</td>
                                <td>{{ $booking->service->service_name }}</td>
                                <td>{{ $booking->confirmation_number }}</td>
                                <td>{{ $booking->customer_name }}</td>
                                <td>{{ $booking->customer_phone }}</td>
                                <td>{{ $booking->customer_email }}</td>
                                <td>
                                    @switch($booking->app_status)
                                        @case(StatusEnum::DRAFT->value)
                                        @case(StatusEnum::CANCELLATION_REQUESTED->value)
                                        @case(StatusEnum::TICKET_CANCELLED->value)
                                        @case(StatusEnum::REFUND_REQUESTED->value)
                                        @case(StatusEnum::REFUNDED->value)
                                            <span class="badge bg-danger rounded-pill d-grid">{{$booking->app_status}}</span>
                                            @break
                                        @case(StatusEnum::PENDING->value)
                                            <span class="badge bg-secondary rounded-pill d-grid">{{$booking->app_status}}</span>
                                            @break
                                        @case(StatusEnum::AUTHORIZED->value)
                                        @case(StatusEnum::PAYMENT_DONE->value)
                                        @case(StatusEnum::TICKET_ISSUED->value)
                                            <span class="badge bg-success rounded-pill d-grid">{{$booking->app_status}}</span>
                                            @break
                                        @case(StatusEnum::SENT_FOR_AUTH->value)
                                            <span class="badge bg-warning rounded-pill d-grid">{{$booking->app_status}}</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    {{-- <div class="btn-group dropdown">
                                        <a href="javascript: void(0);"
                                            class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="mdi mdi-dots-horizontal"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <a class="dropdown-item" href="#"
                                                wire:click="viewBooking({{ $booking->id }})"><i
                                                    class="mdi mdi-pencil me-2 text-success vertical-middle"></i>Complete
                                                Booking</a>
                                            @if ($booking->app_status == StatusEnum::SENT_FOR_AUTH->value)
                                            @switch($booking->service->service_name)
                                            @case('Flight Booking')
                                            <a class="dropdown-item"
                                                href="{{ route('airlineBooking.show', $booking->id) }}"><i
                                                    class="mdi mdi-eye me-2 text-success vertical-middle"></i>View</a>
                                            @break
                                            @case('AMTRAK Booking')
                                            <a class="dropdown-item"
                                                href="{{ route('amtrakBookingDetails.show', $booking->id) }}"><i
                                                    class="mdi mdi-eye me-2 text-success vertical-middle"></i>View</a>
                                            @break
                                            @default
                                            @endswitch
                                            @endif
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#alertModal"
                                                wire:click='selectId({{ $booking->id }})'><i
                                                    class="mdi mdi-delete me-2 text-danger vertical-middle"></i>Delete</a>


                                        </div>
                                    </div> --}}
                                    @livewire('user.action-buttons', [
                                        'appID' => $booking->id
                                    ])
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $bookedSales->links() }}
                    {{--
                </div> --}}
            </div>
        </div>
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
    <x-toast-livewire />

</div>
