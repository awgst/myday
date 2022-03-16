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
    {{-- Toastr --}}
    <link rel="stylesheet" href="{{ asset('plugins/toastr/build/toastr.min.css') }}">
    <script src="{{ asset('plugins/toastr/build/toastr.min.js') }}"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>

    @if(session()->has("notice"))
        @php
            $value = Session::get('notice');
            Session::forget('notice');
        @endphp
        <script>
            $(document).ready(function () {
                let notice = {!! json_encode($value) !!};
                toastr[notice.label](notice.message);
            });
        </script>
    @endif
    
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
        {{-- Content --}}
        @stack('contents')
    </div>
    <script src="{{ asset('js/form-validation.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.navbar-item', function (e) {
                e.preventDefault();
                $('.pages').attr('style', 'display: none;');
                $($(this).attr('data-target')).fadeIn();
            });
            
            // Form validation
            // Login
            let keyCheck = {
                username: "The username or email field is required.",
                password: "The password field is required."
            };
            validate($('#formLogin'), keyCheck, false);
            // Register
            validate($('#formRegister'), {}, true);
        });

    </script>
</body>
</html>
