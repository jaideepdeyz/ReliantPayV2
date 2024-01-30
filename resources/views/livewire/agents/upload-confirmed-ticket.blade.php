<div class="row mb-5">
    <!-- start page title -->
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item">Agent Dashboard</li>
                    <li class="breadcrumb-item active">Confirmed Ticket</li>
                </ol>
            </div>
            <h4 class="page-title">Confirmed Ticket</h4>
        </div>
    </div>
    <!-- end page title -->

    <div class="col-md-12">
        <form wire:submit="saveConfirmation">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">
                                Upload Confirmed Ticket Details
                            </h5>
                            <div class="row">
                                {{-- Departure Block --}}
                                <div class="mb-3 col-md-6">
                                    <label for="confirmation_number" class="form-label">Confirmation # <span
                                            class="text-danger"><sup>*</sup></span></label>
                                    <input type="text"
                                        class="form-control @error('confirmation_number') is-invalid @enderror"
                                        wire:model="confirmation_number">
                                    @error('confirmation_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6" style="position:relative"
                                    x-data="{ uploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="uploading = true"
                                    x-on:livewire-upload-finish="uploading = false"
                                    x-on:livewire-upload-error="uploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <label for="ticket_filepath" class="form-label">Confirmed Ticket (only in PDF format)
                                        <span class="text-danger"><sup>*</sup></span></label>
                                    <input type="file"
                                        class="form-control @error('ticket_filepath') is-invalid @enderror"
                                        wire:model="ticket_filepath">
                                    <span class="text-danger"> @error('ticket_filepath')
                                        {{ $message }}
                                        @enderror </span>
                                    <div class="mt-1" x-show="uploading"
                                        style="position:absolute;bottom:-19px;width:96%">
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-12 action-buttons d-flex justify-content-between">
                                    <button type="submit"
                                        class="btn w-sm btn-success waves-effect waves-light px-4 py-2">Upload and Send Email</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>




</div>
