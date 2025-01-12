@extends('frontend.layouts.master')
@section('title', 'Collections')
@section('meta_title', 'Collections')
@section('meta_description', 'Collections')
@section('meta_keyword', 'Collections')
@section('content')

    @php
        use App\Helpers\CommonHelper;
    @endphp

    <style>
        .collection-card {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .collection-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
        }

        .collection-heading {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .collection-meta {
            font-size: 0.9rem;
            color: #777;
        }

        .event-text {
            font-size: 1rem;
            color: #555;
        }
    </style>

    <!-- Collections section start -->
    <section id="page-banner" class="d-flex align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row position-relative">
                <div class="page-content col-md-8 mx-auto">
                    <div class="page-title">
                        <h2 class="text-uppercase text-white">
                            My Collections
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="Collections" class="my-lg-5 my-md-2">
        <div class="container mt-lg-5">
{{--            <div class="row mb-4">--}}
{{--                <div class="col-12 objectives d-flex justify-content-between">--}}
{{--                    <h1>Our Collections</h1>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="row">
                @if(count($collections) != 0)
                @foreach ($collections as $item)
                    <div class="col-md-6 mb-4">
                        <div class="collection-card d-flex justify-content-between align-items-center">
                            <div>
                                <div>
                                    <p class="collection-meta">
                                        {{ CommonHelper::getGenericItemsByCollection($item)['img_count'] }} images /
                                        {{ CommonHelper::getGenericItemsByCollection($item)['vid_count'] }} videos
                                    </p>
                                </div>
                                <div>
                                    <p class="collection-heading text-uppercase">
                                        {{ $item->collection_name }}
                                        ({{ CommonHelper::getGenericItemsByCollection($item)['price'] }})
                                    </p>
                                </div>
                            </div>
                            <div>
                                <a href="{{ $item->id ? '/collections/' . $item->id : '#' }}" class="btn btn-dark">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                    <div class="no-record-found-box text-center">
                        <img  class="w-25" src="{{asset('/no-result-data.png')}}" alt="">
                        <p class="text-muted text-uppercase">No record found</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
