<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                        <li class="breadcrumb-item">Affiliate Dashboard</li>
                        <li class="breadcrumb-item active">Manage Merchants</li>
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
                            <a href="javascript:void(0);" class="btn btn-blue" data-bs-toggle="modal"
                                data-bs-target="#inviteMerchant"><svg xmlns="http://www.w3.org/2000/svg" width="12"
                                    height="12" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                                </svg> Invite Merchant</a>
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
                        @if ($merchants->count() > 0)
                        <div class="flex">
                            <table class="table table-hover table-striped table-borderless wrap table-fixed">
                                <thead class="table-light">
                                    <tr>

                                        <th class="col-md-1">Merchant Name</th>
                                        <th class="col-md-1">Email</th>
                                        <th class="col-md-2 text-center">Link Active</th>
                                        <th class="col-md-2 text-center">Registration Status</th>
                                        <th class="col-md-1 text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($merchants as $d)
                                    <tr>
                                        <td class="table-user">
                                            <img src="{{ asset('auth/images/users/user-3.jpg') }}" alt="table-user"
                                                class="me-2 rounded-circle">
                                            {{ $d->merchant_name }}
                                        </td>
                                        <td>
                                            {{ $d->merchant_email }}
                                        </td>

                                        <td class="text-center">
                                            @if (($d->created_at) > Carbon\Carbon::now()->subHour(48))
                                            <span class="badge badge-soft-success badge-lg">Active</span>
                                            @else
                                            <span class="badge bg-danger badge-lg">Inactive</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if($d->user_id != null)
                                                <b>Registered</b>
                                            @else
                                                <b>Not Registered</b>
                                            @endif
                                        </td>


                                        {{-- <td>
                                            @if ($d->status == 'Approved')
                                            <span class="badge badge-soft-success badge-lg">{{ $d->status }}</span>
                                            @elseif($d->status == 'Rejected')
                                            <span class="badge bg-danger badge-lg">{{ $d->status }}</span>
                                            @elseif($d->status == 'Submitted')
                                            <span class="badge bg-danger badge-lg">Approval Pending</span>
                                            @elseif($d->status == null)
                                            <span class="badge bg-warning badge-lg">Incomplete</span>
                                            @endif
                                        </td> --}}
                                        {{-- <td>
                                            @if ($d->user->is_active == 'Yes')
                                            <span class="badge badge-soft-success badge-lg">{{ $d->user->is_active
                                                }}</span>
                                            @elseif($d->user->is_active == 'No')
                                            <span class="badge bg-danger badge-lg">{{ $d->user->is_active }}</span>
                                            @endif
                                        </td> --}}



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

                                                        <a href="javascript:void(0);"
                                                            wire:click="activateDeactivate({{ $d->id }})" class="btn">
                                                            {{-- <i class="fas fa-trash text-danger"></i>
                                                            {{ $d->user_id != null ? 'Delete' : 'Resend Invite' }} --}}
                                                            @if(($d->created_at) > Carbon\Carbon::now()->subHour(48))
                                                            <a href="#" wire:click="deleteInvite({{$d->id}})">
                                                                <i class="fas fa-trash text-danger"></i> Delete
                                                            </a>
                                                            @else
                                                            <a href="#" wire:click="resendInvite({{$d->id}})">
                                                                <i class="fas fa-sync"></i> Resend Invite
                                                            </a>
                                                            @endif
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
                                {{ $merchants->links() }}
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
    <div wire:ignore.self class="modal fade" id="inviteMerchant" tabindex="-1" aria-labelledby="CountriesLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inviteMerchantLabel">Send Invite to Merchant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
                </div>


                <form wire:submit.prevent="sendInvite">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Merchant Name</label>
                            <input type="text" wire:model="name" class="form-control @error('is-invalid') name @enderror">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Merchant's Email</label>
                            <input type="email" wire:model="email" class="form-control @error('is-invalid') email @enderror">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            Send Invite
                            <span class="spinner-border text-light m-2" role="status" wire:loading></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>






    {{-- @section('scripts') --}}
    <script>
        window.addEventListener('close-modal', event => {
            console.log('close-modal event received:', event);
            $('#inviteMerchant').modal('hide');
        })
    </script>

</div>
