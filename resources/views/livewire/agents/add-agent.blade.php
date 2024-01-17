<div class="row">
    <!-- start page title -->
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item active">Dealer Dashboard</li>
                </ol>
            </div>
            <h4 class="page-title">Dealer Dashboard</h4>
        </div>
    </div>
    <!-- end page title -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header pb-1">
                <h5 class="d-inline header-title mb-0">Agents of {{ Auth::User()->organization->business_name }}</h5>
                <span class="float-right">
                    <button class="btn btn-blue" wire:click="addAgent"><svg xmlns="http://www.w3.org/2000/svg"
                            width="12" height="12" fill="currentColor" class="bi bi-plus-circle-fill"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                        </svg> Add Agent</button>
                </span>
            </div>
            <div class="card-body">

                <div class="">
                    <table class="table table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agents as $agent)
                            <tr>
                                <td>{{ $agent->name }}</td>
                                <td>{{ $agent->email }}</td>
                                <td>
                                    <span
                                        class="badge {{ $agent->is_active == 'Yes' ? 'badge badge-soft-success p-1' : 'badge badge-soft-danger p-1' }}">{{
                                        $agent->is_active }}</span>

                                </td>
                                <td>
                                    <div class="btn-group dropdown">
                                        <a href="javascript: void(0);"
                                            class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-xs"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="mdi mdi-dots-horizontal"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            {{-- <a class="dropdown-item" href="#"><i
                                                    class="mdi mdi-pencil me-2 text-primary vertical-middle"></i>Edit</a>
                                            --}}

                                            <a class="dropdown-item" href="#"
                                                wire:click='activateDeactivate({{ $agent->id }})'><i
                                                    class="mdi mdi-download me-2 text-danger vertical-middle"></i>{{
                                                $agent->is_active == 'Yes' ? 'Deactivate' : 'Activate' }}</a>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-toast-livewire />
</div>