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
                        <input type="text" wire:model.live="search" class="form-control"
                            placeholder="Customer's Name">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">Search by Customer's Email</label>
                        <input type="text" wire:model.live="search" class="form-control"
                            placeholder="Customer's Email">
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
                        <thead>
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
                                    <td>{{ $booking->app_status }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-blue"
                                            wire:click="showDetails('{{ $booking->id }}')">View</button>
                                        @if ($booking->app_status == StatusEnum::AUTHORIZED->value)
                                            <a class="btn btn-sm btn-danger"
                                                href={{ route('payment.stepOnePay', $booking->id) }}>Charge Card</a>
                                        @endif
                                    </td>
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
