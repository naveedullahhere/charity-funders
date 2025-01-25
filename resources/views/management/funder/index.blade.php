@extends('management.layouts.master')
@section('title')
Funder
@endsection
@section('content')
<div class="content-wrapper">

    <section id="extended">
        <div class="row w-100 mx-auto">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <h2 class="page-title"> Funders List</h2>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                <a href="{{ route('funder.create') }}" class="btn btn-primary position-relative ">
                    Create Funder
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form id="filterForm" class="form">
                            <div class="row ">


                                <div class="col-md-12 my-1 ">
                                    <div class="row justify-content ">
                                        <div class="col-md-2">
                                            <div class="form-group text-left">
                                                <label for="category_id">Category Name</label>
                                                <select name="category" id="category" class="form-control">
                                                    <option value="">Select a Category</option>
                                                    @foreach ($categories as $category)
                                                        <option {{request('category') == $category->id ? 'selected' : ''}}  value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group text-left">
                                                <label for="type_id">Type</label>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="">Select a Type</option>
                                                    @foreach ($types as $type)
                                                        <option {{request('type') == $type->id ? 'selected' : ''}} value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-left">
                                            <label for="customers" class="form-label">Search</label>
                                            <input type="text" class="form-control" id="search"
                                                placeholder="Search here i.e Charity No, Name, Email, Phone"
                                                name="search" value="{{request('search')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                        {{-- <a href="{{ route('export-roles') }}" class="btn btn-warning">Export Roles</a> --}}
                    </div>
                    <div class="card-content">
                        <div class="card-body table-responsive" id="filteredData">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1">Charity No </th>
                                        <th class="col-sm-2">Name</th>
                                        <th class="col-sm-2">Email/Phone</th>
                                        <th class="col-sm-2">Type</th>
                                        <th class="col-sm-2">Category</th>
                                        <th class="col-sm-1">created</th>
                                        <th class="col-sm-1">Status</th>
                                        <th class="col-sm-1">Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        filterationCommon(`{{ route('get.funder') }}`)
    });
</script>
@endsection