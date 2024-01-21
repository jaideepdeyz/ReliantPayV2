<x-dashboard-layout>
    <div class="row">
        <div class="col-md-12">
            <h1>Payment Response</h1>
            @switch($gwResponse['result'])
                @case(1)
                    <div class="card">
                        <div class="card-body">
                            <h3>Great !!</h3>
                            <br>
                            <p>Card has been charged sucessfully and details are as follows:-</p>
                            <table class="table table-sm table-striped table-bordered">
                                <tr>
                                    <th>Booking ID :</th>
                                    <td>{{ $salebooking->id }}</td>
                                </tr>
                                <tr>
                                    <th>Customer's Name :</th>
                                    <td>{{ $salebooking->customer_name }}</td>
                                </tr>
                                <tr>
                                    <th>Service Availed :</th>
                                    <td>{{ $salebooking->service->service_name }}</td>
                                </tr>
                                <tr>
                                    <th>Order ID :</th>
                                    <td>{{ $gwResponse['order-id'] }}</td>
                                </tr>
                                <tr>
                                    <th>Transaction ID :</th>
                                    <td>{{ $gwResponse['transaction-id'] }}</td>
                                </tr>
                                <tr>
                                    <th>Amount :</th>
                                    <td>{{ $gwResponse['amount'] }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Date :</th>
                                    <td>{{ $salebooking->updated_at}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="alert alert-success">
                        <h3>Great !!</h3>
                        <br>
                        <p>Card has been charged sucessfully and details are as follows:-</p>

                        <p>Transaction ID : </p>
                    </div>
                @break

                @case(2)
                    <div class="alert alert-danger">
                        <h3>Payment was declined</h3>
                        <p> Decline Description : {{ $gwResponse['result-text'] }}
                    </div>
                @break

                @default
                    <div class="alert alert-danger">
                        <h3>Transaction caused an Error.</h3>
                        <p> Error Description : {{ $gwResponse['result-text'] }}
                    </div>
            @endswitch
            {{-- XML response --}}
            {{-- <div class="card">
                <div class="card-header">
                    <h3>XML Response</h3>
                </div>
                <div class="card-body">
                    <pre>
                        <code>
                           {{ htmlentities($response) }}
                        </code>
                    </pre>
                </div>
            </div> --}}
        </div>


</x-dashboard-layout>
