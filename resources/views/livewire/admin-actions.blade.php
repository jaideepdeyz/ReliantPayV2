<div class="row">
    <div class="col-md-12">
        <h5 class="text-uppercase text-white bg-primary p-2 mt-0 mb-3">Administrative Section</h5>
    </div>
    <div class="col-md-12">
        <button class="btn btn-sm btn-success" wire:click="approve">Approve</button>
        <button class="btn btn-sm btn-danger" wire:click="reject">Reject</button>
        @switch($org->user->is_active)
            @case('No')
                <button class="btn btn-sm btn-primary" wire:click="activate">Activate</button>
                @break
            @case('Yes')
                <button class="btn btn-sm btn-warning" wire:click="deactivate">De Activate</button>
                @break
         @endswitch
    </div>
</div>
