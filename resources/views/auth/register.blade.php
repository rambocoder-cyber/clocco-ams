@extends('layouts.app')

@section('content')
<div class="container p-5">
    <div class="row ">
      <div class="col-md-6">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-6 mt-5">
        <form id="registerForm" action="{{ route('register') }}" method="POST">
            @csrf
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="text" name="first_name" id="first_name" class="form-control"
              placeholder="Enter your first name" />
          </div>
          <div class="form-outline mb-4">
            <input type="text" name="last_name" id="last_name" class="form-control"
              placeholder="Enter your last name" />
          </div>
          <div class="form-outline mb-4">
            <input type="email" name="email" id="email" class="form-control"
              placeholder="Enter a valid email address" />
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" name="pwd" id="pwd" class="form-control"
              placeholder="Enter password" />
          </div>
          <div class="form-outline mb-3">
            <input type="text" name="phone" id="phone" class="form-control"
              placeholder="Enter phone number" />
          </div>
          <div class="form-outline mb-3">
            <input type="date" name="dob" id="dob" class="form-control"
              placeholder="Enter your date of birth" />
          </div>
          <div class="form-outline mb-3">
            <select name="gender" id="gender" class="form-control">
                <option value="m">Male</option>
                <option value="f">Female</option>
                <option value="o">Others</option>
            </select>
          </div>
          <div class="form-outline mb-3">
            <input type="text" name="address" id="address" class="form-control"
              placeholder="Enter your address" />
          </div>

          <p class="text-danger mt-2 mb-2" id="errorShow" hidden>Please fill the highlighted text</p>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button onclick="registerUser()" type="button" class="btn btn-primary "
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="{{ route('loginPage') }}"
                class="link-danger">Login</a></p>
          </div>

        </form>
      </div>
    </div>
</div>
@endsection

<script>

    function registerUser() {
        let form = document.getElementById('registerForm');
        let formData = new FormData(form);
        formData.delete("_token");
        let entries = [...formData.entries()];
        let validationRes = validateForm(entries);
        if (validationRes > 0) {
            document.getElementById('errorShow').hidden = false;
        }else{
            document.getElementById('errorShow').hidden = true;
            debugger;
            form.submit();
        }
    }

    function validateForm(entries) {
        let errorCount = 0;
        entries.forEach(element => {
            if (element[1] == '') {
                errorCount++;
                document.getElementById(element[0]).style.border = '1px solid red';
            }else{
                debugger;
                document.getElementById(element[0]).style.border = '1px solid #dee2e6';
            }
        });

        return errorCount;
    }
</script>