<div class="row mb-5">
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
    <!-- end page title -->
    <div class="col-md-6 col-xl-3 mb-3">
        <div class="widget-rounded-circle card dashboard-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-primary border-primary border shadow">
                            <i class="bi bi-cash-coin font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1">$<span data-plugin="counterup">{{$revenueThisMonth}}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Revenue this month</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3 mb-3">
        <div class="widget-rounded-circle card dashboard-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-success border-success border shadow">
                            <i class="bi bi-people font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$customers}}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Customers</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3 mb-3">
        <div class="widget-rounded-circle card dashboard-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-info border-info border shadow">
                            <i class="bi bi-cash-stack font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$pendingPayment}}</span></h3>
                            <p class="text-muted mb-1 text-truncate">Pending Payments</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3 mb-3">
        <div class="widget-rounded-circle card dashboard-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-warning border-warning border shadow">
                            <i class="bi bi-clock font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$pendingAuthorization}}</span>
                            </h3>
                            <p class="text-muted mb-1 text-truncate">Pending Authorisation</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div>
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="row">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>

                    <h4 class="header-title mb-0">Revenue (today)</h4>

                    <div class="widget-chart text-center" dir="ltr">

                        <div id="total-revenue" class="mt-0" data-colors="#f1556c"></div>

                        <h5 class="text-muted mt-0">Total sales made today</h5>
                        <h2>${{$revenueThisDay}}</h2>

                        {{-- <p class="text-muted w-75 mx-auto sp-line-2">by Agent {{Auth::User()->name}}</p> --}}

                        <div class="row mt-3">
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">This Week</p>
                                <h4><i class="fe-arrow-down text-danger me-1"></i>${{$revenueThisWeek}}</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">This Month</p>
                                <h4><i class="fe-arrow-up text-success me-1"></i>${{$revenueThisMonth}}</h4>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 mb-1 text-truncate">This Year</p>
                                <h4><i class="fe-arrow-down text-danger me-1"></i>${{$revenueThisYear}}</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col-->

        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-body pb-2">
                    <div class="float-end d-none d-md-inline-block">
                        <div class="btn-group mb-2">
                            <button type="button" class="btn btn-xs btn-light">Today</button>
                            <button type="button" class="btn btn-xs btn-light">Weekly</button>
                            <button type="button" class="btn btn-xs btn-secondary">Monthly</button>
                        </div>
                    </div>

                    <h4 class="header-title mb-3">Sales Analytics</h4>

                    <div dir="ltr">
                        <div id="sales-analytics" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
                    </div>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col-->
    </div>

    {{-- end chart row --}}
    <div class="row mt-3">
        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>

                    <h4 class="header-title mb-3">Top 5 customers by revenue</h4>

                    <div class="table-responsive">
                        <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                            <thead class="table-light">
                                <tr>
                                    <th colspan="2">Customer Name</th>
                                    <th>Sale ID</th>
                                    <th>Customer Phone</th>
                                    <th>Customer Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($authorizations as $authorization)
                                <tr>
                                    <td style="width: 36px;">
                                        <img src="{{asset('auth/images/users/user-1.jpg') }}" alt="contact-img"
                                            title="contact-img" class="rounded-circle avatar-sm" />
                                    </td>
                                    <td>
                                        <h5 class="m-0 fw-normal">{{$authorization->customer_name}}</h5>
                                        <p class="mb-0 text-muted"><small>Authorization Date:
                                                {{$authorization->updated_at}}</small></p>
                                    </td>
                                    <td>{{$authorization->id}}</td>
                                    <td>{{$authorization->customer_phone}}</td>
                                    <td>{{$authorization->customer_email}}</td>
                                    <td>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-light"><i
                                                class="mdi mdi-plus"></i></a>
                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger"><i
                                                class="mdi mdi-minus"></i></a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-xl-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>

                    <h4 class="header-title mb-3">Last 5 Bookings</h4>

                    <div class="table-responsive">
                        <table class="table table-borderless table-nowrap table-hover table-centered m-0">

                            <thead class="table-light">
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                <tr>
                                    <td>
                                        <h5 class="m-0 fw-normal">{{$booking->customer_name}}</h5>
                                    </td>
                                    <td>{{$booking->customer_phone}}</td>
                                    <td>{{$booking->customer_email}}</td>
                                    <td>
                                        @switch($booking->app_status)
                                        @case(StatusEnum::DRAFT->value)
                                        <span class="badge bg-soft-warning text-warning">{{$booking->app_status}}</span>
                                        @break
                                        @case(StatusEnum::PENDING->value)
                                        <span class="badge bg-soft-blue text-blue">{{$booking->app_status}}</span>
                                        @break
                                        @case(StatusEnum::AUTHORIZED->value)
                                        <span class="badge bg-soft-success text-dark">{{$booking->app_status}}</span>
                                        @break
                                        @default
                                        <span class="badge bg-soft-warning text-warning">{{$booking->app_status}}</span>
                                        @endswitch
                                        {{-- <span
                                            class="badge bg-soft-warning text-warning">{{$booking->app_status}}</span>
                                        --}}
                                    </td>
                                    <td><a href="javascript: void(0);" class="btn btn-xs btn-light"><i
                                                class="mdi mdi-pencil"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end .table-responsive-->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>