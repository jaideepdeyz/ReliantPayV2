@extends('layouts.auth.auth-base')
@section('content')

 <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="auth-brand">
                                    <a href="#" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset ('auth/images/adminlogo/admin-logo-light.png') }}" alt="">
                                        </span>
                                    </a>
                
                                    <a href="#" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset ('auth/images/adminlogo/admin-logo-light.png') }}" alt="">
                                        </span>
                                    </a>
                                </div>

                                <div class="text-center mt-4">
                                    {{-- <h2 class="text-error">Oh! Kṛṣṇa!!</h2> --}}
                                    <h3 class="mt-3 mb-2">Invalid Logout Encountered</h3>
                                    <p class="text-muted mb-3">You seem to have not logged out properly in your last session.</p>

                                    <a href="{{ route('logout') }}" class="btn btn-success waves-effect waves-light" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log me out please!</a>
                                
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                
                                </div>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

@stop

{{-- <html>
    <head></head>
<body>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
</form>
</body>
</html> --}}