@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <main class="main-content  mt-0 flex-grow-1">
        <!-- Form container -->
        <section>
            <div class="page-header min-vh-90">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>

                                <!-- Form container -->
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('login.perform') }}">
                                        @csrf
                                        @method('post')
                                        <div class="flex flex-col mb-3">
                                            <input type="email" name="email" class="form-control form-control-lg"
                                                   placeholder="Email" value="{{ old('email') }}" aria-label="Email">
                                            @error('email') <p
                                                class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="flex flex-col mb-3">
                                            <input type="password" name="password" class="form-control form-control-lg"
                                                   placeholder="Password" aria-label="Password" value="">
                                            @error('password') <p
                                                class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="remember" type="checkbox"
                                                   id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">
                                                Sign in
                                            </button>
                                        </div>
                                    </form>
                                    <form action="{{ route('login.admin') }}">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-success btn-lg w-100 mt-4 mb-0">
                                                Admin login
                                            </button>
                                        </div>
                                    </form>
                                    <form action="{{ route('login.client') }}">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-danger btn-lg w-100 mt-4 mb-0">
                                                Client login
                                            </button>
                                        </div>
                                    </form>

                                </div>

                                <!-- Reset password -->
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-1 text-sm mx-auto">
                                        Forgot you password? Reset your password
                                        <a href="{{ route('reset-password') }}"
                                           class="text-primary text-gradient font-weight-bold">here</a>
                                    </p>
                                </div>

                                <!-- Create account -->
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="{{ route('register') }}"
                                           class="text-primary text-gradient font-weight-bold">Sign up</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Vertical banner -->
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div
                                class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden signin-image">
                                <span class="mask bg-gradient-primary opacity-1"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">Join us and many others
                                    today!</h4>
                                <p class="text-white position-relative">Discover a world of tranquility and exclusive
                                    offers. Sign up today and embrace the extraordinary.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
