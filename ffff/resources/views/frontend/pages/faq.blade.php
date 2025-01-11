@extends('frontend.layouts.master')
@section('title', 'Home')
@section('meta_title', 'Home')
@section('meta_description', 'Home')
@section('meta_keyword', 'Home')
@section('content')
 
    <link rel="stylesheet" href="{{ asset('charity/subs.css') }}">

<!-- ........................section-1............................... -->
<section class="Faqs-Banner">
    <div class="main-container">
        <div class="about-container">
            <div class="main-heading">
                <h1>FAQs</h1>
            </div>
            <div class="text-line">
                <p>Frequently asked questions</p>
            </div>
        </div>
    </div>
</section>


<!-- ........................section-2............................... -->
<div class="cordion">
    <div class="row justify-content-center acordion-row ">
        <div class="col-lg-10 md-12 sm-12">
            <div class="accordion" id="faqExample">
                <div class="cardo">
                    <div class="card-header p-4" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link link" type="button" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                style="display: flex; padding: 0; justify-content: space-between; align-items: center; width: 100% !important;">
                                <div class="question">
                                    <h3 class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                </div>
                                <div>
                                    <img src="{{('charity/images/faqs-arrow.png')}}">
                                </div>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#faqExample">
                        <div class="card-body">
                            <p class="mb-0">Our dedicated team add their unique insight into fundraising, produce
                                detailed reports on funders and, in a dynamic and fast-moving environment, regularly
                                update data to ensure the information you receive is both relevant and appropriate.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="cardo">
                    <div class="card-header p-4" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link link" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"
                                style="display: flex; padding: 0; justify-content: space-between; align-items: center; width: 100% !important;">
                                <div class="question">
                                    <h3 class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                </div>
                                <div>
                                    <img src="{{('charity/images/faqs-arrow.png')}}">
                                </div>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqExample">
                        <div class="card-body">
                            <p class="mb-0">This is the answer to the second question. More details about the topic
                                go here.</p>
                        </div>
                    </div>
                </div>
                <div class="cardo">
                    <div class="card-header p-4" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link link" type="button" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"
                                style="display: flex; padding: 0; justify-content: space-between; align-items: center; width: 100% !important;">
                                <div class="question">
                                    <h3 class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                </div>
                                <div>
                                    <img src="{{('charity/images/faqs-arrow.png')}}">
                                </div>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#faqExample">
                        <div class="card-body">
                            <p class="mb-0">Answer to the third question. Additional information is provided here.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="cardo">
                    <div class="card-header p-4" id="headingFour">
                        <h5 class="mb-0">
                            <button class="btn btn-link link" type="button" data-toggle="collapse"
                                data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"
                                style="display: flex; padding: 0; justify-content: space-between; align-items: center; width: 100% !important;">
                                <div class="question">
                                    <h3 class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                </div>
                                <div>
                                    <img src="{{('charity/images/faqs-arrow.png')}}">
                                </div>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqExample">
                        <div class="card-body">
                            <p class="mb-0">Answer to the third question. Additional information is provided here.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="cardo">
                    <div class="card-header p-4" id="headingFive">
                        <h5 class="mb-0">
                            <button class="btn btn-link link" type="button" data-toggle="collapse"
                                data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"
                                style="display: flex; padding: 0; justify-content: space-between; align-items: center; width: 100% !important;">
                                <div class="question">
                                    <h3 class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                </div>
                                <div>
                                    <img src="{{('charity/images/faqs-arrow.png')}}">
                                </div>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#faqExample">
                        <div class="card-body">
                            <p class="mb-0">Answer to the third question. Additional information is provided here.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="cardo">
                    <div class="card-header p-4" id="headingsix">
                        <h5 class="mb-0">
                            <button class="btn btn-link link" type="button" data-toggle="collapse"
                                data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix"
                                style="display: flex; padding: 0; justify-content: space-between; align-items: center; width: 100% !important;">
                                <div class="question">
                                    <h3 class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                </div>
                                <div>
                                    <img src="{{('charity/images/faqs-arrow.png')}}">
                                </div>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#faqExample">
                        <div class="card-body">
                            <p class="mb-0">Answer to the third question. Additional information is provided here.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Add more accordion items as needed -->
            </div>
        </div>
    </div>
</div>




    @include('frontend.pages.scripts')

    @include('frontend.pages.collections.index')
@endsection
