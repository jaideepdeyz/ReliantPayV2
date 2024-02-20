<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                        <li class="breadcrumb-item">Merchant Dashboard</li>
                        <li class="breadcrumb-item active">Pending Payments</li>
                    </ol>
                </div>
                <h4 class="page-title">Pending Payments</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="header-title">
                                Pending Payments
                            </h4>
                        </div>
                        <div class="text-sm-end col-md-8">
                            {{-- <a href="javascript:void(0);" class="btn btn-blue" data-bs-toggle="modal"
                                data-bs-target="#Countries"><svg xmlns="http://www.w3.org/2000/svg" width="12"
                                    height="12" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                                </svg> Add
                                Dealer </a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row mb-3">
                        <div class="row mt-3 d-flex justify-content-between">

                            <div class="col-md-8">
                                <form class="form-floating">
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="search"
                                        placeholder="Search...">
                                    <label for="">Search</label>
                                </form>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select wire:model.live="perPage" class="form-select" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option value="10">10 Records</option>
                                        <option value="20">20 Records</option>
                                        <option value="50">50 Records</option>
                                        <option value="100">100 Records</option>
                                    </select>
                                    <label for="floatingSelect">Page Size</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row mb-3">
                        @if ($pendingPayments->count() > 0)
                        <div class="flex">
                            <table class="table table-hover table-striped table-borderless wrap table-fixed">
                                <thead class="table-light">
                                    <tr>
                                        <th>Sale ID</th>
                                        <th>Agent</th>
                                        <th>Customer's Name</th>
                                        <th>Customer's Email</th>
                                        <th>Customer's Contact #</th>
                                        <th>Service Availed</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        {{-- <th class="col-md-1 text-center">Action</th> --}}
                                    </tr>
                                </thead>


                                <tbody>


                                    @foreach ($pendingPayments as $customer)
                                    <tr>
                                        <td>{{$customer->id}}</td>
                                        <td>{{$customer->agent->name}}</td>
                                        <td>{{$customer->customer_name}}</td>
                                        <td>{{$customer->customer_email}}</td>
                                        <td>{{$customer->customer_phone}}</td>
                                        <td>{{$customer->service->service_name}}</td>
                                        <td>$ {{$customer->amount_charged}}</td>
                                        <td>{{$customer->app_status}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end">
                                {{ $pendingPayments->links() }}
                            </div>

                        </div>
                        @else
                        <p>No data found!!</p>
                        @endif
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

</div>

