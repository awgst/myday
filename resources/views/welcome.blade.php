@extends('layouts.auth.app')

@push('contents')
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
@endpush