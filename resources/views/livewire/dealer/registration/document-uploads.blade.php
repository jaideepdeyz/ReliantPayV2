<div class="mt-3">
    <div class="card">
        <div class="card-body">
            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 4/5: Upload Documents</h5>
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="mb-3 col-md-12 bg-secondary">
                        <h5 class="text-white">All Documents to be uploaded in PDF format only with a maximum file size of 5 MB per document.</h5>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="business_scan_signed_contract" class="form-label">Scanned Signed
                            Contract <span class="text-danger"><sup>*</sup></span></label>
                        <input type="file"
                            class="form-control @error('business_scan_signed_contract') is-invalid @enderror"
                            wire:model="business_scan_signed_contract">
                        <span class="text-danger"> @error('business_scan_signed_contract')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="business_scan_EIN" class="form-label">Scanned EIN <span class="text-danger"><sup>*</sup></span></label>
                        <input type="file" id="business_scan_EIN" name="business_scan_EIN"
                            class="form-control" wire:model="business_scan_EIN">
                        <span class="text-danger"> @error('business_scan_EIN')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="business_scan_PAN" class="form-label">Scanned PAN <span class="text-danger"><sup>*</sup></span></label>
                        <input type="file" id="business_scan_PAN" name="business_scan_PAN"
                            class="form-control" wire:model="business_scan_PAN">
                        <span class="text-danger"> @error('business_scan_PAN')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="business_scan_registration_document" class="form-label">Scanned Business
                            Registration <span class="text-danger"><sup>*</sup></span></label>
                        <input type="file" id="business_scan_registration_document"
                            name="business_scan_registration_document" class="form-control"
                            wire:model="business_scan_registration_document">
                        <span class="text-danger"> @error('business_scan_registration_document')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="business_scan_bank_statement" class="form-label">Scanned Bank Statement
                            (Last 06 Months) <span class="text-danger"><sup>*</sup></span></label>
                        <input type="file" class="form-control" wire:model="business_scan_bank_statement">
                        <span class="text-danger"> @error('business_scan_bank_statement')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="business_scan_utility_bills" class="form-label">Scanned Utility Bills
                            (Last 03 Months)  <span class="text-danger"><sup>*</sup></span></label>
                        <input type="file" id="business_scan_utility_bills"
                            name="business_scan_utility_bills" class="form-control"
                            wire:model="business_scan_utility_bills">
                        <span class="text-danger"> @error('business_scan_utility_bills')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="business_scan_business_tax_returns" class="form-label">Business Tax
                            Returns (Last 03 Years) <span class="text-danger"><sup>*</sup></span></label>
                        <input type="file" id="business_scan_business_tax_returns"
                            name="business_scan_business_tax_returns" class="form-control"
                            wire:model="business_scan_business_tax_returns">
                        <span class="text-danger"> @error('business_scan_business_tax_returns')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="business_premises_external_pictures" class="form-label">Business Premises
                            Pictures (External) <span class="text-danger"><sup>*</sup></span></label>
                        <input type="file" id="business_premises_external_pictures"
                            name="business_premises_external_pictures" class="form-control"
                            wire:model="business_premises_external_pictures">
                        <span class="text-danger"> @error('business_premises_external_pictures')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="business_premises_internal_pictures" class="form-label">Business Premises
                            Pictures (Office) <span class="text-danger"><sup>*</sup></span></label>
                        <input type="file" class="form-control"
                            wire:model="business_premises_internal_pictures">
                        <span class="text-danger"> @error('business_premises_internal_pictures')
                                {{ $message }}
                            @enderror </span>
                    </div>

                    <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                        <button type="button" class="btn w-sm btn-secondary waves-effect waves-light" wire:click="decreaseStep">Previous</button>
                        <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Next</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
