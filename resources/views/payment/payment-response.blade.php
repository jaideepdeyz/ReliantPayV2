<x-dashboard-layout>
    <div class="row">
        <div class="col-md-12">
            <h1>Payment Response</h1>
            @switch($gwResponse['result'])
                @case(1)
                    <div class="alert alert-success">
                        <h3>Payment Success</h3>
                        <p>Payment has been successfully processed.</p>
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
