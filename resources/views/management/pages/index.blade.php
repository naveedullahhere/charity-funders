@extends('management.layouts.master')
@section('title')
    Page
@endsection
@section('content')
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <ul class="breadcrumb breadcrumb-style ">
                    <li class="breadcrumb-item">
                        <h4 class="page-title">Static Pages</h4>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="header">
                <div class="row w-100 mx-auto">
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        @can('page-create')
                            <a onclick="openModal('{{ route('page.create') }}','Create Static Page')" type="button" class="btn btn-primary"> Create  Static Page
                            </a>
                        @endcan
                            <a href="{{route('export-page')}}" class="btn btn-warning">Export Static Pages</a>

                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <form id="filterForm" class="form">
                            <input type="text" name="search" class="form-control" placeholder="Search here">
                        </form>
                    </div>
                </div>
                <div class="body table-responsive" id="filteredData">


                </div>
            </div>
        </div>



        @endsection
        @section('script')
            <script>
                $(document).ready(function () {
                    filterationCommon(`{{route('get.page')}}`)
                });
            </script>
@endsection
