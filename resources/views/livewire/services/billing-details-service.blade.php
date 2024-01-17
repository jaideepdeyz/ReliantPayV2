<div class="row mt-4">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item">Agent Dashboard</li>
                    <li class="breadcrumb-item">{{$saleBooking->service->service_name}}</li>
                    <li class="breadcrumb-item active">Billing Details</li>
                </ol>
            </div>
            <h4 class="page-title">Billing Details</h4>
        </div>
    </div>
    <div class="col-md-12">
        <form wire:submit="saveBillingDetails">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                            Step 3/4: Billing Details
                        </h5>
                        <div class="row">

                            <div class="mb-3 col-md-4">
                                <label for="cc_type" class="form-label">Credit Card Type?</label>
                                <select class="form-control @error('cc_type') is-invalid @enderror"
                                    wire:model="cc_type">
                                    <option value="">Select Option</option>
                                    <option value="Mastercard">Mastercard</option>
                                    <option value="VISA">VISA</option>
                                    <option value="American Express">American Express</option>
                                    <option value="Others">Others</option>
                                </select>
                                @error('cc_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="cc_number" class="form-label">Credit Card Number</label>
                                <input type="text" class="form-control @error('cc_number') is-invalid @enderror"
                                    wire:model="cc_number" minlength="16" maxlength="16">
                                @error('cc_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-2">
                                <label for="cc_expiration_date" class="form-label">Card Expiry Date</label>
                                <input type="text"
                                    class="form-control @error('cc_expiration_date') is-invalid @enderror"
                                    wire:model="cc_expiration_date">
                                @error('cc_expiration_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="mb-3 col-md-2">
                                <label for="cc_cvc" class="form-label">CVV:</label>
                                <input class="form-control @error('cc_cvc') is-invalid @enderror" wire:model="cc_cvc">
                                @error('cc_cvc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="cc_name" class="form-label">Card Holder's Name</label>
                                <input type="text" class="form-control @error('cc_name') is-invalid @enderror"
                                    wire:model="cc_name">
                                @error('cc_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="cc_dob" class="form-label">Card Holder's Date of Birth</label>
                                <input type="date" class="form-control @error('cc_dob') is-invalid @enderror"
                                    wire:model="cc_dob">
                                @error('cc_dob')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="cc_phone" class="form-label">Card Holder's Phone</label>
                                <input type="text" class="form-control @error('cc_phone') is-invalid @enderror"
                                    wire:model="cc_phone">
                                @error('cc_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="cc_email" class="form-label">Card Holder's Email</label>
                                <input type="text" class="form-control @error('cc_email') is-invalid @enderror"
                                    wire:model="cc_email">
                                @error('cc_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="amount_charged" class="form-label">Total Amount Charged:</label>
                                <input class="form-control @error('amount_charged') is-invalid @enderror"
                                    wire:model="amount_charged">
                                @error('amount_charged')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="billingComments" class="form-label">Comments (If any):</label>
                                <input class="form-control @error('billingComments') is-invalid @enderror"
                                    wire:model="billingComments">
                                @error('billingComments')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="primary_passenger_id_doc" class="form-label">Primary Passenger ID</label>
                                <input type="file" id="primary_passenger_id_doc" name="primary_passenger_id_doc"
                                    class="form-control" wire:model="primary_passenger_id_doc">
                                <span class="text-danger"> @error('primary_passenger_id_doc')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                                <button type="button" class="btn w-sm btn-danger waves-effect waves-light"
                                    wire:click="previousStep">Back</button>
                                <button type="submit"
                                    class="btn w-sm btn-success waves-effect waves-light">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
