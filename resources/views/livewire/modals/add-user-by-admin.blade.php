<div>
    <div class="modal-header">
        <h5 class="modal-title">Add Agent</h5>
        <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <h4 class="badge badge-soft-danger p-2" style="font-size:14px">Default Password for new users
            added is "User@123#". The User added will receive default password in thier email.
        </h4>
        <form wire:submit="addUser">

            <div class="row">
                <div class="col-md-12 form-group">

                    <label for="name">Legal Name of the User</label>
                    <input type="text" wire:model="name" class="form-control mb-3 @error('is-invalid') name @enderror">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                    <label for="name">User's Email</label>
                    <input type="email" wire:model="email" class="form-control mb-3 @error('is-invalid') email @enderror">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                    <label for="name">User's Phone Number</label>
                    <input type="text" wire:model="phone" class="form-control mb-3 @error('is-invalid') phone @enderror" minlength="10" maxlength="10">
                    @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                    <label for="name">User's Role</label>
                    <select wire:model="role" class="form-control mb-3 @error('is-invalid') role @enderror">
                        <option value="">Select Role</option>
                        <option value="Admin">Admin</option>
                        <option value="Ticketer">Ticketer</option>
                        <option value="Finance">Finance</option>
                    </select>
                    @error('role')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"
                        wire:loading.class='"disabled'>
                        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"
                            wire:loading></span>
                        Add User
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
