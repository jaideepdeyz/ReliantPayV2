<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{$status}} | Dealers</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless table-nowrap table-hover table-centered m-0">
                        <thead class="table-light">
                            <tr>
                                <th>Dealer Name</th>
                                <th>Dealer Email</th>
                                <th>Dealer Phone</th>
                                <th>Dealer Address</th>
                                <th>Status</th>
                                <th>Dealer Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dealers as $dealer)
                            <tr>
                                <td>{{ $dealer->business_name }}</td>
                                <td>{{ $dealer->business_email }}</td>
                                <td>{{ $dealer->business_phone }}</td>
                                <td>{{ $dealer->business_address }}</td>
                                <td> <span class="badge bg-soft-success text-dark">{{ $dealer->status }}</span></td>
                                <td>
                                    <a href="{{route('adminActions.show', $dealer->id)}}" class="btn btn-sm btn-primary">Show | View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $dealers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>