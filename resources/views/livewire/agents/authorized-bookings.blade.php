<div class="row" x:data=''>
    <!-- start page title -->
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item active">Agent Dashboard</li>
                    <li class="breadcrumb-item active">Sales Listing</li>
                </ol>
            </div>
            <h4 class="page-title">Agent Dashboard</h4>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="d-inline header-title mb-0">Sales Listing</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-9">
                        <div class="form-floating">
                            <input wire:model.live.debounce.800ms="search" class="form-control">
                            <label for="">Search by Name, Email or Phone</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select wire:model.live.debounce.800ms="statusSearch" class="form-select">
                                <option value="" class="select">Select Status</option>
                                {{-- <option value="{{StatusEnum::DRAFT->value}}">{{StatusEnum::DRAFT->value}}</option>
                                <option value="{{StatusEnum::PENDING->value}}">{{StatusEnum::PENDING->value}}</option> --}}
                                <option value="{{StatusEnum::SENT_FOR_AUTH->value}}">{{StatusEnum::SENT_FOR_AUTH->value}}</option>
                                <option value="{{StatusEnum::AUTHORIZED->value}}">{{StatusEnum::AUTHORIZED->value}}</option>
                                <option value="{{StatusEnum::PAYMENT_DONE->value}}">{{StatusEnum::PAYMENT_DONE->value}}</option>
                            </select>
                            <label for="">Search by Status</label>
                        </div>
                    </div>

                </div>

                {{-- <div class="table-responsive"> --}}
                    <table class="table table-striped table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Sale ID</th>
                                <th>Booking Date</th>
                                <th>Service</th>
                                <th>Customer's Name</th>
                                <th>Customer's Phone</th>
                                <th>Customer's Email</th>
                                <th>Service Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ Carbon\Carbon::parse($booking->created_at)->format('F j, Y') }}</td>
                                <td>{{ $booking->service->service_name }}</td>
                                <td>{{ $booking->customer->customer_name }}</td>
                                <td>{{ $booking->customer_phone }}</td>
                                <td>{{ $booking->customer->customer_email }}</td>
                                <td>
                                    @if ($booking->app_status == StatusEnum::AUTHORIZED->value)
                                    <span class="badge badge-outline-info">Authorized</span>
                                    @elseif($booking->app_status == StatusEnum::SENT_FOR_AUTH->value)
                                    <span class="badge badge-outline-warning">{{ StatusEnum::SENT_FOR_AUTH->value
                                    }}</span>
                                    @elseif($booking->app_status == StatusEnum::PAYMENT_DONE->value)
                                    <span class="badge badge-outline-success">{{ StatusEnum::PAYMENT_DONE->value
                                    }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <a href="javascript: void(0);"
                                            class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="mdi mdi-dots-horizontal"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            @if ($booking->app_status == StatusEnum::AUTHORIZED->value)
                                            <a class="dropdown-item"
                                            href={{ route('payment.stepOnePay', $booking->id) }}"><i
                                                    class="mdi mdi-currency-usd me-2 text-danger vertical-middle"></i>Charge Card</a>
                                            @endif
                                            @if ($booking->app_status == StatusEnum::PAYMENT_DONE->value || $booking->app_status == StatusEnum::SENT_FOR_AUTH->value)
                                                @switch($booking->service->service_name)
                                                    @case('Flight Booking')
                                                    <a class="dropdown-item"
                                                        href="{{ route('airlineBooking.show', $booking->id) }}"><i
                                                            class="mdi mdi-eye me-2 text-success vertical-middle"></i>View</a>
                                                    @break
                                                    @case('AMTRAK Booking')
                                                    <a class="dropdown-item"
                                                        href="{{ route('amtrakBookingDetails.show', $booking->id) }}"><i
                                                            class="mdi mdi-eye me-2 text-success vertical-middle"></i>View</a>
                                                    @break
                                                    @default
                                                @endswitch
                                                <a class="dropdown-item"
                                                        href="{{ route('uploadTicket', $booking->id) }}"><i
                                                            class="mdi mdi-upload me-2 text-primary vertical-middle"></i>Upload Ticket</a>
                                            @endif

                                        </div>
                                    </div>
                                </td>
                                {{-- <td>
                                    <button class="btn btn-sm btn-blue"
                                        wire:click="showDetails('{{ $booking->id }}')">View</button>
                                    @if ($booking->app_status == StatusEnum::AUTHORIZED->value)
                                    <span class="badge badge-outline-info">Authorized</span>
                                    @elseif($booking->app_status == StatusEnum::SENT_FOR_AUTH->value)
                                    <span class="badge badge-outline-warning">{{ StatusEnum::SENT_FOR_AUTH->value
                                    }}</span>
                                    @endif
                                    <a class="btn btn-sm btn-danger" href={{ route('payment.generatePaymentLink',
                                        $booking->id) }}>Generate Payment Link</a>
                                </td> --}}

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $sales->links() }}
                {{-- </div> --}}
            </div>
        </div>
    </div>

</div>
