@extends('management.layouts.master')
@section('title')
Companies
@endsection
@section('content')
<div class="content-wrapper">

    <section id="extended">
        <div class="row w-100 mx-auto">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <h2 class="page-title"> Create Companies</h2>
            </div>
           
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-content">
                        <div class="card-body table-responsive">

                            <form action="{{ route('company.store') }}" method="POST" id="ajaxSubmit"
                                autocomplete="off">
                                @csrf
                                <input type="hidden" id="listRefresh" value="{{ route('get.company') }}" />

                                <div class="row form-mar">
                                    
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group ">
                                            <label>Name:</label>
                                            <input type="text" name="name" placeholder="Name" class="form-control"
                                                autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group ">
                                            <label>Email: <small>(Optional)</small></label>
                                            <input type="email" name="email" placeholder="Email" class="form-control"
                                                autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group ">
                                            <label>Phone: <small>(Optional)</small></label>
                                            <input type="text" name="phone" placeholder="Phone" class="form-control"
                                                autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group ">
                                            <label>Registeration No: <small>(Optional)</small></label>
                                            <input type="text" name="registration_no" placeholder="Registeration No"
                                                class="form-control" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group ">
                                            <label>NTN#: <small>(Optional)</small></label>
                                            <input type="text" name="ntn" placeholder="NTN No" class="form-control"
                                                autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group ">
                                            <label>STN# <small>(Optional)</small></label>
                                            <input type="text" name="stn" placeholder="ST No" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group ">
                                            <label>Address:</label>
                                            <textarea name="address" row="2" class="form-control"
                                                placeholder="Address"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group ">
                                            <label>Connection Name: <small>(Optional)</small></label>
                                            <input type="text" name="connection_database" placeholder="Registeration No"
                                                class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row bottom-button-bar">
                                    <div class="col-12">
                                        <a type="button"
                                            class="btn btn-danger modal-sidebar-close position-relative top-1 closebutton">Close</a>
                                        <button type="submit" class="btn btn-primary submitbutton">Save</button>
                                    </div>
                                </div>
                            </form>
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
        filterationCommon(`{{ route('get.company') }}`)
    });
</script>
@endsection




