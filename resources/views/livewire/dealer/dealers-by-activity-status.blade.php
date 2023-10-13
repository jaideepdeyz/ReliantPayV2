<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{$label}} | Dealers</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless table-nowrap table-hover table-centered m-0">
                        <thead class="table-light">
                            <tr>
                                <th>Dealer Name</th>
                                <th>Dealer Email</th>
                                <th>Dealer Phone</th>
                                <th>Dealer Address</th>
                                <th>Login Active</th>
                                <th>Dealer Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->organization->business_name }}</td>
                                <td>{{ $user->organization->business_email }}</td>
                                <td>{{ $user->organization->business_phone }}</td>
                                <td>{{ $user->organization->business_address }}</td>
                                <td> <span class="badge bg-soft-success text-dark">{{ $user->is_active }}</span></td>
                                <td>
                                    <a href="{{route('adminActions.show', $user->organization->id)}}" class="btn btn-sm btn-primary">Show | View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>