<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                        <li class="breadcrumb-item">Dealer Dashboard</li>
                        <li class="breadcrumb-item active">Manage Customers</li>
                    </ol>
                </div>
                <h4 class="page-title">Manage Customers</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="header-title">
                                Customers
                            </h4>
                        </div>
                        <div class="text-sm-end col-md-8">
                            {{-- <a href="javascript:void(0);" class="btn btn-blue" data-bs-toggle="modal"
                                data-bs-target="#Countries"><svg xmlns="http://www.w3.org/2000/svg" width="12"
                                    height="12" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                                </svg> Add
                                Dealer </a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row mb-3">
                        <div class="row mt-3 d-flex justify-content-between">

                            <div class="col-md-8">
                                <form class="form-floating">
                                    <input type="text" class="form-control" wire:model.live.debounce.300ms="search"
                                        placeholder="Search...">
                                    <label for="">Search</label>
                                </form>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select wire:model.live="perPage" class="form-select" id="floatingSelect"
                                        aria-label="Floating label select example">
                                        <option value="10">10 Records</option>
                                        <option value="20">20 Records</option>
                                        <option value="50">50 Records</option>
                                        <option value="100">100 Records</option>
                                    </select>
                                    <label for="floatingSelect">Page Size</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row mb-3">
                        @if ($customers->count() > 0)
                        <div class="flex">
                            <table class="table table-hover table-striped table-borderless wrap table-fixed">
                                <thead class="table-light">
                                    <tr>
                                        <th>Sale ID</th>
                                        <th>Customer's Name</th>
                                        <th>Customer's Email</th>
                                        <th>Customer's Contact #</th>
                                        <th>Service Availed</th>
                                        <th>Service Amount</th>
                                        {{-- <th class="col-md-1 text-center">Action</th> --}}
                                    </tr>
                                </thead>


                                <tbody>


                                    @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{$customer->id}}</td>
                                        <td>{{$customer->customer_name}}</td>
                                        <td>{{$customer->customer_email}}</td>
                                        <td>{{$customer->customer_phone}}</td>
                                        <td>{{$customer->service->service_name}}</td>
                                        <td>{{$customer->amount_charged}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end">
                                {{ $customers->links() }}
                            </div>

                        </div>
                        @else
                        <p>No data found!!</p>
                        @endif
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->


    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="Countries" tabindex="-1" aria-labelledby="CountriesLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CountriesLabel">Create Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModal"></button>
                </div>


                <form wire:submit.prevent="saveCountries">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Country Name</label>
                            <input type="text" wire:model="name" class="form-control">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Country Code</label>
                            <input type="text" wire:model="code" class="form-control">
                            @error('code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Flag icon</label>
                            <input type="text" wire:model="flagimage" class="form-control">
                            @error('flagimage')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Update Country Modal -->
    <div wire:ignore.self class="modal fade" id="updateCountries" tabindex="-1" aria-labelledby="updateCountriesLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCountriesLabel">Edit Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                        aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="updateCountries">
                    <div class="modal-body">
                        <div class="mb-3" style="display:none;">
                            <label>country id</label>
                            <input type="text" wire:model="country_id" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Country Name</label>
                            <input type="text" wire:model="name" class="form-control">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Country Code</label>
                            <input type="text" wire:model="code" class="form-control">
                            @error('code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Flag icon</label>
                            <input type="text" wire:model="flagimage" class="form-control">
                            @error('flagimage')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Country Modal -->
    <div wire:ignore.self class="modal fade" id="deleteCountries" tabindex="-1" aria-labelledby="deleteCountriesLabel"
        aria-hidden="true" x-data="{ livewire: false }">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCountriesLabel">Delete Country</h5>
                    <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyCountry">
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this data ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes! Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    {{-- @section('scripts') --}}
    <script>
        window.addEventListener('close-modal', event => {
            console.log('close-modal event received:', event);
            $('#Countries').modal('hide');
            $('#updateCountries').modal('hide');
            $('#deleteCountries').modal('hide');
        })
    </script>

</div>
