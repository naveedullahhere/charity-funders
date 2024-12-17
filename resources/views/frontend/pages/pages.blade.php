@extends('frontend.layouts.master')
@section('title',$content->title)
@section('meta_title', $content->meta_title ?? $content->title)
@section('meta_description', $content->meta_description)
@section('meta_keyword', $content->meta_keyword)
@section('content')
    <!--Hero start-->
    <div data-cue="fadeIn" class="bg-dark hero-banner-home"
        style="background-image: url({{ asset('frontend/assets/images/underground-car-parking-garage-with-vacant-places_107791-1635.jpg') }}); background-position: center; background-size: cover; background-repeat: no-repeat">
        <section class="py-7">
            <div class="container py-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center  py-lg-8" data-cue="zoomIn">
                            <h1 class="text-white"> {!! $content->title !!}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--Hero end-->
    {!! $content->description !!}

    @include('frontend.extra.footerformsearch')
@endsection
