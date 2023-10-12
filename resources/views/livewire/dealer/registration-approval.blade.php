<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Dealer Registration Requests</div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Dealer Name</th>
                            <th>Dealer Email</th>
                            <th>Dealer Phone</th>
                            <th>Dealer Address</th>
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
