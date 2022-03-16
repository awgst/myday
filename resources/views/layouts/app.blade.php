<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />
    @include('snippets.styles')
    
    <title>@yield('title', 'My Day')</title>
</head>
<body style="background-image: url({{ asset('assets/images/default.jpeg') }}); background-position: center center; background-size: cover; background-attachment: fixed;">
    <div class="wrapper">
        <div class="glass">
            <div class="row glasses" style="height: -webkit-fill-available;margin-bottom: -8px;">
                <div class="col-lg-3 col-dashboard pr-2">
                    <!-- Dashboard -->
                    <div class="dashboard">
                        <!-- Head -->
                        <div class="head">
                            <div class="profile form-search">
                                <a tabindex="0" class="popover-dismiss" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="{{ $user->name ?? '' }}" data-content="">
                                    <img src="{{ asset('assets/images/avatar.jpeg') }}" alt="" class="pict">
                                </a>
                                <ul id="account" class="d-none">
                                    <li><a href="#" class="text-muted">Account</a></li>
                                    <li><a href="{{ route('logout') }}" class="text-muted" data-method="POST">Logout</a></li>
                                </ul>
                                <input type="text" class="mx-1 text-muted" placeholder="Search" value="Hi, {{ $user->first_name ?? '-' }}" id="search" readonly>
                            </div>
                            <div class="search ms-1">
                                <i class="fa fa-search text-muted"></i>
                            </div>
                        </div>
                        <!-- Sidebar Navigation Section -->
                        @include('layouts.sidebar')
                        <!-- End of Sidebar Navigation Section -->
                    </div>
                    <!-- End of Dashboard -->
                </div>
                <div class="col-lg-9 px-3 py-4" id="contentContainer" style="height: 100%; align-items: center; display: flex; justify-content: center; width: 100%;">
                    <!-- Content Section -->
                    <i class="fa fa-spinner fa-pulse text-muted" style="font-size: 30px;"></i>
                    <!-- End of Content Section -->
                </div>
            </div>
        </div>
    </div>
    @include('includes.modal-search')
    @include('snippets.scripts')
</body>
</html>