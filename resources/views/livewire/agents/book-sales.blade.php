<div class="row mb-3" x:data=''>
    <!-- start page title -->
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item">Agent Dashboard</li>
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

                <div class="btn-group mb-2 float-right">

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

                        <a class="dropdown-item btn" data-bs-toggle="modal" data-bs-target="#newBookingModal"
                            href="#">
                            New Reservation
                        </a>
                        <a class="dropdown-item btn" data-bs-toggle="modal" data-bs-target="#newBookingModal"
                            href="#">
                            Reservation Cancellation
                        </a>
                        {{-- <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a> --}}
                    </div>
                </div><!-- /btn-group -->


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
                                <th>Booking Date</th>
                                <th>Service</th>
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
                                <td>{{ Carbon\Carbon::parse($booking->created_at)->format('F j, Y') }}</td>
                                <td>{{ $booking->service->service_name }}</td>
                                <td>{{ $booking->customer_name }}</td>
                                <td>{{ $booking->customer_phone }}</td>
                                <td>{{ $booking->customer_email }}</td>
                                <td>
                                    @if ($booking->app_status == StatusEnum::DRAFT->value)
                                    <span class="badge badge-outline-danger ">Incomplete</span>
                                    @elseif($booking->app_status == StatusEnum::PENDING->value)
                                    <span class="badge badge-outline-secondary">Authorization Pending</span>
                                    @elseif($booking->app_status == StatusEnum::AUTHORIZED->value)
                                    <span class="badge badge-outline-info">Authorized</span>
                                    @elseif($booking->app_status == StatusEnum::PAYMENT_DONE->value)
                                    <span class="badge badge-outline-success">Payment Done</span>
                                    @elseif($booking->app_status == StatusEnum::SENT_FOR_AUTH->value)
                                    <span class="badge badge-outline-warning">{{ StatusEnum::SENT_FOR_AUTH->value
                                        }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group dropdown">
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
                                    </div>
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
    <div class="modal" id="newBookingModal" tabindex="-1" aria-labelledby="rejectionModalLabel" aria-hidden="true"
        wire:ignore.self x-on:close-modal.window='closeModal("newBookingModal")'>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="header-title">Create New Booking</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="storeSaleBooking">
                        <div class="form-group mb-2">
                            <label for="sale_type" class="form-label">Sale Type <span
                                    class="text-danger"><sup>*</sup></span></label>
                            <select class="form-control @error('sale_type') is-invalid @enderror"
                                wire:model="sale_type">
                                <option value="">Select Type</option>
                                <option value="New Sale">New Sale</option>
                                <option value="Cancellation">Cancellation</option>
                            </select>
                            @error('sale_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="serviceName" class="form-label">Service <span
                                    class="text-danger"><sup>*</sup></span></label>
                            <select class="form-control @error('serviceName') is-invalid @enderror"
                                wire:model="serviceName">
                                <option value="">Select Service</option>
                                @foreach ($services as $service)
                                <option value="{{ $service->service_name }}">
                                    {{ $service->service_name }}</option>
                                @endforeach
                            </select>
                            @error('service_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="customer_name" class="form-label">Customer's Name <span
                                    class="text-danger"><sup>*</sup></span></label>
                            <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                                wire:model="customer_name">
                            @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="customer_phone" class="form-label">Customer's
                                Phone <span class="text-danger"><sup>*</sup></span></label>
                            <input type="text" class="form-control @error('customer_phone') is-invalid @enderror"
                                wire:model="customer_phone" placeholder="10 digit mobile number" minlength="10"
                                maxlength="10">
                            @error('customer_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="customer_email" class="form-label">Customer's
                                Email <span class="text-danger"><sup>*</sup></span></label>
                            <input type="email" class="form-control @error('customer_email') is-invalid @enderror"
                                wire:model="customer_email">
                            @error('customer_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="customer_dob" class="form-label">Customer's
                                Date of Birth <span class="text-danger"><sup>*</sup></span></label>
                            <input type="date" class="form-control @error('customer_dob') is-invalid @enderror"
                                wire:model="customer_dob">
                            @error('customer_dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="customer_gender" class="form-label">Customer's
                                Gender <span class="text-danger"><sup>*</sup></span></label>
                            <select class="form-control @error('customer_gender') is-invalid @enderror"
                                wire:model="customer_gender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Others</option>
                            </select>
                            @error('customer_gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="relationship_to_card_holder" class="form-label">Relationship to Card
                                Holder <span class="text-danger"><sup>*</sup></span></label>
                            <select class="form-control @error('relationship_to_card_holder') is-invalid @enderror"
                                wire:model="relationship_to_card_holder">
                                <option value="">Select Option</option>
                                <option value="Self">Self</option>
                                <option value="Husband">Husband</option>
                                <option value="Wife">Wife</option>
                                <option value="Son">Son</option>
                                <option value="Daughter">Daughter</option>
                                <option value="Uncle">Uncle</option>
                                <option value="Aunt">Aunt</option>
                                <option value="Colleague">Colleague</option>
                            </select>
                            @error('relationship_to_card_holder')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="my-3">
                            <button type="submit" class="btn w-sm btn-success waves-effect waves-light"
                                wire:loading.attr="disabled" wire:loading.class='"disabled'>
                                <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"
                                    wire:loading></span>
                                Create New Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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