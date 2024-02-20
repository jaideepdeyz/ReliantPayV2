<div class="row mb-4" wire:poll.keep-alive>
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item">Agent Dashboard</li>
                    <li class="breadcrumb-item">{{$saleBooking->service->service_name}}</li>
                    <li class="breadcrumb-item active">Transaction Details </li>
                </ol>
            </div>
            <h4 class="page-title">Add Details of Transactional Charges</h4>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                    Step 3/5: Add Details of Billing/Charges for Internal Purposes
                </h5>
                <form wire:submit="save">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="mco_amount" class="form-label">MCO (Mean Commission Over) Amount <span class="text-danger"><sup>*</sup></span></label>
                            <input type="text" class="form-control @error('is-invalid') mco_amount @enderror" wire:model="mco_amount">
                            @error('mco_amount') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="ticket_amount" class="form-label">Ticket Cost <span class="text-danger"><sup>*</sup></span></label>
                            <input type="text" class="form-control @error('is-invalid') ticket_amount @enderror" wire:model="ticket_amount">
                            @error('ticket_amount') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3 mt-3 col-md-4 action-buttons d-flex justify-content-between">
                            <button type="submit" class="btn w-sm btn-blue waves-effect waves-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                    class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                                </svg> Save | Update Transaction Details</button>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="table-responsive mt-2">
                                <h5 class="text-uppercase p-2 mt-0 mb-2">
                                    Transaction Details
                                </h5>
                                <table class="table table-sm table-striped">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Booking ID</th>
                                            <th>MCO Amount</th>
                                            <th>Ticket Cost</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($transactionDetails)
                                        <tr>
                                            <td>{{ $transactionDetails->sale_booking_id }}</td>
                                            <td>{{ $transactionDetails->mco_amount }}</td>
                                            <td>{{ $transactionDetails->ticket_amount }}</td>
                                            <td>{{ $transactionDetails->total_amount }}</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="4" class="text-center">No Transaction Details Found</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                            <button type="button" class="btn btn-danger waves-effect waves-dark"
                                wire:click="previousStep">Back</button>
                            <button type="button" class="btn btn-success waves-effect waves-light"
                                wire:click="nextStep">Next</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-toast-livewire />
</div>
