@extends('customer.layouts.master')
@section('title')
    ORDER SUMMARY | #{{$order->order_no}}
@endsection
@section('content')
    <style>
        .booking-view   strong {
            font-weight: 700;
        }
        .booking-view th {
            padding: 10px;
            background: #80808014;
            font-size: 16px;
            text-transform: uppercase;
            font-weight: 700;
            color: black;
        }
        .booking-view td {
            padding: 10px;
            font-size: 16px;
            text-transform: uppercase;
            background: #eaeaea;
            color: black;
        }
    </style>
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
            /*max-width: 60% !important;*/
            /*margin-block: 5rem;*/
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



    <div class="thanksSec ">
        <div class="booking-view">
            <img class="my-3" style="width: 35%;" src="{{ asset('logos/ajp-logo.png') }}" alt="">
            <div class="bg-dark rounded-2 selectval my-3">
                <div class="py-3 d-flex container text-center mx-auto justify-content-between items-center text-white grid grid-cols-2 gap-6">
                    <h4 class=" uppercase m-0 font-medium text-white flex items-center">
                        ORDER SUMMARY
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


                <span class="theme-color d-block mb-2">Purchase Detail</span>

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




                <div class="line-item border-bottom-0">
                    <h5 class="font-weight-bold text-uppercase">Total Amount </h5>
                    <h5>${{number_format($cartItems->sum('price'),2)}}</h5>
                </div>



                <hr>
                <span class="theme-color d-block mb-2">Payment Detail </span>
                                            <div class="form-group">
                                                <table width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th width="85%">Payment Method</th>
                                                        <th width="15%">Price</th>
                                                        @if($order->payment_method == 'CARD')
                                                            <th width="15%"> Stripe Invoice</th>
                                                        @endif
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            {{$order->payment_method == 'COD' ? 'Cash On arrival' : $order->payment_method}}
                                                        </td>
                                                        <td>${{ $order->product_price }}</td>
                                                        @if($order->payment_method == 'CARD')
                                                            <td>
                                                                <a target="_blank" href="{{$order->transaction_key}}">View</a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>


            </div>
        </div>
        <div class="text-end my-3">
            <button id="download-pdf" class="btn btn-dark "><i class="fa-solid fa-download me-2"></i>Download Invoice</button>
        </div>

    </div>


