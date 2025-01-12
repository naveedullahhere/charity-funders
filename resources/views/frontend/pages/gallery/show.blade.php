@extends('frontend.layouts.master')
@section('title', 'Collections')
@section('meta_title', 'Collections')
@section('meta_description', 'Collections')
@section('meta_keyword', 'Collections')
@section('content')

    @php
        use App\Helpers\CommonHelper;
        $mediaPrices = CommonHelper::getMediaPrices($media);
        $basketItemIds = CommonHelper::getBasketItemIds();
    @endphp
    <style>
        .lightbox img,
        .lightbox video {
            max-width: 90vw;
            max-height: 90vh;
            object-fit: contain;
        }

        .disabled-form * {
            pointer-events: none;
            opacity: 0.5;
        }

        .media-grid img {
            width: 100%;
        }
    </style>

    <section id="Events" class="my-lg-5 my-md-2">
        <div class="container mt-lg-5">
            <div class="row">
                <div class="col-12 objectives d-flex justify-content-between">
                    <h1>Media</h1>
                </div>
            </div>
            <div class="row" id="gallery-container">
                <div class="col-md-5">
                    <div class="media-grid" data-lightbox="media-set">
                        <a href="{{ asset($media->file_path) }}" data-lightbox="media-set">
                            <img src="{{ $media->file_path ? asset($media->file_path) : '/placeholder-image.jpg' }}"
                                alt="{{ $media->name ?? 'Thumbnail' }}">
                        </a>
                    </div>
                </div>

                <div class="col-md-7">
                    <h3>{{ ucwords($media->event->name) }}</h3>
                    <p class="event-text">{{ $media->file_type == 'image' ? '1 Image' : '1 Video' }}</p>
                    <form class="">
                        <div class="form-control mb-3 tuntuna px-2">
                            @if ($mediaPrices)
                                @foreach (['price' => 'Standard', 'high_price' => 'High'] as $key => $label)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="media_quality"
                                            id="price-{{ $key }}"
                                            value="{{ $label }}|{{ $mediaPrices[$key === 'price' ? ($media->file_type === 'video' ? 'price_per_video' : 'price_per_image') : ($media->file_type === 'video' ? 'price_per_high_video' : 'price_per_high_image')] }}">
                                        <label class="form-check-label" for="price-{{ $key }}">{{ $label }}
                                            Quality
                                            (${{ $mediaPrices[$key === 'price' ? ($media->file_type === 'video' ? 'price_per_video' : 'price_per_image') : ($media->file_type === 'video' ? 'price_per_high_video' : 'price_per_high_image')] }})
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div title="{{ in_array($media->id, $basketItemIds['media']) ? 'Item already in cart. To add items to this collection, please remove the item from the cart first.' : '' }}"
                            data-toggle="tooltip" data-placement="top" data-html="true" class="d-inline">
                            <button type="button" @disabled(in_array($media->id, $basketItemIds['media'])) class="btn btn-dark"
                                onclick="addToCart(this, {{ $media->id }}, 'media', {{ 1 }})">Buy
                                now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
