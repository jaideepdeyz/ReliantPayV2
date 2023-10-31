<div class="row mb-4" wire:poll.keep-alive>
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item">Agent Dashboard</li>
                    <li class="breadcrumb-item">Flight Booking</li>
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
                    Step 3/4: Add Passengers
                </h5>
                <form wire:submit="storePassenger">
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label for="full_name" class="form-label">Passenger's Name</label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                wire:model="full_name">
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control @error('gender') is-invalid @enderror" wire:model="gender">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                wire:model="dob">
                            @error('dob')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="relationship_to_card_holder" class="form-label">Relationship to Card Holder
                                ?</label>
                            <select class="form-control @error('relationship_to_card_holder') is-invalid @enderror"
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
                            @error('relationship_to_card_holder')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                            <button type="submit" class="btn w-sm btn-success waves-effect waves-danger">Add
                                Passenger</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-2">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                        Passengers Added
                    </h5>
                    <table class="table table-sm table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>DOB</th>
                                <th>Gender</th>
                                <th>Relationship</th>
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
                                    <td>{{ $passenger->relationship_to_card_holder }}</td>
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
