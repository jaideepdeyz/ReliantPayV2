<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                        <li class="breadcrumb-item">Admin Dashboard</li>
                        <li class="breadcrumb-item active">Merchants</li>
                    </ol>
                </div>
                <h4 class="page-title">Manage Merchants</h4>
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
                                Merchants
                            </h4>
                        </div>
                        <div class="text-sm-end col-md-8">
                            <button class="btn btn-success p-2" wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-merchant-by-admin'}})"><svg xmlns="http://www.w3.org/2000/svg" width="12"
                                    height="12" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                                </svg> Add New Merchant </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row mb-3">
                        <div class="row mt-3 d-flex justify-content-between">

                            <div class="col-md-3">
                                <form class="form-floating">
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="search"
                                        placeholder="Search...">
                                    <label for="">Search</label>
                                </form>
                            </div>

                            <div class="col-md-2">
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
                        @if ($dealers->count() > 0)
                        <div class="flex">
                            <table class="table table-hover table-striped table-borderless wrap table-fixed">
                                <thead class="table-light">
                                    <tr>

                                        @include('livewire.util.datatable-sortable-th', [
                                        'name' => 'name',
                                        'displayName' => 'User Name',
                                        'width' => 2,
                                        ])

                                        @include('livewire.util.datatable-sortable-th', [
                                        'name' => 'email',
                                        'displayName' => 'Registered Email',
                                        'width' => 1,
                                        ])

                                        <th class="col-md-1">Business Name</th>

                                        <th class="col-md-1">Registerd Phone</th>

                                        <th class="col-md-2">Address</th>

                                        @include('livewire.util.datatable-sortable-th', [
                                        'name' => 'status',
                                        'displayName' => 'Status',
                                        'width' => 1,
                                        ])
                                        @include('livewire.util.datatable-sortable-th', [
                                        'name' => 'Is Active?',
                                        'displayName' => 'Is Active?',
                                        'width' => 1,
                                        ])

                                        <th class="col-md-1 text-center">Action</th>
                                    </tr>
                                </thead>


                                <tbody>


                                    @foreach ($dealers as $d)
                                    <tr wire:key={{ $d->id }}>
                                        <td class="table-user">
                                            <img src="{{ asset('auth/images/users/user-3.jpg') }}" alt="table-user"
                                                class="me-2 rounded-circle">
                                            {{ $d->name }}
                                            {{-- Showing registered user name only --}}
                                        </td>
                                        <td>
                                            {{ $d->email }}
                                            {{-- Showing registered user email only --}}
                                        </td>

                                        <td>
                                            @if($d->organization)
                                                {{ $d->organization->business_name}}
                                            @else
                                                <span class="badge bg-warning badge-lg">Incomplete</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $d->phone_number }}
                                            {{-- Showing registered user phone only --}}
                                        </td>

                                        <td>
                                            @if($d->organization)
                                                {{ $d->organization->business_address}}
                                            @else
                                                <span class="badge bg-warning badge-lg">Incomplete</span>
                                            @endif
                                        </td>


                                        <td>
                                            @if($d->organization)
                                                @switch($d->organization->status)
                                                    @case(StatusEnum::APPROVED->value)
                                                        <span class="badge badge-soft-success badge-lg">{{ $d->organization->status }}</span>
                                                        @break
                                                    @case(StatusEnum::REJECTED->value)
                                                        <span class="badge bg-danger badge-lg">{{ $d->organization->status }}</span>
                                                        @break
                                                    @case(StatusEnum::SUBMITTED->value)
                                                        <span class="badge bg-danger badge-lg">Approval Pending</span>
                                                        @break
                                                    @case(null)
                                                        <span class="badge bg-warning badge-lg">Incomplete</span>
                                                        @break
                                                @endswitch
                                            @else
                                                <span class="badge bg-warning badge-lg">Incomplete</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($d->is_active == 'Yes')
                                            <span class="badge badge-soft-success badge-lg">{{ $d->is_active
                                                }}</span>
                                            @elseif($d->is_active == 'No')
                                            <span class="badge bg-danger badge-lg">{{ $d->is_active }}</span>
                                            @endif
                                        </td>



                                        <td style="text-align:center;">
                                            <div>

                                                <div class="dropdown d-none d-xl-block">
                                                    <a class="nav-link dropdown-toggle waves-effect waves-light"
                                                        data-bs-toggle="dropdown" href="#" role="button"
                                                        aria-haspopup="false" aria-expanded="false">
                                                        <i class="mdi mdi-chevron-down-box text-success"
                                                            style="font-size: 24px;"></i>
                                                    </a>

                                                    <div class="dropdown-menu">

                                                        @switch( $d->is_active )
                                                            @case('Yes')
                                                            @if(Auth::User()->role == RoleEnum::ADMIN->value)
                                                                <a href="{{ route('registrationByAdmin', ['userID'=> $d->id]) }}" class="btn">
                                                                    <i class="fas fa-eye text-success"></i> View</a>
                                                            @else
                                                                <a href="{{ route('dealers.show', $d->id) }}" class="btn">
                                                                    <i class="fas fa-eye text-success"></i> View</a>

                                                                    <div class="dropdown-divider"></div>
                                                            @endif
                                                                <!-- item-->

                                                                <a href="javascript:void(0);"
                                                                    wire:click="activateDeactivate({{ $d->id }})" class="btn">
                                                                    <i class="fas fa-trash text-danger"></i>
                                                                    {{ $d->is_active == 'Yes' ? 'Deactivate' : 'Activate'
                                                                    }}

                                                                </a>
                                                                @break
                                                            @case('No')
                                                                    @if(Auth::User()->role == RoleEnum::ADMIN->value)
                                                                        <a href="{{ route('registrationByAdmin', ['userID'=> $d->id]) }}" class="btn">
                                                                            <i class="fas fa-eye text-success"></i> Continue Regd.</a>
                                                                    @else
                                                                        <a href="{{ route('dealerRegBusinessInfo', ['userID'=> $d->id, 'viewOnly' => 'False']) }}" class="btn">
                                                                            <i class="fas fa-eye text-dark"></i> Continue Regd.</a>
                                                                    @endif
                                                                @break
                                                        @endswitch


                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end">
                                {{ $dealers->links() }}
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
