<div class="tab-pane fade" id="nav-sign-up" role="tabpanel" aria-labelledby="nav-sign-up-tab">
    <form method="POST" action="{{ route('register') }}" id="formRegister">
      @csrf
      <div class="form-box">
        <label for="nameForm" class="form-label mb-0">Name</label>
        <input type="text" class="form-control" name="name" id="nameForm" placeholder="Name" autocomplete="off">
        <span class="text-danger" data-validation="name"></span>
      </div>
      <div class="form-box">
        <label for="usernameForm" class="form-label mb-0">Username</label>
        <input type="text" class="form-control" name="username" id="usernameForm" placeholder="Username" autocomplete="off">
        <span class="text-danger" data-validation="username"></span>
      </div>
      <div class="form-box">
        <label for="" class="form-label mb-0">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off">
        <span class="text-danger" data-validation="email"></span>
      </div>
      <div class="form-box">
        <label for="" class="form-label mb-0">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
        <span class="text-danger" data-validation="password"></span>
      </div>
      <button type="submit" class="btn btn-primary gradient-blue w-100 mt-2 fw-bold">Register</button>
    </form>
</div>