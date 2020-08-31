@extends('layouts.app')

@section('content')
<div class="col-md-6 m-4">
    <h2>Create New Order</h2>
    <form action="{{ route('orders.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf  
        <div class="form-group">
            <label for="exampleFormControlSelect1">Client</label>
            <select class="form-control" id="exampleFormControlSelect1" name="client_name">
                @foreach ($clients as $client)
                    <option>{{$client->company_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Product ID</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="product_id" required>
            <div class="invalid-feedback">
                Please enter ID
            </div>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Product Name</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="product_name" required>
            <div class="invalid-feedback">
                Please enter Name
            </div>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Product Amount</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="product_amount" required>
            <div class="invalid-feedback">
                Please enter Amount
            </div>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Unit Price</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" name="product_unit_price" required>
            <div class="invalid-feedback">
                Please enter Price
            </div>
        </div>
    <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

@endsection