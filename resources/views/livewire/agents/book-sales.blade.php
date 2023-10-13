<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Book Sales</div>
            <div class="card-body">
                <form wire:submit="storeSalesForm">
                    <div class="row">
                        <div class="col-md-3 mb-3 form-group">
                            <label for="book_id">Travel Category</label>
                            <select wire:model="travel_category" class="form-control @error('travel_category') is-invalid @enderror">
                                <option selected>Select Category</option>
                                <option value="Flights">Flights</option>
                                <option value="Hotels">Hotels</option>
                                <option value="Packages">Packages</option>
                                <option value="Car Rentals">Car Rentals</option>
                                <option value="AmTrak">AmTrak</option>
                            </select>
                            @error('travel_category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3 form-group">
                            <label for="primary_passenger_phone">Primary Passenger Phone</label>
                            <input type="text" wire:model="primary_passenger_phone" class="form-control @error('primary_passenger_phone') is-invalid @enderror">
                            @error('primary_passenger_phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="primary_passenger_email">Primary Passenger Email</label>
                            <input type="text" wire:model="primary_passenger_email" class="form-control @error('primary_passenger_email') is-invalid @enderror">
                            @error('primary_passenger_email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="transport_name">Name of Carrier/Transport</label>
                            <input type="text" wire:model="transport_name" class="form-control @error('transport_name') is-invalid @enderror">
                            @error('transport_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="confirmation_number">Confirmation #</label>
                            <input type="text" wire:model="confirmation_number" class="form-control @error('confirmation_number') is-invalid @enderror">
                            @error('confirmation_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Departure & Destination Details</h5>
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="departureCountry">Departure Country</label>
                            <select wire:model.live="departureCountry" class="form-control @error('departureCountry') is-invalid @enderror">
                                <option selected>Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->code }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('departureCountry')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="departure_location">Departure Airport</label>
                            <select wire:model="departure_location" class="form-control @error('departure_location') is-invalid @enderror">
                                <option selected>Select Airport</option>
                                @foreach ($airports as $airport)
                                    <option value="{{ $airport->name }}">{{ $airport->name }}</option>
                                @endforeach
                            </select>
                            @error('departure_location')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="departure_date">Departure Date</label>
                            <input type="date" wire:model="departure_date" class="form-control @error('departure_date') is-invalid @enderror">
                            @error('departure_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="destinationCountry">Destination Country</label>
                            <select wire:model.live="destinationCountry" class="form-control @error('destinationCountry') is-invalid @enderror">
                                <option selected>Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->code }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('destinationCountry')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="destination_location">Destination Airport</label>
                            <select wire:model="destination_location" class="form-control @error('destination_location') is-invalid @enderror">
                                <option selected>Select Airport</option>
                                @foreach ($airports as $airport)
                                    <option value="{{ $airport->name }}">{{ $airport->name }}</option>
                                @endforeach
                            </select>
                            @error('destination_location')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="oneway_or_roundtrip">One Way or Round Trip ?</label>
                            <select wire:model="oneway_or_roundtrip" class="form-control @error('oneway_or_roundtrip') is-invalid @enderror">
                                <option selected>Select Trip</option>
                                <option value="One Way">One Way</option>
                                <option value="Round Trip">Round Trip</option>
                            </select>
                            @error('oneway_or_roundtrip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="return_date">Return Date</label>
                            <input type="date" wire:model="return_date" class="form-control @error('return_date') is-invalid @enderror">
                            @error('return_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Credit Card Details</h5>
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="cc_name">Credit Card Number</label>
                            <input type="text" wire:model="cc_name" class="form-control @error('cc_name') is-invalid @enderror">
                            @error('cc_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="cc_phone">Credit Card Linked Phone</label>
                            <input type="text" wire:model="cc_phone" class="form-control @error('cc_phone') is-invalid @enderror">
                            @error('cc_phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="cc_email">Credit Card Linked Email</label>
                            <input type="email" wire:model="cc_email" class="form-control @error('cc_email') is-invalid @enderror">
                            @error('cc_email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="cc_dob">Credit Card Linked Date of Birth</label>
                            <input type="date" wire:model="cc_dob" class="form-control @error('cc_dob') is-invalid @enderror">
                            @error('cc_dob')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="cc_number">Credit Card Number</label>
                            <input type="text" wire:model="cc_number" class="form-control @error('cc_number') is-invalid @enderror">
                            @error('cc_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="cc_type">Credit Card Type</label>
                            <select wire:model="cc_type" class="form-control @error('cc_type') is-invalid @enderror">
                                <option selected>Select Card Type</option>
                                <option value="Visa">Visa</option>
                                <option value="Master Card">Master Card</option>
                                <option value="American Express">American Express</option>
                                <option value="Discover">Discover</option>
                            </select>
                            @error('cc_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="cc_expiration_date">Credit Card Expiry(MM/YYYY)</label>
                            <input type="text" wire:model="cc_expiration_date" class="form-control @error('cc_expiration_date') is-invalid @enderror">
                            @error('cc_expiration_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="cc_cvc">Credit Card CVC / CVV</label>
                            <input type="text" wire:model="cc_cvc" class="form-control @error('cc_cvc') is-invalid @enderror" minlength="3" maxlength="3">
                            @error('cc_cvc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="amount_charged">Amount Charged:</label>
                            <input type="text" wire:model="amount_charged" class="form-control @error('amount_charged') is-invalid @enderror" >
                            @error('amount_charged')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="cc_billing_address">Billing Address:</label>
                            <textarea wire:model="cc_billing_address" class="form-control @error('cc_billing_address') is-invalid @enderror" minlength="3" maxlength="3"> </textarea>
                            @error('cc_billing_address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3 form-group">
                            <label for="comments">Agent Comments:</label>
                            <textarea wire:model="comments" class="form-control @error('comments') is-invalid @enderror" minlength="3" maxlength="3"> </textarea>
                            @error('comments')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <button type="submit" class="btn btn-sm btn-primary">Send Authorization Request</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>