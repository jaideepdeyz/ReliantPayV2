<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><button
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="btn btn-primary btn-sm">Logout</button>
                        </li>
                    </ol>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: one;">
                        {{ csrf_field() }}
                    </form>
                </div>
                <h4 class="page-title">ReliantPay | Business Registration Form</h4>
            </div>
        </div>
    </div>
    <form wire:submit="registerDealer">
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 1/5: Dealer Business Information</h5>
                            <div class="mb-3 col-md-12">
                                <label for="business_name" class="form-label">Business Name</label>
                                <input type="text" class="form-control @error('business_name') is-invalid @enderror"
                                    placeholder="Enter business name" wire:model="business_name">
                                @error('business_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="business_address" class="form-label">Address</label>
                                <textarea class="form-control @error('business_address') is-invalid @enderror" rows="4"
                                    placeholder="Enter business address" wire:model="business_address"></textarea>
                                @error('business_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="business_website" class="form-label">Website</label>
                                <input type="text"
                                    class="form-control @error('business_website') is-invalid @enderror"
                                    placeholder="Enter business website" value ="{{ old('business_website') }}"
                                    wire:model="business_website">
                                @error('business_website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="business_email" class="form-label">E-Mail</label>
                                <input type="text" class="form-control @error('business_email') is-invalid @enderror"
                                    placeholder="Enter business email" wire:model="business_email">
                                @error('business_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label for="business_phone" class="form-label">Phone</label>
                                <input type="text"
                                    class="form-control  @error('business_phone') is-invalid @enderror"
                                    placeholder="Enter business phone" wire:model="business_phone">
                                @error('business_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <h5 style="opacity:0.7">Products & Services (Please select all applicable products &
                                    services)</h5>
                            </div>
                            @foreach ($services as $service)
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <input type="checkbox" class="form-check-input"
                                            wire:model="business_product_services.{{ $service->name }}">
                                        <label for="" class="form-check-label">{{ $service->name }}</label>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-md-12 mb-3 mt-3">
                                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 2/5: Statutory Compliances</h5>
                            </div>

                            <div class="mb-3 col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"
                                        wire:model="business_PCI_DSS_compliance_status">
                                    <label class="form-check-label" for="business_PCI_DSS_compliance_status">
                                        PCI DSS Compliance
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"
                                        wire:model="business_HTTPS_compliance_status">
                                    <label class="form-check-label" for="business_HTTPS_compliance_status">
                                        HTTPS Compliance
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Step 3/5: Bank Details</h5>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_bank_account_name" class="form-label">Bank Account Name</label>
                                <input type="text" class="form-control" placeholder="Enter Bank Account Name"
                                    wire:model="business_bank_account_name">
                                <span class="text-danger"> @error('business_bank_account_name')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_bank_account_address" class="form-label">Bank Account
                                    Address</label>
                                <input type="text" class="form-control" placeholder="Enter Bank Address"
                                    wire:model="business_bank_account_address">
                                <span class="text-danger"> @error('business_bank_account_address')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_bank_name" class="form-label">Bank Name</label>
                                <input type="text" class="form-control" placeholder="Enter Bank Name"
                                    wire:model="business_bank_name">
                                <span class="text-danger"> @error('business_bank_name')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_bank_address" class="form-label">Bank Address</label>
                                <input type="text" class="form-control" placeholder="Enter Bank Address"
                                    wire:model="business_bank_address">
                                <span class="text-danger"> @error('business_bank_address')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_bank_IBAN" class="form-label">Bank IBAN</label>
                                <input type="text" class="form-control" placeholder="Enter IBAN"
                                    wire:model="business_bank_IBAN">
                                <span class="text-danger"> @error('business_bank_IBAN')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_bank_IFSC" class="form-label">Bank IFSC</label>
                                <input type="text" class="form-control" placeholder="Enter IFSC"
                                    wire:model="business_bank_IFSC">
                                <span class="text-danger"> @error('business_bank_IFSC')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_bank_SWIFT_code" class="form-label">Bank SWIFT Code</label>
                                <input type="text" class="form-control" placeholder="Enter SWIFT Code"
                                    wire:model="business_bank_SWIFT_code">
                                <span class="text-danger"> @error('business_bank_SWIFT_code')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_bank_routing_code" class="form-label">Bank Routing Code</label>
                                <input type="text" class="form-control" placeholder="Enter Routing Code"
                                    wire:model="business_bank_routing_code">
                                <span class="text-danger"> @error('business_bank_routing_code')
                                        {{ $message }}
                                    @enderror </span>
                            </div>
                            <div class="col-md-12 mb-3">
                                <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Step 4/5: Upload Documents</h5>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_scan_signed_contract" class="form-label">Scanned Signed
                                    Contract</label>
                                <input type="file"
                                    class="form-control @error('business_scan_signed_contract') is-invalid @enderror"
                                    wire:model="business_scan_signed_contract">
                                <span class="text-danger"> @error('business_scan_signed_contract')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_scan_EIN" class="form-label">Scanned EIN</label>
                                <input type="file" id="business_scan_EIN" name="business_scan_EIN"
                                    class="form-control" wire:model="business_scan_EIN">
                                <span class="text-danger"> @error('business_scan_EIN')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_scan_PAN" class="form-label">Scanned PAN</label>
                                <input type="file" id="business_scan_PAN" name="business_scan_PAN"
                                    class="form-control" wire:model="business_scan_PAN">
                                <span class="text-danger"> @error('business_scan_PAN')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_scan_registration_document" class="form-label">Scanned Business
                                    Registration</label>
                                <input type="file" id="business_scan_registration_document"
                                    name="business_scan_registration_document" class="form-control"
                                    wire:model="business_scan_registration_document">
                                <span class="text-danger"> @error('business_scan_registration_document')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_scan_bank_statement" class="form-label">Scanned Bank Statement
                                    (Last 06 Months)</label>
                                <input type="file" class="form-control" wire:model="business_scan_bank_statement">
                                <span class="text-danger"> @error('business_scan_bank_statement')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_scan_utility_bills" class="form-label">Scanned Utility Bills
                                    (Last 03 Months) </label>
                                <input type="file" id="business_scan_utility_bills"
                                    name="business_scan_utility_bills" class="form-control"
                                    wire:model="business_scan_utility_bills">
                                <span class="text-danger"> @error('business_scan_utility_bills')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_scan_business_tax_returns" class="form-label">Business Tax
                                    Returns (Last 03 Years)</label>
                                <input type="file" id="business_scan_business_tax_returns"
                                    name="business_scan_business_tax_returns" class="form-control"
                                    wire:model="business_scan_business_tax_returns">
                                <span class="text-danger"> @error('business_scan_business_tax_returns')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_premises_external_pictures" class="form-label">Business Premises
                                    Pictures (External)</label>
                                <input type="file" id="business_premises_external_pictures"
                                    name="business_premises_external_pictures" class="form-control"
                                    wire:model="business_premises_external_pictures">
                                <span class="text-danger"> @error('business_premises_external_pictures')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_premises_internal_pictures" class="form-label">Business Premises
                                    Pictures (Office)</label>
                                <input type="file" id="business_premises_internal_pictures"
                                    name="business_premises_internal_pictures" class="form-control"
                                    wire:model="business_premises_internal_pictures">
                                <span class="text-danger"> @error('business_premises_internal_pictures')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="col-md-12 mb-3">
                                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 5/5: Terms & Conditions</h5>
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

                            <div class="col-md-12 float-right">
                                <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Submit
                                    Registration Request</button>
                            </div>
                        </div>

                    </div>
                </div> <!-- end card -->
            </div> <!-- end col -->

        </div> --}}


         {{-- multipage form  --}}
        <div class="row">
            <div class="col-md-12">
                @if($currentStep==1)
                                
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 1/5: Dealer Business Information</h5>
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="business_name" class="form-label">Business Name</label>
                                    <input type="text" class="form-control @error('business_name') is-invalid @enderror"
                                        placeholder="Enter business name" wire:model="business_name">
                                    @error('business_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="mb-3 col-md-12">
                                    <label for="business_address" class="form-label">Address</label>
                                    <textarea class="form-control @error('business_address') is-invalid @enderror" rows="4"
                                        placeholder="Enter business address" wire:model="business_address"></textarea>
                                    @error('business_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="mb-3 col-md-4">
                                    <label for="business_website" class="form-label">Website</label>
                                    <input type="text"
                                        class="form-control @error('business_website') is-invalid @enderror"
                                        placeholder="Enter business website" value ="{{ old('business_website') }}"
                                        wire:model="business_website">
                                    @error('business_website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="mb-3 col-md-4">
                                    <label for="business_email" class="form-label">E-Mail</label>
                                    <input type="text" class="form-control @error('business_email') is-invalid @enderror"
                                        placeholder="Enter business email" wire:model="business_email">
                                    @error('business_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="mb-3 col-md-4">
                                    <label for="business_phone" class="form-label">Phone</label>
                                    <input type="text"
                                        class="form-control  @error('business_phone') is-invalid @enderror"
                                        placeholder="Enter business phone" wire:model="business_phone">
                                    @error('business_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-2">
                                    <h5 style="opacity:0.7">Products & Services (Please select all applicable products &
                                        services)</h5>
                                </div>
                                @foreach ($services as $service)
                                    <div class="col-md-3 mb-2">
                                        <div class="form-group">
                                            <input type="checkbox" class="form-check-input"
                                                wire:model="business_product_services.{{ $service->name }}">
                                            <label for="" class="form-check-label">{{ $service->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                                
                                <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                                    <button type="button" class="btn w-sm btn-success waves-effect waves-light" wire:click="increaseStep()">Next</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card -->

                @endif

                @if($currentStep==2)
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 2/5: Statutory Compliances</h5>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"
                                        wire:model="business_PCI_DSS_compliance_status">
                                    <label class="form-check-label" for="business_PCI_DSS_compliance_status">
                                        PCI DSS Compliance
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"
                                        wire:model="business_HTTPS_compliance_status">
                                    <label class="form-check-label" for="business_HTTPS_compliance_status">
                                        HTTPS Compliance
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                                <button type="button" class="btn w-sm btn-secondary waves-effect waves-light" wire:click="decreaseStep()">Previous</button>
                                <button type="button" class="btn w-sm btn-success waves-effect waves-light" wire:click="increaseStep()">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($currentStep==3)
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 3/5: Bank Details</h5>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="business_bank_account_name" class="form-label">Bank Account Name</label>
                                <input type="text" class="form-control" placeholder="Enter Bank Account Name"
                                    wire:model="business_bank_account_name">
                                <span class="text-danger"> @error('business_bank_account_name')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_bank_account_address" class="form-label">Bank Account
                                    Address</label>
                                <input type="text" class="form-control" placeholder="Enter Bank Address"
                                    wire:model="business_bank_account_address">
                                <span class="text-danger"> @error('business_bank_account_address')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_bank_name" class="form-label">Bank Name</label>
                                <input type="text" class="form-control" placeholder="Enter Bank Name"
                                    wire:model="business_bank_name">
                                <span class="text-danger"> @error('business_bank_name')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_bank_address" class="form-label">Bank Address</label>
                                <input type="text" class="form-control" placeholder="Enter Bank Address"
                                    wire:model="business_bank_address">
                                <span class="text-danger"> @error('business_bank_address')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_bank_IBAN" class="form-label">Bank IBAN</label>
                                <input type="text" class="form-control" placeholder="Enter IBAN"
                                    wire:model="business_bank_IBAN">
                                <span class="text-danger"> @error('business_bank_IBAN')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_bank_IFSC" class="form-label">Bank IFSC</label>
                                <input type="text" class="form-control" placeholder="Enter IFSC"
                                    wire:model="business_bank_IFSC">
                                <span class="text-danger"> @error('business_bank_IFSC')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_bank_SWIFT_code" class="form-label">Bank SWIFT Code</label>
                                <input type="text" class="form-control" placeholder="Enter SWIFT Code"
                                    wire:model="business_bank_SWIFT_code">
                                <span class="text-danger"> @error('business_bank_SWIFT_code')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_bank_routing_code" class="form-label">Bank Routing Code</label>
                                <input type="text" class="form-control" placeholder="Enter Routing Code"
                                    wire:model="business_bank_routing_code">
                                <span class="text-danger"> @error('business_bank_routing_code')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                                <button type="button" class="btn w-sm btn-secondary waves-effect waves-light" wire:click="decreaseStep()">Previous</button>
                                <button type="button" class="btn w-sm btn-success waves-effect waves-light" wire:click="increaseStep()">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($currentStep==4)
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 4/5: Upload Documents</h5>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="business_scan_signed_contract" class="form-label">Scanned Signed
                                    Contract</label>
                                <input type="file"
                                    class="form-control @error('business_scan_signed_contract') is-invalid @enderror"
                                    wire:model="business_scan_signed_contract">
                                <span class="text-danger"> @error('business_scan_signed_contract')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_scan_EIN" class="form-label">Scanned EIN</label>
                                <input type="file" id="business_scan_EIN" name="business_scan_EIN"
                                    class="form-control" wire:model="business_scan_EIN">
                                <span class="text-danger"> @error('business_scan_EIN')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_scan_PAN" class="form-label">Scanned PAN</label>
                                <input type="file" id="business_scan_PAN" name="business_scan_PAN"
                                    class="form-control" wire:model="business_scan_PAN">
                                <span class="text-danger"> @error('business_scan_PAN')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_scan_registration_document" class="form-label">Scanned Business
                                    Registration</label>
                                <input type="file" id="business_scan_registration_document"
                                    name="business_scan_registration_document" class="form-control"
                                    wire:model="business_scan_registration_document">
                                <span class="text-danger"> @error('business_scan_registration_document')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_scan_bank_statement" class="form-label">Scanned Bank Statement
                                    (Last 06 Months)</label>
                                <input type="file" class="form-control" wire:model="business_scan_bank_statement">
                                <span class="text-danger"> @error('business_scan_bank_statement')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_scan_utility_bills" class="form-label">Scanned Utility Bills
                                    (Last 03 Months) </label>
                                <input type="file" id="business_scan_utility_bills"
                                    name="business_scan_utility_bills" class="form-control"
                                    wire:model="business_scan_utility_bills">
                                <span class="text-danger"> @error('business_scan_utility_bills')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_scan_business_tax_returns" class="form-label">Business Tax
                                    Returns (Last 03 Years)</label>
                                <input type="file" id="business_scan_business_tax_returns"
                                    name="business_scan_business_tax_returns" class="form-control"
                                    wire:model="business_scan_business_tax_returns">
                                <span class="text-danger"> @error('business_scan_business_tax_returns')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_premises_external_pictures" class="form-label">Business Premises
                                    Pictures (External)</label>
                                <input type="file" id="business_premises_external_pictures"
                                    name="business_premises_external_pictures" class="form-control"
                                    wire:model="business_premises_external_pictures">
                                <span class="text-danger"> @error('business_premises_external_pictures')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="business_premises_internal_pictures" class="form-label">Business Premises
                                    Pictures (Office)</label>
                                <input type="file" id="business_premises_internal_pictures"
                                    name="business_premises_internal_pictures" class="form-control"
                                    wire:model="business_premises_internal_pictures">
                                <span class="text-danger"> @error('business_premises_internal_pictures')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                                <button type="button" class="btn w-sm btn-secondary waves-effect waves-light" wire:click="decreaseStep()">Previous</button>
                                <button type="button" class="btn w-sm btn-success waves-effect waves-light" wire:click="increaseStep()">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($currentStep==5)
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 5/5: Terms & Conditions</h5>
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
                                <button type="button" class="btn w-sm btn-secondary waves-effect waves-light" wire:click="decreaseStep()">Previous</button>
                                <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </form>
</div>
