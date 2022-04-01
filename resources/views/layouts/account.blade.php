<div class="content">
    <!-- Header -->
    <div class="header row mx-0">
        <div class="col-8 px-0">
            <h2 class="mb-0" style="color: #444444;">{{ __('Account') }}</h2>
        </div>
    </div>
    {{-- Body --}}
    <div class="account-body mt-3">
        <form action="{{ route('account.update', $user->uuid) }}" method="POST" enctype="multipart/form-data" id="formAccount">
            @csrf
            @method('put')
            <div class="row" style="overflow-x: clip; overflow-y: auto; height: 70vh;">
                <div class="col-md-4 mb-5">
                    <div class="image-account" style="width: 100%; height: 100%;">
                        <img src="{{ $user->profile_picture_url }}" alt="" class="pict" style="width: 100%; height: 100%;">
                    </div>
                    <div class="d-flex row-reverse">
                        {{-- <input type="file" name="x" id="test" value="test"> --}}
                        <label class="label" for="profilePicture">
                            <input type="file" name="profile_picture" id="profilePicture" class="image-upload" accept="image/png,image/jpeg,image/jpg"/>
                            {{-- <input type="hidden" name="profile_picture"> --}}
                            <span>{{ __('Upload file') }}</span>
                        </label>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-search">
                        <div class="form-account">
                            <input type="text" name="name" class="mb-0 form-account" style="line-height: 10px; border-bottom: none;" placeholder="{{ __('Name') }}" value="{{ $user->name ?? '' }}" autocomplete="off">
                            <span class="text-danger" data-validation="name"></span>
                        </div>
                        <div class="form-account">
                            <input type="text" name="username" class="mb-0 form-account" style="line-height: 10px; border-bottom: none;" placeholder="Username" value="{{ $user->username ?? '' }}" autocomplete="off">
                            <span class="text-danger" data-validation="username"></span>
                        </div>
                        <div class="form-account">
                            <input type="email" class="mb-0 form-account" style="line-height: 10px; border-bottom: none;" placeholder="Email" value="{{ $user->email ?? '' }}" autocomplete="off" disabled>
                            <span class="text-danger" data-validation="email"></span>
                        </div>
                        <div class="form-account">
                            <input type="password" name="current_password" class="mb-0 form-account" style="line-height: 10px; border-bottom: none;" placeholder="{{ __('Current Password') }}" value="" autocomplete="off">
                            <span class="text-danger" data-validation="current_password"></span>
                        </div>
                        <div class="form-account">
                            <input type="password" name="new_password" class="mb-0 form-account" style="line-height: 10px; border-bottom: none;" placeholder="{{ __('New Password') }}" value="" autocomplete="off">
                            <span class="text-danger" data-validation="new_password"></span>
                        </div>
                        <button type="submit" class="btn btn-primary btn-submit-account mt-3 ml-auto">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>