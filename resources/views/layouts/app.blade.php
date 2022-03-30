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
                                    <img src="{{ asset('assets/images/dummy.png') }}" alt="" class="pict">
                                </a>
                                <ul id="account" class="d-none">
                                    <li><a href="#" class="text-muted" id="account">Account</a></li>
                                    <li><a href="{{ route('logout') }}" class="text-muted" data-method="POST">Logout</a></li>
                                </ul>
                                <input type="text" class="mx-1 text-muted" placeholder="Search" value="Hi, {{ $user->first_name ?? '-' }}" id="search" readonly autocomplete="off">
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
    <script>
        $(document).ready(function () {
            $(document).on('submit', '#formAccount', function (e) {
                e.preventDefault();
                $(this).find(`[type="submit"]`).prop('disabled', true);
                $(this).find(`[type="submit"]`).html(`<i class="fa fa-spinner fa-pulse"></i>`);
                $.ajax({
                    type: "PUT",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function (response) {
                        $('.text-danger').html('');
                        uploadFile($(`[name="profile_picture"]`), accountUploadRoute);
                    }, error: function (response) {
                        $('.text-danger').html('');
                        if (response.status == 422) {
                            let errors = response.responseJSON.errors;
                            for (const key in errors) {
                                if (Object.hasOwnProperty.call(errors, key)) {
                                    const element = errors[key];
                                    $(`[data-validation="${key}"]`).text(element);
                                }
                            }
                        } 
                        if (response.status == 500) {    
                            toastr["error"](response.responseJSON.message,"ERROR");
                        }
                    }, complete: function () {
                        $('.btn-submit-account').removeAttr('disabled');
                        $('.btn-submit-account').html('Save');
                    }
                });
            });

            $(document).change('.image-upload', function (input) {
                let file = input.target.files;
                let reader = new FileReader();
                reader.onload = function(e){
                    $('.image-account').find('img').attr('src', e.target.result);
                }
                reader.readAsDataURL(file[0]);
            });
        });

        function uploadFile(selector, url) {
            let data = new FormData();
            data.append('file', selector.prop('files')[0]);
            console.log(data);
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                }, error: function (reponse) {
                    console.log(response);
                    toastr['error']("Upload failed", "ERROR");
                }
            });
        }
    </script>
</body>
</html>