<div class="row mb-4" wire:poll.keep-alive>
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item">Agent Dashboard</li>
                    <li class="breadcrumb-item">{{$saleBooking->service->service_name}}</li>
                    <li class="breadcrumb-item active">Billing Details </li>
                </ol>
            </div>
            <h4 class="page-title">Add Details of Billing/Charges</h4>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                    Step 4/5: Add Details of Billing/Charges
                </h5>
                <form wire:submit="storeCharge">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('charge_type') is-invalid @enderror"
                                    wire:model="charge_type" placeholder="Charge/Bill Type">
                                <label for="charge_type" class="form-label">Charge/Bill Type</label>
                                @error('charge_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                    wire:model="amount" placeholder="Amount Charged">
                                <label for="amount" class="form-label">Amount Charged (in USD)</label>
                                @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body bg-success text-center">
                                    <p class="text-white">Total Charges</p>
                                    <h5 class="text-white">$ {{ $totalCharges }} </h5>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 mt-3 col-md-12 action-buttons d-flex justify-content-between">
                            <button type="submit" class="btn w-sm btn-blue waves-effect waves-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                    class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                                </svg> Add Charges </button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-2">
                    <h5 class="text-uppercase p-2 mt-0 mb-2">
                        Charges Added
                    </h5>
                    <table class="table table-sm table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($charges as $charge)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $charge->charge_type }}</td>
                                <td>$ {{ $charge->amount }}</td>
                                <td>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#alertModal"
                                        wire:click='selectId({{ $charge->id }})'>Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                        <button type="button" class="btn btn-danger waves-effect waves-dark"
                            wire:click="previousStep">Back</button>
                        <button type="button" class="btn btn-success waves-effect waves-light"
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
                    <p>Are you sure you want to remove this charge?</p>
                    <button class="btn btn-warning text-uppercase" wire:click="deleteCharge()"
                        data-bs-dismiss="modal" type="button">Yes remove</button>
                </div>
            </div>
        </div>
    </div>
    <x-toast-livewire />
</div>
