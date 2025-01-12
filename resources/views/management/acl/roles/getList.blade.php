<table class="table m-0">
    <thead>
        <tr>
            <th class="col-sm-1">S no.</th>
            <th class="col-sm-3">Name</th>
            <th class="col-sm-6">Description</th>
            <th class="col-sm-2">Action</th>
        </tr>
    </thead>
    <tbody>
        @if (count($roles) != 0)
            @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        {{ $role->name }}
                    </td>
                    <td>
                        {{ $role->description ?? '-' }}
                    </td>
                    <td>
                        @can('role-edit')
                            @if (!in_array($role->id, [1, 2]))
                                <a onclick="openModal(this,'{{ route('roles.edit', $role->id) }}','Edit Role')"
                                    class="info p-1 text-center mr-2 position-relative ">
                                    <i class="ft-edit-2 font-medium-3"></i>
                                </a>
                            @else
                                <a class="info p-1 text-center mr-2 position-relative "
                                    onclick="openModal(this,'{{ route('roles.edit', $role->id) }}','Edit Role')"> <i
                                        class="ft-eye font-medium-3"></i></a>
                            @endif
                        @endcan
                        {{--                    <button class="btn btn-primary" onclick="openModal('{{ route('roles.show',$role->id) }}','View Role')"><span class="material-symbols-outlined">visibility</span></button> --}}
                        @can('role-delete')
                            @if (!in_array($role->id, [1, 2]))
                                <a onclick="deletemodal('{{ route('roles.destroy', $role->id) }}','{{ route('get.roles') }}')"
                                    class="danger p-1 text-center mr-2 position-relative ">

                                    <i class="ft-x font-medium-3"></i>
                                </a>
                            @endif
                        @endcan
                    </td>
                </tr>
            @endforeach
        @else
            <tr class="ant-table-placeholder">
                <td colspan="11" class="ant-table-cell text-center">
                <div class="my-5">
                    <svg width="64" height="41" viewBox="0 0 64 41" xmlns="http://www.w3.org/2000/svg">
                        <g transform="translate(0 1)" fill="none" fill-rule="evenodd">
                            <ellipse fill="#f5f5f5" cx="32" cy="33" rx="32" ry="7">
                            </ellipse>
                            <g fill-rule="nonzero" stroke="#d9d9d9">
                                <path
                                    d="M55 12.76L44.854 1.258C44.367.474 43.656 0 42.907 0H21.093c-.749 0-1.46.474-1.947 1.257L9 12.761V22h46v-9.24z">
                                </path>
                                <path
                                    d="M41.613 15.931c0-1.605.994-2.93 2.227-2.931H55v18.137C55 33.26 53.68 35 52.05 35h-40.1C10.32 35 9 33.259 9 31.137V13h11.16c1.233 0 2.227 1.323 2.227 2.928v.022c0 1.605 1.005 2.901 2.237 2.901h14.752c1.232 0 2.237-1.308 2.237-2.913v-.007z"
                                    fill="#fafafa"></path>
                            </g>
                        </g>
                    </svg>
                    <p class="ant-empty-description">No data</p>
                    </div>
                </td>
            </tr>
        @endif
    </tbody>
</table>
{{-- <div id="paginationLinks">
    {{ $roles->links() }}
</div> --}}



<div class="row d-flex" id="paginationLinks">
    <div class="col-md-6">
        <p> Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }} of {{ $roles->total() }}
            entries</p>
    </div>
    <div class="col-md-6 text-right">
        <div id="">
            {{ $roles->links() }}
        </div>
    </div>
</div>
