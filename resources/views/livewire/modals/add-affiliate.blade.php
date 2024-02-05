<div>
    <div class="modal-header">
        <h5 class="modal-title">{{$id ? 'Edit' : 'Add'}} Affilate</h5>
        <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <h4 class="badge badge-soft-danger p-2" style="font-size:14px">Default Password for new Affiliates
            added is "Affilate@123#". The Affilate can change the password after logging in.
        </h4>
        <form wire:submit="addAffiliate">
            <div class="row">
                <div class="col-md-12 form-group">

                    <label for="name"> Name</label>
                    <input type="text" wire:model="name" class="form-control mb-3">
                </div>
                <div class="col-md-12 form-group">
                    <label for="name">Email</label>
                    <input type="email" wire:model="email" class="form-control mb-3">
                </div>
                <div class="col-md-12 form-group">
                    <label for="name">Phone</label>
                    <input type="text" wire:model="phone" class="form-control mb-3">
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary">{{$id ? 'Edit' : 'Add'}} Affilate</button>
                </div>
            </div>
        </form>
    </div>

</div>