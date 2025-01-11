@extends('management.layouts.master')
@section('title', 'Edit Product')
@section('content')
    @include('management.theme.includes.error_success')
    <div class="card p-1">
        <div class="body">
            <h2 class="mb-4">Edit Product</h2>
            <form class="example" id="subm" method="post" action="{{ route('product.update', $product->id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" id="url" value="{{ route('product.index') }}" />
                <div class="row form-mar w-100 mx-auto">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="title">Product Title <span class="text-danger">*</span></label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Title"
                                value="{{ $product->title }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="provider_id">Provider ID</label>
                            <select id="provider_id" name="provider_id" class="form-control">
                                @foreach ($providers as $provider)
                                    <option value="{{ $provider->id }}"
                                        {{ $provider->id == $product->provider_id ? 'selected' : '' }}>
                                        {{ $provider->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="airport_id">Airport ID</label>
                            <select id="airport_id" name="airport_id" class="form-control">
                                @foreach ($airports as $airport)
                                    <option value="{{ $airport->id }}"
                                        {{ $airport->id == $product->airport_id ? 'selected' : '' }}>{{ $airport->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="space_id">Space ID</label>
                            <select id="space_id" name="space_id" class="form-control">
                                @foreach ($spaces as $space)
                                    <option value="{{ $space->id }}"
                                        {{ $space->id == $product->space_id ? 'selected' : '' }}>{{ $space->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone"
                                value="{{ $product->phone }}">
                        </div>
                    </div> --}}

                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="min_lead_time">Minimum Lead Time</label>
                            <input type="number" id="min_lead_time" name="min_lead_time" class="form-control"
                                placeholder="Minimum Lead Time" value="{{ $product->min_lead_time }}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="max_lead_time">Maximum Lead Time</label>
                            <input type="number" id="max_lead_time" name="max_lead_time" class="form-control"
                                placeholder="Maximum Lead Time" value="{{ $product->max_lead_time }}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="d-block">Transfer Required</label>
                            <label class="text-capitalize mt-3">
                                <input class="parent" name="transfer_required" type="checkbox" id="transferRequiredCheckbox"
                                    {{ $product->transfer_required ? 'checked' : '' }}>
                                <span>Transfer Required</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="selling_points">Selling Points</label>
                            <textarea id="selling_points" name="selling_points" class="ckeditor form-control" placeholder="Selling Points">{{ $product->selling_points }}</textarea>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="Address"
                                value="{{ $product->address }}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="post_code">Post Code</label>
                            <input type="text" id="post_code" name="post_code" class="form-control"
                                placeholder="Post Code" value="{{ $product->post_code }}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" class="form-control" placeholder="City"
                                value="{{ $product->city }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="satnav">Satnav</label>
                            <input type="text" id="satnav" name="satnav" class="form-control"
                                placeholder="Satnav" value="{{ $product->satnav }}">
                        </div>
                    </div> --}}
                    {{-- <div class="col-12">
                        <div class="form-group">
                            <label for="short_description">Short Description</label>
                            <textarea id="short_description" name="short_description" class="ckeditor form-control"
                                placeholder="Short Description">{{ $product->short_description }}</textarea>
                        </div>
                    </div> --}}
                    <div class="col-12">
                        <div class="form-group">
                            <label for="long_description">Description</label>
                            <textarea id="long_description" name="long_description" class="ckeditor form-control" placeholder="Description">{{ $product->long_description }}</textarea>
                        </div>
                    </div>
                    {{-- <div class="col-12">
                        <div class="form-group">
                            <label for="arrival_procedure">Arrival Procedure</label>
                            <textarea id="arrival_procedure" name="arrival_procedure" class="ckeditor form-control"
                                placeholder="Arrival Procedure">{{ $product->arrival_procedure }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="return_procedure">Return Procedure</label>
                            <textarea id="return_procedure" name="return_procedure" class="ckeditor form-control"
                                placeholder="Return Procedure">{{ $product->return_procedure }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="additional_info">Additional Info</label>
                            <textarea id="additional_info" name="additional_info" class="ckeditor form-control" placeholder="Additional Info">{{ $product->additional_info }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="instruction_content">Instruction Content</label>
                            <textarea id="instruction_content" name="instruction_content" class="ckeditor form-control"
                                placeholder="Instruction Content">{{ $product->instruction_content }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="page_content">Page Content</label>
                            <textarea id="page_content" name="page_content" class="ckeditor form-control" placeholder="Page Content">{{ $product->page_content }}</textarea>
                        </div>
                    </div> --}}
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="product_priority">Product Priority</label>
                            <input type="number" id="product_priority" name="product_priority" class="form-control"
                                placeholder="Product Priority" value="{{ $product->product_priority }}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="total_space">Total Space</label>
                            <input type="number" id="total_space" name="total_space" class="form-control"
                                placeholder="Total Space" value="{{ $product->total_space }}">
                        </div>
                    </div>
{{--                    <div class="col-12 col-sm-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="price">Price</label>--}}
{{--                            <input type="text" id="price" name="price" class="form-control"--}}
{{--                                placeholder="Price" value="{{ $product->price }}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="2" {{ $product->status == 2 ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row text-center center">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('product.index') }}" class="btn btn-danger">Cancel</a>
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
