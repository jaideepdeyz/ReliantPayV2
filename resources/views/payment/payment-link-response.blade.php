<x-guest-base>

    <div class="auth-fluid-form-box" id="">
        <div class="align-items-center d-flex justify-content-center h-100">
            <div class="p-3">
                <div class="auth-brand text-center text-lg-start">
                    <div class="auth-brand">
                        <a href="{{ url('/') }}" class="logo logo-dark text-center">
                            <span class="logo-lg">
                                <img src="{{ asset('auth/images/adminlogo/admin-logo-light.png') }}" alt="">
                            </span>
                        </a>

                        <a href="index.html" class="logo logo-light text-center">
                            <span class="logo-lg">
                                <img src="{{ asset('auth/images/adminlogo/admin-logo-light.png') }}" alt="">
                            </span>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        @switch($response['response'])
                            @case(1)
                                <div class="alert alert-success">
                                    <h3>Payment Success</h3>
                                    <p>Payment has been successfully processed with transaction ID :
                                        {{ $response['transactionid'] }}</p>
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
                <!-- end form-->

                <!-- Footer-->
                <footer class="footer footer-alt">
                    <p class="text-muted">Don't have an account? <a href="{{ route('register') }}"
                            class="text-muted ms-1"><b>Sign Up</b></a></p>
                </footer>

            </div>

        </div>
    </div>
 
</x-guest-base>
