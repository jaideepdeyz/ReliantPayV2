<div>
    <div class="modal-header">
        <h5 class="modal-title">Add Agent</h5>
        <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form wire:submit="addAgent">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="name">Agent Name</label>
                    <input type="text" wire:model="name" class="form-control mb-3">
                </div>
                <div class="col-md-12 form-group">
                    <label for="name">Agent Email</label>
                    <input type="email" wire:model="email" class="form-control mb-3">
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary">Add Agent</button>
                </div>
            </div>
        </form>
    </div>

</div>
