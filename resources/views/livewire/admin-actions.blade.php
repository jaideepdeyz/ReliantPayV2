<div class="row">
    <div class="col-md-6 mb-3">
        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Uploaded Documents</h5>
        <ol>
            @foreach($docs as $doc)
                    <li class="mb-2"><button class="btn btn-sm btn-dark" wire:click="openPdf('{{$doc->document_filepath}}', '{{$doc->document_name}}')">{{$doc->document_name}}</button></li>
            @endforeach
        </ol>
    </div>

    <div class="col-md-6 mb-3">
        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Products and Services Offered</h5>
        <ol>
            @foreach($services as $service)
                    <li >{{$service->service_name}}</li>
            @endforeach
        </ol>
    </div>

    <div class="col-md-12">
        <h5 class="text-uppercase text-white bg-primary p-2 mt-0 mb-3">Administrative Section</h5>
    </div>
    <div class="col-md-12">
        <button class="btn btn-sm btn-success" wire:click="approve">Approve</button>
        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectionModal">Reject</button>
        @switch($org->user->is_active)
            @case('No')
                <button class="btn btn-sm btn-primary" wire:click="activate">Activate</button>
                @break
            @case('Yes')
                <button class="btn btn-sm btn-warning" wire:click="deactivate">De Activate</button>
                @break
         @endswitch
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
                            <button type="submit" class="btn btn-sm btn-primary" >Reject</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
