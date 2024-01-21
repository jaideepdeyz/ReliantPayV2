<x-dashboard-layout>
    <div class="row mt-2">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Reliant Pay</a></li>
                        <li class="breadcrumb-item active">Agent Dashboard</li>
                        <li class="breadcrumb-item active">Authorized Sales</li>
                        <li class="breadcrumb-item active">Charge Card</li>
                    </ol>
                </div>
                <h4 class="page-title">Agent Dashboard</h4>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-6 ">
                        <form action="{{ $formUrl }}" method="post" id="payment-form">
                            <div class="form-group mt-2">
                                <label for="name">Card Number</label>
                                <input type="text" name="billing-cc-number" id="billing-cc-number" class="form-control"
                                    placeholder="Enter card Number" minlength="16" maxlength="16"
                                    value="{{ $salebooking->payment->cc_number }}" required>
                            </div>
                            <div class="form-group mt-2">

                                <label for="name">Expiration Date</label>
                                <input type="text" name="billing-cc-exp" id="billing-cc-exp" class="form-control"
                                    placeholder="MM/YY" required pattern="([0-9]{2}[/]?){2}" />
                            </div>
                            <div class="form-group mt-2">
                                <label for="name">CVV</label>
                                <input type="password" name="cvv" id="cvv" class="form-control"
                                    placeholder="Enter card CVV" minlength="3" maxlength="3" required>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">Charge Card</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        var expDate = document.getElementById('billing-cc-exp');
        expDate.onkeyup = function(e) {
            if (this.value == this.lastValue) return;
            var caretPosition = this.selectionStart;
            var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
            var parts = [];

            for (var i = 0, len = sanitizedValue.length; i < len; i += 2) {
                parts.push(sanitizedValue.substring(i, i + 2));
            }

            for (var i = caretPosition - 1; i >= 0; i--) {
                var c = this.value[i];
                if (c < '0' || c > '9') {
                    caretPosition--;
                }
            }
            caretPosition += Math.floor(caretPosition / 2);

            this.value = this.lastValue = parts.join('/');
            this.selectionStart = this.selectionEnd = caretPosition;
        }
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            var exp = document.getElementById('billing-cc-exp').value;
            var cleanedDate = exp.replace(/\//g, '');
            document.getElementById("billing-cc-exp").value = cleanedDate;
            form.submit();
        });
    </script>




</x-dashboard-layout>
