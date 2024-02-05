<div class="row">
    <!-- start page title -->
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                    <li class="breadcrumb-item active">Admin Dashboard</li>
                </ol>
            </div>
            <h4 class="page-title">Admin Dashboard</h4>
        </div>
    </div>
    <!-- end page title -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header pb-1">
                <h5 class="d-inline header-title mb-0">Affilates List</h5>
                <span class="float-right">
                    <button class="btn btn-blue"
                    wire:click="$dispatch('showModal',{data: {'alias' : 'modals.add-affiliate'}})"
                    
                    ><svg xmlns="http://www.w3.org/2000/svg"
                            width="12" height="12" fill="currentColor" class="bi bi-plus-circle-fill"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                        </svg> Add Affilate</button>
                </span>
            </div>
            <div class="card-body">

                <div class="">
                    <table class="table table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Affilate Code</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($affiliates as $affiliate)
                            <tr>
                                <td>{{ $affiliate->affiliate_name }}</td>
                                <td>{{ $affiliate->affiliate_email }}</td>
                                <td>{{ $affiliate->affiliate_phone }}</td>
                                <td>{{ $affiliate->affiliate_code }}</td>
                                <td>
                                    {{-- edit --}}
                                    <button class="btn btn-blue btn-sm"
                                    wire:click="$dispatch('showModal',{data: {'alias' : 'modals.add-affiliate','params':{ 'id' : '{{ $affiliate->id }}'} }})"
                                    ><svg xmlns="http://www.w3.org/2000/svg"
                                            width="12" height="12" fill="currentColor" class="bi bi-pencil"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M12.793 1.793a1 1 0 0 1 1.414 1.414l-10 10a1 1 0 0 1-1.414-1.414l10-10zm1 1a1 1 0 0 0-1.414-1.414l-10 10a1 1 0 0 0 1.414 1.414l10-10z" />
                                            <path fill-rule="evenodd"
                                                d="M13.854 3.146a.5.5 0 0 1 0 .708L12.707 4.5 11.5 3.293l1.146-1.146a.5.5 0 0 1 .708 0zm-1.708.708a.5.5 0 0 0 0-.708L11.293 3.5 12.5 4.707l.146-.146z" />
                                            <path fill-rule="evenodd"
                                                d="M2.5 13.5a1 1 0 0 1 1-1h8a1 1 0 0 1 0 2h-8a1 1 0 0 1-1-1z" />
                                        </svg> Edit</button>
                                    {{-- delete --}}
                                </td>
                           
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-toast-livewire />
</div>