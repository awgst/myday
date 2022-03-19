@extends('layouts.auth.app')

@push('contents')
<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-6">
            <div class="card">

                <div class="card-body p-5 pt-3">
                    <h3 class="text-center">My Day</h3>
                    <p class="text-center" style="font-size: 12px; font-weight: normal;color: #6c757d!important;">Forgot your password? Don't worry we will get you back.</p>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="ctext-md-end">{{ __('EMAIL') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email Address">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Reset Link') }}
                                </button>
                                <p class="text-center pt-2" style="font-size: 12px; font-weight: normal;color: #6c757d!important;">Remember your password? <a href="{{ route('login') }}">Login</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endpush

@if (session('status'))
    @push('scripts')
        <script>
            $(document).ready(function () {
                toastr['success']("{{ session('status') }}");
            });
        </script>
    @endpush
@endif
