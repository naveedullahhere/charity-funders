@extends('frontend.layouts.master')
@section('title')
    Thank You  {{ $order->first_name . ' '.  $order->last_name}} For  Order
@endsection
@section('content')
    <style>
        .theme-color {
            color: #0a4171;
            background: #161717;
            color: white;
            padding: 10px;
            margin-bottom: 0px !important;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
        }

        hr.customrow {
            border-top: 4px dashed #0a4171;
            margin: 0.4rem 0;
        }

        .thanksSec {
            max-width: 60% !important;
            margin-block: 5rem;
        }

        @media (min-width: 576px) {
            .thanksSec {
                margin-left: auto;
                margin-right: auto;
                max-width: var(--bs-modal-width);
            }
        }

        .text--sm {
            font-size: 12px;
        }

        .line-item {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            padding: 10px;
            border-bottom: 1px solid #f4f4f4;
        }
        .line-item-grey {
            display: flex;
            justify-content: space-between;
            padding: 4px;
            border-bottom: 2px solid #ffffff;
            background: #eaeaea;
            color: #000000;
            font-size: 18px;
            padding: 10px;
        }
    </style>

    {{--    <div data-cue="fadeIn" class="bg-dark hero-banner-home"--}}
    {{--         style="background-image: url({{ asset('frontend/assets/images/underground-car-parking-garage-with-vacant-places_107791-1635.jpg') }}); background-position: center; background-size: cover; background-repeat: no-repeat">--}}
    {{--        <section class="py-7">--}}
    {{--            <div class="container py-3">--}}
    {{--                <div class="row">--}}
    {{--                    <div class="col-lg-12">--}}
    {{--                        <div class="text-center py-lg-8" data-cue="zoomIn">--}}
    {{--                            <h1 class="text-white"> Thank you 💖</h1>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </section>--}}
    {{--    </div>--}}

    <div class="thanksSec ">
        <div class="booking-view">
            <img class="my-3" style="width: 35%;" src="{{ asset('logos/ajp-logo.png') }}" alt="">
            <div class="bg-dark rounded-2 selectval my-3">
                <div class="py-3 d-flex container text-center mx-auto justify-content-between items-center text-white grid grid-cols-2 gap-6">
                    <h4 class=" uppercase m-0 font-medium text-white flex items-center">
                        THANK YOU 💖 FOR YOUR ORDER
                    </h4>
                    <h4 class="text m-0 text-uppercase  font-medium text-white flex items-center px-4 col-span-1">
                        ORDER NO: {{$order->order_no}}</h4>
                </div>
            </div>


            <div class="px-3 py-5 bg-light rounded-2">
                <div class="d-flex justify-content-between">
                    <h4 class="text-uppercase"><span class="d-block fw-bold">{{ $order->first_name . ' '.  $order->last_name}}</span>
                        <small class="text-muted text--sm text-lowercase">
                            ({{$order->phone_no}} | {{$order->email}})
                        </small>
                    </h4>
                    <span>
                        {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i A') }}
                    </span>
                </div>


                <span class="theme-color d-block mb-2">Purchase Items</span>

                @foreach ($cartItems as $item)
                    <div class="line-item-grey">
                        <small>
                            @if ($item->item_type == 'media')

                                {{ basename($item->media->file_path) }}
                            @elseif($item->item_type == 'event')
                                {{ $item->event->name }}
                            @elseif($item->item_type == 'collection')
                                {{ $item->collection->collection_name }}
                            @else
                                Unnamed Item
                            @endif

                                <span class="badge bg-dark">{{ ucwords($item->item_type) }}
                                    {{ $item->quantity > 1 ? '(' . $item->quantity . ')' : '' }}</span>
                        </small>
                        <small>${{ number_format($item->price, 2) }}
                        </small>
                    </div>
                @endforeach




                <div class="line-item border-bottom">
                    <h5 class="font-weight-bold text-uppercase">Total Amount </h5>
                    <h5>${{number_format($cartItems->sum('price'),2)}}</h5>
                </div>
                <div class="line-item border-bottom-0">
                    <h5 class="font-weight-bold text-uppercase ">Payment Method </h5>
                    <h5>{{ $order->payment_method }}</h5>
                </div>



            </div>
        </div>
        <div class="text-end my-3">
            <button id="download-pdf" class="btn btn-dark "><i class="fa-solid fa-download me-2"></i>Download Invoice</button>
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>


    <script>
        document.getElementById('download-pdf')?.addEventListener('click', function () {
            const element = document.querySelector('.booking-view'); // Select the div to convert

            const opt = {
                margin:       0.5,
                filename:     'Invoice-{{$order->order_no}}.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();
        });
    </script>
@endsection
