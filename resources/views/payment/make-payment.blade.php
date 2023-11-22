<x-dashboard-layout>
    <div class="row mt-2">

        <div class="col-md-6 ">
            <form action="{{ $formUrl }}" method="post" id="payment-form">
                <div class="form-group mt-2">
                    <label for="name">Card Number</label>
                    <input type="text" name="billing-cc-number" id="billing-cc-number" class="form-control"
                        placeholder="Enter card Number" minlength="16" maxlength="16"  value="{{$salebooking->payment->cc_number}}" required readonly>
                </div>
                <div class="form-group mt-2">

                    <label for="name">Expiration Date</label>
                    <input type="text" name="billing-cc-exp" id="billing-cc-exp" class="form-control"
                        placeholder="MMYY"  required >
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
 



</x-dashboard-layout>
