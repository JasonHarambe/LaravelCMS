@extends('layouts.app')

@section('content')
<div class="col-md-6 m-4">
    <h2>Create New Client</h2>
    <form action="{{route('clients.store')}}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="form-group">
            <label for="name">Company Name</label>
                <input type="text" class="form-control" name="company_name" placeholder="Bastill Ltd" required>
            <div class="invalid-feedback">
                Please enter Company Name
            </div>
        </div>
        <div class="form-group">
            <label for="name">Company Address</label>
            <input type="text" class="form-control" name="company_address" placeholder="Lot 123 Jalan Company" required>
            <div class="invalid-feedback">
                Please enter Company Address
            </div>
        </div>
        <div class="form-group">
            <label for="name">Company Registration Number</label>
            <input type="text" class="form-control" name="company_reg" placeholder="13891001" required>
            <div class="invalid-feedback">
                Please enter Registration Number
            </div>
        </div>
        <div class="form-group">
            <label for="name">Company Contact Number</label>
            <input type="text" class="form-control" name="company_contact" placeholder="01233771211" required>
            <div class="invalid-feedback">
                Please enter Contact Number
            </div>
        </div>
    <button type="submit" class="btn btn-primary">Submit</button>
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