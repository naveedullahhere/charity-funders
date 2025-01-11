@extends('frontend.layouts.master')
@section('title', 'Checkout')
@section('meta_title', 'Complete Your Purchase')
@section('meta_description', 'Securely complete your purchase and provide shipping details.')
@section('meta_keyword', 'checkout, payment, shipping')

@section('content')
    <style>
        form .form-control {
            width: 100% !important
        }
    </style>

    <div class="container mt-5">
        <h1 class="mb-4">Checkout</h1>

        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('checkout.process') }}" class="require-validation" method="POST"
            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Billing Details</h5>
                            <input type="hidden" class="form-control" id="a" name="basketId"
                                   value="{{ old('basketId', $basketId) }}" required>

                            <div class="row mb-3">
                                <div class="px-0 col-12">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 ps-0">
                                    <label for="first_name" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                </div>
                                <div class="col-md-6 pe-0">
                                    <label for="last_name" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12 px-0">
                                    <label for="phone_no" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_no" name="phone_no" value="{{ old('phone_no') }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12 px-0">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 ps-0">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}" required>
                                </div>
                                <div class="col-md-3 pe-0">
                                    <label for="zip" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="zip" name="zip" value="{{ old('zip') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Summary</h5>
                            @foreach ($cartItems as $item)
                                <div class="d-flex justify-content-between mb-2">
                                    <span>
                                        @if ($item->media)
                                            {{ basename($item->media->file_path) }}
                                        @elseif($item->event)
                                            {{ $item->event->name }}
                                        @elseif($item->collection)
                                            {{ $item->collection->collection_name }}
                                        @else
                                            Unnamed Item
                                        @endif
                                        <span class="badge bg-dark">{{ ucwords($item->item_type) }}
                                            {{ $item->quantity > 1 ? '(' . $item->quantity . ')' : '' }}</span>
                                    </span>
                                    <span>${{ number_format($item->price, 2) }}</span>
                                </div>
                            @endforeach
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong>Total:</strong>
                                <strong>${{ number_format($totalPrice, 2) }}</strong>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-3">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pe-0">
                    <div class="card px-0">
                        <div class="card-body">
                            <div class="payment-type">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="payment_method" checked type="radio"
                                        id="cod" value="COD" />
                                    <label class="form-check-label text-uppercase" for="cod">Cash on Arrival</label>
                                </div>
                                @if (env('STRIPE_SWITCH') == 'true')
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="payment_method" type="radio"
                                            id="card" value="CARD" />
                                        <label class="form-check-label text-uppercase" for="card">Card</label>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if (env('STRIPE_SWITCH') == 'true')
                    <div class="col-12 mt-4 card_form" style="display: none">
                        <div class="card px-0">
                            <div class="card-body">
                                <div class="panel panel-default credit-card-box">
                                    <div class="panel-body">
                                        @if (Session::has('success'))
                                            <div class="alert alert-success text-center">
                                                <a href="#" class="close" data-dismiss="alert"
                                                    aria-label="close">×</a>
                                                <p>{{ Session::get('success') }}</p>
                                            </div>
                                        @endif
                                        <div>
                                            <div class='form-row row px-0'>
                                                <div class='col-xs-12 px-0 my-2 form-group required'>
                                                    <label class='control-label'>Name on Card</label> <input
                                                        class='form-control' size='4' type='text'>
                                                </div>
                                            </div>

                                            <div class='form-row row'>
                                                <div class='col-xs-12 px-0 my-2 form-group required'>
                                                    <label class='control-label'>Card Number</label> <input
                                                        autocomplete='off' class='form-control card-number'
                                                        size='20' type='text'>
                                                </div>
                                            </div>

                                            <div class='form-row row'>
                                                <div class='col-xs-12 ps-0 my-2 col-md-4 form-group cvc required'>
                                                    <label class='control-label'>CVC</label> <input autocomplete='off'
                                                        class='form-control card-cvc' placeholder='ex. 311'
                                                        size='4' type='text'>
                                                </div>
                                                <div class='col-xs-12  my-2 col-md-4 form-group expiration required'>
                                                    <label class='control-label'>Expiration Month</label> <input
                                                        class='form-control card-expiry-month' placeholder='MM'
                                                        size='2' type='text'>
                                                </div>
                                                <div class='col-xs-12 pe-0 my-2 col-md-4 form-group expiration required'>
                                                    <label class='control-label'>Expiration Year</label> <input
                                                        class='form-control card-expiry-year' placeholder='YYYY'
                                                        size='4' type='text'>
                                                </div>
                                            </div>

                                            <div class='form-row row'>
                                                <div class='col-md-12 px-0 my-2 error form-group d-none'>
                                                    <div class='alert-danger alert'>Please correct the errors and
                                                        try
                                                        again.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-12 mt-4">
                    <button class="btn btn-primary me-2" type="submit">Book Now</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(function() {
            $('[name="payment_method"]').change(({
                target
            }) => {
                console.log("ad");

                if ($(target).val() === "CARD") {
                    $(".card_form").slideDown();
                } else {
                    $(".card_form").slideUp();
                }
            });

            $(".card_form").slideUp();
        });

        $(function() {

            /*------------------------------------------
            --------------------------------------------
            Stripe Payment Code
            --------------------------------------------
            --------------------------------------------*/

            var $form = $(".require-validation");

            $form.on('submit', function(e) {
                e.preventDefault();
                var checkedValue = $('[name="payment_method"]:checked').val();

                if ((checkedValue === "CARD")) {

                    var $form = $(".require-validation"),
                        inputSelector = ['input[type=email]', 'input[type=password]',
                            'input[type=text]', 'input[type=file]',
                            'textarea'
                        ].join(', '),
                        $inputs = $form.find('.required').find(inputSelector),
                        $errorMessage = $form.find('div.error'),
                        valid = true;
                    $errorMessage.addClass('d-none');

                    $('.has-error').removeClass('has-error');
                    $inputs.each(function(i, el) {
                        var $input = $(el);
                        if ($input.val() === '') {
                            $input.parent().addClass('has-error');
                            $errorMessage.removeClass('d-none');
                            e.preventDefault();
                        }
                    });

                    if (!$form.data('cc-on-file')) {
                        e.preventDefault();
                        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                        Stripe.createToken({
                            number: $('.card-number').val(),
                            cvc: $('.card-cvc').val(),
                            exp_month: $('.card-expiry-month').val(),
                            exp_year: $('.card-expiry-year').val()
                        }, stripeResponseHandler);
                    }
                } else {
                    console.log("else");
                    $("#payment-form").off('submit').submit();
                }
            });

            /*------------------------------------------
            --------------------------------------------
            Stripe Response Handler
            --------------------------------------------
            --------------------------------------------*/
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('d-none')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>
@endsection
