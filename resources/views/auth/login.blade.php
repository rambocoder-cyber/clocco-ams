@extends('layouts.app')

@section('content')
<div class="container p-5">
<div class="row">
      <div class="col-md-6">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-6 mt-5">
        <form id="loginForm" action="{{ route('login') }}" method="post">
            @csrf
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" name="email" id="email" class="form-control"
              placeholder="Enter a valid email address" />
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" name="pwd" id="pwd" class="form-control"
              placeholder="Enter password" />
          </div>

          <p class="text-danger mt-2 mb-2" id="errorShow" hidden>Please fill the highlighted text</p>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" name="remember" value="" id="rememberMe" />
              <label class="form-check-label" for="rememberMe">
                Remember me
              </label>
            </div>
            <a href="{{ route('password.request') }}" class="text-body">Forgot password?</a>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button onclick="login()" type="button" class="btn btn-primary"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{ route('registerPage') }}"
                class="link-danger">Register</a></p>
          </div>

        </form>
      </div>
    </div>
</div>
@endsection
<script>
    function login(){
        let form = document.getElementById('loginForm');
        let formData = new FormData(form);
        formData.delete('_token');
        formData.delete('remember');
        let entries = [...formData.entries()];
        let validationRes = validateForm(entries);
        if (validationRes > 0) {
            document.getElementById('errorShow').hidden = false;
        }else{
            document.getElementById('errorShow').hidden = true;
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
                document.getElementById(element[0]).style.border = '1px solid #dee2e6';
            }
        });

        return errorCount;
    }
</script>
