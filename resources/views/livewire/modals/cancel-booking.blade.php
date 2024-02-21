<div>
    <div class="modal-header">
        <h5 class="modal-title">Cancel Booking</h5>
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