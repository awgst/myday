<div class="content">
    <!-- Header -->
    <div class="header row mx-0">
        <div class="col-8 px-0">
            <h2 class="mb-0" style="color: #444444;">{{ __('Account') }}</h2>
        </div>
    </div>
    {{-- Body --}}
    <div class="account-body mt-3">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row" style="overflow-x: clip; overflow-y: auto; height: 57vh;">
                <div class="col-md-4 mb-5">
                    <div class="image-account" style="width: 100%; height: 100%;">
                        <img src="{{ asset('assets/images/dummy.png') }}" alt="" class="pict" style="width: 100%; height: 100%;">
                    </div>
                    <div class="d-flex row-reverse">
                        <label class="label">
                            <input type="file" name="profile_picture"/>
                            <span>{{ __('Upload file') }}</span>
                        </label>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-search">
                        <input type="text" name="name" class="mb-0 form-account" style="line-height: 10px; border-bottom: none;" placeholder="{{ __('Name') }}" value="{{ $user->name ?? '' }}" autocomplete="off">
                        <input type="text" name="username" class="mb-0 form-account" style="line-height: 10px; border-bottom: none;" placeholder="Username" value="{{ $user->username ?? '' }}" autocomplete="off">
                        <input type="email" class="mb-0 form-account" style="line-height: 10px; border-bottom: none;" placeholder="Email" value="{{ $user->email ?? '' }}" autocomplete="off" disabled>
                        <input type="password" name="current_password" class="mb-0 form-account" style="line-height: 10px; border-bottom: none;" placeholder="{{ __('Current Password') }}" value="" autocomplete="off">
                        <input type="password" name="new_password" class="mb-0 form-account" style="line-height: 10px; border-bottom: none;" placeholder="{{ __('New Password') }}" value="" autocomplete="off">
                        <button type="submit" class="btn btn-primary mt-3 ml-auto">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>