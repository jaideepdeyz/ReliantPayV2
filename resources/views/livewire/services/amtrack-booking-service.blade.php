<div class="row mb-5">
    <!-- start page title -->
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item">Agent Dashboard</li>
                    <li class="breadcrumb-item active">AMTRAK Booking</li>
                </ol>
            </div>
            <h4 class="page-title">AMTRAK Booking</h4>
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
                                Step 2/5: Details for AmTRAK Booking
                            </h5>
                            <div class="row">
                                {{-- testing livewire searchable dropdown --}}

                                <div class="mb-3 col-md-4">
                                    <div class="dropdownList">
                                        <label for="departure_location" class="form-label">Departure Station <span class="text-danger"><sup>*</sup></span></label>
                                        <input type="text" class="form-input form-control @error('departureQuery') is-invalid @enderror"
                                            placeholder="Search By Station Code" wire:model.live="departureQuery" required>
                                        @error('departureQuery')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if (count($departureStations) > 0)
                                        <div class="dropdown-container pt-2">
                                            @foreach ($departureStations as $departureStation)
                                            <a href="#" class="d-block dropdown-links"
                                                wire:click="setDepartureStation('{{ $departureStation->id }}')">
                                                <span class="country-code">{{ $departureStation->station_code }}</span>
                                                &nbsp;&nbsp;{{ $departureStation->station_location }}
                                            </a>
                                            @endforeach
                                        </div>
                                        @endif
                                        
                                    </div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <div class="dropdownList">
                                        <label for="destination_location" class="form-label">Destination Station <span
                                                class="text-danger"><sup>*</sup></span></label>
                                        <input type="text" class="form-input form-control @error('destinationQuery') is-invalid @enderror"
                                            placeholder="Search Stations .." wire:model.live="destinationQuery"
                                            required>
                                        @error('destinationQuery')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if (count($destinationStations) > 0)
                                        <div class="dropdown-container pt-2">
                                            @foreach ($destinationStations as $destinationStation)
                                            <a href="#" class="d-block dropdown-links"
                                                wire:click="setDestinationStation('{{ $destinationStation->id }}')">
                                                <span class="country-code">{{ $destinationStation->station_code }}</span>
                                                &nbsp;&nbsp;{{ $destinationStation->station_location }}
                                            </a>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- testing end --}}

                                <div class="mb-3 col-md-4">
                                    <label for="tripType" class="form-label">One Way or Round Trip ? <span
                                            class="text-danger"><sup>*</sup></span></label>
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


                                {{-- Departure Block --}}
                                <div class="mb-3 col-md-2">
                                    <label for="departure_date" class="form-label">Departure Date <span
                                            class="text-danger"><sup>*</sup></span></label>
                                    <input type="date"
                                        class="form-control @error('departure_date') is-invalid @enderror"
                                        wire:model="departure_date">
                                    @error('departure_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4 form-group">
                                    <label for="departure_time" class="form-label">Departure Time <span
                                            class="text-danger"><sup>*</sup></span></label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" wire:model="departureHour"
                                                    class="form-control @error('departureHour') is-invalid @enderror" placeholder="HH" minlength="2" maxlength="2">
                                                <span class="input-group-text" id="basic-addon1">HH</span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" wire:model="departureMinute"
                                                    class="form-control @error('departureMinute') is-invalid @enderror" placeholder="MM" minlength="2" maxlength="2">
                                                <span class="input-group-text" id="basic-addon1">MM</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-2">
                                    <label for="departure_eta_date" class="form-label">Arrival Date <span
                                            class="text-danger"><sup>*</sup></span></label>
                                    <input type="date"
                                        class="form-control @error('departure_eta_date') is-invalid @enderror"
                                        wire:model="departure_eta_date">
                                    @error('departure_eta_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-3 col-md-4 form-group">
                                    <label for="departure_time" class="form-label">Arrival Time<span
                                            class="text-danger"><sup>*</sup></span></label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" wire:model="departureETAHour"
                                                    class="form-control @error('departureETAHour') is-invalid @enderror" placeholder="HH" minlength="2" maxlength="2">
                                                <span class="input-group-text" id="basic-addon1">HH</span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" wire:model="departureETAMinute"
                                                    class="form-control @error('departureETAMinute') is-invalid @enderror" placeholder="MM" minlength="2" maxlength="2">
                                                <span class="input-group-text" id="basic-addon1">MM</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Departure Block End  --}}

                                {{-- Return block  --}}
                                <div class="row  @if($isRoundTrip == 'No') d-none @endif">
                                    <div class="mb-3 col-md-2">
                                        <label for="return_date" class="form-label">Return Date <span
                                                class="text-danger"><sup>*</sup></span></label>
                                        <input type="date"
                                            class="form-control @error('return_date') is-invalid @enderror"
                                            wire:model="return_date" @if ($isRoundTrip=='Yes' ) required @endif>
                                        @error('return_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-4 form-group">
                                        <label for="return_time" class="form-label">Return Time <span
                                                class="text-danger"><sup>*</sup></span></label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="text" wire:model="returnHour"
                                                        class="form-control @error('returnHour') is-invalid @enderror" placeholder="HH" minlength="2" maxlength="2">
                                                    <span class="input-group-text" id="basic-addon1">HH</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="text" wire:model="returnMinute"
                                                        class="form-control @error('returnMinute') is-invalid @enderror" placeholder="MM" minlength="2" maxlength="2">
                                                    <span class="input-group-text" id="basic-addon1">MM</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-2">
                                        <label for="return_eta_date" class="form-label">Return Date <span
                                                class="text-danger"><sup>*</sup></span></label>
                                        <input type="date"
                                            class="form-control @error('return_eta_date') is-invalid @enderror"
                                            wire:model="return_eta_date">
                                        @error('return_eta_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-4 form-group">
                                        <label for="departure_time" class="form-label">Return Time
                                            <span class="text-danger"><sup>*</sup></span></label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="text" wire:model="returnETAHour"
                                                        class="form-control @error('$returnETAHour') is-invalid @enderror" placeholder="HH" minlength="2" maxlength="2">
                                                    <span class="input-group-text" id="basic-addon1">HH</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="text" wire:model="returnETAMinute"
                                                        class="form-control @error('returnETAMinute') is-invalid @enderror" placeholder="MM" minlength="2" maxlength="2">
                                                    <span class="input-group-text" id="basic-addon1">MM</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{-- <div class="mb-3 col-md-6">
                                    <label for="confirmation_number" class="form-label">Confirmation #</label>
                                    <input class="form-control @error('confirmation_number') is-invalid @enderror"
                                        wire:model="confirmation_number">
                                    @error('confirmation_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div> --}}

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


                                <div class="mb-3 col-md-12" style="position:relative"
                                    x-data="{ uploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="uploading = true"
                                    x-on:livewire-upload-finish="uploading = false"
                                    x-on:livewire-upload-error="uploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <label for="itenary_screenshot" class="form-label">Screenshot of Travel Itenary
                                        <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="file"
                                        class="form-control @error('itenary_screenshot') is-invalid @enderror"
                                        wire:model="itenary_screenshot">
                                    <span class="text-danger"> @error('itenary_screenshot')
                                        {{ $message }}
                                        @enderror </span>
                                    <div class="mt-1" x-show="uploading"
                                        style="position:absolute;bottom:-19px;width:96%">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
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
