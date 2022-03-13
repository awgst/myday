@extends('layouts.auth.app')

@push('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center pt-4" style="padding: 3rem;">
            <a href="https://storyset.com/user" target="_blank">
                <img src="{{ asset('assets/images/confirmed.png') }}" alt="" style="width: 25%; height: 55%;">
            </a>
            <p style="font-size: 20px; font-weight: unset;">Thank's for register, a verification email has been sent to <span class="fw-bold" style="color: black">{{ $email ?? 'your email' }}</span>, please check your inbox and follow the given link to verify your account.</p>
            <p style="font-size: 20px; font-weight: unset;">{{ __('If you did not receive the email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">{{ __('Click here to request another') }}</button>
                </form>
            </p>
            <div class="card d-none">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endpush
