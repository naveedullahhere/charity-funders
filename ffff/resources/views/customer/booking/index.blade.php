@extends('customer.layouts.master')
@section('title')
    Booking History
@endsection
@section('content')
    <div class="col-">
        <div class="card border-0 mb-4 shadow-sm">
            <div class="card-body p-lg-5">
                <div class="mb-5">
                    <h4 class="mb-1">Booking History</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered td table-centered th table-lg text-nowrap">
                        <thead>
                        <tr class="bg-dark text-white">
                            <th width="10%" scope="col">
                                <span class="fs-6  text-white fw-semibold text-uppercase">Order No</span>
                            </th>
                            <th width="40%"  scope="col">
                                <div class="fs-6  text-white  fw-semibold text-uppercase">Name & Email</div>
                            </th>

                            <th width="10%"  scope="col">
                                <div class="fs-6 text-white  fw-semibold text-uppercase">Price</div>
                            </th>
                            <th width="15%" scope="col" class=" text-center">
                                <div class="fs-6 text-white   fw-semibold text-uppercase"> Payment  Method</div>
                            </th>
                            <th scope="col">
                                <div class="fs-6 text-white fw-semibold text-uppercase"> Action</div>

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="fs-6 text-dark fw-semibold">#{{$order->order_no}}</span>
                                    </div>
                                </td>
                                <th >
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            <div class="fs-5 fw-semibold text-dark">{{$order->first_name.' '.$order->last_name}}</div>
                                            <small>{{$order->email}}</small>
                                        </div>
                                    </div>
                                </th>
                                <td> <span class="fs-6 text-dark fw-semibold">${{$order->product_price}}</span></td>
                                <td class=" text-center"> <span class="btn btn-sm btn-outline-success">{{$order->payment_method}}</span></td>




                                <td>
                                    <a  href="{{ route('booking-history.show', ['id' => $order->inv_id]) }}" class="btn btn-sm btn-dark">View</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
