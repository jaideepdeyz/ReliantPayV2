<x-guest-base>
    <div class="account-pages mt-5 mb-5" x-data="register">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card bg-pattern" style="height:620px;position:relative">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-brand mb-0">
                                    <a href="{{ url('/') }}" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('auth/images/adminlogo/admin-logo-light.png') }}"
                                                alt="">
                                        </span>
                                    </a>

                                    <a href="index.html" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('auth/images/adminlogo/admin-logo-light.png') }}"
                                                alt="">
                                        </span>
                                    </a>
                                </div>
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

                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="block1">
                                    <h6 class="text-muted d-block text-center">Step 1</h6>
                                    <h4 class="mb-1 text-center">
                                        Account Details
                                    </h4>
                                    <div class="mb-3">
                                        <label for="fullname" class="form-label">Full Name</label>
                                        <input class="form-control" type="text" id="name" name ="name"
                                            value = "{{ old('name') }}" placeholder="Enter your name" required>
                                        <div class="invalid-feedback">
                                            Please enter full name.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Enter your password" x-model="password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter Password.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Confirm Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="confirm_password" name="password_confirmation"
                                                class="form-control" placeholder="Confirm your password"
                                                x-model="confirm_password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                            <div class="invalid-feedback passwordValidation">
                                                Please enter Password confirmation.
                                            </div>
                                        </div>
                                        {{-- <div
                                            x-show="password !== '' && confirm_password !== '' && password !== confirm_password">
                                            Passwords do not match.
                                        </div>
                                        <div
                                            x-show="password !== '' && confirm_password !== '' && password === confirm_password">
                                            Passwords match!
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="block2 d-none">
                                    <h6 class="text-muted d-block text-center">Step 2</h6>
                                    <h4 class="mb-4 text-center">Email Verification</h4>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input class="form-control" type="email" name ="email"
                                            value = "{{ old('email') }}" id="email" required
                                            placeholder="Enter your email">
                                        <div class="invalid-feedback emailValidation">
                                        </div>
                                    </div>
                                    <div class="mb-3 d-none">
                                        <label for="email" class="form-label">OTP</label>
                                        <input class="form-control" type="text" name ="emailOtp"
                                            value = "{{ old('emailOtp') }}" id="email" required
                                            placeholder="Enter your otp">
                                        <div class="invalid-feedback emailOtp">
                                        </div>
                                    </div>
                                    <button class="btn btn-success sendEmailOtp" type="button">Send OTP to
                                        email</button>
                                    <img src="{{ asset('img/email.gif') }}" alt=""
                                        class="mt-1 sendEmailGif d-none" width="40">
                                </div>


                                <div class="block3 d-none">
                                    <h6 class="text-muted d-block text-center">Step 3</h6>
                                    <h4 class="mb-4 text-center">Mobile Verification</h4>
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">Mobile Number</label>
                                        <input class="form-control" type="text" id="phone_number"
                                            name ="phone_number" placeholder="Enter your mobile number" required
                                            x-bind:readonly="otp_requested ? true : false">
                                        <div class="invalid-feedback">
                                            Please enter mobile number.
                                        </div>
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
                                </div>
                                <div class="btnBottom" style="position:absolute;bottom:30px;width:85%">
                                    <button class="btn btn-secondary btnBack d-none" type="button"><i
                                            class="bi bi-arrow-left-circle-fill"></i> Back</button>
                                    <button class="btn btn-primary btnProceed" style="float:right" type="button"><i
                                            class="bi bi-arrow-right-circle-fill"></i> Proceed</button>
                                </div>

                                <div class="block4 d-none">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="terms"
                                                name="terms">
                                            <label class="form-check-label" for="terms">I accept <a
                                                    href="javascript: void(0);" class="text-dark">Terms and
                                                    Conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="text-center d-grid">
                                        <button class="btn btn-success" type="submit" x-show="otp_verified">Sign
                                            up</button>
                                    </div>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-white-50">Already have account? <a href="auth-login.html"
                                    class="text-white ms-1"><b>Sign In</b></a></p>
                        </div> <!-- end col -->
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->
    <script>
        var steps = 0;
        // $('.sendEmailOtp').click(function() {
        //     $('.sendEmailGif').removeClass('d-none');
        //     $('.sendEmailOtp').html('Sending OTP...');
        // });

        $('.btnProceed').click(function() {
            steps++;
            if (steps == 1) {
                //loop through block1 inputs and check if valid
                var valid = true;
                $('.block1 input').each(function() {
                    if ($(this).val() == '') {
                        valid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                //check if passwords match
                $('.block1 input[type="password"]').each(function() {
                    if ($(this).val() != $('.block1 input[type="password"]').eq(0).val()) {
                        valid = false;
                        $(this).addClass('is-invalid');
                        $('.passwordValidation').html('Passwords do not match.');
                    } else {
                        $('.passwordValidation').html('Please enter password confirmation.');
                    }
                });
                if (!valid) {
                    steps--;
                    return false;
                }
                $('.block1').addClass('d-none');
                $('.block2').removeClass('d-none');
                $('.btnBack')
                    .removeClass('d-none');
            } else if (steps == 2) {
                var valid = true;
                $('.block2 input').each(function() {
                    if ($(this).val() == '') {
                        valid = false;
                        $(this).addClass('is-invalid');
                        $('.emailValidation').html('Please enter an email address');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                var email = $('.block2 input[type="email"]').val();
                if (email != '') {
                    if (!validateEmail(email)) {
                        valid = false;
                        $('.block2 input[type="email"]').addClass('is-invalid');
                        $('.emailValidation').html('Please enter a valid email address.');
                    } else {
                        $('.block2 input[type="email"]').removeClass('is-invalid');
                    }
                }

                function validateEmail(email) {
                    var re = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    return re.test(String(email).toLowerCase());
                }

                if (!valid) {
                    steps--;
                    return false;
                }
                $('.block2').addClass('d-none');
                $('.block3').removeClass('d-none');
            } else if (steps == 3) {
                var valid = true;
                $('.block3 input').each(function() {
                    if ($(this).val() == '') {
                        valid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                if (!valid) {
                    steps--;
                    return false;
                }
                $('.block3').addClass('d-none');
                $('.block4').removeClass('d-none');
            }
        });
        $('.btnBack').click(function() {
            steps--;
            if (steps == 0) {
                $('.block2').addClass('d-none');
                $('.block1').removeClass('d-none');
                $('.btnBack').addClass('d-none');
            } else if (steps == 1) {
                $('.block3').addClass('d-none');
                $('.block2').removeClass('d-none');
            } else if (steps == 2) {
                $('.block4').addClass('d-none');
                $('.block3').removeClass('d-none');
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('register', () => ({
                password: '',
                confirm_password: '',
                otp_requested: false,
                otp_verified: false,
                resend_otp_count: 0,
                show_resend_otp: false,
                resend_otp_timer: null,
                requestOtp() {
                    var phone_number = document.getElementById('phone_number').value;
                    // if (phone_number == '') {
                    //     $(this).addClass('is-invalid');
                    //     return false;
                    // } else {
                    //     $(this).removeClass('is-invalid');
                    // }
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
            }))
        })
    </script>
</x-guest-base>
