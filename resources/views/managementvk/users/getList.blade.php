<table class="table">
    <thead>
    <tr>
        <th class="col-lg-1">S no.</th>
        <th class="col-lg-3">Name</th>
        <th class="col-lg-3">email</th>
        <th >role</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @if(count($users) != 0)
    @foreach ($users as $key => $user)

        <tr>
            <td>{{ $key+1 }}</td>
            <td>
                <a href="javascript:;" onclick="openModal('{{ route('users.edit',$user->id) }}','View User',true)">
                {{ $user->name }}
                </a>
            </td>
            <td>{{ $user->email }}</td>
            <td>
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                        <label class="badge badge-success">{{ $v }}</label>
                    @endforeach
                @endif
            </td>
            <td>
                @can('role-edit')
                    <button class="btn btn-primary" onclick="openModal('{{ route('users.edit',$user->id) }}','Edit User')"><span class="material-symbols-outlined">edit</span></button>
                @endcan
{{--                <button class="btn btn-primary" onclick="openModal('{{ route('users.show',$user->id) }}','View User')"><span class="material-symbols-outlined">visibility</span></button>--}}
                @can('role-delete')
                    @if($user->id != 1)
                        <button class="btn btn-danger "  onclick="deletemodal('{{ route('users.destroy',$user->id) }}')"><span class="material-symbols-outlined">delete</span></button>
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
    {{ $users->links() }}
</div>
