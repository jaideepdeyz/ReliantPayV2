<div>
    <div class="modal-header">
        <h5 class="modal-title">New {{$title}}</h5>
        <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form wire:submit="storeSaleBooking">
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
                    Date of Birth (dd-mm-YYYY) <span class="text-danger"><sup>*</sup></span></label>
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
                    <option value="Mother">Mother</option>
                    <option value="Father">Father</option>
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