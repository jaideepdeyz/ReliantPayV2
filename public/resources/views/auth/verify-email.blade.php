@extends('layouts.guest.guest-base')
@section('content')

 <div class="auth-fluid">

             <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    {{-- <h2 class="mb-3 text-white">I love the color!</h2> --}}
                
                </div> <!-- end auth-user-testimonial-->
            </div>
            <!-- end Auth fluid right content -->
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="p-3">

                        <!-- Logo -->
                        <div class="auth-brand text-center text-lg-start">
                            <div class="auth-brand">
                                <a href="index.html" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset ('auth/images/adminlogo/admin-logo-light.png') }}" alt="" >
                                    </span>
                                </a>
            
                                <a href="index.html" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset ('auth/images/adminlogo/admin-logo-light.png') }}" alt="">
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- title-->
                        <h4 class="mt-0">You must verify your email address, please check your email for a verification link</h4>
                        {{-- <p class="text-muted mb-4">Your email id is not verified. Please click on verify and check your email to access your account.</p> --}}

                        @if ($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            @foreach ($errors->all() as $error)
                                                <ul>
                                                    <li>
                                                        {{$error}}
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </div>
                                    @endif

                            @if(session('status'))

                                        <div class="alert alert-success" role="alert">
                                            {{ session('status')}}
                                        </div>


                            @endif

                                <form method="POST" action="{{ route('verification.send')}}">
                                    
                                    @csrf

                                    

                                    <div class="text-center d-grid">
                                        <button class="btn btn-primary" type="submit"> Re-send Verification Link </button>
                                    </div>

                                </form>
                        <!-- end form-->

                        <!-- Footer-->
                        <footer class="footer footer-alt">
                            <p class="text-muted">Don't have an account? <a href="{{ route('register')}}" class="text-muted ms-1"><b>Sign Up</b></a></p>
                        </footer>

                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->

           
        </div>


@stop