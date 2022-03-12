<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}"/>
    {{-- Custom Style --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    {{-- jQuery --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}">
    <title>@yield('title', 'My Day')</title>
</head>
<body style="background-image: url({{ asset('assets/images/bg-new.png') }}); background-position: center center; background-size: cover; background-attachment: fixed;">
    <div class="container-fluid">
        {{-- Navbar --}}
        <nav class="navbar navbar-light pt-3">
            <div class="container">
                <a class="navbar-brand navbar-item" href="" data-target="#landing">
                    My Day
                </a>
                <div class="d-flex">
                    <a href="" class="navbar-item" data-target="#about">About</a>
                </div>
            </div>
        </nav>
        {{-- wrapper --}}
        <div class="pages" id="landing">
            <div class="container d-flex align-items-center" style="height: 85vh;">
                <div class="d-flex align-items-center justify-content-between w-100 wrapper">
                    <div class="tagline">
                        <h1>My Day</h1>
                        <p style="width: 75%;">My Day help you for managing your daily task, work or anything else.</p>
                    </div>
                    <div class="login-form">
                        <div class="card px-0 pt-0" style="min-width: 21rem;">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                  <button class="nav-link active" id="nav-sign-in-tab" data-bs-toggle="tab" data-bs-target="#nav-sign-in" type="button" role="tab" aria-controls="nav-sign-in" aria-selected="true">Sign In</button>
                                  <button class="nav-link" id="nav-sign-up-tab" data-bs-toggle="tab" data-bs-target="#nav-sign-up" type="button" role="tab" aria-controls="nav-sign-up" aria-selected="false">Sign Up</button>
                                </div>
                            </nav>
                            <div class="card-body tab-content" id="nav-tabContent">
                                {{-- Login  Form --}}
                                @include('layouts.auth.login-form')
                                {{-- Register Form --}}
                                @include('layouts.auth.register-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.about')
    </div>
    <script>
        $(document).on('click', '.navbar-item', function (e) {
            e.preventDefault();
            $('.pages').attr('style', 'display: none;');
            $($(this).attr('data-target')).fadeIn();
        });

    </script>
</body>
</html>
