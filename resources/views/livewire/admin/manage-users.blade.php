<div class="container-fluid">

    <!-- start page title -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                        <li class="breadcrumb-item">Admin Dashboard</li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>

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
                                <h4 class="page-title">Manage Users</h4>
                            </h4>
                        </div>
                        <div class="text-sm-end col-md-8">
                            <button class="btn btn-success p-2" wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-user-by-admin'}})"><svg xmlns="http://www.w3.org/2000/svg" width="12"
                                    height="12" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                                </svg> Add New User </button>
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
                        @if ($users->count() > 0)
                        <div class="flex">
                            <table class="table table-hover table-striped table-borderless wrap table-fixed">
                                <thead class="table-light">
                                    <tr>

                                        <th class="col-md-1">NAME</th>
                                        <th class="col-md-1">EMAIL</th>
                                        <th class="col-md-1">PHONE</th>
                                        <th class="col-md-1">ROLE</th>
                                        <th class="col-md-1">IS ACTIVE ?</th>
                                        <th class="col-md-1 text-center">ACTION</th>
                                    </tr>
                                </thead>


                                <tbody>


                                    @foreach ($users as $u)
                                    <tr>
                                        <td class="table-user">
                                            <img src="{{ asset('auth/images/users/user-3.jpg') }}" alt="table-user"
                                                class="me-2 rounded-circle">
                                            {{ $u->name }}
                                        </td>

                                        <td>
                                            {{ $u->email }}
                                            {{-- Showing registered user email only --}}
                                        </td>

                                        <td>
                                            {{ $u->phone_number }}
                                            {{-- Showing registered user phone only --}}
                                        </td>
                                        <td>
                                            {{ $u->role }}
                                            {{-- Showing registered user phone only --}}
                                        </td>

                                        <td>
                                            @if ($u->is_active == 'Yes')
                                            <span class="badge badge-soft-success badge-lg">{{ $u->is_active
                                                }}</span>
                                            @elseif($u->is_active == 'No')
                                            <span class="badge bg-danger badge-lg">{{ $u->is_active }}</span>
                                            @endif
                                        </td>

                                        <td style="text-align:center;">
                                            <div>

                                                <div class="dropdown d-none d-xl-block">
                                                    <a class="nav-link dropdown-toggle waves-effect waves-light"
                                                        data-bs-toggle="dropdown" href="#" role="button"
                                                        aria-haspopup="false" aria-expanded="false">
                                                        <i class="mdi mdi-chevron-down-box text-success"
                                                            style="font-size: 18px;"></i>
                                                    </a>

                                                    <div class="dropdown-menu">
                                                        <a href="javascript:void(0);"
                                                            wire:click="activateDeactivate({{ $u->id }})" class="btn">
                                                            <i class="fas fa-trash text-danger"></i>
                                                            {{ $u->is_active == 'Yes' ? 'Deactivate' : 'Activate'
                                                            }}

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end">
                                {{ $users->links() }}
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
