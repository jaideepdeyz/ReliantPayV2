<div class="row mt-2">
    <div class="mt-3 col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 1/5: Merchant Business Information </h5>
                <form wire:submit.prevent="save">
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="business_name" class="form-label">Business Name <span class="text-danger"><sup>*</sup></span></label>
                            <input type="text" class="form-control @error('business_name') is-invalid @enderror"
                                placeholder="Enter business name" wire:model="business_name">
                            @error('business_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Services Offered --}}
                        <div class="col-md-12 mb-2">
                            <h5 style="opacity:0.7">Products & Services (Please select all applicable products &
                                services) <span class="text-danger"><sup>*</sup></span></h5>
                        </div>
                        @foreach ($services as $service)
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <input type="checkbox" class="form-check-input"
                                        wire:model="business_product_services.{{ $service->name }}">
                                    <label for="" class="form-check-label">{{ $service->name }}</label>
                                </div>
                            </div>
                        @endforeach


                        <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                            <button type="submit" class="btn btn-success waves-effect waves-light">Next</button>
                        </div>
                    </div>
                </form>

            </div>
        </div> <!-- end card -->
    </div>
</div>

