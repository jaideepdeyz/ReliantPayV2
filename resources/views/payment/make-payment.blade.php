<x-dashboard-layout>
    <div class="row">
      
        <div class="col-md-12">
            <form action="{{$formUrl}}" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="billing-cc-number" id="billing-cc-number" class="form-control" placeholder="Enter card Number">
                </div>
                <div class="form-group">
                    
                    <label for="name">Expiration Date</label>
                    <input type="text" name="billing-cc-exp" id="billing-cc-exp" class="form-control" placeholder="Enter card Expiration Date">
                </div>
                <div class="form-group">
                    <label for="name">CVV</label>
                    <input type="text" name="cvv" id="cvv" class="form-control" placeholder="Enter card CVV">
                </div>
               
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>




</x-dashboard-layout>