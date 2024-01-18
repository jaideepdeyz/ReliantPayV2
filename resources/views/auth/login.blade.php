<x-guest-base>
    <div class="auth-fluid">

        <!-- Auth fluid right content -->
        {{-- <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                

            </div> 
        </div> --}}
        <!-- end Auth fluid right content -->
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="p-3">

                    <!-- Logo -->
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

                    <!-- title-->
                    <h4 class="mt-0">Sign In</h4>
                    <p class="text-muted mb-4">Enter your email address and password to access account.</p>

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
                            </div>


                        </div>
                        {{-- <x-captcha /> --}}

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" checked>
                                <label class="form-check-label" for="checkbox-signin">Remember me</label>
                            </div>
                        </div>
                        

                        <div class="text-center d-grid">
                            
                            <button class="btn btn-primary" type="submit"> Log In </button>
                        </div>

                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">Don't have an account? <a href="{{ route('register') }}"
                                class="text-muted ms-1"><b>Sign Up</b></a></p>
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    {{-- <script type="text/javascript">
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script> --}}
</x-guest-base>
