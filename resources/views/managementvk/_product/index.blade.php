@extends('management/layouts/master')
@section('title')
    Department
@endsection
@section('content')
    <!-- Center Main Content -->
    <section class="center-section">
        <div class="container-fluid">
            <div class="row mb">
                <div class="col-md-3 main-h">
                    <h1>{{ count($products) }} Products</h1>
                </div>
                <div class="col-md-9 text-right">
                    <ul class="lead-d2">
                        <li>
                            @can('product-create')
                                <a onclick="openModal('{{ route('product.create') }}','Add Product')" class="btn-theme"><i
                                        class="fa fa-solid fa-plus"></i> &nbsp; Add New</a>
                            @endcan
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table tab-des">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $row)
                                <tr>
                                    <td class="td-set new-lead">{{ $row->name }}</td>
                                    <td>{{ $row->description }}</td>
                                    <td>{{ $row->price }}</td>
                                    <td>{{ $row->stock }}</td>
                                    <td class="text-center tag-g"><span>{{ $row->status == 1 ? 'Active' : 'Draft' }}</span>
                                    </td>
                                    <td class="text-center">
                                        @can('product-delete')
                                            <button class="btn-sm btn-danger "
                                                onclick="deletemodal('{{ route('product.destroy', $row->id) }}')"><span
                                                    class="material-symbols-outlined">delete</span></button>
                                        @endcan
                                        @can('product-edit')
                                            <button class="btn-sm btn-primary"
                                                onclick="openModal('{{ route('product.edit', $row->id) }}','Edit Product')"><span
                                                    class="material-symbols-outlined">edit</span></button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
    <!-- Center Main content End -->
@endsection