{{--    <div class="col-">--}}
{{--        <div class="card border-0 mb-4 shadow-sm">--}}
{{--            <div class="bg-warning selectval">--}}
{{--                <div class="py-3 sm:flex container mx-auto items-center text-white grid grid-cols-2 gap-6">--}}
{{--            <span class="text-xs uppercase font-medium text-white flex items-center sm:col-span-2 px-4 md:px-0">--}}
{{--                <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="square-parking" class="svg-inline--fa fa-square-parking text-2xl md:text-4xl mr-3" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">--}}
{{--                    <g class="fa-duotone-group">--}}
{{--                        <path class="fa-secondary" fill="currentColor" d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM192 256h48c17.7 0 32-14.3 32-32s-14.3-32-32-32H192v64zm48 64H192v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V288 168c0-22.1 17.9-40 40-40h72c53 0 96 43 96 96s-43 96-96 96z"></path>--}}
{{--                        <path class="fa-primary" fill="currentColor" d="M192 192h48c17.7 0 32 14.3 32 32s-14.3 32-32 32H192V192zm0 128h48c53 0 96-43 96-96s-43-96-96-96H168c-22.1 0-40 17.9-40 40V288v64c0 17.7 14.3 32 32 32s32-14.3 32-32V320z"></path>--}}
{{--                    </g>--}}
{{--                </svg> Airport Parking--}}
{{--            </span>--}}
{{--                    <span class="text-xs uppercase font-medium text-white flex items-center px-4 col-span-1">--}}
{{--                <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="location-dot" class="svg-inline--fa fa-location-dot text-2xl md:text-4xl mr-3" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">--}}
{{--                    <g class="fa-duotone-group">--}}
{{--                        <path class="fa-secondary" fill="currentColor" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 112a80 80 0 1 1 0 160 80 80 0 1 1 0-160z"></path>--}}
{{--                        <path class="fa-primary" fill="currentColor" d="M192 144a48 48 0 1 0 0 96 48 48 0 1 0 0-96z"></path>--}}
{{--                    </g>--}}
{{--                </svg> {{$product->airport->title}}--}}
{{--            </span>--}}
{{--                    <span class="text-xs text-uppercase font-medium text-white flex items-center px-4 col-span-1">--}}
{{--                <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="plane-departure" class="svg-inline--fa fa-plane-departure text-2xl md:text-4xl mr-3" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">--}}
{{--                    <g class="fa-duotone-group">--}}
{{--                        <path class="fa-secondary" fill="currentColor" d="M0 480c0-17.7 14.3-32 32-32H608c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32z"></path>--}}
{{--                        <path class="fa-primary" fill="currentColor" d="M381 114.9L186.1 41.8c-16.7-6.2-35.2-5.3-51.1 2.7L89.1 67.4C78 73 77.2 88.5 87.6 95.2l146.9 94.5L136 240 77.8 214.1c-8.7-3.9-18.8-3.7-27.3 .6L18.3 230.8c-9.3 4.7-11.8 16.8-5 24.7l73.1 85.3c6.1 7.1 15 11.2 24.3 11.2H248.4c5 0 9.9-1.2 14.3-3.4L535.6 212.2c46.5-23.3 82.5-63.3 100.8-112C645.9 75 627.2 48 600.2 48H542.8c-20.2 0-40.2 4.8-58.2 14L381 114.9z"></path>--}}
{{--                    </g>--}}
{{--                </svg> {{date('D d M Y',strtotime($basket->arrival_date))}}--}}
{{--            </span>--}}
{{--                    <span class="text-xs text-uppercase  font-medium text-white flex items-center px-4 col-span-1">--}}
{{--                <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="plane-arrival" class="svg-inline--fa fa-plane-arrival text-2xl md:text-4xl mr-3" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">--}}
{{--                    <g class="fa-duotone-group">--}}
{{--                        <path class="fa-secondary" fill="currentColor" d="M128 368a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM0 480c0-17.7 14.3-32 32-32H608c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM256 352a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"></path>--}}
{{--                        <path class="fa-primary" fill="currentColor" d="M0 68l.2 98.9c0 8.4 3.4 16.5 9.3 22.5l82.9 83.5c8.1 8.1 18.2 14 29.3 16.9l298.4 77.7c42.6 11.1 87.6 8.6 128.8-7c28.8-10.9 34.8-49 10.7-68.2l-34.4-27.6c-13-10.4-27.8-18.1-43.7-22.8L374.2 210.2 265.2 16.3C259.5 6.2 248.8 0 237.3 0L197.2 0c-10.6 0-18.3 10.2-15.4 20.4l41.5 145.2L96 128 78.1 80.2c-3.8-10.1-12.5-17.7-23-20L19.5 52.3C9.5 50.1 0 57.7 0 68z"></path>--}}
{{--                    </g>--}}
{{--                </svg>{{date('D d M Y',strtotime($basket->return_date))}}</span>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="card-body p-lg-5">--}}
{{--                <div class="mb-5">--}}
{{--                    <h4 class="mb-1">Booking History</h4>--}}
{{--                </div>--}}

{{--                <div class="table-responsive">--}}


{{--                    <div class="row booking-view">--}}

{{--                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">--}}
{{--                            <h6>Product Detail</h6>--}}
{{--                            <div class="form-group">--}}
{{--                                <table width="100%">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>Product</th>--}}
{{--                                        <th>Provider</th>--}}
{{--                                        <th>Airport</th>--}}
{{--                                        <th>Arrival Date</th>--}}
{{--                                        <th>Return Date</th>--}}
{{--                                        <th>Price</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr class="text-uppercase">--}}
{{--                                        <td>--}}
{{--                                            <a target="_blank" href="{{route('product.edit',$product->id)}}">--}}
{{--                                                {{$product->title }}--}}
{{--                                            </a>--}}
{{--                                        </td>--}}
{{--                                        <td>{{ optional($product->provider)->title ?? '-----' }}</td>--}}
{{--                                        <td>{{ optional($product->airport)->title ?? '-----' }}</td>--}}
{{--                                        <td >{{date('D d M Y',strtotime($basket->arrival_date))}}</td>--}}
{{--                                        <td>{{date('D d M Y',strtotime($basket->return_date))}}</td>--}}
{{--                                        <td width="15%">${{ $order->product_price }}</td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">--}}
{{--                            <h6>Payment</h6>--}}
{{--                            <div class="form-group">--}}
{{--                                <table width="100%">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th width="85%">Payment Method</th>--}}
{{--                                        <th width="15%">Price</th>--}}
{{--                                        @if($order->payment_method == 'CARD')--}}
{{--                                            <th width="15%"> Stripe Invoice</th>--}}
{{--                                        @endif--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            {{$order->payment_method == 'COD' ? 'Cash On arrival' : $order->payment_method}}--}}
{{--                                        </td>--}}
{{--                                        <td>${{ $order->product_price }}</td>--}}
{{--                                        @if($order->payment_method == 'CARD')--}}
{{--                                            <td>--}}
{{--                                                <a target="_blank" href="{{$order->transaction_key}}">View</a>--}}
{{--                                            </td>--}}
{{--                                        @endif--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">--}}
{{--                            <h6>Lead Detail</h6>--}}
{{--                            <div class="form-group">--}}
{{--                                <table width="100%">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>Name</th>--}}
{{--                                        <th>Email</th>--}}
{{--                                        <th>Phone</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>{{$order->lead_title.'. '.' '.$order->lead_first_name.' '.$order->lead_last_name }}</td>--}}
{{--                                        <td>{{ $order->email }}</td>--}}
{{--                                        <td>{{ $order->lead_phone }}</td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">--}}
{{--                            <h6>Vehicle Detail</h6>--}}
{{--                            <div class="form-group">--}}
{{--                                <table width="100%">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th width="25%">Registration</th>--}}
{{--                                        <th width="25%">Model</th>--}}
{{--                                        <th width="25%">Color</th>--}}
{{--                                        <th width="25%">Passenger</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>{{$order->vehicle_registration}}</td>--}}
{{--                                        <td>{{ $order->vehicle_model }}</td>--}}
{{--                                        <td>{{ $order->vehicle_color }}</td>--}}
{{--                                        <td>{{ $order->passenger }}</td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">--}}
{{--                            <h6>Flight Detail</h6>--}}
{{--                            <div class="form-group">--}}
{{--                                <table width="100%">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th width="25%">Terminal Out</th>--}}
{{--                                        <th width="25%">Flight Out</th>--}}
{{--                                        <th width="25%">Terminal In</th>--}}
{{--                                        <th width="25%">Flight In</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $order->terminal_out }}</td>--}}
{{--                                        <td>{{ $order->flight_out }}</td>--}}
{{--                                        <td>{{$order->terminal_in}}</td>--}}
{{--                                        <td>{{ $order->flight_in }}</td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


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
