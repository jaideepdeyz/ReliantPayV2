<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Agents of {{Auth::User()->organization->business_name}}</h5>
                <span class="float-right">
                    <button class="btn btn-sm btn-primary" wire:click="addAgent">Add Agent</button>
                </span>
            </div>
            <div class="card-body">
                <h5>Default Password for new agents added is "Agent@123#"</h5>
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
                            @foreach($agents as $agent)
                            <tr>
                                <td>{{$agent->name}}</td>
                                <td>{{$agent->email}}</td>
                                <td>{{$agent->is_active}}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                    <button class="btn btn-sm btn-secondary">Deactivate</button>
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