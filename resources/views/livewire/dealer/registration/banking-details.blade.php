<div class="mt-3">
    <div class="card">
        <div class="card-body">
            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 3/5: Banking Details</h5>
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="business_bank_account_name" class="form-label">Bank Account Name <span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" class="form-control" placeholder="Enter Bank Account Name"
                            wire:model="business_bank_account_name">
                        <span class="text-danger"> @error('business_bank_account_name')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="business_bank_account_address" class="form-label">Bank Account
                            Address <span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" class="form-control" placeholder="Enter Bank Address"
                            wire:model="business_bank_account_address">
                        <span class="text-danger"> @error('business_bank_account_address')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="business_bank_name" class="form-label">Bank Name <span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" class="form-control" placeholder="Enter Bank Name"
                            wire:model="business_bank_name">
                        <span class="text-danger"> @error('business_bank_name')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="business_bank_address" class="form-label">Bank Address <span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" class="form-control" placeholder="Enter Bank Address"
                            wire:model="business_bank_address">
                        <span class="text-danger"> @error('business_bank_address')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="business_bank_IBAN" class="form-label">Bank IBAN <span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" class="form-control" placeholder="Enter IBAN"
                            wire:model="business_bank_IBAN">
                        <span class="text-danger"> @error('business_bank_IBAN')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="business_bank_IFSC" class="form-label">Bank IFSC <span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" class="form-control" placeholder="Enter IFSC"
                            wire:model="business_bank_IFSC">
                        <span class="text-danger"> @error('business_bank_IFSC')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="business_bank_SWIFT_code" class="form-label">Bank SWIFT Code <span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" class="form-control" placeholder="Enter SWIFT Code"
                            wire:model="business_bank_SWIFT_code">
                        <span class="text-danger"> @error('business_bank_SWIFT_code')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="business_bank_routing_code" class="form-label">Bank Routing Code <span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" class="form-control" placeholder="Enter Routing Code"
                            wire:model="business_bank_routing_code">
                        <span class="text-danger"> @error('business_bank_routing_code')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                        <button type="button" class="btn w-sm btn-secondary waves-effect waves-light" wire:click="decreaseStep">Previous</button>
                        <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Next</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
