<style>
    a.btn-sm.btn-primary {
        padding: 9px;
    }
</style>
<table class="table tab-des">
    <thead>
    <tr>
        <th>Name</th>
        <th class="text-center">Status</th>
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
    @if(count($pages) != 0)
        @foreach($pages as $row)
            <tr>
                <td class="td-set new-lead">
                    <a href="javascript:;" onclick="openModal('{{ route('page.edit',$row->id) }}','View Page',true)">
                        {{$row->title}}
                    </a>
                </td>
                <td class="text-center">
                    @if($row->status == 1)
                        <label class="badge badge-success">Active</label>
                    @else
                        <label class="badge badge-danger">Draft</label>

                    @endif
                </td>
                <td class="text-center">
                    @if($row->id != 1)
                        @can('page-delete')
                            <button class="btn-sm btn-danger "  onclick="deletemodal('{{ route('page.destroy',$row->id) }}')"><span class="material-symbols-outlined">delete</span></button>
                        @endcan
                    @endif
                    @can('page-edit')
                        <button class="btn-sm btn-primary" onclick="openModal('{{ route('page.edit',$row->id) }}','Edit Static Page')"><span class="material-symbols-outlined">edit</span></button>
                        <a class="btn-sm btn-primary" target="_blank" href="{{ route('preview_page',$row->slug) }}"><span class="material-symbols-outlined">open_in_new</span></a>
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
    {{ $pages->links() }}
</div>
