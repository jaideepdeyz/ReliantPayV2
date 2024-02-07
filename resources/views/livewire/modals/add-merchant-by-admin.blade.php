<div>
    <div class="modal-header" wire:ignore:self>
        <h5 class="modal-title">Add Merchant</h5>
        <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <h6>Please Provide the details of the Merchant to create Login</h6>
        <p>
            <small>Merchant Added will be automatically approved</small>
        </p>
        <form wire:submit.prevent="createUser">
            <hr>
            <div class="row mt-3">
                <div class="col-md-12 form-group mb-2">
                    <label for="name">User Name</label>
                    <input type="text" class="form-control @error('is-invalid') name @enderror" wire:model="name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 form-group mb-2">
                    <label for="email">User Email</label>
                    <input type="email" class="form-control  @error('is-invalid') email @enderror"  wire:model.live="email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 form-group mb-2">
                    <label for="mobile">User Mobile</label>
                    <input type="text" class="form-control @error('is-invalid') mobile @enderror"  wire:model.live="mobile" minlength="10" maxlength="10">
                    @error('mobile')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 mb-2">
                    <button type="submit" class="btn btn-primary">Create User & Proceed</button>
                </div>
            </div>
        </form>
    </div>

</div>
