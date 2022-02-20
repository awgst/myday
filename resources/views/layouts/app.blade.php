<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                <img src="{{ asset('assets/images/avatar.jpeg') }}" alt="" class="pict">
                                <input type="text" class="mx-1 text-muted" placeholder="Search" value="Hi, Name" id="search">
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
                <div class="col-lg-9 px-3 py-4">
                    <!-- Content Section -->
                    @include('layouts.content')
                    <!-- End of Content Section -->
                </div>
            </div>
        </div>
    </div>
    @include('snippets.scripts')
</body>
</html>