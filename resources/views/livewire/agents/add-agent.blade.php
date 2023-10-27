<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header pb-1">
                <h5 class="d-inline card-header px-0">Agents of {{ Auth::User()->organization->business_name }}</h5>
                <span class="float-right">
                    <button class="btn btn-sm btn-primary" wire:click="addAgent">Add Agent</button>
                </span>
            </div>
            <div class="card-body">
                <h5 class="text-danger">Default Password for new agents added is "Agent@123#"</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agents as $agent)
                                <tr>
                                    <td>{{ $agent->name }}</td>
                                    <td>{{ $agent->email }}</td>
                                    <td>{{ $agent->is_active }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Edit</button>
                                        <button
                                            class="btn btn-sm {{ $agent->is_active == 'Yes' ? 'btn-danger' : 'btn-info' }}"
                                            wire:click='activateDeactivate({{ $agent->id }})'>{{ $agent->is_active == 'Yes' ? 'Deactivate' : 'Activate' }}</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
