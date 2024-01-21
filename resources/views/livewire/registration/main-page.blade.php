<div class="account-pages mt-5 mb-5">
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
                        <form wire:submit.prevent="register">

                            <div class="block1" x-show="$wire.step == 1">
                                <h6 class="text-muted d-block text-center">Step 1</h6>
                                <h4 class="mb-1 text-center">
                                    Account Details
                                </h4>
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input class="form-control" type="text" id="name" wire:model="name"
                                        placeholder="Enter your name" required>
                                    <div class="invalid-feedback">
                                        Please enter full name.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="Enter your password" wire:model="password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Confirm Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="confirm_password" name="password_confirmation"
                                            wire:model="password_confirmation" class="form-control"
                                            placeholder="Confirm your password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                        <div class="invalid-feedback passwordValidation">
                                            Please enter Password confirmation.
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="block2" x-show="$wire.step == 2">
                                <h6 class="text-muted d-block text-center">Step 2</h6>
                                <h4 class="mb-4 text-center">Email Verification</h4>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input class="form-control" type="email" name ="email" wire:model="email"
                                        id="email" required placeholder="Enter your email">
                                    <div class="invalid-feedback emailValidation">
                                    </div>
                                </div>
                                <div class="mb-3" x-show="$wire.is_email_otp_sent">
                                    <label for="email" class="form-label">OTP</label>
                                    <input class="form-control" type="text" wire:model="email_otp" required
                                        placeholder="Enter your otp"
                                        x-bind:readonly="$wire.is_email_verified ? true : false">
                                    <div class="invalid-feedback emailOtp">
                                    </div>
                                </div>
                                <button class="btn btn-success sendEmailOtp" type="button" wire:click="sendEmailOtp()"
                                    x-show="!$wire.is_email_otp_sent">Send OTP to
                                    email</button>
                                <button class="btn btn-warning verifyEmailOtp" type="button"
                                    wire:click="verifyEmailOtp()" x-show="$wire.is_email_otp_sent"
                                    x-bind:disabled="$wire.is_email_verified ? true : false">Verify
                                    OTP</button>
                                {{-- <img src="{{ asset('img/email.gif') }}" alt=""
                                    class="mt-1 sendEmailGif d-none" width="40"> --}}

                            </div>


                            <div class="block3 " x-show="$wire.step==3">
                                <h6 class="text-muted d-block text-center">Step 3</h6>
                                <h4 class="mb-4 text-center">Mobile Verification</h4>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Mobile Number</label>
                                    <input class="form-control" type="text" id="phone" name ="phone"
                                        placeholder="Enter your mobile number" required wire:model="phone"
                                        x-bind:readonly="$wire.is_phone_verified ? true : false">
                                    <div class="invalid-feedback">
                                        Please enter mobile number.
                                    </div>
                                </div>

                                <div class="mb-3" x-show="$wire.is_phone_otp_sent">
                                    <label for="phone_otp" class="form-label">OTP</label>
                                    <input class="form-control" type="text" id="phone_otp" name ="phone_otp"
                                        wire:model="phone_otp"
                                        x-bind:readonly="$wire.is_phone_verified ? true : false"
                                        placeholder="Enter your otp" required>
                                </div>
                                <div class="mb-3" x-show="!$wire.is_phone_otp_sent">
                                    <button class="btn btn-success" type="button" wire:click="sendPhoneOtp()"
                                       >Request
                                        OTP</button>
                                </div>
                                <div class="mb-3" x-show="$wire.is_phone_otp_sent">
                                     <button class="btn btn-warning" type="button"
                                    wire:click="verifyPhoneOtp()"
                                    x-bind:disabled="$wire.is_phone_verified ? true : false">Verify
                                    OTP</button>
                                </div>
                            </div>


                            <div class="block4 " x-show="$wire.step==4">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="terms"
                                            name="terms" required>
                                        <label class="form-check-label" for="terms">I accept <a
                                                href="javascript: void(0);" class="text-dark">Terms and
                                                Conditions</a></label>
                                    </div>
                                </div>
                                <div class="text-center d-grid">
                                    <button class="btn btn-success" type="submit" >Sign
                                        up</button>
                                </div>
                            </div>
                       
                            <div class="btnBottom" style="position:absolute;bottom:30px;width:85%">
                                <button class="btn btn-secondary btnBack " type="button"
                                x-show="$wire.step > 1" wire:click="gotoPreviousStep"
                                ><i
                                        class="bi bi-arrow-left-circle-fill"></i> Back</button>
                                <button class="btn btn-primary btnProceed" style="float:right" type="button"
                                x-show="$wire.step < 4" wire:click="gotoNextStep"
                                ><i
                                        class="bi bi-arrow-right-circle-fill"></i> Proceed</button>
                            </div>
                           
                        </form>
                    </div>
                </div>


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
