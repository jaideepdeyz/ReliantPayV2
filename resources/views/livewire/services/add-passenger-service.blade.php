<div class="row">
    <div class="col-md-12">
        <form wire:submit="storePassenger">
            <div class="row">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                                Step 3/4: Add Passengers
                            </h5>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="full_name" class="form-label">Passenger's Name</label>
                                    <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                        wire:model="full_name">
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="gender" class="form-label">Departure Country</label>
                                    <select class="form-control @error('gender') is-invalid @enderror"
                                        wire:model="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                        wire:model="dob">
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="relationship_to_card_holder" class="form-label">Relationship to Card Holder ?</label>
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
                                    <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Add Passenger</button>
                                </div>

                            </div>
                        </div>
                    </form>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                                Psassenger Details
                            </h5>
                            <span><button class="btn btn-sm btn-dark">Booking Info</button></span>
                            <div class="table-responsive mt-2">
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
                                       @foreach($passengers as $passenger)
                                       <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$passenger->full_name}}</td>
                                            <td>{{$passenger->dob}}</td>
                                            <td>{{$passenger->gender}}</td>
                                            <td>{{$passenger->relationship_to_card_holder}}</td>
                                            <td>
                                                <button class="btn btn-sm btn-danger" wire:click="deletePassenger({{$passenger->id}})">Delete</button>
                                            </td>
                                       </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
