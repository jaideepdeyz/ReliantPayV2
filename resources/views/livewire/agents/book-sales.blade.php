<div class="row">
    <div class="col-md-12">
        <form wire:submit="storeSaleBooking">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 1/5: Customer Details</h5>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="agent_name" class="form-label">Agent Name</label>
                                    <input type="text" class="form-control @error('agent_name') is-invalid @enderror"
                                        wire:model="agent_name" readonly>
                                    @error('agent_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
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

                                <div class="mb-3 col-md-4">
                                    <label for="customer_name" class="form-label">Customers / Primary Passengers Name</label>
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                                        wire:model="customer_name">
                                    @error('customer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="customer_phone" class="form-label">Customers / Primary Passengers Phone</label>
                                    <input type="text" class="form-control @error('customer_phone') is-invalid @enderror"
                                        wire:model="customer_phone">
                                    @error('customer_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="customer_email" class="form-label">Customers / Primary Passengers Email</label>
                                    <input type="text" class="form-control @error('customer_email') is-invalid @enderror"
                                        wire:model="customer_email">
                                    @error('customer_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                                    <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Next</button>
                                </div>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>