@extends('management/layouts/master')
@section('title')
    Business Profile
@endsection
@section('content')
    <!-- Center Main Content -->
    <section class="center-section">
        <div class="container-fluid">
            <form id="filterForm" class="form">
                <div class="row mb justify-content-end">
                    <div class="col-md-6 main-h">
                        <h1>{{count($business)}}  Business Profile</h1>
                    </div>
                    <div class="col-md-6 text-right">
                        <ul class="lead-d2">
                            <li>
                                <div class="h-search-form text-center">
                                    <input type="search" name="search" placeholder="Search..">
                                    <button><ion-icon class="fa fa-search" name="search-outline"></ion-icon></button>
                                </div>
                            </li>
                            <li>
                                @can('department-create')
                                    <a href="{{ route('business-profile.create') }}" class="btn-theme"><i class="fa fa-solid fa-plus"></i> &nbsp; Add New</a>
                                @endcan
                            </li>
                        </ul>

                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-md-12" id="filteredData">
                </div>
            </div>

        </div>
    </section>
    <!-- Center Main content End -->
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            filterationCommon(`{{route('get.business-profile')}}`)
        });
    </script>
@endsection
