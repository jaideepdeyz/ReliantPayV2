<div class="mt-3">
    <div class="card">
        <div class="card-body">
            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 5/5: Terms & Conditions</h5>
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="terms" name="terms"
                                wire:model="terms">

                            <label class="form-check-label" for="terms">
                                I agree to the terms and conditions and submit this application for
                                registration.
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                        <button type="button" class="btn w-sm btn-secondary waves-effect waves-light" wire:click="decreaseStep">Previous</button>
                        <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
