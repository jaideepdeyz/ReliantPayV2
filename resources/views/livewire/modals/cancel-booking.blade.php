<div>
    <div class="modal-header">
        <h5 class="modal-title">Cancel Booking # {{$appID}}</h5>
        <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
    </div>
    <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-sm table-striped table-bordered">
                        <tr>
                            <th>Customer's Name:</th>
                            <td>{{$booking->customer_name}}</td>
                        </tr>
                        <tr>
                            <th>Customer's Email | Phone:</th>
                            <td>{{$booking->customer_email}} | {{$booking->customer_phone}}</td>
                        </tr>
                        <tr>
                            <th>Service:</th>
                            <td>{{$booking->sale_type}} ({{$booking->service->service_name}})</td>
                        </tr>
                        <tr>
                            <th>Confirmation Number:</th>
                            <td>{{$booking->confirmation_number}}</td>
                        </tr>
                        <tr>
                            <th>Is Ticket Issued:</th>
                            <td>
                                @if($booking->confirmation_number != null)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                @if($booking->app_status == StatusEnum::CANCELLATION_REQUESTED->value || $booking->app_status == StatusEnum::REFUND_REQUESTED->value)
                    <form wire:submit="saveCancellation" class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="receipt">Cancellation Receipt</label>
                                <input type="file" wire:model="receipt" class="form-control @error('receipt') is-invalid @enderror">
                                @error('receipt')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-dark">Upload and Confirm cancellation</button>
                        </div>
                    </form>
                @endif
                
                @switch($booking->app_status)
                    @case(StatusEnum::CANCELLATION_REQUESTED->value)
                    @case(StatusEnum::REFUND_REQUESTED->value)
                        {{-- Do nothing --}}
                        @break
                    @default
                        <div class="col-md-12">
                            <button class="btn btn-danger" wire:click="cancelBooking">Cancel Booking</button>
                        </div>
                @endswitch
                
            </div>
    </div>

</div>