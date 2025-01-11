<div class="row">
    @if (count($events) != 0)
        @foreach ($events as $row)
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="card box-card">
                    <div class="header py-2">
                        <div class="d-flex justify-content-between w-100 align-items-center">

                            <div class="creating-info d-flex">
                                <a href="javascript:;">
                                    <img class="creator-image p-2" src="{{ asset(optional($row->creator)->profile_image ?? 'users/fallback.jpg') }}" alt="Creator Image">
                                </a>
                                <div class="mx-2">
                                    <h2>
                                        {{ optional($row->creator)->name ?? 'Creator name not  provided' }}
                                    </h2>
                                    <small>
                                        {{ \Carbon\Carbon::parse($row->created_at)->format('Y-m-d') }}
                                    </small>
                                </div>
                            </div>

                            <ul class="header-dropdown mb-0">
                                <li class="dropdown">
                                    <a href="#" onclick="return false;" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        @can('event-edit')
                                            <li>
                                                <a href="javascript:;"  onclick="openModal('{{ route('event.edit', $row->id) }}', 'Edit Event')" >Edit</a>
                                            </li>
                                        @endcan
                                        @can('event-delete')
                                            <li>
                                                <a href="javascript:;"  onclick="deletemodal('{{ route('event.destroy', $row->id) }}', `{{ route('get.event') }}`)">Delete</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="body p-0">
                        <div class="featured-img">

                            <img class="h-100" width="100%" src="{{ url($row->thumbnail) }}" alt="Thumbnail">
                        </div>
                    </div>
                    <div class="header info py-0">
                        <div class="row py-2 bg-white text-dark">
                            <div class="col-12 ">
                                <h5>
                                    {{ $row->name }}
                                </h5>
                            </div>
                        </div>
                        <div class="row py-3">
                            <div class="col-6">
                                <label class="d-block m-0 font-weight-bold">Location</label>
                                {{ $row->event_location->name }}
                            </div>

                            <div class="col-6">
                                <label class="d-block m-0 font-weight-bold">Date</label>
                                {{ $row->event_date }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12">
            <div colspan="8" class="text-center py-5 error-box-table">
                No record found
            </div>
        </div>
    @endif
    <div class="col-12">
        <div id="paginationLinks">
            {{ $events->links() }}
        </div>
    </div>
</div>



{{--<table class="table tab-des">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th class="text-center">Thumbnail</th>--}}
{{--        <th colspan="1">Event Name</th>--}}
{{--        <th>Date</th>--}}
{{--        <th>Role</th>--}}
{{--        <th>Location</th>--}}
{{--        <th class="text-center">Status</th>--}}
{{--        <th class="text-center">Action</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @if (count($events) != 0)--}}
{{--        @foreach ($events as $row)--}}
{{--            <tr>--}}
{{--                <td width="10%" class="td-set new-lead text-center">--}}
{{--                    <img width="100%" src="{{ url($row->thumbnail) }}" alt="Thumbnail">--}}
{{--                </td>--}}
{{--                <td class="td-set new-lead">--}}
{{--                    <a href="javascript:;"--}}
{{--                       onclick="openModal('{{ route('event.edit', $row->id) }}', 'View Event', true)">--}}
{{--                        {{ $row->creator->name }}--}}
{{--                    </a>--}}
{{--                </td>--}}
{{--                <td class="td-set new-lead">--}}
{{--                    {{ \Carbon\Carbon::parse($row->event_date)->format('Y-m-d') }}--}}
{{--                </td>--}}
{{--                <td class="td-set new-lead">--}}
{{--                    {{ $row->event_role->name }}--}}
{{--                </td>--}}
{{--                <td class="td-set new-lead">--}}
{{--                    {{ $row->event_location->name }}--}}
{{--                </td>--}}
{{--                <td class="text-center">--}}
{{--                    @if ($row->status == 1)--}}
{{--                        <label class="badge badge-success">Active</label>--}}
{{--                    @else--}}
{{--                        <label class="badge badge-danger">Draft</label>--}}
{{--                    @endif--}}
{{--                </td>--}}
{{--                <td class="text-center">--}}
{{--                    @can('event-delete')--}}
{{--                        <button class="btn-sm btn-danger"--}}
{{--                                onclick="deletemodal('{{ route('event.destroy', $row->id) }}', `{{ route('get.event') }}`)">--}}
{{--                            <span class="material-symbols-outlined">delete</span>--}}
{{--                        </button>--}}
{{--                    @endcan--}}
{{--                    @can('event-edit')--}}
{{--                        <button class="btn-sm btn-primary"--}}
{{--                                onclick="openModal('{{ route('event.edit', $row->id) }}', 'Edit Event')">--}}
{{--                            <span class="material-symbols-outlined">edit</span>--}}
{{--                        </button>--}}
{{--                    @endcan--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--    @else--}}
{{--        <tr>--}}
{{--            <td colspan="8" class="text-center py-5 error-box-table">--}}
{{--                No record found--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @endif--}}
{{--    </tbody>--}}
{{--</table>--}}
{{--    <div id="paginationLinks">--}}
{{--        {{ $events->links() }}--}}
{{--    </div>--}}

