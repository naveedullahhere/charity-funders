@extends('frontend.layouts.master')
@section('title')
    Products
@endsection
@section('content')
    <style>
        .products-search .card-body ul,
        .modal ul {
            padding: 0
        }

        .products-search .card-body ul>li,
        .modal ul>li {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' fill='green' class='bi bi-check-circle-fill text-success' viewBox='0 0 16 16'%3E%3Cpath d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: 14px;
            background-position: left center;
            padding-left: 2rem !important;
            list-style: none;
            font-size: 13px;
            margin-bottom: 0.5rem
        }

        .book-now-button .spinner-border {
            --bs-spinner-width: 1.4rem;
            --bs-spinner-height: 1.4rem;
            --bs-spinner-vertical-align: -0.125em;
            --bs-spinner-border-width: 0.15em;
        }
    </style>
    <div data-cue="fadeIn" class="bg-dark hero-banner-home"
        style="background-image: url({{ asset('frontend/assets/images/underground-car-parking-garage-with-vacant-places_107791-1635.jpg') }}); background-position: center; background-size: cover; background-repeat: no-repeat">
        <section class="py-7">
            <div class="container py-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center  py-lg-8" data-cue="zoomIn">
                            <h1 class="text-white"> Your Search Result</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="bg-primary selectval">
        <div class="py-3 text-center sm:flex container mx-auto items-center text-white grid grid-cols-2 gap-6">
            <span class="text-xs uppercase font-medium text-white flex items-center sm:col-span-2 px-4 md:px-0">
                <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="square-parking"
                    class="svg-inline--fa fa-square-parking text-2xl md:text-4xl mr-3" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <g class="fa-duotone-group">
                        <path class="fa-secondary" fill="currentColor"
                            d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM192 256h48c17.7 0 32-14.3 32-32s-14.3-32-32-32H192v64zm48 64H192v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V288 168c0-22.1 17.9-40 40-40h72c53 0 96 43 96 96s-43 96-96 96z">
                        </path>
                        <path class="fa-primary" fill="currentColor"
                            d="M192 192h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H192V192zm0 128h48c53 0 96-43 96-96s-43-96-96-96H168c-22.1 0-40 17.9-40 40V288v64c0 17.7 14.3 32 32 32s32-14.3 32-32V320z">
                        </path>
                    </g>
                </svg> Airport Parking
            </span>
            <span class="text-xs uppercase font-medium text-white flex items-center px-4 col-span-1">
                <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="location-dot"
                    class="svg-inline--fa fa-location-dot text-2xl md:text-4xl mr-3" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                    <g class="fa-duotone-group">
                        <path class="fa-secondary" fill="currentColor"
                            d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 112a80 80 0 1 1 0 160 80 80 0 1 1 0-160z">
                        </path>
                        <path class="fa-primary" fill="currentColor" d="M192 144a48 48 0 1 0 0 96 48 48 0 1 0 0-96z"></path>
                    </g>
                </svg> {{ \App\Helpers\CommonHelper::getProductName($airportSlug) }}
            </span>
            <span class="text-xs text-uppercase font-medium text-white flex items-center px-4 col-span-1">
                <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="plane-departure"
                    class="svg-inline--fa fa-plane-departure text-2xl md:text-4xl mr-3" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <g class="fa-duotone-group">
                        <path class="fa-secondary" fill="currentColor"
                            d="M0 480c0-17.7 14.3-32 32-32H608c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32z">
                        </path>
                        <path class="fa-primary" fill="currentColor"
                            d="M381 114.9L186.1 41.8c-16.7-6.2-35.2-5.3-51.1 2.7L89.1 67.4C78 73 77.2 88.5 87.6 95.2l146.9 94.5L136 240 77.8 214.1c-8.7-3.9-18.8-3.7-27.3 .6L18.3 230.8c-9.3 4.7-11.8 16.8-5 24.7l73.1 85.3c6.1 7.1 15 11.2 24.3 11.2H248.4c5 0 9.9-1.2 14.3-3.4L535.6 212.2c46.5-23.3 82.5-63.3 100.8-112C645.9 75 627.2 48 600.2 48H542.8c-20.2 0-40.2 4.8-58.2 14L381 114.9z">
                        </path>
                    </g>
                </svg> {{ date('D d M Y', strtotime($arrival_date)) }}
            </span>
            <span class="text-xs text-uppercase  font-medium text-white flex items-center px-4 col-span-1">
                <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="plane-arrival"
                    class="svg-inline--fa fa-plane-arrival text-2xl md:text-4xl mr-3" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <g class="fa-duotone-group">
                        <path class="fa-secondary" fill="currentColor"
                            d="M128 368a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM0 480c0-17.7 14.3-32 32-32H608c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM256 352a32 32 0 1 1 0 64 32 32 0 1 1 0-64z">
                        </path>
                        <path class="fa-primary" fill="currentColor"
                            d="M0 68l.2 98.9c0 8.4 3.4 16.5 9.3 22.5l82.9 83.5c8.1 8.1 18.2 14 29.3 16.9l298.4 77.7c42.6 11.1 87.6 8.6 128.8-7c28.8-10.9 34.8-49 10.7-68.2l-34.4-27.6c-13-10.4-27.8-18.1-43.7-22.8L374.2 210.2 265.2 16.3C259.5 6.2 248.8 0 237.3 0L197.2 0c-10.6 0-18.3 10.2-15.4 20.4l41.5 145.2L96 128 78.1 80.2c-3.8-10.1-12.5-17.7-23-20L19.5 52.3C9.5 50.1 0 57.7 0 68z">
                        </path>
                    </g>
                </svg>{{ date('D d M Y', strtotime($return_date)) }}</span>
        </div>
    </div>
    <!-- products -->
    @if (isset($products) && count($products) != 0)
        <section class="pt-4 ">
            <div class="container price-wrapper">
                <div class="table-responsive-xl">
                    <div class="row pb-4 me-5 me-lg-0">
                        @foreach ($products as $row)
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <!--card-->
                                <div class="card pricing products-search">
                                    <div class="card-body">
                                        <img class="card-img" src="{{ url('file', $row->logo) }}" alt="">

                                        <div class="my-3">
                                            <h4>{{ $row->product_title }}</h4>
                                            <p class="mb-0">{{ optional($row->space)->name }}</p>
                                        </div>
                                        {!! $row->selling_points !!}
                                        <div>
                                            <a class="more-info-btn" data-bs-toggle="modal"
                                                data-bs-target="#modal{{ $row->product_id }}" href="">More Info</a>
                                        </div>
                                        <p class="text-center my-0 text-uppercase fw-bold"><small>Today's Price</small></p>
                                        <h2 class="mb-4 d-flex align-items-center justify-content-center">
                                            £{{ $row->price }}
                                        </h2>
                                        <div class="d-grid mt-6">

                                            <input type="hidden" value="{{ $row->product_id }}" name="id">
                                            <input type="hidden" value="{{ $row->price }}" name="price">
                                            <a class="btn btn-primary book-now-button">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                                <!--card-->
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- products -->

        <!-- Modal -->
        @foreach ($products as $row)
            <div class="modal fade" id="modal{{ $row->product_id }}" tabindex="-1"
                aria-labelledby="modal{{ $row->product_id }}Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="card pricing">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="card-img" src="{{ url('file', $row->logo) }}" alt="">
                                        </div>
                                        <div class="col-md-6">
                                            <h4>{{ $row->product_title }}</h4>
                                            {!! $row->selling_points !!}
                                        </div>
                                        <div class="col-md-3">
                                            <p class="text-center my-0 text-uppercase fw-bold"><small>Today's Price</small>
                                            </p>
                                            <h2 class="d-flex align-items-center justify-content-center">
                                                £{{ $row->price }}
                                            </h2>
                                            <div class="d-grid">
                                                <input type="hidden" value="{{ $row->product_id }}" name="id">
                                                <a class="btn btn-primary book-now-button">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! $row->long_description !!}
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @elseif(isset($error))
        <div class="text-center my-5">
            <h1 class="text-dark">
                {{ $error }}
            </h1>
        </div>
    @endif
@endsection
