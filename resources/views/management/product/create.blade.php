@extends('management.layouts.master')
@section('title')
    Create Products
@endsection
@section('content')
    @include('management.theme.includes.error_success')
    <div class="card p-1">
        <div class="body">
            <h2 class="mb-4">
                Create Product
            </h2>
            <form class="example" id="subm" method="post" action="{{ route('product.store') }}">
                @csrf
                <input type="hidden" id="url" value="{{ route('product.index') }}" />
                <div class="row form-mar w-100 mx-auto">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="title">Product title <span class="text-danger">*</span></label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Title"
                                required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="provider_id">Provider ID</label>
                            <select id="provider_id" name="provider_id" class="form-control">
                                @foreach ($providers as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="airport_id">Airport ID</label>
                            <select id="airport_id" name="airport_id" class="form-control">
                                @foreach ($airports as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="space_id">Space ID</label>
                            <select id="space_id" name="space_id" class="form-control">
                                @foreach ($spaces as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone">
                        </div>
                    </div> --}}

                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="min_lead_time">Minimum Lead Time</label>
                            <input type="number" id="min_lead_time" name="min_lead_time" class="form-control"
                                placeholder="Minimum Lead Time">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="max_lead_time">Maximum Lead Time</label>
                            <input type="number" id="max_lead_time" name="max_lead_time" class="form-control"
                                placeholder="Maximum Lead Time">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="d-block">Transfer Required</label>
                            <label class="text-capitalize mt-3">
                                <input class="parent" name="transfer_required" type="checkbox"
                                    id="transferRequiredCheckbox">
                                <span>Transfer Required</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="selling_points">Selling Points</label>
                            <textarea id="selling_points" name="selling_points" class="ckeditor form-control" placeholder="Selling Points">
                                <li class="mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-check-circle-fill text-success" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                    </svg>
                                    <span class="ms-3">A Special Price for FHR Customers</span>
                                </li>
                            </textarea>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="Address">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="post_code">Post Code</label>
                            <input type="text" id="post_code" name="post_code" class="form-control"
                                placeholder="Post Code">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" class="form-control"
                                placeholder="City">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="satnav">Satnav</label>
                            <input type="text" id="satnav" name="satnav" class="form-control"
                                placeholder="Satnav">
                        </div>
                    </div> 
                    <div class="col-12">
                        <div class="form-group">
                            <label for="short_description">Short Description</label>
                            <textarea id="short_description" name="short_description" class="ckeditor form-control"
                                placeholder="Short Description"></textarea>
                        </div>
                    </div> --}}
                    <div class="col-12">
                        <div class="form-group">
                            <label for="long_description">Description</label>
                            <textarea id="long_description" name="long_description" class="ckeditor form-control" placeholder="Description"></textarea>
                        </div>
                    </div>
                    {{-- <div class="col-12">
                        <div class="form-group">
                            <label for="arrival_procedure">Arrival Procedure</label>
                            <textarea id="arrival_procedure" name="arrival_procedure" class="ckeditor form-control"
                                placeholder="Arrival Procedure"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="return_procedure">Return Procedure</label>
                            <textarea id="return_procedure" name="return_procedure" class="ckeditor form-control"
                                placeholder="Return Procedure"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="additional_info">Additional Info</label>
                            <textarea id="additional_info" name="additional_info" class="ckeditor form-control" placeholder="Additional Info"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="instruction_content">Instruction Content</label>
                            <textarea id="instruction_content" name="instruction_content" class="ckeditor form-control"
                                placeholder="Instruction Content"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="page_content">Page Content</label>
                            <textarea id="page_content" name="page_content" class="ckeditor form-control" placeholder="Page Content"></textarea>
                        </div>
                    </div> --}}
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="product_priority">Product Priority</label>
                            <input type="number" id="product_priority" name="product_priority" class="form-control"
                                placeholder="Product Priority">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="total_space">Total Space</label>
                            <input type="number" id="total_space" name="total_space" class="form-control"
                                placeholder="Total Space">
                        </div>
                    </div>
{{--                    <div class="col-12 col-sm-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="price">Price</label>--}}
{{--                            <input type="text" id="price" name="price" class="form-control"--}}
{{--                                placeholder="Price">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="2">Draft</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row text-center center">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{url('admin/product')}}" class="btn btn-danger" data-close="modeel">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    @endsection

    @section('script')
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                let transferRequiredCheckbox = document.getElementById('transferRequiredCheckbox');

                transferRequiredCheckbox.addEventListener('change', function() {
                    transferRequiredCheckbox.value = transferRequiredCheckbox.checked ? 1 : 0;
                });

                transferRequiredCheckbox.value = transferRequiredCheckbox.checked ? 1 : 0;
            });
        </script>
    @endsection
