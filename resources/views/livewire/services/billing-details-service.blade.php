<div class="row mb-3">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item">Agent Dashboard</li>
                    <li class="breadcrumb-item">{{ $saleBooking->service->service_name }}</li>
                    <li class="breadcrumb-item active">Billing Details</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <form wire:submit="saveBillingDetails">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                            Step 5/5: Billing Details
                        </h5>
                        <div class="row">

                            <div class="mb-3 col-md-4">
                                <label for="cc_type" class="form-label">Debit/Credit Card Type? <span
                                        class="text-danger"><sup>*</sup></span></label>
                                <select class="form-control @error('cc_type') is-invalid @enderror"
                                    wire:model.live="cc_type">
                                    <option value="Mastercard" selected>Mastercard</option>
                                    <option value="VISA">VISA</option>
                                    <option value="American Express">American Express</option>
                                    <option value="Discover">Discover</option>

                                </select>
                                @error('cc_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="cc_number" class="form-label">Credit Card Number <span
                                        class="text-danger"><sup>*</sup></span></label>

                                <input type="text" id="cc_number" {{-- data-toggle="input-mask"
                                data-mask-format={{ $maskFormat}}
                                placeholder={{ $maskFormat}} --}}
                                    placeholder={{ $maskFormat }}
                                    class="form-control @error('cc_number') is-invalid @enderror"
                                    wire:model.live="cc_number">


                                @error('cc_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-2">
                                <label for="cc_expiration_date" class="form-label">Card Expiry Date <span
                                        class="text-danger"><sup>*</sup></span></label>
                                <input type="text" data-toggle="input-mask" data-mask-format="00/00"
                                    class="form-control @error('cc_expiration_date') is-invalid @enderror"
                                    wire:model="cc_expiration_date" placeholder="MM/YY">
                                @error('cc_expiration_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="mb-3 col-md-2">
                                <label for="cc_cvc" class="form-label">CVV: <span
                                        class="text-danger"><sup>*</sup></span></label>
                                <input type="text" class="form-control @error('cc_cvc') is-invalid @enderror"
                                    wire:model="cc_cvc" minlength="3" maxlength="3">
                                @error('cc_cvc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-3">
                                <label for="cc_billing_address_street">Street Address:</label>
                                <input type="text"
                                    class="form-control @error('cc_billing_address_street') is-invalid @enderror mt-1"
                                    wire:model="cc_billing_address_street">
                                @error('cc_billing_address_street')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-3">
                                <div class="dropdownList">
                                    <label for="destination_location" class="form-label">City <span
                                            class="text-danger"><sup>*</sup></span></label>
                                    {{-- <input type="text" class="form-input form-control @error('cityQuery') is-invalid @enderror"
                                        placeholder="Search Cities .." wire:model.live="cityQuery"
                                        required> --}}
                                    <input type="text"
                                        class="form-input form-control @error('cityQuery') is-invalid @enderror"
                                        placeholder="Enter City" wire:model="cc_billing_address_city" required>
                                    {{-- @if ($cities)
                                    <div class="dropdown-container">
                                        @foreach ($cities as $selectedCity)
                                        <a href="#" class="d-block dropdown-links"
                                            wire:click="setCity('{{ $selectedCity->id }}')">
                                           {{ $selectedCity->city }}
                                        </a>
                                        @endforeach
                                    </div>
                                    @endif --}}
                                    @error('cc_billing_address_city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-3">
                                <div class="dropdownList">
                                    <label for="destination_location" class="form-label">State <span
                                            class="text-danger"><sup>*</sup></span></label>
                                    {{-- <input type="text" class="form-input form-control @error('stateQuery') is-invalid @enderror"
                                        placeholder="Search States .." wire:model.live="stateQuery"
                                        required> --}}
                                    <input type="text"
                                        class="form-input form-control @error('stateQuery') is-invalid @enderror"
                                        placeholder="Enter State" wire:model="cc_billing_address_state" required>
                                    {{-- @if ($states)
                                    <div class="dropdown-container">
                                        @foreach ($states as $state)
                                        <a href="#" class="d-block dropdown-links"
                                            wire:click="setState('{{ $state->id }}')">
                                            <span class="country-code">{{ $state->state_code }}</span>
                                            &nbsp;&nbsp;{{ $state->state_name }}
                                        </a>
                                        @endforeach
                                    </div>
                                    @endif --}}
                                    @error('cc_billing_address_state')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 col-md-3">
                                <label for="cc_billing_address_zip" class="form-label">ZIP Code <span
                                        class="text-danger"><sup>*</sup></span></label>
                                <input type="text"
                                    class="form-control @error('cc_billing_address_zip') is-invalid @enderror"
                                    wire:model="cc_billing_address_zip" minlength="5" maxlength="5">
                                @error('cc_billing_address_zip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="cc_name" class="form-label">Card Holder's Name <span
                                        class="text-danger"><sup>*</sup></span></label>
                                <input type="text" class="form-control @error('cc_name') is-invalid @enderror"
                                    wire:model="cc_name">
                                @error('cc_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="cc_dob" class="form-label">Card Holder's Date of Birth <span
                                        class="text-danger"><sup>*</sup></span></label>
                                <input type="date" class="form-control @error('cc_dob') is-invalid @enderror"
                                    wire:model="cc_dob">
                                @error('cc_dob')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="cc_phone" class="form-label">Card Holder's Phone <span
                                        class="text-danger"><sup>*</sup></span></label>
                                <input type="text" class="form-control @error('cc_phone') is-invalid @enderror"
                                    wire:model="cc_phone" minlength="10" maxlength="10"
                                    placeholder="Enter 10 digit mobile number">
                                @error('cc_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="cc_email" class="form-label">Card Holder's Email <span
                                        class="text-danger"><sup>*</sup></span></label>
                                <input type="text" class="form-control @error('cc_email') is-invalid @enderror"
                                    wire:model="cc_email">
                                @error('cc_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="amount_charged" class="form-label">Total Amount Charged (in USD): <span
                                        class="text-danger"><sup>*</sup></span></label>
                                <input class="form-control @error('amount_charged') is-invalid @enderror"
                                    wire:model="amount_charged" readonly>
                                @error('amount_charged')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="bookedThroughReservationAssistance" class="form-label">Ticket booked
                                    through Reservation Assistance ?:</label>
                                <select
                                    class="form-control @error('bookedThroughReservationAssistance') is-invalid @enderror"
                                    wire:model="bookedThroughReservationAssistance">
                                    <option value="">Select Option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                @error('bookedThroughReservationAssistance')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="billingComments" class="form-label">Comments (If any):</label>
                                <input class="form-control @error('billingComments') is-invalid @enderror"
                                    wire:model="billingComments">
                                @error('billingComments')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6 @if ($showIdUpload == 'No') d-none @endif">
                                <label for="primary_passenger_id_doc" class="form-label">Primary Passenger ID <span
                                        class="text-danger">(mandatory for transactions above $500) <sup>*</sup></span>
                                </label>
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
    <script>
        window.addEventListener('maskChange', event => {
           

            $('#cc_number').mask(event.detail[0]['mask']);

            $('#cc_number').attr('minlength', event.detail[0]['cc_length']);
            $('#cc_number').attr('maxlength', event.detail[0]['cc_length']);
            


        });
    </script>
</div>
