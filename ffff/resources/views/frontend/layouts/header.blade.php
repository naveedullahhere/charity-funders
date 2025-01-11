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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="{{ asset('charity/style.css') }}">
<script>

document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll(".count");

    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-number');
            const speed = +counter.getAttribute('data-speed');
            const count = +counter.innerText;

            const increment = target / speed * 1;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(updateCount, 100);
            } else {
                counter.innerText = target;
            }
        };

        counter.innerText = '0';
        updateCount();
    });
});

</script>
</head>

<body>
    <div class="header">
        <div class="container-fuild">
            <div class="header-row">
                <div class="row col-lg-12 justify-content-between align-items-center">
                    <div class="col-lg-6 d-flex gap-3 m-0 p-0 email-phone-flex">
                        <div class=" email d-flex align-items-center gap-2">
                            <i class="far fa-envelope mt-0"></i>
                            <p class="m-auto">info@charityfunders.org.uk</p>
                        </div>
                        <div class="phone d-flex align-items-center gap-2">
                            <i class="fa-light fa-phone-flip"></i>
                            <p class="mb-0">020 3740 2750</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-end m-0 p-0 gap-4 button-login-sub">
                     <!--<div class="btn-nav-1"><a href="company/group"><i class="fa fa-search"></i> Search Funders</a></div>-->
                     <!--                                                   <div class="btn-nav-1"><a href="my_account"><i class="fa fa-user"></i> My Account</a></div>-->
                     <!--                                                   <div class="btn-nav-2"><a href="auth/logout"><i class="fa fa-sign-out"></i> Logout</a></div>-->
                 <div class="btn-nav-1"><a href="{{url('register')}}">Subscribe to database</a></div>
                                                                        <div class="btn-nav-2"><a href="{{url('my-account')}}">Client Log in</a></div>
                        
                       
                        <!-- <div class="btn-nav-1"><a href="">Subscribe</a></div>
                    <div class="btn-nav-2"><a href="">Login</a></div> -->
                    </div>
                </div>
            </div>
            <div class="main-row">
                <div class="nav-logo align-items-center">
                    <div class="col-lg-3 col-md-3 col-sm-6 main-logo">
                        <a href="/"><img src="{{ asset('charity/images/logo.png') }}" alt=""
                                class="img-fluid"></a>
                    </div>
                    <div class="col-lg-8 col-sm-6 d-flex pt-2 justify-content-end main-navbar">
                        <div class="navmenu">
                            <ul id="MenuItems">
                                <li><a href="/">Home</a></li>
                                <li><a href="about">About us</a></li>
                                <li><a href="subscribe">Subscriptions</a></li>
                                <li><a href="faqs">FAQs</a></li>
                                <li><a href="contact">Contact us</a></li>
                            </ul>
                            <img src="assets/pages/images/menu.png" class="menu-icon" onclick="menutoggle()">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
