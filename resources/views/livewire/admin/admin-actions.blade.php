<div class="row">
    <div class="col-md-6 mb-3">
        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Uploaded Documents</h5>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($docs as $doc)
                    <tr>
                        <td>{{ $doc->document_name }}</td>
                        <td><button class="btn btn-sm btn-dark"
                                wire:click="openPdf('{{ $doc->document_filepath }}', '{{ $doc->document_name }}')">View</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <div class="col-md-6 mb-3">
        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Products and Services Offered</h5>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th class="text-center">Sl.No</th>
                    <th>Name</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($services as $service)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $service->service_name }}</td>
                        <td>
                            @if ($service->service_status == StatusEnum::ACTIVE->value)
                                <h6 class="badge bg-success" style="display:inline-block; width:100%">{{ $service->service_status }}</h6>
                            @else
                                <h6 class="badge bg-danger" style="display:inline-block; width:100%">{{ $service->service_status }}</h6>
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
                                        <a href="javascript:void(0);"
                                            wire:click="activateDeactivate({{ $service->id }})" class="btn">
                                            <i class="fas fa-trash text-danger"></i>
                                            {{ $service->service_status == StatusEnum::ACTIVE->value ? 'Deactivate' : 'Activate'
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
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-dark py-1">
                <h5 class="text-white text-uppercase">Administrative Section</h5>
            </div>
            <div class="card-body">
                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#alertModal"
                    wire:click="setAction('approve')">Approve</button>
                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                    data-bs-target="#rejectionModal">Reject</button>
                @switch($org->user->is_active)
                    @case('No')
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#alertModal"
                            wire:click="setAction('activate')" wire:click="setAction('activate')">Activate</button>
                    @break

                    @case('Yes')
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#alertModal"
                            wire:click="setAction('deactivate')" wire:click="setAction('deactivate')">De
                            Activate</button>
                    @break
                @endswitch
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="rejectionModal" tabindex="-1" aria-labelledby="rejectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectionModalLabel">Reject Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="rejectOrganization">
                        <div class="row">
                            <div class="col-md-12 form-group mb-2">
                                <label for="remarks">Reason for Rejection</label>
                                <textarea class="form-control" wire:model="remarks" cols="30" rows="5" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary">Reject</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="rejectionModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h1>Alert</h1>
                    <p>Are you sure you want to {{ $action }} this registration?</p>
                    <button class="btn btn-primary text-uppercase"
                        @if ($action == 'approve') wire:click="approve"
                        @elseif($action == 'activate') wire:click="activate"
                        @elseif($action == 'deactivate') wire:click="deactivate" @endif>{{ $action }}

                        <span class="spinner-border text-light m-2" role="status" wire:loading></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
