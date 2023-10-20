<div class="row">
    <div class="col-md-12">
        <form wire:submit="storeSaleBooking">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                                Step 2/5: Details for Flight Booking
                            </h5>
                            <span class="float-right bg-dark text-white p-2">Sale ID: {{$appID}}</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="departureCountry" class="form-label">Departure Country</label>
                                    <select class="form-control @error('departureCountry') is-invalid @enderror"
                                        wire:model.live="departureCountry">
                                        <option value="">Select Departure Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->code }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('departureCountry')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="departure_location" class="form-label">Departure Aiport</label>
                                    <select class="form-control @error('departure_location') is-invalid @enderror"
                                        wire:model="departure_location">
                                        <option value="">Select Departure Airport</option>
                                        @foreach ($airports as $airport)
                                            <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('departure_location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="destinationCountry" class="form-label">Destination Country</label>
                                    <select class="form-control @error('destinationCountry') is-invalid @enderror"
                                        wire:model.live="destinationCountry">
                                        <option value="">Select Destination Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->code }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('destinationCountry')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="destination_location" class="form-label">Destination Aiport</label>
                                    <select class="form-control @error('destination_location') is-invalid @enderror"
                                        wire:model="destination_location">
                                        <option value="">Select Destination Airport</option>
                                        @foreach ($destinationAirports as $airport)
                                            <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('destination_location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="oneway_or_roundtrip" class="form-label">One Way or Round Trip ?</label>
                                    <select class="form-control @error('oneway_or_roundtrip') is-invalid @enderror"
                                        wire:model="oneway_or_roundtrip">
                                        <option value="">Select Option</option>
                                        <option value="One Way">One Way</option>
                                        <option value="Round Trip">Round Trip</option>
                                    </select>
                                    @error('oneway_or_roundtrip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                
                                <div class="mb-3 col-md-4">
                                    <label for="departure_date" class="form-label">Departure Date</label>
                                    <input type="date" class="form-control @error('departure_date') is-invalid @enderror"
                                        wire:model="departure_date">
                                    @error('departure_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="return_date" class="form-label">Return Date</label>
                                    <input type="date" class="form-control @error('return_date') is-invalid @enderror"
                                        wire:model="return_date">
                                    @error('return_date')
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
