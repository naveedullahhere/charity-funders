<?php
use App\Helpers\CommonHelper;
?>
<table class="table tab-des">
    <thead>
        <tr>
            <th>Title</th>
            <th>Airport</th>
            <th>Provider</th>
            <th>Space</th>
{{--            <th>Price</th>--}}
            <th>Prices</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @if (count($products) != 0)
            @foreach ($products as $row)
                <tr>
                    <td class="td-set new-lead">
                        <a href="{{ route('product.show', $row->id) }}">
                            {{ $row->title }}
                        </a>
                    </td>
                    <td class="td-set new-lead">
                        {!! CommonHelper::getFirstColumn('airports', 'title', $row->airport_id) !!}
                    </td>
                    <td class="td-set new-lead">{{ optional($row->provider)->title ?? '-' }}</td>
                    <td class="td-set new-lead">{{ optional($row->space)->name ?? '-' }}</td>
{{--                    <td class="td-set new-lead">${{ $row->price ?? '0' }}</td>--}}
                    <td class="td-set new-lead">
                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#prices{{ $row->id }}">
                            Launch demo modal
                        </button> --}}

                        <button class="btn-sm btn-primary"
                            onclick="openModal('{{ route('product.dailyPrice', $row->id) }}','Edit Product Prices')"><span
                                class="material-symbols-outlined">edit</span></button>

                    </td>
                    <td class="text-center">
                        @if ($row->status == 1)
                            <label class="badge badge-success">Active</label>
                        @else
                            <label class="badge badge-danger">Draft</label>
                        @endif
                    </td>
                    </td>
                    <td class="text-center">
                        @can('product-delete')
                            <button class="btn-sm btn-danger "
                                onclick="deletemodal('{{ route('product.destroy', $row->id) }}')"><span
                                    class="material-symbols-outlined">delete</span></button>
                        @endcan
                        @can('product-edit')
                            <button class="btn-sm btn-primary"
                                onclick="window.location = '{{ route('product.edit', $row->id) }}'">
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                        @endcan
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10" class="text-center py-5 error-box-table">
                    No record found
                </td>
            </tr>
        @endif
    </tbody>
</table>
<div id="paginationLinks">
    {{ $products->links() }}
</div>
