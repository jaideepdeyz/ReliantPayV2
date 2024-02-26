<div>
    <div class="modal-header" wire:ignore:self>
        <h4 class="modal-title">Add New Merchant</h4>
        <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        {{-- <h4>Please Provide the details of the Merchant to create Login</h4> --}}
        <p class="text-info">
            Merchants added by the administrator will be automatically approved. The login credentails will be sent to the email provided below.
        </p>
        <p>&nbsp;</p>

        <form wire:submit.prevent="createUser">

            <div class="row mb-3">

                <div class="col-md-12 form-group mb-3">
                    <label class="form-label" for="name">Business Owner's Name <span class="text-danger"><sup>*</sup></span></label>
                    <input type="text" style="color: #0096C7;" class="form-control @error('is-invalid') name @enderror" wire:model="name">

                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 form-group mb-3">
                    <label class="form-label" for="email">Business Owner's Email <span class="text-danger"><sup>*</sup></span></label>
                    <input type="email" style="color: #0096C7;" class="form-control  @error('is-invalid') email @enderror" wire:model="email">

                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 form-group mb-3">
                    <label class="form-label" for="mobile">Business Owner's Mobile <span class="text-danger"><sup>*</sup></span></label>
                    <input type="text" style="color: #0096C7;" class="form-control @error('is-invalid') mobile @enderror" wire:model="mobile"
                        minlength="10" maxlength="10" placeholder="Enter the 10 digit mobile number without dashes">

                        @error('mobile')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="row mb-3 float-right">
                <div class="col-md-12 mb-2 mt-2">
                    <button type="submit" class="btn btn-info" wire:loading.attr="disabled"
                        wire:loading.class='"disabled'>
                        <span wire:loading>
                            <i class="fas fa-spinner fa-spin"></i>
                                Creating Merchant
                        </span>
                        <span wire:loading.remove>Create Merchant</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
