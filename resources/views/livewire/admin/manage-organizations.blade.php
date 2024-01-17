<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                        <li class="breadcrumb-item">Admin Dashboard</li>
                        <li class="breadcrumb-item active">Manage Dealers</li>
                    </ol>
                </div>
                <h4 class="page-title">Manage Dealers</h4>
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
                                Dealers
                            </h4>
                        </div>
                        <div class="text-sm-end col-md-8">
                            <a href="javascript:void(0);" class="btn btn-blue" data-bs-toggle="modal"
                                data-bs-target="#Countries"><svg xmlns="http://www.w3.org/2000/svg" width="12"
                                    height="12" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                                </svg> Add
                                Dealer </a>
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
                                        'displayName' => 'Name',
                                        'width' => 2,
                                        ])

                                        @include('livewire.util.datatable-sortable-th', [
                                        'name' => 'email',
                                        'displayName' => 'Email',
                                        'width' => 1,
                                        ])

                                        <th class="col-md-1">Phone</th>

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

                                        <th class="col-md-1">Action</th>
                                    </tr>
                                </thead>


                                <tbody>


                                    @foreach ($dealers as $d)
                                    <tr wire:key={{ $d->id }}>
                                        <td class="table-user">
                                            <img src="{{ asset('auth/images/users/user-3.jpg') }}" alt="table-user"
                                                class="me-2 rounded-circle">
                                            {{ $d->business_name }}
                                        </td>
                                        <td>
                                            {{ $d->business_email }}
                                        </td>

                                        <td>
                                            {{ $d->business_phone }}
                                        </td>

                                        <td>
                                            {{ $d->business_address }}
                                        </td>


                                        <td>
                                            @if ($d->status == 'Approved')
                                            <span class="badge badge-soft-success badge-lg">{{ $d->status }}</span>
                                            @elseif($d->status == 'Rejected')
                                            <span class="badge bg-danger badge-lg">{{ $d->status }}</span>
                                            @else
                                            <span class="badge bg-warning badge-lg">{{ $d->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($d->user->is_active == 'Yes')
                                            <span class="badge badge-soft-success badge-lg">{{ $d->user->is_active
                                                }}</span>
                                            @elseif($d->user->is_active == 'No')
                                            <span class="badge bg-danger badge-lg">{{ $d->user->is_active }}</span>
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


                                                        <a href="{{ route('dealers.show', $d->id) }}" class="btn">
                                                            <i class="fas fa-eye text-success"></i> View</a>


                                                        <div class="dropdown-divider"></div>

                                                        <!-- item-->

                                                        <a href="javascript:void(0);"
                                                            wire:click="activateDeactivate({{ $d->id }})" class="btn">
                                                            <i class="fas fa-trash text-danger"></i>
                                                            {{ $d->user->is_active == 'Yes' ? 'Deactivate' : 'Activate'
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


    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="Countries" tabindex="-1" aria-labelledby="CountriesLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CountriesLabel">Create Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
                </div>


                <form wire:submit.prevent="saveCountries">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Country Name</label>
                            <input type="text" wire:model="name" class="form-control">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Country Code</label>
                            <input type="text" wire:model="code" class="form-control">
                            @error('code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Flag icon</label>
                            <input type="text" wire:model="flagimage" class="form-control">
                            @error('flagimage')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Update Country Modal -->
    <div wire:ignore.self class="modal fade" id="updateCountries" tabindex="-1" aria-labelledby="updateCountriesLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCountriesLabel">Edit Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateCountries">
                    <div class="modal-body">
                        <div class="mb-3" style="display:none;">
                            <label>country id</label>
                            <input type="text" wire:model="country_id" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Country Name</label>
                            <input type="text" wire:model="name" class="form-control">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Country Code</label>
                            <input type="text" wire:model="code" class="form-control">
                            @error('code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Flag icon</label>
                            <input type="text" wire:model="flagimage" class="form-control">
                            @error('flagimage')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Country Modal -->
    <div wire:ignore.self class="modal fade" id="deleteCountries" tabindex="-1" aria-labelledby="deleteCountriesLabel"
        aria-hidden="true" x-data="{ livewire: false }">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCountriesLabel">Delete Country</h5>
                    <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyCountry">
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this data ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes! Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- @section('scripts') --}}
    <script>
        window.addEventListener('close-modal', event => {
            console.log('close-modal event received:', event);
            $('#Countries').modal('hide');
            $('#updateCountries').modal('hide');
            $('#deleteCountries').modal('hide');
        })
    </script>

</div>