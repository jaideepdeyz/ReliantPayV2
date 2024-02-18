<div class="row mt-2">
    @if($viewOnly == 'Yes')
        <div class="mt-2 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-uppercase bg-light p-2 mt-0">Merchant Business Information (as submitted on file) </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Business Name:</th>
                                <td>{{$business_name}}</td>
                            </tr>
                            <tr>
                                <th>Business Address:</th>
                                <td>{{$business_address}}</td>
                            </tr>
                            <tr>
                                <th>Business Website:</th>
                                <td>{{$business_website}}</td>
                            </tr>
                            <tr>
                                <th>Business Email:</th>
                                <td>{{$business_email}}</td>
                            </tr>
                            <tr>
                                <th>Business Phone:</th>
                                <td>{{$business_phone}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="mt-3 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 1/5: Merchant Business Information </h5>
                    <form wire:submit.prevent="storeBusinessInfo">
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="business_name" class="form-label">Business Name <span class="text-danger"><sup>*</sup></span></label>
                                <input type="text" class="form-control @error('business_name') is-invalid @enderror"
                                    placeholder="Enter business name" wire:model="business_name">
                                @error('business_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="business_address" class="form-label">Address <span class="text-danger"><sup>*</sup></span></label>
                                <textarea class="form-control @error('business_address') is-invalid @enderror" rows="4"
                                    placeholder="Enter business address" wire:model="business_address"></textarea>
                                @error('business_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="business_website" class="form-label">Website @if(Auth::User()->role != RoleEnum::ADMIN->value) <span class="text-danger"><sup>*</sup></span> @endif</label>
                                <input type="text"
                                    class="form-control @error('business_website') is-invalid @enderror"
                                    placeholder="Enter business website" value ="{{ old('business_website') }}"
                                    wire:model="business_website" @if(Auth::User()->role != RoleEnum::ADMIN->value) required @endif >
                                @error('business_website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="business_email" class="form-label">E-Mail <span class="text-danger"><sup>*</sup></span></label>
                                <input type="text" class="form-control @error('business_email') is-invalid @enderror"
                                    placeholder="Enter business email" wire:model="business_email">
                                @error('business_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="business_phone" class="form-label">Phone <span class="text-danger"><sup>*</sup></span></label>
                                <input type="text"
                                    class="form-control  @error('business_phone') is-invalid @enderror"
                                    placeholder="Enter business phone" wire:model="business_phone">
                                @error('business_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                                <button type="submit" class="btn btn-success waves-effect waves-light">Next</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div> <!-- end card -->
        </div>
    @endif
</div>

