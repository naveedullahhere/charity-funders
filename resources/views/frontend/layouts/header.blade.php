@php
    use App\Helpers\CommonHelper;
@endphp
<!doctype html>
<html lang="en" data-bs-theme="light">

<!-- Mirrored from block.codescandy.com/landing-accounting.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Mar 2024 18:51:44 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>@yield('title', 'A default title') - {{ config('app.name') }}</title>
    <meta name="title" content="@yield('meta_title', 'UK Airport Parking Services | Cheap Airport Car Parking')">
    <meta name="keywords" content="@yield('meta_keyword', 'Air Parking Services')">
    <meta name="description" content="@yield('meta_description', 'UK Airport parking services provide meet & greet airport services along with chauffeur driven services to give the best valet parking in Manchester, Gatwick or Heathrow.')">
    <link rel="canonical" href="{{ url()->current() }}" />
    <!-- Favicon icon-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon.ico') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.ico') }}" />
    <link rel="mask-icon" href="{{ asset('favicon.ico') }}" color="#8b3dff" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <meta name="msapplication-TileColor" content="#8b3dff" />
    <meta name="msapplication-config" content="frontend/assets/images/favicon/tile.xml" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Color modes -->
    {{--    <script src="frontend/assets/js/vendors/color-modes.js"></script> --}}

    <!-- Libs CSS -->
    <link href="{{ asset('frontend/assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/assets/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet" />

    <!-- Scroll Cue -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/libs/scrollcue/scrollCue.css') }}" />

    <!-- Box icons -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/fonts/css/boxicons.min.css') }}" />

    <!-- Theme CSS -->
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/theme.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('ajpfrontend/css/style.css') }}">

    <style>
        /* .cart-btn {
            display: inline-flex;
            align-items: center;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .cart-btn:hover {
            background-color: #343a40;
        } */

        .cart-btn i {
            margin-right: 4px;
        }

        .cart-count {
            background-color: #ffc107;
            color: #000;
            padding: 4px 8px;
            font-size: 14px;
            font-weight: bold;
        }

        .cart-count::before {
            content: '';
            width: 8px;
            height: 8px;
            background-color: #fff;
            position: absolute;
            top: -2px;
            left: -2px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg transparent navbar-light navbar-dark">
            <div class="container px-3">
                <a class="navbar-brand" href="{{ url('/') }}"> <img
                        src="{{ asset('ajpfrontend/images/ajp-logo.png') }}" alt="Air Parking Services"></a>
                <button class="navbar-toggler offcanvas-nav-btn" type="button">
                    <i class="bi bi-list"></i>
                </button>
                <div class="offcanvas offcanvas-start offcanvas-nav" style="width: 20rem">
                    <div class="offcanvas-header">
                        <a href="{{ url('/') }}" class="text-inverse logo">
                            <img class="w-75" src="{{ asset('ajpfrontend/images/ajp-logo.png') }}"
                                alt="Air Parking Services">
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body pt-0 align-items-center justify-content-between">
                        <ul class="navbar-nav navbar-nav ms-md-5 align-items-lg-center text-uppercase">
                            <li class="nav-item"><a class="nav-link 0" href="{{ url('/') }}">Events</a></li>
                            <li class="nav-item"><a class="nav-link 0" href="{{ route('galleries') }}">Gallery</a></li>
                            <li class="nav-item"><a class="nav-link 0" href="{{ url('/collections') }}">Collections</a>
                            </li>
                        </ul>

                        <div class="mt-3 mt-lg-0 d-flex align-items-center">
                            @auth
                                <a href="{{ url('cart') }}" class="btn btn-dark position-relative mx-1 cart-btn">
                                    <i class="fas fa-shopping-cart"></i> Cart
                                    <span id="cartCount"
                                        class="cart-count badge badge-light position-absolute top-0 start-100 translate-middle rounded-pill">
                                        @if (auth()->check() && auth()->user()->basket)
                                            {{ CommonHelper::getCartCount(auth()->user()->basket->id) }}
                                        @else
                                            0
                                        @endif
                                    </span>
                                </a>
                            @endauth
                            @auth
                                <a href="{{ url('my-account') }}" class="btn btn-dark">My Account</a>
                            @endauth
                            @guest
                                <a href="{{ url('login') }}" class="btn btn-dark">Login</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
