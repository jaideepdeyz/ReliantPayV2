<div class="row" x:data=''>
    <!-- start page title -->
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item active">Agent Dashboard</li>
                </ol>
            </div>
            <h4 class="page-title">Agent Dashboard</h4>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="d-inline header-title mb-0">Latest Bookings</h5>
                <button type="button" data-bs-toggle="modal" data-bs-target="#newBookingModal"
                    class="btn btn-blue btn-sm float-right"><i class="fas fa-plus"></i> Create new
                    Booking</button>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="form-group col-md-3">
                        <label for="">Search by ID</label>
                        <input type="text" wire:model.live="search" class="form-control" placeholder="Sale ID">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">Search by Customer's Name</label>
                        <input type="text" wire:model.live="search" class="form-control"
                            placeholder="Customer's Name">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">Search by Customer's Email</label>
                        <input type="text" wire:model.live="search" class="form-control"
                            placeholder="Customer's Email">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">Search by Status</label>
                        <select wire:model.live="search" class="form-control">
                            <option value="">Select Status</option>
                            <option value="Draft">Draft</option>
                            <option value="Pending">Pending</option>
                            <option value="Authorized">Authorized</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Sale ID</th>
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
                                            <span class="badge badge-outline-success">Authorized</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary"
                                            wire:click="viewBooking({{ $booking->id }})">Proceed</button>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#alertModal"
                                            wire:click='selectId({{ $booking->id }})'>Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $bookedSales->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="newBookingModal" tabindex="-1" aria-labelledby="rejectionModalLabel" aria-hidden="true"
        wire:ignore.self x-on:close-modal.window='closeModal("newBookingModal")'>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="header-title">Create new booking</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="storeSaleBooking">
                        <div class="form-group mb-2">
                            <label for="service_id" class="form-label">Service</label>
                            <select class="form-control @error('service_id') is-invalid @enderror"
                                wire:model="service_id">
                                <option value="">Select Service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">
                                        {{ $service->service_name }}</option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="customer_name" class="form-label">Customer's Name</label>
                            <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                                wire:model="customer_name">
                            @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="customer_phone" class="form-label">Customer's
                                Phone</label>
                            <input type="text" class="form-control @error('customer_phone') is-invalid @enderror"
                                wire:model="customer_phone">
                            @error('customer_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="customer_email" class="form-label">Customer's
                                Email</label>
                            <input type="email" class="form-control @error('customer_email') is-invalid @enderror"
                                wire:model="customer_email">
                            @error('customer_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="my-3">
                            <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Create
                                New Booking</button>
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
