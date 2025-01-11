@extends('management.layouts.master')
@section('title')
    Dashboard
@endsection
@section('content')
    <style>
        .counter-box {
            padding: 15px;
            color: #212529;
            margin: 8px 0 25px 0;
            border-radius: 10px;
            min-height: 140px;
            background: #f0f0f0 !important;
        }
    </style>
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">Dashboard</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a>
                                <i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="counter-box text-center white">
                    <div class="text font-17 m-b-5">Total Purchases</div>
                    <h3 class="m-b-10 m-t-0">1025
                        <i class="material-icons col-red">trending_down</i>
                    </h3>
                    <div class="icon">
                        <span class="chart chart-line"><canvas width="60" height="45" style="display: inline-block; width: 60px; height: 45px; vertical-align: top;"></canvas></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="counter-box text-center white">
                    <div class="text font-17 m-b-5">Total Gallery Size</div>
                    <h3 class="m-b-10 m-t-0">956 MB
                        <i class="material-icons col-green">trending_up</i>
                    </h3>
                    <div class="icon">
                        <div class="chart chart-pie"><canvas width="45" height="45" style="display: inline-block; width: 45px; height: 45px; vertical-align: top;"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="counter-box text-center white">
                    <div class="text font-17 m-b-5">Total Active Photographer</div>
                    <h3 class="m-b-10 m-t-0">214
                        <i class="material-icons col-red">trending_down</i>
                    </h3>
                    <div class="icon">
                        <div class="chart" id="liveChart"><canvas width="60" height="45" style="display: inline-block; width: 60px; height: 45px; vertical-align: top;"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="counter-box text-center white">
                    <div class="text font-17 m-b-5">Total Active Users</div>
                    <h3 class="m-b-10 m-t-0">214
                        <i class="material-icons col-red">trending_down</i>
                    </h3>
                    <div class="icon">
                        <div class="chart" id="liveChart"><canvas width="60" height="45" style="display: inline-block; width: 60px; height: 45px; vertical-align: top;"></canvas></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <strong>Recent</strong> Order</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                            </li>
                        </ul>
                    </div>
                    <div class="tableBody">
                        <div class="table-responsive">

                            <table class="table tab-des">
                                <thead>
                                <tr>
                                    <th>Order No</th>
                                    <th>Customer</th>
                                    <th>No  of Images/Videos</th>
                                    <th>Price</th>
                                    <th class="text-center">Payment Method</th>
                                    <th class="text-center">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($orders) != 0)
                                    @foreach ($orders as $row)
                                        <tr>
                                            <td class="td-set new-lead">
                                                <div class="d-flex align-items-center">
                                                    <span class="fs-6 text-dark fw-semibold">#{{$row->id}}</span>
                                                </div>
                                            </td>
                                            <td class="td-set new-lead">
                                                {{ $row->lead_title }}.  {{ $row->lead_first_name.' '.$row->lead_last_name }}
                                                <small><br>{{$row->email}}</small>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="">
                                                        <div class="fs-5 fw-semibold text-dark">{{$row->vehicle_registration}}</div>
                                                        <small>{{$row->vehicle_model}}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td> <span class="fs-6 text-dark fw-semibold">£{{$row->product_price}}</span></td>
                                            <td class=" text-center"> <span class="badge badge-success text-white">{{$row->payment_method == 'COD' ? 'CARD' : $row->payment_method}}</span></td>
                                            <td class="text-center">
                                                @can('bookings-edit')
                                                    <button class="btn-sm btn-primary"
                                                            onclick="openModal('{{ route('bookings.show', $row->id) }}','View Booking')"><span
                                                                class="material-symbols-outlined">visibility</span></button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center py-5 error-box-table">
                                            No record found
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
        </div>
    </div>

@endsection
