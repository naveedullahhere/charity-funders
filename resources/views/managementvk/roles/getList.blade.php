<table class="table">
    <thead>
    <tr>
        <th class="col-lg-3">S no.</th>
        <th class="col-lg-3">Name</th>
        <th class="col-lg-3">Action</th>
    </tr>
    </thead>
    <tbody>
    @if(count($roles) != 0)
        @foreach ($roles as $key => $role)

            <tr>
                <td>{{ $key+1 }}</td>
                <td>
                    <a href="javascript:;" onclick="openModal('{{ route('roles.edit',$role->id) }}','View Role',true)">
                        {{ $role->name }}
                    </a>
                </td>
                <td>
                    @can('role-edit')
                        @if(!in_array($role->id, [1,2]))
                        <button class="btn btn-primary" onclick="openModal('{{ route('roles.edit',$role->id) }}','Edit Role')"><span class="material-symbols-outlined">edit</span></button>
                        @else
                            <button class="btn btn-primary" onclick="openModal('{{ route('roles.edit',$role->id) }}','Edit Role',true)"><span class="material-symbols-outlined">edit</span></button>
                        @endif
                    @endcan
{{--                    <button class="btn btn-primary" onclick="openModal('{{ route('roles.show',$role->id) }}','View Role')"><span class="material-symbols-outlined">visibility</span></button>--}}
                    @can('role-delete')
                        @if(!in_array($role->id, [1,2]))
                            <button class="btn btn-danger "  onclick="deletemodal('{{ route('roles.destroy',$role->id) }}')"><span class="material-symbols-outlined">delete</span></button>
                        @endif
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
    {{ $roles->links() }}
</div>
