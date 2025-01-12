@extends('frontend.layouts.master')
@section('title', 'Collections')
@section('meta_title', 'Collections')
@section('meta_description', 'Collections')
@section('meta_keyword', 'Collections')
@section('content')

    @php
        use App\Helpers\CommonHelper;
        use App\Models\Collection;

        $collections = Collection::with(['media.event'])
            ->where('status', 0)
            ->get();

        $basketItemIds = CommonHelper::getBasketItemIds()['collection'];
    @endphp
    <style>
        .media-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 5px;
            width: 100%;
        }

        .media-grid img,
        .media-grid .remaining-media {
            width: 100%;
            object-fit: cover;
            height: 200px;
        }

        .remaining-media {
            position: relative;
            background: rgba(0, 0, 0, 0.5);
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
        }

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
    </style>

    <section id="Events" class="my-lg-5 my-md-2">
        <div class="container mt-lg-5">
            <div class="row">
                <div class="col-12 objectives d-flex justify-content-between">
                    <h1>Collection</h1>
                </div>
            </div>
            <div class="row" id="gallery-container">
                <div class="col-md-5">
                    <div class="media-grid" data-lightbox="media-set">
                        @foreach ($collection->media as $index => $item)
                            @if ($index < 2)
                                <a href="{{ asset($item->file_path) }}" data-lightbox="media-set">
                                    <img src="{{ $item->file_path ? asset($item->file_path) : '/placeholder-image.jpg' }}"
                                        alt="{{ $item->name ?? 'Thumbnail' }}">
                                </a>
                            @endif
                            @if ($index > 2)
                                <a class="d-none" href="{{ asset($item->file_path) }}" data-lightbox="media-set">
                                    <img src="{{ $item->file_path ? asset($item->file_path) : '/placeholder-image.jpg' }}"
                                        alt="{{ $item->name ?? 'Thumbnail' }}">
                                </a>
                            @endif
                        @endforeach

                        @if ($collection->media->count() > 2)
                            @php
                                $thirdItem = $collection->media->get(2);
                                $fourthItem = $collection->media->count() > 3 ? $collection->media->get(3) : null;
                            @endphp
                            <a href="{{ asset($thirdItem->file_path) }}" data-lightbox="media-set">
                                <img src="{{ $thirdItem->file_path ? asset($thirdItem->file_path) : '/placeholder-image.jpg' }}"
                                    alt="{{ $thirdItem->name ?? 'Thumbnail' }}">
                            </a>
                            @if ($collection->media->count() > 3)
                                <div class="remaining-media"
                                    style="background-image: url('{{ $fourthItem ? asset($fourthItem->file_path) : '' }}');">
                                    +{{ $collection->media->count() - 3 }} more
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="col-md-7">
                    <h3>{{ ucwords($collection->collection_name) }}</h3>
                    <p class="event-text">{{ CommonHelper::getGenericItemsByCollection($collection)['img_count'] }} images
                        / {{ CommonHelper::getGenericItemsByCollection($collection)['vid_count'] }} videos</p>
                    <form class="{{ $collection->status === 1 ? 'disabled-form' : '' }}">
                        <div class="form-control mb-3 tuntuna px-2">
                            @foreach (['price' => 'Standard', 'high_price' => 'High'] as $key => $label)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="media_quality"
                                        id="price-{{ $key }}"
                                        value="{{ $label }}|{{ CommonHelper::getGenericItemsByCollection($collection, 1)[$key] }}">
                                    <label class="form-check-label" for="price-{{ $key }}">{{ $label }}
                                        Quality
                                        ({{ CommonHelper::getGenericItemsByCollection($collection)[$key] }})
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div title="{{ in_array($collection->id, $basketItemIds) ? 'Item already in cart. To add items to this collection, please remove the item from the cart first.' : '' }}"
                            data-toggle="tooltip" data-placement="top" data-html="true" class="d-inline">
                            <button type="button" class="btn btn-dark" @disabled(in_array($collection->id, $basketItemIds))
                                onclick="addToCart(this, {{ $collection->id }}, 'collection', {{ CommonHelper::getGenericItemsByCollection($collection, 1)['price'] }}, {{ CommonHelper::getGenericItemsByCollection($collection, 1)['total_media'] }})">Buy
                                now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
