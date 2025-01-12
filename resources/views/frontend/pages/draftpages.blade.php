
<nav class="navbar fixed w-100 bg-transparent border-0">
    <div class="alert alert-warning m-0 w-100">
        <form method="post" class="m-0" action="{{route('page.update',$content->id)}}">
            @method('PUT')
            @csrf
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="m-0">Preview</h4>
                @if($content->status == 0)
                    <input type="hidden" name="status" value="1">
                    <button class="btn btn-warning" type="submit">Activate</button>
                @else
                    <input type="hidden" name="status" value="0">
                    <button class="btn btn-warning" type="submit">Draft</button>
                @endif
            </div>
        </form>
    </div>
</nav>

{{--draftpages--}}
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
