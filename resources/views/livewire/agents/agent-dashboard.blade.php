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

        @switch($firstPasswordChanged)
        @case('No')
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>This is your first login, please change your password before accessing any services.</h5>
                        <hr>
                        <form wire:submit.prevent="changePassword">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="currentPassword" class="form-label">Current Password</label>
                                    <input type="password" class="form-control" id="currentPassword"
                                        wire:model="currentPassword" placeholder="Please enter current password">
                                    @error('currentPassword') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="newPassword" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="newPassword"
                                        wire:model="newPassword" placeholder="Please provide a new password">
                                    @error('newPassword') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword"
                                        wire:model="confirmPassword" placeholder="Please retype the new password">
                                    @error('confirmPassword') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-12 mb-2">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @break
        @case('Yes')
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
                                    <h3 class="text-dark mt-1">$ <span data-plugin="counterup">{{ $revenueThisMonth }}</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate"><a href="{{ route('manageSales') }}">Revenue this
                                            month</a></p>
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
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $customers }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate"><a href="{{ route('manageCustomers') }}">Completed Bookings</a>
                                    </p>
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
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $pendingPayment }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate"><a
                                            href="{{ route('pendingPayments') }}">Pending Payments</a></p>
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
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $pendingAuthorization }}</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate"><a
                                            href="{{ route('pendingAuthorizations') }}">Pending Authorization</a></p>
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

                                <div dir="ltr" x-data="{ totalRevenueChart: {} }" x-init="totalRevenueChart = {{ json_encode($totalrevenueoptions) }};
                                new ApexCharts($refs.totalrevenuechart, totalRevenueChart).render();">
                                    <div x-ref="totalrevenuechart"></div>
                                </div>
                                {{-- <div id="total-revenue" class="apex-charts mb-4 mt-4" dir="ltr"></div> --}}

                                <h5 class="text-muted mt-0">Total sales made today</h5>
                                <h2>${{ $revenueThisDay }}</h2>

                                {{-- <p class="text-muted w-75 mx-auto sp-line-2">by Agent {{Auth::User()->name}}</p> --}}

                                <div class="row mt-3">
                                    <div class="col-4">
                                        <p class="text-muted font-15 mb-1 text-truncate">This Week</p>
                                        <h4><i class="text-danger me-1"></i>${{ $revenueThisWeek }}</h4>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-muted font-15 mb-1 text-truncate">This Month</p>
                                        <h4><i class="text-success me-1"></i>${{ $revenueThisMonth }}</h4>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-muted font-15 mb-1 text-truncate">This Year</p>
                                        <h4><i class="text-danger me-1"></i>${{ $revenueThisYear }}</h4>
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
                                    <button type="button" class="btn btn-xs btn-light mr-1"
                                    wire:click="updateChart('10')"

                                    >Last 10 Days</button>
                                    <button type="button" class="btn btn-xs btn-light  mr-1" wire:click="updateChart('30')">Last 30 days</button>
                                    <button type="button" class="btn btn-xs btn-light  mr-1" wire:click="updateChart('60')">Last 60 days</button>


                                </div>
                            </div>

                            <h4 class="header-title mb-3">Sales Analytics</h4>

                            <div dir="ltr" x-data="{ chartData: {} }"
                            x-init="

                                chartData = {{ json_encode($options) }};
                                new ApexCharts($refs.chart, chartData).render();
                            ">
                                <div x-ref="chart"></div>
                            </div>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col-->
            </div>

            {{-- end chart row --}}
            <div class="row mt-3">
                <div class="col-xl-12">
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

                            <h4 class="header-title mb-3">Top 5 Customers <span><small>(cumulative by revenue)</small></span>
                            </h4>

                            <div class="table-responsive">
                                <table class="table table-borderless table-hover table-nowrap table-centered m-0">

                                    <thead class="table-light">
                                        <tr>
                                            <th>Sale ID</th>
                                            <th>Service Availed</th>
                                            <th>Customer's Name</th>
                                            <th>Customer's Email</th>
                                            <th>Customer's Phone</th>
                                            <th>Booking Amount in USD </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topCustomers as $customer)
                                            <tr>
                                                <td>{{ $customer->id }}</td>
                                                <td>{{ $customer->service->service_name }}</td>
                                                <td>{{ $customer->customer->customer_name }}</td>
                                                <td>{{ $customer->customer->customer_email }}</td>
                                                <td>{{ $customer->customer_phone }}</td>
                                                <td>{{ $customer->amount_charged }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            @break
        @default
    @endswitch
    <x-toast-livewire />
</div>




