<div class="mt-3">
    <div class="card">
        <div class="card-body">
            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 1/5: Dealer Business Information </h5>
            <form wire:submit.prevent="storeBusinessInfo">
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="business_name" class="form-label">Business Name <span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" class="form-control @error('business_name') is-invalid @enderror"
                            placeholder="Enter business name" wire:model="business_name">
                        @error('business_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="business_address" class="form-label">Address <span class="text-danger"><sup>*</sup></span></label>
                        <textarea class="form-control @error('business_address') is-invalid @enderror" rows="4"
                            placeholder="Enter business address" wire:model="business_address"></textarea>
                        @error('business_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4">
                        <label for="business_website" class="form-label">Website <span class="text-danger"><sup>*</sup></span></label>
                        <input type="text"
                            class="form-control @error('business_website') is-invalid @enderror"
                            placeholder="Enter business website" value ="{{ old('business_website') }}"
                            wire:model="business_website">
                        @error('business_website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4">
                        <label for="business_email" class="form-label">E-Mail <span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" class="form-control @error('business_email') is-invalid @enderror"
                            placeholder="Enter business email" wire:model="business_email">
                        @error('business_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4">
                        <label for="business_phone" class="form-label">Phone <span class="text-danger"><sup>*</sup></span></label>
                        <input type="text"
                            class="form-control  @error('business_phone') is-invalid @enderror"
                            placeholder="Enter business phone" wire:model="business_phone">
                        @error('business_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Next</button>
                    </div>
                </div>
            </form>

        </div>
    </div> <!-- end card -->
</div>