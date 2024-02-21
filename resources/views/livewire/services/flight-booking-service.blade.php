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
                                Step 1/5: Details for Flight Booking {{ $airline_name }}
                            </h5>
                            <div class="row">
                                {{-- testing livewire searchable dropdown --}}

                                <div class="mb-3 col-md-12">
                                    <div class="dropdownList">
                                        <label for="airline_name" class="form-label">Airline Name <span
                                                class="text-danger"><sup>*</sup></span></label>
                                        <input type="text"
                                            class="form-input form-control @error('query') is-invalid @enderror""
                                            placeholder=" Search Airlines .." wire:model.live="query" required>
                                        @error('query')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if (count($airlines) > 0 && $query != '')
                                        <div class="dropdown-container">
                                            @foreach ($airlines as $airline)
                                            <a href="#" class="d-block dropdown-links"
                                                wire:click="setAirline('{{ $airline->name }}')">
                                                <img src="{{ $airline->logo }}" alt="logo" width="45" height="45">
                                                &nbsp;&nbsp;{{ $airline->name }}
                                            </a>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <div class="dropdownList">
                                        <label for="departure_location" class="form-label">Departure Airport <span
                                                class="text-danger"><sup>*</sup></span></label>
                                        <input type="text"
                                            class="form-input form-control @error('departureQuery') is-invalid @enderror"
                                            placeholder="Search by Departure Airport Code"
                                            wire:model.live="departureQuery" required>
                                        @error('departureQuery')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if (count($departureAirports) > 0 && $departureQuery != '')
                                        <div class="dropdown-container">
                                            @foreach ($departureAirports as $depAirport)
                                            <a href="#" class="d-block dropdown-links"
                                                wire:click="setDepartureAirport('{{ $depAirport->id }}')">
                                                <span class="country-code">{{ $depAirport->code }}</span>
                                                &nbsp;&nbsp;{{ $depAirport->name }}
                                            </a>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 col-md-4">
                                    <div class="dropdownList">
                                        <label for="destination_location" class="form-label">Destination Airport <span
                                                class="text-danger"><sup>*</sup></span></label>
                                        <input type="text"
                                            class="form-input form-control @error('destinationQuery') is-invalid @enderror"
                                            placeholder="Search by Destination Airport Code"
                                            wire:model.live="destinationQuery" required>
                                        @error('destinationQuery')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if (count($destinationAirports) > 0 && $destinationQuery != '')
                                        <div class="dropdown-container">
                                            @foreach ($destinationAirports as $destAirport)
                                            <a href="#" class="d-block dropdown-links"
                                                wire:click="setDestinationAirport('{{ $destAirport->id }}')">
                                                <span class="country-code">{{ $destAirport->code }}</span>
                                                &nbsp;&nbsp;{{ $destAirport->name }}
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
                                                    class="form-control @error('departureHour') is-invalid @enderror"
                                                    placeholder="00" data-toggle="input-mask" data-mask-format="00"
                                                    maxlength="2" minlength="2">
                                                <span class="input-group-text" id="basic-addon1">HH</span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" wire:model="departureMinute"
                                                    class="form-control @error('departureMinute') is-invalid @enderror"
                                                    placeholder="00" data-toggle="input-mask" data-mask-format="00"
                                                    maxlength="2" minlength="2">
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
                                                    class="form-control @error('departureETAHour') is-invalid @enderror"
                                                    placeholder="00" data-toggle="input-mask" data-mask-format="00"
                                                    maxlength="2" minlength="2">
                                                <span class="input-group-text" id="basic-addon1">HH</span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" wire:model="departureETAMinute"
                                                    class="form-control @error('departureETAMinute') is-invalid @enderror"
                                                    placeholder="00" data-toggle="input-mask" data-mask-format="00"
                                                    maxlength="2" minlength="2">
                                                <span class="input-group-text" id="basic-addon1">MM</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Departure Block End --}}

                                {{-- Return block --}}
                                <div class="row  @if ($isRoundTrip == 'No') d-none @endif">
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
                                                        class="form-control @error('returnHour') is-invalid @enderror"
                                                        placeholder="00" data-toggle="input-mask" data-mask-format="00"
                                                        maxlength="2" minlength="2">
                                                    <span class="input-group-text" id="basic-addon1">HH</span>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="text" wire:model="returnMinute"
                                                        class="form-control @error('returnMinute') is-invalid @enderror"
                                                        placeholder="00" data-toggle="input-mask" data-mask-format="00"
                                                        maxlength="2" minlength="2">
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
                                                        class="form-control @error('$returnETAHour') is-invalid @enderror"
                                                        placeholder="00" data-toggle="input-mask" data-mask-format="00"
                                                        maxlength="2" minlength="2">
                                                    <span class="input-group-text" id="basic-addon1">HH</span>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="text" wire:model="returnETAMinute"
                                                        class="form-control @error('returnETAMinute') is-invalid @enderror"
                                                        placeholder="00" data-toggle="input-mask" data-mask-format="00"
                                                        maxlength="2" minlength="2">
                                                    <span class="input-group-text" id="basic-addon1">MM</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

                                @if($saleType == 'Cancellation')
                                    <div class="mb-3 col-md-4">
                                        <label for="confirmation_number" class="form-label">Confirmation Number <span class="text-danger"><sup>*</sup></span></label>
                                        <input class="form-control @error('is-invalid') confirmation_number @enderror"
                                            wire:model="confirmation_number">
                                        @error('confirmation_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="transport_number" class="form-label">Train Number <span class="text-danger"><sup>*</sup></span></label>
                                        <input class="form-control @error('is-invalid') transport_number @enderror"
                                            wire:model="transport_number">
                                        @error('transport_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="travel_class" class="form-label">Travel Class <span class="text-danger"><sup>*</sup></span></label>
                                        <input class="form-control @error('is-invalid') travel_class @enderror"
                                            wire:model="travel_class">
                                        @error('travel_class')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @else
                                    {{-- itenary_screenshot section  --}}
                                    <div class="mb-3 col-md-12" style="position:relative"
                                        x-data="{ uploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="uploading = true"
                                        x-on:livewire-upload-finish="uploading = false"
                                        x-on:livewire-upload-error="uploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <label for="itenary_screenshot" class="form-label">Screenshot of Travel Itenary
                                            (jpg, png)
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
                                @endif

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