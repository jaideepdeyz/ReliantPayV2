<div class="mt-3">
    <div class="card">
        <div class="card-body">
            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Step 2/5: Services & Statutory Compliances </h5>
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h5 style="opacity:0.7">Products & Services (Please select all applicable products &
                            services) <span class="text-danger"><sup>*</sup></span></h5>
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

                    <div class="col-md-12 mb-2">
                        <h5 style="opacity:0.7">Statutory Compliances (Please select all applicable products &
                            services) <span class="text-danger"><sup>*</sup></span></h5>
                    </div>
                    <div class="mb-3 col-md-6">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input"
                                wire:model="business_PCI_DSS_compliance_status">
                            <label class="form-check-label" for="business_PCI_DSS_compliance_status">
                                PCI DSS Compliance <span class="text-danger"><sup>*</sup></span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input"
                                wire:model="business_HTTPS_compliance_status">
                            <label class="form-check-label" for="business_HTTPS_compliance_status">
                                HTTPS Compliance <span class="text-danger"><sup>*</sup></span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary waves-effect waves-light" wire:click="decreaseStep()">Previous</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">Next</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
