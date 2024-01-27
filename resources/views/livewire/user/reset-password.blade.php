<div class="account-pages mt-5 mb-5" x-data="{ resendEmailCountdown: 60 }">
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

                                <a href="{{url('/')}}" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('auth/images/adminlogo/admin-logo-light.png') }}"
                                            alt="">
                                    </span>
                                </a>
                            </div>
                        </div>
                        <form wire:submit.prevent="resetPassword">
                            @if($is_email_verified == false)
                            <div class="row">
                                <h4 class="mb-4 text-center">Reset Password</h4>
                                <div class="mb-3 col-md-12">
                                    <label for="email" class="form-label">Email address</label>
                                    <input class="form-control @error('is-invalid') email @enderror" type="email" name ="email" wire:model.blur="email"
                                        id="email" required placeholder="Enter your registered email">
                                    @error('email')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12" x-show="$wire.is_email_otp_sent">
                                    <label for="email" class="form-label">OTP</label>
                                    <input class="form-control @error('is-invalid') email_otp @enderror" type="text" wire:model.blur="email_otp" required
                                        placeholder="Enter your OTP"
                                        x-bind:readonly="$wire.is_email_verified ? true : false">
                                    @error('email_otp')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3 text-center">
                                    <button class="btn btn-success sendEmailOtp" type="button" wire:click="sendEmailOtp()"
                                    x-show="!$wire.is_email_otp_sent">Send OTP to
                                    email</button>
                                </div>

                                <div x-show="$wire.is_email_otp_sent" class= "mb-2 row">
                                    <div class="col-md-6 text-center">
                                        <span x-show="$wire.resendEmailCountdown > 0">
                                            Resend OTP in {{ $resendEmailCountdown }} seconds
                                        </span>
                                        <button class="btn btn-success" type="button" wire:click="resendEmailOtp()"
                                        x-bind:disabled="$wire.resendEmailCountdown > 0" x-show="$wire.resendEmailCountdown == 0">
                                            {{-- <span x-show="$wire.resendEmailCountdown == 0"> --}}
                                                Resend OTP
                                            {{-- </span> --}}
                                        </button>
                                    </div>
                                    <div class="col-md-6 mb-2 text-right">
                                        <button class="btn btn-primary verifyEmailOtp" type="button"
                                            wire:click="verifyEmailOtp()" x-show="$wire.is_email_otp_sent"
                                            x-bind:disabled="$wire.is_email_verified ? true : false">Verify
                                            OTP
                                        </button>
                                    </div>
                                </div>

                            </div>

                            @elseif($is_email_verified == true)
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">New Password</label>
                                    <input type="password" wire:model="password" class="form-control @error('is-invalid') password @enderror">
                                    @error('password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3 text-center">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50">Already have account? <a href="{{route('login')}}"
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
            Livewire.on('startEmailCountdown', (e) => {



                let resendInterval = setInterval(() => {

                    @this.resendEmailCountdown--;
                    console.log(@this.resendEmailCountdown);
                    @this.$refresh();


                    if (@this.resendEmailCountdown == 0) {
                        clearInterval(resendInterval);
                    }
                }, 1000);

            });
        });
    </script>

</div>
