@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <x-custom-alert type="warning" :session="session('warning')" />
    <x-custom-alert type="success" :session="session('success')" />
    <x-custom-alert type="error" :session="session('error')" />
        <main class="hs-main-content hs-d-flex hs-flex-grow-1 hs-flex-column hs-mt-7">
            <!-- Form container -->
            <section>
                <div class="hs-page-header hs-min-vh-80 ">
                    <div class="hs-container">
                        <div class="hs-row">
                            <div class="hs-col-xl-4 hs-col-lg-5 hs-col-md-7 hs-d-flex hs-flex-column hs-mx-lg-0 hs-mx-auto">
                                <div class="hs-card">
                                    <div class="hs-card-header hs-pb-0 hs-text-start">
                                        <h4 class="hs-font-weight-bolder">Sign In</h4>
                                        <p class="hs-mb-0">Enter your email and password to sign in</p>
                                    </div>

                                    <!-- Form container -->
                                    <div class="hs-card-body">
                                        <form role="form" method="POST" action="{{ route('login.perform') }}" style="margin-bottom: 7%;">
                                            @csrf
                                            @method('post')
                                            <div class="hs-flex hs-flex-col hs-mb-3">
                                                <input type="email" name="email" class="hs-form-control hs-form-control-lg"
                                                       placeholder="Email" value="{{ old('email') }}" aria-label="Email">
                                                @error('email')
                                                <p class="hs-text-danger hs-text-xs hs-pt-1"> {{$message}} </p>
                                                @enderror
                                            </div>
                                            <div class="hs-flex hs-flex-col hs-mb-3">
                                                <x-hidden-password-input />
                                            </div>
                                            <div class="hs-form-check hs-form-switch">
                                                <input class="hs-form-check-input" name="remember" type="checkbox"
                                                       id="rememberMe">
                                                <label class="hs-form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                            <div class="hs-text-center">
                                                <button type="submit" class="hs-btn hs-btn-lg hs-btn-primary hs-w-100 hs-mt-4 hs-mb-0">
                                                    Sign in
                                                </button>
                                            </div>
                                        </form>
                                        <form action="{{ route('login.admin') }}">
                                            <div class="hs-text-center">
                                                <button type="submit" class="hs-btn hs-btn-lg hs-btn-success hs-w-100 hs-mt-4 hs-mb-0">
                                                    Admin login
                                                </button>
                                            </div>
                                        </form>
                                        <form action="{{ route('login.client') }}">
                                            <div class="hs-text-center">
                                                <button type="submit" class="hs-btn hs-btn-lg hs-btn-danger hs-w-100 hs-mt-4 hs-mb-0">
                                                    Client login
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Reset password -->
                                    <div class="hs-card-footer hs-text-center hs-pt-0 hs-px-lg-2 hs-px-1">
                                        <p class="hs-mb-1 hs-text-sm hs-mx-auto">
                                            Forgot your password? Reset your password
                                            <a href="{{ route('reset-password') }}"
                                               class="hs-text-primary hs-text-gradient hs-font-weight-bold">here</a>
                                        </p>
                                    </div>

                                    <!-- Create account -->
                                    <div class="hs-card-footer hs-text-center hs-pt-0 hs-px-lg-2 hs-px-1">
                                        <p class="hs-mb-4 hs-text-sm hs-mx-auto">
                                            Don't have an account?
                                            <a href="{{ route('register') }}"
                                               class="hs-text-primary hs-text-gradient hs-font-weight-bold">Sign up</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Vertical banner -->
                            <div
                                class=" hs-d-lg-flex hs-d-none hs-h-100 hs-my-auto hs-pe-0 hs-position-absolute hs-top-0 hs-end-0 hs-text-center hs-justify-content-center hs-flex-column" style="width: 35%; margin-right: 7%;">
                                <div
                                    class="hs-position-relative hs-bg-gradient-primary hs-h-100 hs-m-3 hs-px-7 hs-border-radius-lg hs-d-flex hs-flex-column hs-justify-content-center hs-overflow-hidden signin-image">
                                    <span class="hs-mask hs-bg-gradient-primary hs-opacity-1"></span>
                                    <h4 class="hs-mt-5 hs-text-white hs-font-weight-bolder hs-position-relative">Join us and many others
                                        today!</h4>
                                    <p class="hs-text-white hs-position-relative">Discover a world of tranquility and exclusive
                                        offers. Sign up today and embrace the extraordinary.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
@endsection
