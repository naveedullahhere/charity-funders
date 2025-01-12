@extends('frontend.layouts.master')
@section('title', 'Gallery')
@section('meta_title', 'Gallery')
@section('meta_description', 'Gallery')
@section('meta_keyword', 'Gallery')
@section('content')

    @php
        use App\Helpers\CommonHelper;

        $basketItemIds = CommonHelper::getBasketItemIds();

    @endphp

<section id="page-banner" style="background: url({{asset($eventdetail->thumbnail)}});" class="d-flex align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row position-relative">
            <div class="page-content col-md-8 mx-auto">
                <div class="page-title d-flex justify-content-between px-4 align-items-center">
                    <h2 class="text-uppercase text-white">
                        {{$eventdetail->name}}
                    </h2>
                    <h4 class="text-white m-0">
                        $ {{$eventdetail->whole_event_price}}
                    </h4>
                </div>

                <div title="{{ in_array($slug, $basketItemIds['event']) ? 'Item already in cart. please remove the item from the cart first.' : '' }}"
                     data-toggle="tooltip" data-placement="top" data-html="true" class="d-inline optionbox text-end">
                    <button type="button" @disabled(in_array($slug, $basketItemIds['event'])) class="btn btn-dark hover-blur-effect mt-3 text-uppercase"
                            onclick="openQualityModal(this, {{ $slug }}, {{ $event_price }}, {{ $high_event_price }})">
                        <i class="fa-solid fa-cart-shopping me-2 "></i>
                        Buy whole event
                        </button>
                </div>
            </div>
        </div>
    </div>
</section>


    <style>
        #qualityModal {}

        #qualityModal label {
            margin-left: 14px;
        }

        #qualityModal input {
            margin-left: 8px;
        }
    </style>
    <section id="Events" class="my-lg-5 my-md-2">
        <div class="container mt-lg-5">
            <div class="row pb-5">
                <div class="col-12 objectives d-flex justify-content-between">
                    <h1>Event Gallery</h1>
{{--                    <div title="{{ in_array($slug, $basketItemIds['event']) ? 'Item already in cart. please remove the item from the cart first.' : '' }}"--}}
{{--                        data-toggle="tooltip" data-placement="top" data-html="true" class="d-inline optionbox text-end">--}}
{{--                        <button type="button" @disabled(in_array($slug, $basketItemIds['event'])) class="btn btn-dark"--}}
{{--                            onclick="openQualityModal(this, {{ $slug }}, {{ $event_price }}, {{ $high_event_price }})">Buy--}}
{{--                            now</button>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="row" id="gallery-container">
                @include('frontend.pages._media', ['media' => $media])
            </div>

            @if ($media->hasMorePages())
                <div class="col-md-12 d-flex justify-content-center my-3">
                    <button type="button" class="load" id="load-more-gallery-btn"
                        data-page="{{ $media->currentPage() }}">
                        Load More
                        <span class="spinner-border spinner-border-sm d-none"></span>
                    </button>
                </div>
            @endif
        </div>
    </section>

    <!-- Quality Selection Modal -->
    <div class="modal fade" id="qualityModal" tabindex="-1" role="dialog" aria-labelledby="qualityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qualityModalLabel">Select Quality</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="qualityOptions" id="standardQuality"
                            value="standard" checked>
                        <label class="form-check-label" for="standardQuality">
                            Standard Quality - Price: <span id="standardPrice"></span>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="qualityOptions" id="highQuality"
                            value="high">
                        <label class="form-check-label" for="highQuality">
                            High Quality - Price: <span id="highPrice"></span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="confirmSelection()">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let selectedSlug;
        let selectedEventPrice;
        let selectedHighEventPrice;
        let evt;

        function openQualityModal(e, slug, eventPrice, highEventPrice) {
            selectedSlug = slug;
            selectedEventPrice = eventPrice;
            selectedHighEventPrice = highEventPrice ?? 0;

            evt = e;
            document.getElementById('standardPrice').innerText = selectedEventPrice;
            document.getElementById('highPrice').innerText = selectedHighEventPrice;

            $('#qualityModal').modal('show');
        }

        function confirmSelection() {
            const selectedQuality = document.querySelector('input[name="qualityOptions"]:checked').value;
            const price = selectedQuality === 'standard' ? selectedEventPrice : selectedHighEventPrice;
            addToCart(evt, selectedSlug, 'event', price);
            $('#qualityModal').modal('hide');
        }
    </script>
    @include('frontend.pages.scripts')
    @include('frontend.pages.collections.index')
@endsection
