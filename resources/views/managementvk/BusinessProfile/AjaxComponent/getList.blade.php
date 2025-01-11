<table class="table tab-des">
    <thead>
    <tr>
        <th>Name</th>
        {{--                            <th>Description</th>--}}
        {{--                            <th class="text-center">Status</th>--}}
        {{--                            <th class="text-center">Created Date</th>--}}
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
    @if(count($business) != 0)

        @foreach($business as $row)
        <tr>
            <td class="td-set new-lead">{{$row->title}}</td>
            {{--                                <td class="text-center">{{$row->created_at}}</td>--}}
            <td class="text-center">
                @can('department-delete')
                    <a class="btn btn-danger "  onclick="deletemodal('{{ route('business-profile.destroy',$row->id) }}')"><span class="material-symbols-outlined">delete</span></a>
                @endcan
                @can('department-edit')
                    <a class="btn btn-primary " href="{{ route('business-profile.edit',$row->id) }}"><span class="material-symbols-outlined">edit</span></a>
                @endcan
                @can('department-edit')
                    <a class="btn btn-primary" target="_blank" href="{{ url('t',$row->slug) }}"><span class="material-symbols-outlined">visibility</span></a>
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
    {{ $business->links() }}
</div>
