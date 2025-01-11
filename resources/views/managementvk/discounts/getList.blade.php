<table class="table tab-des">
    <thead>
        <tr>
            <th>Discount code</th>
            <th>Discount percentage</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @if (count($discounts) != 0)
            @foreach ($discounts as $row)
                <tr>
                    <td class="td-set new-lead">
                        <a href="javascript:;" onclick="openModal('{{ route('discount.edit',$row->id) }}','View Coupon Code',true)">
                        {{ $row->discount_code }}
                        </a>
                    </td>

                    <td class="td-set new-lead">{!! $row->discount_percentage !!}</td>
                    <td class="text-center">
                        @if ($row->status == 1)
                            <label class="badge badge-success">Active</label>
                        @else
                            <label class="badge badge-danger">Draft</label>
                        @endif
                    </td>
                    <td class="text-center">
                        @can('discount-delete')
                            <button class="btn-sm btn-danger"
                                onclick="deletemodal('{{ route('discount.destroy', $row->id) }}')"><span
                                    class="material-symbols-outlined">delete</span></button>
                        @endcan
                        @can('discount-edit')
                            <button class="btn-sm btn-primary"
                                onclick="openModal('{{ route('discount.edit', $row->id) }}','Edit Coupon Code')"><span
                                    class="material-symbols-outlined">edit</span></button>
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
    {{ $discounts->links() }}
</div>
