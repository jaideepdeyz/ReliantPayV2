<div class="row mb-4" wire:poll.keep-alive>
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item">Agent Dashboard</li>
                    <li class="breadcrumb-item">{{$saleBooking->service->service_name}}</li>
                    <li class="breadcrumb-item active">Add Passenger</li>
                </ol>
            </div>
            <h4 class="page-title">Add Passenger</h4>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                    Step 3/5: Add Passengers
                </h5>
                <form wire:submit="storePassenger">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                    wire:model="full_name" placeholder="Passenger Name">
                                <label for="full_name" class="form-label">Passenger's Name</label>
                                @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('gender') is-invalid @enderror" wire:model="gender"
                                    placeholder="Gender">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <label for="gender" class="form-label">Gender</label>
                                @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="form-floating">
                                <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                    wire:model="dob" placeholder="Date of Birth">
                                <label for="dob" class="form-label">Date of Birth</label>
                                @error('dob')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="col-md-3 mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('relationship_to_card_holder') is-invalid @enderror"
                                    wire:model="relationship_to_card_holder">
                                    <option value="">Select Option</option>
                                    <option value="Card Holder">Card Holder</option>
                                    <option value="Husband">Husband</option>
                                    <option value="Wife">Wife</option>
                                    <option value="Son">Son</option>
                                    <option value="Daughter">Daughter</option>
                                    <option value="Uncle">Uncle</option>
                                    <option value="Aunt">Aunt</option>
                                    <option value="Colleague">Colleague</option>
                                </select>
                                <label for="relationship_to_card_holder" class="form-label">Relationship to Card
                                    Holder
                                    ?</label>
                                @error('relationship_to_card_holder')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="col-md-3 mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('is_disabled') is-invalid @enderror"
                                    wire:model.live="is_disabled">
                                    <option value="">Select Option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <label for="is_disabled" class="form-label">Does the passenger have any disability
                                    ?</label>
                                @error('is_disabled')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 mb-3 @if($pwdType == 0) d-none @endif">
                            <div class="form-floating">
                                <select class="form-select @error('disability_type') is-invalid @enderror"
                                    wire:model="disability_type">
                                    <option value="">Select Option</option>
                                    <option value="Blind or Vision Loss">Blind or Vision Loss</option>
                                    <option value="Deaf or Hearing Loss">Deaf or Hearing Loss</option>
                                    <option value="Reduced Mobility">Reduced Mobility</option>
                                    <option value="Needs Not Listed">Needs Not Listed</option>
                                </select>
                                <label for="disability_type" class="form-label">Disability Type
                                    ?</label>
                                @error('disability_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-5 mb-3 @if($pwdType == 0) d-none @endif">
                            <div class="form-floating">
                                <select class="form-select @error('requires_assistance') is-invalid @enderror"
                                    wire:model="requires_assistance">
                                    <option value="">Select Option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                <label for="requires_assistance" class="form-label">Passenger requires Airport/Station Assistance
                                    ?</label>
                                @error('requires_assistance')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-3 mt-3 col-md-12 action-buttons d-flex justify-content-between">
                            <button type="submit" class="btn w-sm btn-blue waves-effect waves-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                    class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                                </svg> Add Passenger</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-2">
                    <h5 class="text-uppercase p-2 mt-0 mb-2">
                        Passengers Added
                    </h5>
                    <table class="table table-sm table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                {{-- <th>Relationship</th> --}}
                                <th>Needs Assistance</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($passengers as $passenger)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $passenger->full_name }}</td>
                                <td>{{ $passenger->dob }}</td>
                                <td>{{ $passenger->gender }}</td>
                                {{-- <td>{{ $passenger->relationship_to_card_holder }}</td> --}}
                                <td>
                                    @if($passenger->requires_assistance == 'Yes')
                                        Yes
                                    @else
                                        No
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#alertModal"
                                        wire:click='selectId({{ $passenger->id }})'>Remove</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                        <button type="button" class="btn w-sm btn-danger waves-effect waves-dark"
                            wire:click="previousStep">Back</button>
                        <button type="button" class="btn w-sm btn-success waves-effect waves-light"
                            wire:click="nextStep">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="rejectionModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="dripicons-warning h1 text-warning"></i>
                    <p>Are you sure you want to remove this passenger?</p>
                    <button class="btn btn-warning text-uppercase" wire:click="deletePassenger()"
                        data-bs-dismiss="modal" type="button">Yes remove</button>
                </div>
            </div>
        </div>
    </div>
    <x-toast-livewire />
</div>
