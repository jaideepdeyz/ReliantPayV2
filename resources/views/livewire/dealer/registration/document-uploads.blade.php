<div class="mt-3">
    <div class="card">
        <div class="card-body">
            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 4/5: Upload Documents</h5>
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="col0-md-12 mb-2">
                        <h5 class="text-uppercase">All Documents must be PDF format only having a maximum filesize of 5 MB.</h5>
                    </div>
                    {{-- Business EIN --}}
                    <div class="mb-3 col-md-6" style="position:relative" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <label for="business_scan_EIN" class="form-label">Scanned EIN <span class="text-danger"><sup>*</sup></span></label>
                        <input type="file" id="business_scan_EIN" name="business_scan_EIN"
                            class="form-control" wire:model="business_scan_EIN">
                        <span class="text-danger"> @error('business_scan_EIN')
                                {{ $message }}
                            @enderror </span>
                        <div class="mt-1" x-show="uploading"
                        style="position:absolute;bottom:-19px;width:96%">
                        <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>

                    {{-- Business Contract  --}}
                    <div class="mb-3 col-md-6" style="position:relative" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <label for="business_scan_signed_contract" class="form-label">Scanned Signed
                            Contract <span class="text-danger"><sup>*</sup></span></label>
                        <input type="file"
                            class="form-control @error('business_scan_signed_contract') is-invalid @enderror"
                            wire:model="business_scan_signed_contract">
                        <span class="text-danger"> @error('business_scan_signed_contract')
                                {{ $message }}
                            @enderror </span>
                        <div class="mt-1" x-show="uploading"
                            style="position:absolute;bottom:-19px;width:96%">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>

                    {{-- Business PAN  --}}
                    <div class="mb-3 col-md-6">
                        <label for="business_scan_PAN"  style="position:relative" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <label for="business_scan_PAN"class="form-label">Scanned PAN <span class="text-danger"><sup>*</sup></span></label>
                        <input type="file" id="business_scan_PAN" name="business_scan_PAN"
                            class="form-control" wire:model="business_scan_PAN">
                        <span class="text-danger"> @error('business_scan_PAN')
                                {{ $message }}
                            @enderror </span>
                        <div class="mt-1" x-show="uploading"
                        style="position:absolute;bottom:-19px;width:96%">
                        <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>

                    {{-- Business Bank Statement  --}}
                    <div class="mb-3 col-md-6" style="position:relative" x-data="{ uploading: false, progress: 0 }"
                            x-on:livewire-upload-start="uploading = true"
                            x-on:livewire-upload-finish="uploading = false"
                            x-on:livewire-upload-error="uploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <label for="business_scan_bank_statement" class="form-label">Scanned Bank
                                Statement
                                (Last 06 Months) <span class="text-danger"><sup>*</sup></span></label>
                            <input type="file" class="form-control"
                                wire:model="business_scan_bank_statement">
                            <span class="text-danger"> @error('business_scan_bank_statement')
                                    {{ $message }}
                                @enderror </span>
                            <div class="mt-1" x-show="uploading"
                                style="position:absolute;bottom:-19px;width:96%">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>

                    {{-- Business Utility Bills  --}}

                    <div class="mb-3 col-md-6" style="position:relative" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <label for="business_scan_utility_bills" class="form-label">Scanned Utility Bills
                            (Last 03 Months)  <span class="text-danger"><sup>*</sup></span></label>
                        <input type="file" id="business_scan_utility_bills"
                            name="business_scan_utility_bills" class="form-control"
                            wire:model="business_scan_utility_bills">
                        <span class="text-danger"> @error('business_scan_utility_bills')
                                {{ $message }}
                            @enderror </span>
                        <div class="mt-1" x-show="uploading"
                        style="position:absolute;bottom:-19px;width:96%">
                        <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>

                        {{-- Business Registration Document  --}}
                    <div class="mb-3 col-md-6" style="position:relative" x-data="{ uploading: false, progress: 0 }"
                        x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false"
                        x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <label for="business_scan_registration_document" class="form-label">Scanned
                            Business
                            Registration <span class="text-danger"><sup>*</sup></span></label>
                        <input type="file" id="business_scan_registration_document"
                            name="business_scan_registration_document" class="form-control"
                            wire:model="business_scan_registration_document">
                        <span class="text-danger"> @error('business_scan_registration_document')
                                {{ $message }}
                            @enderror </span>
                        <div class="mt-1" x-show="uploading"
                            style="position:absolute;bottom:-19px;width:96%">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6" style="position:relative" x-data="{ uploading: false, progress: 0 }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <label for="business_scan_business_tax_returns" class="form-label">Business Tax
                        Returns (Last 03 Years) <span class="text-danger"><sup>*</sup></span></label>
                    <input type="file" id="business_scan_business_tax_returns"
                        name="business_scan_business_tax_returns" class="form-control"
                        wire:model="business_scan_business_tax_returns">
                    <span class="text-danger"> @error('business_scan_business_tax_returns')
                            {{ $message }}
                        @enderror </span>
                    <div class="mt-1" x-show="uploading"
                        style="position:absolute;bottom:-19px;width:96%">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>

                    {{-- Business External Pics --}}

                    <div class="mb-3 col-md-6" style="position:relative" x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <label for="business_premises_external_pictures" class="form-label">Business Premises
                            Pictures (External) <span class="text-danger"><sup>*</sup></span></label>
                        <input type="file" id="business_premises_external_pictures"
                            name="business_premises_external_pictures" class="form-control"
                            wire:model="business_premises_external_pictures">
                        <span class="text-danger"> @error('business_premises_external_pictures')
                                {{ $message }}
                            @enderror </span>
                            <div class="mt-1" x-show="uploading"
                        style="position:absolute;bottom:-19px;width:96%">
                        <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6" style="position:relative" x-data="{ uploading: false, progress: 0 }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <label for="business_premises_internal_pictures" class="form-label">Business
                        Premises
                        Pictures (Office) <span class="text-danger"><sup>*</sup></span></label>
                    <input type="file" id="business_premises_internal_pictures"
                        name="business_premises_internal_pictures" class="form-control"
                        wire:model="business_premises_internal_pictures">
                    <span class="text-danger"> @error('business_premises_internal_pictures')
                            {{ $message }}
                        @enderror </span>
                    <div class="mt-1" x-show="uploading"
                        style="position:absolute;bottom:-19px;width:96%">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>

                <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" wire:click="decreaseStep">Previous</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Next</button>
                </div>
                </div>
            </form>

        </div>
    </div>
</div>
