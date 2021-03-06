<div class="tab-pane fade show active" id="nav-sign-in" role="tabpanel" aria-labelledby="nav-sign-in-tab">
    <form method="POST" action="{{ route('login') }}" id="formLogin">
      @csrf
      <div class="mb-3">
        <label for="emailForm" class="form-label">Username or email</label>
        <input type="text" name="username_login" value="{{ old('email') ? old('email') : old('username') }}" class="form-control" id="emailForm" placeholder="Username or email" autocomplete="off">
        <span class="text-danger" data-validation="username_login"></span>
      </div>
      <div class="mb-3">
        <label for="passwordForm" class="form-label">Password</label>
        <input type="password" name="password_login" class="form-control" id="passwordForm" placeholder="Password" autocomplete="off">
        <span class="text-danger" data-validation="password_login"></span>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
          <label class="form-check-label" for="rememberMe">Remember me</label>
        </div>
        <div class="mb-3 form-check">
          <a href="{{ route('password.request') }}">Forgot password?</a>
        </div>
      </div>
      <button type="submit" class="btn btn-primary gradient-blue w-100 fw-bold">Sign In</button>
    </form>
    <hr class="mb-1">
    <span class="text-muted fw-bold">Sign in with</span>
    <div class="d-flex mt-1">
        <div class="sign-in ps-0">
            <a href="{{ route('auth.redirect', 'google') }}" class="btn btn-outline-secondary w-100 fw-bold"><i class="fa fa-google-plus-square"></i> Google</a>
        </div>
    </div>
</div>