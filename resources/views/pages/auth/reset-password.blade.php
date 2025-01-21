@extends('layouts.app')

@section('content')
    <div class="hs-container hs-position-sticky hs-z-index-sticky hs-top-0">
        <div class="hs-row">
            <div class="hs-col-12">
                @include('layouts.navbars.guest.navbar')
            </div>
        </div>
    </div>
    <main class="hs-main-content hs-mt-0">
        <section>
            <div class="hs-page-header hs-min-vh-100">
                <div class="hs-container">
                    <div class="hs-row">
                        <div class="hs-col-xl-4 hs-col-lg-5 hs-col-md-7 hs-d-flex hs-flex-column hs-mx-lg-0 hs-mx-auto">
                            <div class="hs-card hs-card-plain">
                                <div class="hs-card-header hs-pb-0 hs-text-start">
                                    <h4 class="hs-font-weight-bolder">Reset your password</h4>
                                    <p class="hs-mb-0">Enter your email and please wait a few seconds</p>
                                </div>
                                <div class="hs-card-body">
                                    <form role="form" method="POST" action="{{ route('reset.perform') }}">
                                        @csrf
                                        @method('post')
                                        <div class="hs-flex hs-flex-col hs-mb-3">
                                            <input type="email" name="email" class="hs-form-control hs-form-control-lg" placeholder="Email" value="{{ old('email') }}" aria-label="Email">
                                            @error('email') <p class="hs-text-danger hs-text-xs hs-pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="hs-text-center">
                                            <button type="submit" class="hs-btn hs-btn-lg hs-btn-primary hs-w-100 hs-mt-4 hs-mb-0">Send Reset Link</button>
                                        </div>
                                    </form>
                                </div>
                                <div id="alert">
                                    @include('components.alert')
                                </div>
                            </div>
                        </div>
                        <div
                            class="hs-col-6 hs-d-lg-flex hs-d-none hs-h-100 hs-my-auto hs-pe-0 hs-position-absolute hs-top-0 hs-end-0 hs-text-center hs-justify-content-center hs-flex-column">
                            <div class="hs-position-relative hs-bg-gradient-primary hs-h-100 hs-m-3 hs-px-7 hs-border-radius-lg hs-d-flex hs-flex-column hs-justify-content-center hs-overflow-hidden"
                                 style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
                                        background-size: cover;">
                                <span class="hs-mask hs-bg-gradient-primary hs-opacity-6"></span>
                                <h4 class="hs-mt-5 hs-text-white hs-font-weight-bolder hs-position-relative">"Attention is the new
                                    currency"</h4>
                                <p class="hs-text-white hs-position-relative">The more effortless the writing looks, the more
                                    effort the writer actually put into the process.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
