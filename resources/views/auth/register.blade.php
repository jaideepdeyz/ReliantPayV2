<x-guest-base>
    <div class="auth-fluid" x-data="{
        password: '',
        confirm_password: '',
        otp_requested: false,
        otp_verified: false,
        resend_otp_count: 0,
        show_resend_otp: false,
        resend_otp_timer: null,
        requestOtp() {
            var phone_number = document.getElementById('phone_number').value;
            if (phone_number == '') {
                alert('Please enter your mobile number');
                return false;
            }
            axios.post('/api/sendOtp', {
                phone_number: phone_number
    
            }).then(response => {
                if (response.status == 200) {
                    this.otp_requested = true;
                    alert(response.data.message);
                } else {
                    alert(response.data.message);
                }
            }).catch(error => {
                alert(error.response.data.message);
            });
            if (this.resend_otp_count < 1) {
                this.resendOtpTimer();
            }
        },
        resendOtp() {
            if (this.resend_otp_count < 1) {
                this.resend_otp_count++;
                this.requestOtp();
            } else {
                alert('You can resend OTP only once');
            }
        },
        verifyOtp() {
            var phone_number = document.getElementById('phone_number').value;
            var otp = document.getElementById('otp').value;
            if (otp == '') {
                alert('Please enter your otp');
                return false;
            }
            axios.post('/api/verifyOtp', {
                phone_number: phone_number,
                otp: otp
    
            }).then(response => {
                if (response.status == 200) {
                    this.otp_verified = true;
                    alert(response.data.message);
                } else {
                    alert(response.data.message);
                }
            }).catch(error => {
                alert(error.response.data.message);
            });
        },
        resendOtpTimer() {
            this.resend_otp_timer = 10;
            var timer = setInterval(() => {
                this.resend_otp_timer--;
                if (this.resend_otp_timer == 0) {
                    clearInterval(timer);
                    this.show_resend_otp = true;
                }
            }, 1000);
        }
    }">
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
                    <h4 class="mt-0">Sign Up</h4>
                    <p class="text-muted mb-4">Don't have an account? Create your account, it takes less than a minute
                    </p>

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

                    <!-- form -->


                    <form method="POST" action="{{ route('register') }}">

                        @csrf

                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input class="form-control" type="text" id="name" name ="name"
                                value = "{{ old('name') }}" placeholder="Enter your name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input class="form-control" type="email" name ="email" value = "{{ old('email') }}"
                                id="email" required placeholder="Enter your email">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Enter your password" x-model="password">
                                <div class="input-group-text" data-password="false">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="confirm_password" name="password_confirmation"
                                    class="form-control" placeholder="Confirm your password" x-model="confirm_password">
                                <div class="input-group-text" data-password="false">
                                    <span class="password-eye"></span>
                                </div>
                            </div>
                            <div x-show="password !== '' && confirm_password !== '' && password !== confirm_password">
                                Passwords do not match.
                            </div>
                            <div x-show="password !== '' && confirm_password !== '' && password === confirm_password">
                                Passwords match!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Mobile Number</label>
                            <input class="form-control" type="text" id="phone_number" name ="phone_number"
                                placeholder="Enter your mobile number" required
                                x-bind:readonly="otp_requested ? true : false">
                        </div>

                        <div class="mb-3" x-show="otp_requested && !otp_verified">
                            <label for="otp" class="form-label">OTP</label>
                            <input class="form-control" type="text" id="otp" name ="otp"
                                placeholder="Enter your otp" required>
                        </div>
                        <div class="mb-3" x-show="!otp_requested">
                            <button class="btn btn-success" type="button" @click="requestOtp()">Request
                                OTP</button>

                        </div>
                        <div class="mb-3" x-show="otp_requested && !otp_verified">
                            <button class="btn btn-warning" type="button" @click="verifyOtp()">Verify
                                OTP</button>


                            <button class="btn btn-primary" type="button" @click="resendOtp()"
                                x-show="show_resend_otp">Resend
                                OTP</button>

                            <span class="d-block mt-2" x-show="resend_otp_timer"
                                x-text="'You can resend OTP in '+resend_otp_timer+' seconds'"></span>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="terms" name="terms">
                                <label class="form-check-label" for="terms">I accept <a
                                        href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                            </div>
                        </div>

                        <div class="text-center d-grid">
                            <button class="btn btn-success" type="submit" x-show="otp_verified">Sign up</button>
                        </div>

                    </form>
                    <!-- end form-->

                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">Already have account? <a href=" {{ route('login') }}"
                                class="text-muted ms-1"><b>Log In</b></a></p>
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                {{-- <h2 class="mb-3 text-white">I love the color!</h2> --}}

            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</x-guest-base>
