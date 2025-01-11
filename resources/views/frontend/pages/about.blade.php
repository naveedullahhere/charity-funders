@extends('frontend.layouts.master')
@section('title', 'Home')
@section('meta_title', 'Home')
@section('meta_description', 'Home')
@section('meta_keyword', 'Home')
@section('content')

    <link rel="stylesheet" href="{{ asset('charity/about.css') }}">

    <section class="About-Banner">
        <div class="main-container">
            <div class="about-container">
                <div class="main-heading">
                    <h1>About us</h1>
                </div>
                <div class="text-line">
                    <p>We love to fundraise and we love what we do</p>
                </div>
            </div>
        </div>
    </section>
    <!-- .........................Section-2.......................... -->
    <section class="image-with-text">
        <div class="image-with-text-container">
            <div class="row m-0 align-items-center">
                <div class="col-lg-6 col-md-12 col-sm-12">
                
                    <img src="{{ asset('charity/images/funding-solutions.png') }}" class="img-fluid" alt="Image">
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="content">
                        <h2 class="mt-md-2">A funding solution</h2>
                        <p class="mt-lg-3 mb-lg-5"><b>Charity Funders</b> was developed by <span style="color: #FF7260;"> a
                                group of Fundraisers with over 20 years’ experience </span>
                            fundraising for the not for profit sector. As Fundraisers ourselves, we know exactly what
                            matters to you and give you the information you need at your fingertips, helping you save
                            time and energy. We’re the UK’s most advanced online grant finding service, packed full of
                            innovative and never before seen features, we make fundraising easier and that’s a promise!
                        </p>
                        <button>
                            <a href="#" class="btn btn-primary"> Subscribe Now <i class="fas fa-arrow-up"></i></a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- .........................Section-3.......................... -->
    <section class="box-image-heading-text">
        <div class="image-heading-text-container">
            <div class="row m-0">
                <div class="col-lg-12 text-lg-center p-0">
                    <div class="content">
                        <h2 class="mt-md-2">Charity professionals</h2>
                        <p class="mt-lg-3 mb-lg-5">Our dedicated team add their unique insight into fundraising, produce
                            detailed reports on funders and, in a dynamic and fast-moving environment, regularly update
                            data to ensuring the information you receive is both relevant and appropriate.</p>
                    </div>
                </div>
            </div>
            <div class="row m-0 gap-3 justify-content-between">
                <div class="col-lg-3  col-md-12 col-sm-12  p-0 width-mob">
                    <div class="box">
                        <div class="chlid-box pt-4">
                            <img src="{{ asset('charity/images/avatar.png') }}" alt="Image 3">
                        </div>
                        <div class="heading-and-text pt-4 ">
                            <h2>John smith</h2>
                            <p>Director</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12  p-0 width-mob">
                    <div class="box">
                        <div class="chlid-box pt-4">
                            <img src="{{ asset('charity/images/avatar.png') }}" alt="Image 2">
                        </div>
                        <div class="heading-and-text pt-4">
                            <h2>John smith</h2>
                            <p>Director</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12  p-0 width-mob">
                    <div class="box">
                        <div class="chlid-box pt-4">
                            <img src="{{ asset('charity/images/avatar.png') }}" alt="Image 3">
                        </div>
                        <div class="heading-and-text pt-4">
                            <h2>John smith</h2>
                            <p>Director</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row back-text" style="margin: 80px 0 0 0;">
                <div class="col-lg-12 p-5 padd-mob" style="background: #FF7260; color: #fff;">
                    <div class="content">
                        <p class="m-0">With Charity Funders you can seek assistance from other subscribers, post
                            comments and suggestions, search by pending funding deadlines and find out who funds your
                            competitors. And using our bespoke search engine and intuitive filters, we can help you find
                            exactly what you’re looking for in an instant, navigating effortlessly through over 5,000
                            funding prospects including wealthy individuals, companies, charitable trusts/foundations
                            and corporate sponsors.</p>
                        <p class="mt-5 text-padd">At Charity Funders we help you fundraise efficiently and effectively.
                            And we love what we do, it’s who we are</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- .........................Section-4......................... -->
    <section class="text-with-text">
        <div class="text-with-text-container">
            <div class="row m-0 align-items-center justify-content-between">
                <div class="col-lg-5 col-md-12 col-sm-12 p-0 m-0 width-adjust">
                    <div class="content mb-md-5">
                        <h2 class="mt-md-2">Join our growing list of subscribers</h2>
                        <p class="mt-lg-3 mb-lg-5">We’re an all-encompassing fundraising solution, providing a forum to
                            discuss all things fundraising as well as matching a wide range of organisations in the
                            public, private and voluntary sector, with funders most sympathetic to their cause.</p>
                        <button>
                            <a href="#" class="btn btn-primary"> Subscribe Now <i class="fas fa-arrow-up"></i></a>
                        </button>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 p-0 m-0 width-adjust">
                    <div class="content-box-wex p-5">
                        <img src="{{ asset('charity/images/quote.png') }}" alt="">
                        <p class="mt-lg-3 mb-lg-5 text-adjust">Charity Funders was developed by a group of Fundraisers
                            with over 20 years’ experience fundraising for the not for profit sector. As Fundraisers
                            ourselves, we know exactly what matters to you and give you the information you need at your
                            fingertips, helping you save time and energy. We’re the UK’s most advanced online grant
                            finding service, packed full of innovative and never before seen features, we make
                            fundraising easier and that’s a promise!</p>
                        <div class="heading-and-text">
                            <h2>John smith</h2>
                            <p>Director</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- .........................Section-5......................... -->
    <section class="Call-to-action">
        <div class="Action-container">
            <div class="Action">
                <div class="content">
                    <h2>Got a question? <br> We’d love to hear from you</h2>
                    <button class="mt-lg-5">
                        <a href="#" class="btn btn-primary"> Contact Us <i class="fas fa-arrow-up"></i></a>
                    </button>
                    <button>
                        <a href="#" class="btn btn-primary"> Read FAQs <i class="fas fa-arrow-up"></i></a>
                    </button>
                </div>

            </div>
        </div>
    </section>


@endsection
