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

                <div class="col-md-12">
                    <button class="btn btn-danger" wire:click="cancelBooking">Cancel Booking</button>
                </div>
            </div>
    </div>

</div>