<table class="table tab-des">
    <thead>
    <tr>
        <th>Order No</th>
        <th>Customer</th>
        <th>Vehicle Info</th>
        <th>Price</th>
        <th class="text-center">Payment Method</th>
        <th class="text-center">Status</th>
    </tr>
    </thead>
    <tbody>
    @if (count($orders) != 0)
        @foreach ($orders as $row)
            <tr>
                <td class="td-set new-lead">
                    <div class="d-flex align-items-center">
                        <span class="fs-6 text-dark fw-semibold">#{{$row->id}}</span>
                    </div>
                </td>
                <td class="td-set new-lead">
                    {{ $row->lead_title }}.  {{ $row->lead_first_name.' '.$row->lead_last_name }}
                    <small><br>{{$row->email}}</small>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="">
                            <div class="fs-5 fw-semibold text-dark">{{$row->vehicle_registration}}</div>
                            <small>{{$row->vehicle_model}}</small>
                        </div>
                    </div>
                </td>
                <td> <span class="fs-6 text-dark fw-semibold">£{{$row->product_price}}</span></td>
                <td class=" text-center"> <span class="badge badge-success text-white">{{$row->payment_method == 'COD' ? 'Cash On Arrival' : $row->payment_method}}</span></td>
                <td class="text-center">
                    @can('bookings-delete')
                        <button class="btn-sm btn-danger"
                                onclick="deletemodal('{{ route('bookings.destroy', $row->id) }}')"><span
                                    class="material-symbols-outlined">delete</span></button>
                    @endcan
                    @can('bookings-edit')
                        <button class="btn-sm btn-primary"
                                onclick="openModal('{{ route('bookings.edit', $row->id) }}','Edit Booking Orders')"><span
                                    class="material-symbols-outlined">edit</span></button>
                    @endcan
                        @can('bookings-edit')
                        <button class="btn-sm btn-primary"
                                onclick="openModal('{{ route('bookings.show', $row->id) }}','View Booking Orders')"><span
                                    class="material-symbols-outlined">visibility</span></button>
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
    {{ $orders->links() }}
</div>
