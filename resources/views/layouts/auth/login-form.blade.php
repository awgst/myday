<div class="tab-pane fade show active" id="nav-sign-in" role="tabpanel" aria-labelledby="nav-sign-in-tab">
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="mb-3">
        <label for="emailForm" class="form-label">Username or email</label>
        <input type="text" name="username" class="form-control" id="emailForm" placeholder="Username or email">
      </div>
      <div class="mb-3">
        <label for="passwordForm" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="passwordForm" placeholder="Password">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="rememberMe">
        <label class="form-check-label" for="rememberMe">Remember me</label>
      </div>
      <button type="submit" class="btn btn-primary gradient-blue w-100 fw-bold">Sign In</button>
    </form>
    <hr class="mb-1">
    <span class="text-muted fw-bold">Sign in with</span>
    <div class="d-flex mt-1">
        <div class="sign-in ps-0">
            <a href="#" class="btn btn-outline-secondary w-100 fw-bold"><i class="fa fa-google-plus-square"></i> Google</a>
        </div>
        <div class="sign-in pe-0">
            <a href="#" class="btn btn-outline-secondary w-100 fw-bold"><i class="fa fa-twitter-square"></i> Twitter</a>
        </div>
    </div>
</div>