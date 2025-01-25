{{-- @extends('layouts.app')

@section('content') --}}
@extends('management.layouts.master')
@section('title')
    Funder
@endsection
@section('content')
    <div class="content-wrapper">
        <section id="extended">
            <div class="row w-100 mx-auto">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <h2 class="page-title"> Create Funder</h2>
                </div>
            </div>
            <div class="row w-100 mx-auto">
                <div class="col-8 mx-auto">
                    <form id="ajaxSubmit" action="{{ route('funders.store') }}" method="post">
                        @csrf
                        <div class="">
                            <div class="form-group">
                                <label for="category_id">Category Name *</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">--Select a Category--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_category_id">Sub Category Name</label>
                                <select name="sub_category_id" id="sub_category_id" class="form-control">
                                    <option value="">--- Select Sub Category ---</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type_id">Group *</label>
                                <select name="type_id" id="type_id" class="form-control">
                                    <option value="">--Select a Group--</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="company_name">Company Name *</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="charity_no">Charity No *</label>
                                <input type="text" name="charity_no" id="charity_no" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number *</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="status">Status *</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Publish">Publish</option>
                                    <option value="Draft">Draft</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" id="save-general">Save General
                                Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
