<div class="row" x:data=''>
    <!-- start page title -->
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item active">Agent Dashboard</li>
                </ol>
            </div>
            <h4 class="page-title">Agent Dashboard</h4>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="d-inline header-title mb-0">Authorized Sales</h5>
            </div>
            <div class="card-body">
                {{-- <div class="row mb-3">
                    <div class="form-group col-md-3">
                        <label for="">Search by ID</label>
                        <input type="text" wire:model.live="search" class="form-control" placeholder="Sale ID">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">Search by Customer's Name</label>
                        <input type="text" wire:model.live="search" class="form-control" placeholder="Customer's Name">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">Search by Customer's Email</label>
                        <input type="text" wire:model.live="search" class="form-control" placeholder="Customer's Email">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">Search by Status</label>
                        <select wire:model.live="search" class="form-control">
                            <option value="">Select Status</option>
                            <option value="Draft">Draft</option>
                            <option value="Pending">Pending</option>
                            <option value="Authorized">Authorized</option>
                        </select>
                    </div>
                </div> --}}

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Sale ID</th>
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
                                <td>{{ $booking->service->service_name }}</td>
                                <td>{{ $booking->customer_name }}</td>
                                <td>{{ $booking->customer_phone }}</td>
                                <td>{{ $booking->customer_email }}</td>
                                <td>
                                    @if ($booking->app_status == StatusEnum::AUTHORIZED->value)
                                    <span class="badge badge-outline-info">Authorized</span>
                                    @elseif($booking->app_status == StatusEnum::SENT_FOR_AUTH->value)
                                    <span class="badge badge-outline-warning">{{ StatusEnum::SENT_FOR_AUTH->value
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
                                            {{-- <a class="dropdown-item" href="#"
                                                wire:click="viewBooking({{ $booking->id }})"><i
                                                    class="mdi mdi-pencil me-2 text-success vertical-middle"></i>Proceed</a> --}}
                                            @if ($booking->app_status == StatusEnum::SENT_FOR_AUTH->value)
                                            <a class="dropdown-item"
                                                href="{{ route('checkAuthorizationFormStatus', $booking->id) }}"><i
                                                    class="mdi mdi-pencil me-2 text-success vertical-middle"></i>Check
                                                Status</a>
                                            @endif
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#alertModal"
                                                wire:click='selectId({{ $booking->id }})'><i
                                                    class="mdi mdi-delete me-2 text-danger vertical-middle"></i>Delete</a>
                                            @if ($booking->app_status == StatusEnum::SENT_FOR_AUTH->value)
                                            <a class="dropdown-item"
                                                href="{{ route('checkAuthorizationForm', $booking->id) }}"><i
                                                    class="mdi mdi-delete me-2 text-muted vertical-middle"></i>Check
                                                Status</a>
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
                </div>
            </div>
        </div>
    </div>

</div>
