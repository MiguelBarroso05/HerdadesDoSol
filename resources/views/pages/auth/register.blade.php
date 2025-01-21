@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <main class="hs-main-content hs-mt-0 hs-flex-grow-1">
        <!-- Horizontal banner -->
        <section>
            <div class="hs-page-header hs-align-items-start hs-min-vh-50 hs-pt-5 hs-pb-11 hs-m-3 hs-border-radius-lg signup-image">
                <span class="hs-mask hs-bg-gradient-dark hs-opacity-6"></span>
                <div class="hs-container mobile-hidden">
                    <div class="hs-row hs-justify-content-center">
                        <div class="hs-col-lg-6 hs-text-center hs-mx-auto">
                            <h1 class="hs-text-white hs-mb-2 hs-mt-5 hs-mt-md-7">Herdades do Sol!</h1>
                            <p class="hs-text-lead hs-text-white">Start your journey with us and discover the harmony of nature and comfort. Create your account today and unlock exclusive experiences tailored just for you!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Form container -->
        <section>
            <div class="hs-container hs-mb-4">
                <div class="hs-row hs-mt-lg-n10 hs-mt-md-n11 hs-mt-n12 hs-justify-content-center">
                    <div class="hs-col-xl-8 hs-col-md-8 hs-mx-auto">
                        <div class="hs-card hs-z-index-0 hs-shadow">
                            <div class="hs-card-body">
                                <form method="POST" action="{{ route('register.perform') }}">
                                    @csrf
                                    <!-- Email -->
                                    <div class="hs-mb-3">
                                        <input type="email" name="email" class="hs-form-control" placeholder="Email" aria-label="Email" value="{{ old('email') }}">
                                        @error('email') <p class='hs-text-danger hs-text-xs hs-pt-1'>{{ $message }}</p> @enderror
                                    </div>

                                    <!-- Password and Confirm Password -->
                                    <div class="hs-row">
                                        <div class="hs-col-12 hs-col-md-6 hs-mb-3">
                                            <input type="password" name="password" class="hs-form-control" placeholder="Password" aria-label="Password">
                                            @error('password') <p class='hs-text-danger hs-text-xs hs-pt-1'>{{ $message }}</p> @enderror
                                        </div>
                                        <div class="hs-col-12 hs-col-md-6 hs-mb-3">
                                            <input type="password" name="password_confirmation" class="hs-form-control" placeholder="Confirm Password" aria-label="Password">
                                        </div>
                                    </div>

                                    <!-- First Name and Last Name -->
                                    <div class="hs-row">
                                        <div class="hs-col-12 hs-col-md-6 hs-mb-3">
                                            <input type="text" name="firstname" class="hs-form-control" placeholder="First Name" aria-label="Name" value="{{ old('firstname') }}">
                                            @error('firstname') <p class='hs-text-danger hs-text-xs hs-pt-1'>{{ $message }}</p> @enderror
                                        </div>
                                        <div class="hs-col-12 hs-col-md-6 hs-mb-3">
                                            <input type="text" name="lastname" class="hs-form-control" placeholder="Last Name" aria-label="Name" value="{{ old('lastname') }}">
                                            @error('lastname') <p class='hs-text-danger hs-text-xs hs-pt-1'>{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <!-- Birth Date -->
                                    <div class="hs-row">
                                        <div class="hs-col-12 hs-col-md-6 hs-mb-3">
                                            <label class="hs-form-check-label">
                                                Birth Date:
                                            </label>
                                            <input type="date" name="birthdate" class="hs-form-control" placeholder="Birth Date" aria-label="Birth Date" value="{{ old('birthdate') }}">
                                            @error('birthdate') <p class='hs-text-danger hs-text-xs hs-pt-1'>{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <!-- Terms and Conditions -->
                                    <div class="hs-form-check hs-form-check-info hs-text-start hs-mb-3">
                                        <input class="hs-form-check-input" type="checkbox" name="terms" id="flexCheckDefault">
                                        <label class="hs-form-check-label" for="flexCheckDefault">
                                            I agree to the <a href="javascript:;" class="hs-text-dark hs-font-weight-bolder">Terms and Conditions</a>
                                        </label>
                                        @error('terms') <p class='hs-text-danger hs-text-xs'>{{ $message }}</p> @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="hs-text-center">
                                        <button type="submit" class="hs-btn hs-btn-primary hs-w-100 hs-my-4 hs-mb-2">Sign up</button>
                                    </div>
                                    <p class="hs-text-sm hs-mt-3 hs-mb-0">Already have an account? <a href="{{ route('login') }}" class="hs-text-dark hs-font-weight-bolder">Sign in</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
