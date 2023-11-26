<x-guest-base>

    <script src="https://secure.nationalprocessinggateway.com/token/Collect.js"
        data-tokenization-key="YjdVSz-jg23c4-45a5qu-rqMhWD" data-variant="inline"
        data-field-ccnumber-placeholder='000 0000 0000 0000' data-field-ccexp-placeholder='10/29'
        data-field-cvv-placeholder='123' data-fields-available-callback="(function() {
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('payment-form').style.visibility = 'visible';
                })"

         data-custom-css='{
                    "font-size": "16px",
                    "color": "#000000",
                    "font-family": "Arial",
                    "font-weight": "400",
                    "line-height": "1.5",
                    "letter-spacing": "0.32px",
                    "padding": "10px 14px",
                    "border": "1px solid #ced4da",
                    "border-radius": "4px",
                    "background-color": "#ffffff",
                    "background-clip": "padding-box",
                    "transition": "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out"
                }'
             
                
        ></script>
    <div class="auth-fluid-form-box" id="">
        <div class="align-items-center d-flex justify-content-center h-100">
            <div class="p-3">
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
                <h4 class="mt-0">Make Payment</h4>
                <p class="text-muted mb-4">Enter your card details to make payment of
                    <b>${{ $salebooking->payment->amount_charged }}</b>
                </p>
                <div class="spinner-border text-primary text-center" role="status" id="loading">
                    <span class="visually-hidden text-center">Loading...</span>
                </div>

                <form action="{{ route('makePaymentLinkPayment') }}" method="POST" id="payment-form"
                    style="visibility:hidden;">
                    @csrf
                    <input type="hidden" name="decodedId" value="{{ $decodedId }}">
                    <div class="mb-3">
                        <label for="cardnumber" class="form-label">Card Number</label>
                        <div id="ccnumber"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cardexpiry" class="form-label">Card Expiry</label>
                            <div id="ccexp"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cardcvv" class="form-label">Card CVV</label>
                            <div id="cvv"></div>
                        </div>
                    </div>
                    <div class="mt-3 d-grid">
                        <button class="btn btn-primary waves-effect waves-light" type="submit" id="payButton">Make
                            Payment</button>
                    </div>
                </form>

                <!-- end form-->

                <!-- Footer-->
                <footer class="footer footer-alt">
                    <p class="text-muted">Don't have an account? <a href="{{ route('register') }}"
                            class="text-muted ms-1"><b>Sign Up</b></a></p>
                </footer>

            </div>

        </div>
    </div>
    <script></script>
</x-guest-base>
