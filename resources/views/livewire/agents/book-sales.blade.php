<div class="row">
    <div class="col-md-12">
        <form wire:submit="storeSaleBooking">
            <div class="row">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">New Booking</h5>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <span class="badge bg-blue"><h5 class="text-white">Agent : {{$agent_name}}</h5></span>
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="service_id" class="form-label">Service</label>
                                    <select class="form-control @error('service_id') is-invalid @enderror"
                                        wire:model="service_id">
                                        <option value="">Select Service</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('service_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="customer_name" class="form-label">Customer's Name</label>
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                                        wire:model="customer_name">
                                    @error('customer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="customer_phone" class="form-label">Customer's Phone</label>
                                    <input type="text" class="form-control @error('customer_phone') is-invalid @enderror"
                                        wire:model="customer_phone">
                                    @error('customer_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="customer_email" class="form-label">Customer's Email</label>
                                    <input type="text" class="form-control @error('customer_email') is-invalid @enderror"
                                        wire:model="customer_email">
                                    @error('customer_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                                    <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Create New Booking</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Latest Bookings</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Sale ID</th>
                                            <th>Service</th>
                                            <th>Customer</th>
                                            <th>Service Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bookedSales as $booking)
                                        <tr>
                                            <td>{{ $booking->id }}</td>
                                            <td>{{ $booking->service->service_name }}</td>
                                            <td>{{ $booking->customer_name }}</td>
                                            <td>
                                                @if($booking->app_status == StatusEnum::DRAFT->value)
                                                    <span class="badge badge-outline-danger ">Incomplete</span>
                                                @elseif($booking->app_status == StatusEnum::PENDING->value)
                                                    <span class="badge badge-outline-secondary">Authorization Pending</span>
                                                @elseif($booking->app_status == StatusEnum::AUTHORIZED->value)
                                                    <span class="badge badge-outline-success">Authorized</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" wire:click="viewBooking({{$booking->id}})">View</button>
                                                <a href="" class="btn btn-sm btn-warning">Edit</a>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirm('Are you sure you want to delete this booking?') || event.stopImmediatePropagation()" wire:click="deleteSaleBooking({{ $booking->id }})">Delete</button>
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
            </div>

        </form>
    </div>
</div>
