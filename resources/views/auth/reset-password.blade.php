@extends('layouts.guest-base')
@section('content')

 <div class="auth-fluid">

             <!-- Auth fluid right content -->
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    {{-- <h2 class="mb-3 text-white">I love the color!</h2> --}}
                    <p class="lead"><i class="mdi mdi-format-quote-open"></i> 
                        Anyone who is steady in his determination for the advanced stage of spiritual realization and can equally tolerate the onslaughts of distress and happiness is certainly a person eligible for liberation <i class="mdi mdi-format-quote-close">

                        </i>
                    </p>
                    <h5 class="text-white">
                        - A.C. Bhaktivedanta Swami Prabhupada, The Bhagavad-gita
                    </h5>
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
                        <h4 class="mt-0">Set Password</h4>
                        <p class="text-muted mb-4">Enter your email address and password to access account.</p>

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

                        <form method="POST" action="{{ route('password.update')}}">
                                    
                         @csrf

                                    <input type="hidden" name="token" value={{ $request->route('token') }}>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input class="form-control" type="email" id="email" name="email" required="" value={{ $request->email }}>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">New Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>


                                <div class="mb-3">
                                    <label for="password" class="form-label">Confirm New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="confirm_password" name="password_confirmation" class="form-control" placeholder="Confirm your password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                                         

                                    </div>

                                  

                                    <div class="text-center d-grid">
                                        <button class="btn btn-primary" type="submit"> Update Password </button>
                                    </div>

                                </form>
                        <!-- end form-->

                        <!-- Footer-->
                       

                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->

           
        </div>


@stop