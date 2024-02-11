<div class="account-pages mt-5 mb-5" x-data="{ resendEmailCountdown: 60 }">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-pattern" style="position:relative">
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
                                        <img src="{{ asset('auth/images/adminlogo/admin-logo-light.png') }}"
                                            alt="">
                                    </span>
                                </a>
                            </div>
                        </div>
                        <form wire:submit.prevent="register">
                            <div class="row">
                                <h6 class="text-muted d-block text-center">Merchant Registration</h6>
                                <h4 class="mb-1 col-md-12">
                                    Merchant Details
                                </h4>

                                <div class="mb-3 col-md-6">
                                    <label for="merchantName" class="form-label">Merchant's Name</label>
                                    <input class="form-control @error('is-invalid') merchantName @enderror"
                                        type="text" id="name" wire:model="merchantName"
                                        wire:model="merchantName" readonly>

                                    @error('merchantName')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="merchantEmail" class="form-label">Merchant's Email</label>
                                    <input class="form-control @error('is-invalid') merchantEmail @enderror"
                                        type="text" id="name" wire:model="merchantEmail"
                                        wire:model="merchantEmail" readonly>

                                    @error('merchantEmail')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <h4 class="mb-1 col-md-12">
                                    Account Details (All fields are required)
                                </h4>

                                <div class="mb-3 col-md-4">
                                    <label for="fullname" class="form-label">Legal Name</label>
                                    <input class="form-control @error('is-invalid') name @enderror" type="text"
                                        id="name" wire:model="name" placeholder="Enter your name" required>

                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('is-invalid') password @enderror"
                                            placeholder="Enter your password" wire:model.blur="password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4">
                                    <label for="password" class="form-label">Confirm Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="confirm_password" name="password_confirmation"
                                            wire:model.blur="password_confirmation"
                                            class="form-control @error('is-invalid') password_confirmation @enderror"
                                            placeholder="Confirm your password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="text-danger mb-3">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <h4 class="mb-4 col-md-12">Mobile Verification</h4>
                                <div class="mb-3 col-md-3" class="input-group input-group-merge">
                                    <label for="phone" class="form-label">Mobile Number</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text" id="basic-addon1">+1</span>
                                        <input class="form-control @error('is-invalid') phone @enderror" type="text"
                                            id="phone" name ="phone" placeholder="Enter your mobile number"
                                            required wire:model.blur="phone"
                                            x-bind:readonly="$wire.is_phone_verified ? true : false">
                                    </div>
                                    @error('phone')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-4" x-show="$wire.is_phone_otp_sent">
                                    <label for="phone_otp" class="form-label">OTP</label>
                                    <input class="form-control @error('is-invalid') phone_otp @enderror" type="text"
                                        id="phone_otp" name ="phone_otp" wire:model="phone_otp"
                                        x-bind:readonly="$wire.is_phone_verified ? true : false"
                                        placeholder="Enter your OTP" required>
                                    @error('phone_otp')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 pt-3 col-md-4" x-show="!$wire.is_phone_otp_sent">
                                    <button class="btn btn-primary" type="button" wire:click="sendPhoneOtp()">Send
                                        OTP
                                        <span class="spinner-border text-light ml-2"
                                            style="width:0.8rem;height:0.8rem" role="status" wire:loading></span>
                                    </button>
                                </div>

                                <div class="mb-3 col-md-4" x-show="$wire.is_phone_otp_sent">
                                    <div class="row">
                                        <div class="col-md-6 mb-2 text-center">
                                            <span x-show="$wire.resendPhoneCountdown > 0">
                                                Resend OTP in {{ $resendPhoneCountdown }} seconds
                                            </span>
                                            <button class="btn btn-success" type="button"
                                                wire:click="resendPhoneOtp()"
                                                x-bind:disabled="$wire.resendPhoneCountdown > 0"
                                                x-show="$wire.resendPhoneCountdown == 0">
                                                {{-- <span > --}}
                                                Resend OTP
                                                {{-- </span> --}}
                                            </button>
                                        </div>
                                        <div class="col-md-6 mb-2 text-center">
                                            <button class="btn btn-primary" type="button"
                                                wire:click="verifyPhoneOtp()"
                                                x-bind:disabled="$wire.is_phone_verified ? true : false">Verify
                                                OTP
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-2">
                                    <p>Terms & Conditions</p>
                                    <ol>
                                        <li>By signing up, you agree to abide by our terms and conditions.</li>
                                        <li>Any false or misleading details may result in account termination.</li>
                                        <li>Keep your login details safe. Report any unauthorized access.</li>
                                        <li>Your personal info is handled per our privacy policy. We value your privacy.
                                        </li>
                                        <li>We reserve the right to terminate or suspend your account at our discretion.
                                            You will be notified of any such action taken.</li>
                                    </ol>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="terms"
                                            name="terms" required {{ $formStatus }}>
                                        <label class="form-check-label" for="terms">I accept <a
                                                href="javascript: void(0);" class="text-dark">all the Terms and
                                                Conditions</a></label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2 text-center">
                                    <button class="btn btn-success" type="submit" {{ $formStatus }}>Sign
                                        Up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50">Already have account? <a href="{{ route('login') }}"
                                class="text-white ms-1"><b>Sign In</b></a></p>
                    </div> <!-- end col -->
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.on('notify', (e) => {
                Swal.fire({
                    icon: e[0].type,
                    title: e[0].message,
                    showConfirmButton: false,
                    timer: 1500
                })
            });
            Livewire.on('startPhoneCountdown', (e) => {
                let resendInterval = setInterval(() => {

                    @this.resendPhoneCountdown--;
                    console.log(@this.resendPhoneCountdown);
                    @this.$refresh();
                    if (@this.resendPhoneCountdown == 0) {
                        clearInterval(resendInterval);
                    }
                }, 1000);
            });


        });
    </script>

</div>
