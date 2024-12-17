@extends('frontend.layouts.master')
@section('title', 'Cart')
@section('meta_title', 'Cart')
@section('meta_description', 'Cart')
@section('meta_keyword', 'Cart')
@section('content')

    <style>
        /* General Page Styles */
        h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Cart Item Styles */
        .cart-item img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .cart-item h5 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .cart-item p {
            font-size: 1rem;
            color: #6c757d;
        }

        .cart-item .badge {
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .delete-item {
            font-size: 0.9rem;
            border: 0;
            background: transparent;
            transition: all .3s ease;
        }

        .delete-item:hover {
            color: #c82333;
            scale: 1.1
        }

        /* Order Summary Styles */
        .order-summary {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
        }

        .order-summary h5 {
            font-weight: bold;
        }

        .order-summary p {
            font-size: 1rem;
            color: #6c757d;
        }

        .order-summary h4 {
            font-size: 1.5rem;
            font-weight: bold;
            color: rgb(00 0 0) !important;
        }

        /* Buttons Styles */
        .btn-primary {
            border: none;
            padding: 12px 20px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }
    </style>

    <div class="container mt-4">

        <div class="row">
            <!-- Cart Items Section -->
            <div class="col-12">
                <h2>Your Cart</h2>
            </div>
            @if (count($cartItems) != 0)
                <div class="col-md-7 px-0">
                    <div class="row w-100 mx-auto" id="cartItems">
                        @foreach ($cartItems as $item)
                            <div class="col-md-12 mb-3 cart-item" data-id="{{ $item->id }}">
                                <div class="card p-3">
                                    <div class="row align-items-center w-100">
                                        <div class="col-md-3">
                                            @if ($item->media)
                                                <img src="{{ $item->media->file_path ? asset($item->media->file_path) : '/placeholder-image.jpg' }}"
                                                    alt="{{ $item->media->name ?? 'Thumbnail' }}">
                                            @elseif ($item->event)
                                                <img src="{{ $item->event->thumbnail ? asset($item->event->thumbnail) : '/placeholder-image.jpg' }}"
                                                    alt="{{ $item->media->name ?? 'Thumbnail' }}">
                                            @elseif ($item->collection)
                                                <img src="{{ isset($item->collection->media[0]->file_path) ? asset($item->collection->media[0]->file_path) : '/placeholder-image.jpg' }}"
                                                    alt="{{ $item->media->name ?? 'Thumbnail' }}">
                                            @endif
                                        </div>
                                        <div class="col-md-5">
                                            @if ($item->media)
                                                <h5>{{ basename($item->media->file_path) }}</h5>
                                            @elseif ($item->event)
                                                <h5>{{ ucwords($item->event->name) }}</h5>
                                            @elseif ($item->collection)
                                                <h5>{{ ucwords($item->collection->collection_name) }}</h5>
                                            @else
                                                <h5>Unnamed Item</h5>
                                            @endif
                                            <p>Price: ${{ number_format($item->price, 2) }}</p>
                                            <span class="badge bg-dark">{{ ucwords($item->item_type) }}
                                                {{ $item->quantity > 1 ? '(' . $item->quantity . ')' : '' }}</span>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <button class="delete-item" data-id="{{ $item->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="col-md-5">
                    <div class="order-summary">
                        <h5>Order Summary</h5>
                        <hr>
                        <p class="mt-5">Total Items: <strong>{{ count($cartItems) }}</strong></p>
                        <h4>Total Amount: $<span id="totalPrice">{{ number_format($totalPrice, 2) }}</span></h4>

                        <div class="d-flex justify-content-between flex-column gap-3 mt-5">
                            <a href="{{ route('checkout', ['unique_id' => $basket->uniq_id]) }}"
                                class="btn btn-dark w-100">Checkout</a>
                            <a href="{{ route('/') }}" class="d-block btn btn-secondary w-100">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-12 mb-3 no-record-found-box text-center">
                    <img class="w-25" src="{{ asset('/no-result-data.png') }}" alt="">
                    <p class="text-muted text-uppercase">Your cart is empty.</p>
                </div>
            @endif
        </div>
    </div>

@endsection
