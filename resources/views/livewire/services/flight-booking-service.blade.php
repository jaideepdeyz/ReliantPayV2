<div class="row mb-5">
    <!-- start page title -->
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item">Agent Dashboard</li>
                    <li class="breadcrumb-item active">Flight Booking</li>
                </ol>
            </div>
            <h4 class="page-title">Flight Booking</h4>
        </div>
    </div>
    <!-- end page title -->

    <div class="col-md-12">
        <form wire:submit="storeFlightBooking">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                                Step 2/5: Details for Flight Booking
                            </h5>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="airline_name" class="form-label">Airline Name</label>
                                    <input type="text"
                                        class="form-control @error('airline_name') is-invalid @enderror"
                                        wire:model="airline_name">
                                    @error('airline_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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
                                    <label for="tripType" class="form-label">One Way or Round Trip ?</label>
                                    <select class="form-control @error('tripType') is-invalid @enderror"
                                        wire:model.live="tripType" required>
                                        <option value="">Select Option</option>
                                        <option value="One Way">One Way</option>
                                        <option value="Round Trip">Round Trip</option>
                                    </select>
                                    @error('tripType')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="confirmation_number" class="form-label">Confirmation #</label>
                                    <input class="form-control @error('confirmation_number') is-invalid @enderror"
                                        wire:model="confirmation_number">
                                    @error('confirmation_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-3 col-md-4">
                                    <label for="departure_date" class="form-label">Departure Date</label>
                                    <input type="date"
                                        class="form-control @error('departure_date') is-invalid @enderror"
                                        wire:model="departure_date">
                                    @error('departure_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4 @if ($isRoundTrip == 'No') d-none @endif">
                                    <label for="return_date" class="form-label">Return Date</label>
                                    <input type="date"
                                        class="form-control @error('return_date') is-invalid @enderror"
                                        wire:model="return_date" @if ($isRoundTrip == 'Yes') required @endif>
                                    @error('return_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="no_days_hotel_car" class="form-label">No. of days (Hotel / Car)</label>
                                    <input type="text"
                                        class="form-control @error('no_days_hotel_car') is-invalid @enderror"
                                        wire:model="no_days_hotel_car" placeholder="No. of days for Hotels or Cars">
                                    @error('no_days_hotel_car')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="comments" class="form-label">Comments</label>
                                    <textarea type="text" class="form-control @error('comments') is-invalid @enderror" wire:model="comments" col=20
                                        row=20></textarea>
                                    @error('comments')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                                    <button type="submit"
                                        class="btn w-sm btn-success waves-effect waves-light">Next</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
