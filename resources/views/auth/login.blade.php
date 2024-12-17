{{--@extends('layouts.app')--}}
{{--@section('content')--}}
{{-- <div style="height: 100vh" class="container ">--}}
{{-- <div class="row justify-content-center align-items-center h-100">--}}
{{-- <div class="col-md-5">--}}
{{-- <div class="card border-0 shadow rounded-3 p-4 mt-5">--}}

{{-- <div class="card-header bg-white border-0">--}}
{{-- {{ __('Login') }}</div>--}}

{{-- <div class="card-body">--}}
{{-- <form method="POST" action="{{ route('login') }}">--}}
{{-- @csrf--}}

{{-- <div class="row mb-3">--}}
{{-- --}}{{-- <label for="email" class="col-md-12 ">{{ __('Email Address') }}</label>--}}

{{-- <div class="col-md-12">--}}
{{-- <input id="email" placeholder="Email Address" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{-- @error('email')--}}
{{-- <span class="invalid-feedback" role="alert">--}}
{{-- <strong>{{ $message }}</strong>--}}
{{-- </span>--}}
{{-- @enderror--}}
{{-- </div>--}}
{{-- </div>--}}

{{-- <div class="row mb-3">--}}
{{-- --}}{{-- <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>--}}

{{-- <div class="col-md-12">--}}
{{-- <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{-- @error('password')--}}
{{-- <span class="invalid-feedback" role="alert">--}}
{{-- <strong>{{ $message }}</strong>--}}
{{-- </span>--}}
{{-- @enderror--}}
{{-- </div>--}}
{{-- </div>--}}

{{-- <div class="row mb-3">--}}
{{-- <div class="col-md-6">--}}
{{-- <div class="form-check">--}}
{{-- <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{-- <label class="form-check-label" for="remember">--}}
{{-- {{ __('Remember Me') }}--}}
{{-- </label>--}}
{{-- </div>--}}
{{-- </div>--}}


{{-- <div class="col-md-6">--}}
{{-- <div class="form-check p-0">--}}
{{-- @if (Route::has('password.request'))--}}
{{-- <a class="btn btn-link text-dark" href="{{ route('password.request') }}">--}}
{{-- {{ __('Forgot Your Password?') }}--}}
{{-- </a>--}}
{{-- @endif--}}
{{-- </div>--}}
{{-- </div>--}}

{{-- </div>--}}

{{-- <div class="row mb-0">--}}
{{-- <div class="col-md-12">--}}
{{-- <button type="submit" class="btn btn-dark w-100 text-light">--}}
{{-- {{ __('Login') }}--}}
{{-- </button>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </form>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{--@endsection--}}




<!doctype html>
<html lang="en">

<!-- Mirrored from block.codescandy.com/signin-v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Mar 2024 18:53:56 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon icon-->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png" />
    <link rel="manifest" href="assets/images/favicon/site.html" />
    <link rel="mask-icon" href="assets/images/favicon/block-safari-pinned-tab.svg" color="#8b3dff" />
    <link rel="shortcut icon" href="assets/images/favicon/favicon.ico" />
    <meta name="msapplication-TileColor" content="#8b3dff" />
    <meta name="msapplication-config" content="assets/images/favicon/tile.xml" />

    <!-- Color modes -->
    <script src="{{asset('assets/js/vendors/color-modes.js')}}"></script>

    <!-- Libs CSS -->
    <link href="{{asset('frontend/assets/libs/simplebar/dist/simplebar.min.css')}}" rel="stylesheet" />
    <link href="{{asset('frontend/assets/libs/bootstrap-icons/font/bootstrap-icons.min.css')}}" rel="stylesheet" />

    <!-- Scroll Cue -->
    <link rel="stylesheet" href="{{asset('frontend/assets/libs/scrollcue/scrollCue.css')}}" />

    <!-- Box icons -->
    <link rel="stylesheet" href="{{asset('frontend/assets/fonts/css/boxicons.min.css')}}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/theme.min.css')}}" />
    <!-- Analytics Code -->

    <title>Login - {{config('app.name')}}</title>
</head>

<body>
    <main>
        <!--Pageheader start-->
        <div class="position-relative h-100">
            <div class="container d-flex flex-wrap justify-content-center vh-100 align-items-center w-lg-50 position-lg-absolute">
                <div class="row justify-content-center">
                    <div class="align-self-end col-md-9 col-11">
                        <div class=" mb-7">
                            <a href="{{url('/')}}"><img src="{{asset('management/images/ajp-logo.png')}}" alt="brand" class="mb-5 w-50" /></a>
                            <h2 class="mb-1 text-center">Login To Your Account</h2>
                            <p class="mb-0">
                                {{-- Don’t have an account yet?--}}
                                {{-- <a href="{{url('/register')}}" class="text-primary">Register here</a>--}}
                            </p>
                            @if (session('message'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                        </div>
                        <form method="POST" class="needs-validation mb-6" novalidate action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                {{-- <label for="signinEmailInput" class="form-label">--}}
                                {{-- Email--}}
                                {{-- <span class="text-danger">*</span>--}}
                                {{-- </label>--}}

                                <input id="signinEmailInput" placeholder="Email Address" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <div class="invalid-feedback">Please enter email.</div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                {{-- <label for="formSignUpPassword" class="form-label">Password</label>--}}
                                <div class="password-field position-relative">
                                    <input id="formSignUpPassword" type="password" placeholder="Password" class="form-control fakePassword @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                    <div class="invalid-feedback">Please enter password.</div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" name="remember" id="rememberMeCheckbox" {{ old('remember') ? 'checked' : '' }} type="checkbox" />
                                        <label class="form-check-label" for="rememberMeCheckbox">Remember me</label>
                                    </div>

                                    <div>
                                        @if (Route::has('password.request'))
                                        <a class="text-primary" href="{{ route('password.request') }}">
                                            {{ __('Forgot Password?') }}
                                        </a>
                                        @endif

                                    </div>
                                </div>

                                <div class="d-grid text-center">
                                    <button class="btn btn-dark mt-3" type="submit">Sign In</button>
                                    <span class="text-dark">Not A Member Yet?<a href="{{url('register')}}">Register Now</a></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div
                class="position-fixed top-0 end-0 w-50 h-100 d-none d-xl-block vh-100"
                style="background-image: url({{asset('management/images/authentication.png')}}); background-position: center; background-repeat: no-repeat; background-size: cover"></div>
        </div>

    </main>

    <!-- Libs JS -->
    <script src="{{asset('frontend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/assets/libs/simplebar/dist/simplebar.min.js')}}"></script>
    <script src="{{asset('frontend/assets/libs/headhesive/dist/headhesive.min.js')}}"></script>

    <!-- Theme JS -->
    <script src="{{asset('frontend/assets/js/theme.min.js')}}"></script>

    <script src="{{asset('frontend/assets/js/vendors/password.js')}}"></script>
</body>

<!-- Mirrored from block.codescandy.com/signin-v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Mar 2024 18:53:56 GMT -->

</html>