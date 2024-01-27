<x-guest-base>
    <div class="account-pages mt-5 mb-5" x-data="register">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-brand mb-0">
                                    <a href="{{ url('/') }}" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('auth/images/adminlogo/admin-logo-light.png') }}"
                                                alt="">
                                        </span>
                                    </a>

                                    <a href="{{ url('/') }}" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('auth/images/adminlogo/admin-logo-dark.png') }}"
                                                alt="">
                                        </span>
                                    </a>
                                </div>
                                <h4 class="mt-0">Sign In</h4>
                                <p class="text-muted mb-4">Enter your email address and password to access account.</p>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <ul>
                                            <li>
                                                {{ $error }}
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            @endif

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input class="form-control" type="email" id="email" name="email" required=""
                                        placeholder="Enter your email">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="Enter your password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter Password.
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remember" name="remember" checked>
                                        <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div>

                                <div class="text-center d-grid mb-3">
                                    <a href="{{route('resetPassword')}}">Forgot Password ? Click here to reset</a>
                                </div>

                                <div class="text-center d-grid">
                                    <button class="btn btn-success" type="submit">Sign
                                        In</button>
                                </div>
                                {!! RecaptchaV3::field('login') !!}

                                <p class="text-muted mt-3">Don't have an account? <a href="{{ route('register') }}"
                                        class="text-muted ms-1"><b>Sign Up</b></a></p>
                            </form>
                            <!-- Footer-->

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
</x-guest-base>
