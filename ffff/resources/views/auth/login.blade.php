
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
            <div class="container d-flex flex-wrap justify-content-center vh-100 align-items-center ">
                <div class="row justify-content-center">
                    <div class="align-self-end col-md-11 col-11">
                        <div class="card shadow-sm">
                               <div class="card-body">
                            <div class=" mb-7">
                            <a href="{{url('/')}}"><img src="{{ asset('charity/images/logo.png') }}" alt="brand" class="mb-5 w-75" /></a>
                            <h4 class="mb-1 text-center">Login To Your Account</h4>
                        
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
                </div>
            </div>
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