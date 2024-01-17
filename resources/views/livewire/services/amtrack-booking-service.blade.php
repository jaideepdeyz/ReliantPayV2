<div class="row mb-5">
    <!-- start page title -->
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item">Agent Dashboard</li>
                    <li class="breadcrumb-item active">Amtrak Booking</li>
                </ol>
            </div>
            <h4 class="page-title">Amtrak Booking</h4>
        </div>
    </div>
    <!-- end page title -->

    <div class="col-md-12">
        <form wire:submit="storeAmtrakBooking">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                                Step 2/5: Details for Amtrak Booking
                            </h5>
                            <div class="row">

                                {{-- testing livewire searchable dropdown --}}


                                <div class="mb-3 col-md-6">
                                    <div class="dropdownList">
                                        <label for="departure_location" class="form-label">Departure Station</label>
                                        <input type="text" class="form-input form-control"
                                            placeholder="Search Stations .." wire:model.live="departureQuery" required>
                                        @if($departureStations)
                                        <div class="dropdown-container">
                                            @foreach($departureStations as $depStation)
                                            <a href="#" class="d-block dropdown-links"
                                                wire:click="setDepartureStation('{{$depStation->id}}')">
                                                <span class="country-code">{{$depStation->station_code}}</span>
                                                &nbsp;&nbsp;{{$depStation->station_location}}
                                            </a>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="dropdownList">
                                        <label for="destination_location" class="form-label">Destination Station</label>
                                        <input type="text" class="form-input form-control"
                                            placeholder="Search Stations .." wire:model.live="destinationQuery"
                                            required>
                                        @if($destinationStations)
                                        <div class="dropdown-container">
                                            @foreach($destinationStations as $destStation)
                                            <a href="#" class="d-block dropdown-links"
                                                wire:click="setDestinationStation('{{$destStation->id}}')">
                                                <span class="country-code">{{$destStation->station_code}}</span>
                                                &nbsp;&nbsp;{{$destStation->station_location}}
                                            </a>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- testing end --}}




                                {{-- <div class="mb-3 col-md-6">
                                    <label for="destination_location" class="form-label">Destination Aiport</label>
                                    <input type="text" wire:model="destinationAirport" class="form-control"
                                        wire:click="getDestinationAirports" readonly style="cursor: pointer;">
                                    @error('destination_location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div> --}}

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

                                {{-- <div class="mb-3 col-md-6">
                                    <label for="confirmation_number" class="form-label">Confirmation #</label>
                                    <input class="form-control @error('confirmation_number') is-invalid @enderror"
                                        wire:model="confirmation_number">
                                    @error('confirmation_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div> --}}


                                <div class="mb-3 col-md-2">
                                    <label for="departure_date" class="form-label">Departure Date</label>
                                    <input type="date"
                                        class="form-control @error('departure_date') is-invalid @enderror"
                                        wire:model="departure_date">
                                    @error('departure_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4 form-group">
                                    <label for="departure_time" class="form-label">Departure Time</label>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select wire:model="departureHour"
                                                class="form-control @error('departureHour') is-invalid @enderror">
                                                <option value="">HH</option>
                                                @for ($i = 1; $i <= 24; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select wire:model="departureMinute"
                                                class="form-control @error('departureMinute') is-invalid @enderror">
                                                <option value="">MM</option>
                                                @for ($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-4 @if ($isRoundTrip == 'No') d-none @endif">
                                    <label for="return_date" class="form-label">Return Date</label>
                                    <input type="date" class="form-control @error('return_date') is-invalid @enderror"
                                        wire:model="return_date" @if ($isRoundTrip=='Yes' ) required @endif>
                                    @error('return_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <div class="mb-3 col-md-4">
                                    <label for="no_days_hotel_car" class="form-label">No. of days (Hotel / Car)</label>
                                    <input type="text"
                                        class="form-control @error('no_days_hotel_car') is-invalid @enderror"
                                        wire:model="no_days_hotel_car" placeholder="No. of days for Hotels or Cars">
                                    @error('no_days_hotel_car')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div> --}}

                                <div class="mb-3 col-md-12">
                                    <label for="comments" class="form-label">Comments</label>
                                    <textarea type="text" class="form-control @error('comments') is-invalid @enderror"
                                        wire:model="comments" col=20 row=20></textarea>
                                    @error('comments')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                                    <button type="submit"
                                        class="btn w-sm btn-success waves-effect waves-light px-4 py-2">Next</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>




</div>