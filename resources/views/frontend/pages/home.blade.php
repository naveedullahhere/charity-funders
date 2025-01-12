@extends('frontend.layouts.master')
@section('title', 'Home')
@section('meta_title', 'Home')
@section('meta_description', 'Home')
@section('meta_keyword', 'Home')
@section('content')
    
    <!-- .............................................Section-1......................................... -->
    <section class="main-banner ">
        <div class="main-container d-flex pt-5">
            <div class="row align-items-end  justify-content-between">
                <div class="col-lg-7  col-md-12 p-0 col-sm-12">
                    <div class="heading">
                        <h2>The most cost-effective and comprehensive grant finding service.</h2>
                    </div>
                </div>

                <div class="col-lg-4  col-md-12 p-0 col-sm-12">
                    <div class="para">
                        <p>Charity Funders was developed by a group of Fundraisers with over <b>20 years’ </b>experience
                            fundraising for the not for profit sector.</p>
                        <button class="btn-3">
                            <a href="about">Learn more </a> <i class="fas fa-arrow-up"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <!-- ..................................Section-2...................................... -->

    <section class="section-2 mt-n-25">
        <div class="main-container">
            <div class="row">
                <div class="main-video">

                    <img src="{{asset('charity/images/video-img.png')}}" alt="" class="img-fluid">

                    <div id="counter">
                        <div class="item">
                            <h1 class="count " data-number="4500" data-speed="100000000"></h1>
                            <p class="text m-auto">Charitable trusts & foundations</p>
                        </div>
                        <div class="item">
                            <h1 class="count " data-number="500" data-speed="100000000"></h1>
                            <p class="text m-auto">Corporate foundations</p>
                        </div>
                        <div class="item">
                            <h1 class="count " data-number="4" data-speed="100000000"></h1>
                            <p class="text m-auto">Registered sources of funding</p>
                        </div>
                        <div class="item">
                            <h1 class="count " data-number="50" data-speed="100000000"></h1>
                            <p class="text m-auto">Subscription form £50 - a cost effective funding solution</p>
                        </div>
                        <div class="item">
                            <h1 class="count " data-number="40000000" data-speed="100000000"> </h1>
                            <p class="text m-auto">Two services for the price of one</p>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- ............................................Section-3..................................... -->

    <section class="image-with-text">
        <div class="image-with-text-container">
            <div class="row m-0 align-items-center">
                <div class="col-lg-6 col-md-12 col-sm-12 p-0">
                    <img src="{{asset('charity/images/finance-wealth-banner-with-human-hand-copy-space 1.png')}}" class="img-fluid" alt="Image">
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 p-0">
                    <div class="content">
                        <h2 class="mt-md-2">About us</h2>
                        <p class="mt-lg-3 mb-lg-5"><b>Charity Funders</b> was developed by
                            <span style="color: #FF7260;"> a group of Fundraisers with over 20 years’ experience </span>
                            fundraising for the not for profit sector. As Fundraisers ourselves, we know exactly what matters to you and give you
                            the information you need at your fingertips, helping you save time and energy. We’re the UK’s
                            most advanced online grant finding service, packed full of innovative and never before seen
                            features, we make fundraising easier and that’s a promise!</p>
                        <button class="btn-3">
                            <a href="about">Read more </a> <i class="fas fa-arrow-up"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ...............................................Section-4....................................... -->
    <section class="icon-with-text-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="container">
                    <p class=" ">With subscriptions from just £50, can you afford not to subscribe?</p>
                </div>
                <div class="icon-box-container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="icon-box">
                                <img src="{{asset('charity/images/Expertise.png')}}" alt="" class="img-fluid">
                                <h3 class="">Expertise</h3>
                                <p>Developed by fundraising professionals</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="icon-box">
                                <img src="{{asset('charity/images/Data-driven.png')}}" alt="" class="img-fluid">
                                <h3 class="">Data-driven</h3>
                                <p>More information, analysis
                                    and discussion than anywhere else</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="icon-box">
                                <img src="{{asset('charity/images/Innovation.png')}}" alt="" class="img-fluid">
                                <h3 class="">Innovation</h3>
                                <p>Intuitive navigation, intelligent search options and filters</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="icon-box">
                                <img src="{{asset('charity/images/Accessibility.png')}}" alt="" class="img-fluid">
                                <h3 class="">Accessibility</h3>
                                <p>With flexible subscriptions and free multiple licenses</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="icon-box">
                                <img src="{{asset('charity/images/Comprehensive.png')}}" alt="">
                                <h3 class="">Comprehensive</h3>
                                <p>The largest prospect database</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="icon-box">
                                <img src="{{asset('charity/images/License.png')}}" alt="">
                                <h3 class="">License</h3>
                                <p> Flexible subscriptions and free multiple licenses</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- .....................................Section-5........................................ -->
    <section class="Call-to-action">
        <div class="Action-container">
            <div class="Action">
                <div class="content">
                    <h2>Got a question? <br> We’d love to hear from you</h2>
                </div>
            </div>
            <div class="row-eww">
                <button class="btn-3">
                    <a href="contact">Contact Us </a> <i class="fas fa-arrow-up"></i>
                </button>
                <button class="btn-3">
                    <a href="faqs">Read FAQS </a> <i class="fas fa-arrow-up"></i>
                </button>
            </div>
        </div>
    </section>



@endsection
