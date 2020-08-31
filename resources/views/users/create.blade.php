@extends('layouts.app')

@section('content')
<div class="col-md-6 m-4">
    <h2>Create New User</h2>
    <form action="{{route('users.store')}}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
                <input type="text" class="form-control" name="user_name" placeholder="Bastill Ltd" required>
            <div class="invalid-feedback">
                Please enter Name
            </div>
        </div>
        <div class="form-group">
            <label for="name">Email</label>
            <input type="email" class="form-control" name="user_email" placeholder="Lot 123 Jalan Company" required>
            <div class="invalid-feedback">
                Please enter Email
            </div>
        </div>
        <div class="form-group">
            <label for="name">Password</label>
            <input type="password" class="form-control" name="user_password" placeholder="13891001" required>
            <div class="invalid-feedback">
                Please enter Password
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