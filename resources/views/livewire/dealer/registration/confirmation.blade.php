<div class="mt-3">
    <div class="card">
        <div class="card-body">
            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 5/5: Terms & Conditions</h5>
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <h5><b>Terms & Conditions</b></h5>
                        <ol>
                            <li>
                                <p>
                                    <b>User Agreement:</b>
                                    <p>By submitting this application, you agree to abide by our terms and conditions. This includes compliance with applicable laws and regulations.</p>
                                </p>
                            </li>
                            <li>
                                <p>
                                    <b>Accurate Information:</b>
                                    <p>You must provide accurate and complete information during the Merchant Onboarding process. Any false or misleading details may result in the termination of your account.</p>
                                </p>
                            </li>
                            <li>
                                <p>
                                    <b>Privacy Policy:</b>
                                    <p>By submitting this application you agree that Your personal / business information will be handled in accordance with our privacy policy. We respect your privacy and take measures to protect your data.</p>
                                </p>
                            </li>
                            <li>
                                <p>
                                    <b>Termination of Registration:</b>
                                    <p>We reserve the right to terminate or suspend your account at our discretion, especially if there is a violation of these terms or misuse of our services. You will be notified of any such action taken.</p>
                                </p>
                            </li>
                        </ol>
                    </div>
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
