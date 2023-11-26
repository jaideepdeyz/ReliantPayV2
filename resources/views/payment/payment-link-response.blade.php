<x-guest-base>
    {{-- create a success of failure page below --}}
    <div class="row">
        <div class="col-md-12">
           
            @switch($response['response'])
                @case(1)
                    <div class="alert alert-success">
                        <h3>Payment Success</h3>
                        <p>Payment has been successfully processed with transaction ID : {{ $response['transactionid'] }}</p>
                    </div>
                @break

                @case(2)
                    <div class="alert alert-danger">
                        <h3>Payment was declined</h3>
                        <p> Decline Description : {{ $response['responsetext'] }}
                    </div>
                @break

                @default
                    <div class="alert alert-danger">
                        <h3>Transaction caused an Error.</h3>
                        <p> Error Description : {{ $gwResponse['responsetext'] }}
                    </div>
                @break
            @endswitch

        </div>
    </div>
</x-guest-base>
