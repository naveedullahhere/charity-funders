@extends('management.layouts.master')
@section('title')
Contact (Inquiry)
@endsection
@section('content')
<div class="content-wrapper">

    <section id="extended">
        <div class="row w-100 mx-auto">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <h2 class="page-title"> Contact (Inquiry)</h2>
            </div>
            {{-- <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                <button onclick="openModal(this,'{{ route('workareas.create') }}','Add Work Areas')" type="button"
                    class="btn btn-primary position-relative ">
                    Create Work Areas
                </button>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form id="filterForm" class="form">
                            <div class="row">
                                <!-- Search Input -->
                                <div class="col-md-12 my-1">
                                    <div class="row justify-content-end text-right">
                                        <div class="col-md-2">
                                            <label for="search" class="form-label">Search</label>
                                            <input type="hidden" name="page" value="{{ request('page', 1) }}">

                                            <input type="text" class="form-control" id="search" name="search"
                                                placeholder="Search here" value="{{ request('search', '') }}">
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
                                        <th class="col-sm-2">Name</th>
                                        <th class="col-sm-2">Email/Phone</th>
                                        <th class="col-sm-4">Message</th>
                                        <th class="col-sm-2">Created</th>
                                        <th class="col-sm-2">Action</th>
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
        filterationCommon(`{{ route('get.contact') }}`)
    });
</script>
@endsection