<div>
    <div class="modal-header">
        <h5 class="modal-title">Add New Sales Agent</h5>
        <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <h4 class="text-warning py-2" style="font-size:14px">Default Password for new agents
            added is "Agent@123#". The Agent will receive default password in thier email.
        </h4>
        <form wire:submit="addAgent">

            <div class="row">

                <div class="col-md-12 form-group mb-3">
                    <label class="form-label" for="name">Agent Name</label>
                    <input style="color: #0096C7;" type="text" wire:model="name" class="form-control">
                </div>

                <div class="col-md-12 form-group mb-3">
                    <label class="form-label" for="name">Agent Email</label>
                    <input style="color: #0096C7;" type="email" wire:model="email" class="form-control">
                </div>

                <div class="col-md-12 form-group mb-3">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                        wire:loading.class='"disabled'>
                        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"
                            wire:loading></span>
                        Add Agent
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
