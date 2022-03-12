<div class="tab-pane fade" id="nav-sign-up" role="tabpanel" aria-labelledby="nav-sign-up-tab">
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="form-box">
        <label for="nameForm" class="form-label mb-0">Name</label>
        <input type="text" class="form-control" name="name" id="nameForm" placeholder="Name">
      </div>
      <div class="form-box">
        <label for="usernameForm" class="form-label mb-0">Username</label>
        <input type="text" class="form-control" name="username" id="usernameForm" placeholder="Username">
      </div>
      <div class="form-box">
        <label for="" class="form-label mb-0">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Email">
      </div>
      <div class="form-box">
        <label for="" class="form-label mb-0">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password">
      </div>
      <button type="submit" class="btn btn-primary gradient-blue w-100 mt-2 fw-bold">Register</button>
    </form>
</div>