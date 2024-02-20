<div class="row">
    <!-- start page title -->
    <div class="row mb-3">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item">Merchant Dashboard</li>
                    <li class="breadcrumb-item active">Manage Agents</li>
                </ol>
            </div>

        </div>
    </div>
    <!-- end page title -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header pb-1">
                <h5 class="d-inline header-title mb-0">Agents of {{ Auth::User()->organization->business_name }}</h5>
                <span class="float-right">
                    <button class="btn btn-success p-2" wire:click="addAgent"><svg xmlns="http://www.w3.org/2000/svg"
                            width="12" height="12" fill="currentColor" class="bi bi-plus-circle-fill"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                        </svg> Add New Sales Agent</button>
                </span>
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
                        @if ($agents->count() > 0)
                        <div class="flex">
                            <table class="table table-hover table-striped table-borderless wrap table-fixed">
                                <thead class="table-light">
                                    <tr>

                                        @include('livewire.util.datatable-sortable-th', [
                                        'name' => 'name',
                                        'displayName' => 'AGENT NAME',
                                        'width' => 3,
                                        ])

                                        @include('livewire.util.datatable-sortable-th', [
                                        'name' => 'email',
                                        'displayName' => 'E-MAIL',
                                        'width' => 1,
                                        ])




                                        <th class="col-md-1 text-center">STATUS</th>



                                        <th class="col-md-1 text-center">ACTION</th>
                                    </tr>
                                </thead>


                                <tbody>


                                    @foreach ($agents as $d)
                                    <tr wire:key={{ $d->id }}>

                                        <td class="table-user">
                                            {{  $d->name}}
                                        </td>

                                        <td>
                                            {{ $d->email }}
                                            {{-- Showing registered user email only --}}
                                        </td>

                                        {{-- <td>
                                            @if($d->organization)
                                                {{ $d->organization->business_name}}
                                            @else
                                                <span class="badge bg-warning badge-lg">Incomplete</span>
                                            @endif
                                        </td> --}}



                                        {{-- <td>
                                            @if($d->organization)
                                                {{ $d->organization->business_address}}
                                            @else
                                                <span class="badge bg-warning badge-lg">Incomplete</span>
                                            @endif
                                        </td> --}}




                                        <td style="text-align:center;">
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
                                                            style="font-size: 18px;"></i>
                                                    </a>

                                                    <div class="dropdown-menu">

                                                        <a class="dropdown-item" href="#"
                                                        wire:click='activateDeactivate({{ $d->id }})'><i
                                                        class="mdi mdi-download me-2 text-danger vertical-middle"></i>
                                                        {{ $d->is_active == 'Yes' ? 'Deactivate' : 'Activate' }}</a>

                                                    </div>
                                                </div>

                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end">
                                {{ $agents->links() }}
                            </div>

                        </div>
                        @else
                        <p>No data found!!</p>
                        @endif
                    </div>
            </div> <!-- end card-body-->


        </div>
    </div>
    <x-toast-livewire />
</div>
