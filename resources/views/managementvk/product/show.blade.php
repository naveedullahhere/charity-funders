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
                <div class="row form-mar w-100 mx-auto">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="title">Product Title <span class="text-danger">*</span></label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Title"
                                   value="{{ $product->title }}" required disabled>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="provider_id">Provider ID</label>
                            <select id="provider_id" name="provider_id" class="form-control" disabled>
                                @foreach ($providers as $provider)
                                    <option value="{{ $provider->id }}"
                                            {{ $provider->id == $product->provider_id ? 'selected' : '' }} disabled>
                                        {{ $provider->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="airport_id">Airport ID</label>
                            <select id="airport_id" name="airport_id" class="form-control" disabled>
                                @foreach ($airports as $airport)
                                    <option value="{{ $airport->id }}"
                                            {{ $airport->id == $product->airport_id ? 'selected' : '' }} disabled>{{ $airport->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="space_id">Space ID</label>
                            <select id="space_id" name="space_id" class="form-control" disabled>
                                @foreach ($spaces as $space)
                                    <option value="{{ $space->id }}"
                                            {{ $space->id == $product->space_id ? 'selected' : '' }} disabled>{{ $space->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="min_lead_time">Minimum Lead Time</label>
                            <input type="number" id="min_lead_time" name="min_lead_time" class="form-control"
                                   placeholder="Minimum Lead Time" value="{{ $product->min_lead_time }}" disabled>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="max_lead_time">Maximum Lead Time</label>
                            <input type="number" id="max_lead_time" name="max_lead_time" class="form-control"
                                   placeholder="Maximum Lead Time" value="{{ $product->max_lead_time }}" disabled>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="d-block">Transfer Required</label>
                            <label class="text-capitalize mt-3">
                                <input class="parent" name="transfer_required" type="checkbox" id="transferRequiredCheckbox"
                                       {{ $product->transfer_required ? 'checked' : '' }} disabled>
                                <span>Transfer Required</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="selling_points">Selling Points</label>
                            <textarea id="selling_points" name="selling_points" class="ckeditor form-control" placeholder="Selling Points" readonly>{{ $product->selling_points }}</textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="long_description">Description</label>
                            <textarea id="long_description" name="long_description" class="ckeditor form-control" placeholder="Description" readonly>{{ $product->long_description }}</textarea>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="product_priority">Product Priority</label>
                            <input type="number" id="product_priority" name="product_priority" class="form-control"
                                   placeholder="Product Priority" value="{{ $product->product_priority }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="total_space">Total Space</label>
                            <input type="number" id="total_space" name="total_space" class="form-control"
                                   placeholder="Total Space" value="{{ $product->total_space }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" id="price" name="price" class="form-control"
                                   placeholder="Price" value="{{ $product->price }}" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control" readonly>
                                <option value="1" {{ $product->status == 1 ? 'selected' : '' }} disabled>Active</option>
                                <option value="2" {{ $product->status == 2 ? 'selected' : '' }} disabled>Inactive</option>
                            </select>
                        </div>
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
