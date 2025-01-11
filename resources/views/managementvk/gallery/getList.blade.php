<div class="row">
    @if (count($galleries) != 0)
        @foreach ($galleries as $row)
            @php
                $thumbnail = $row->media->where('is_thumbnail', '1')->first();

                // Count media items for images and videos
                $imageCount = $row->media->where('file_type', 'image')->count();
                $videoCount = $row->media->where('file_type', 'video')->count();
            @endphp
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
                                        {{ $row->creator->name }}
                                    </h2>
                                    <small>
                                        {{ \Carbon\Carbon::parse($row->created_at)->format('Y-m-d') }}
                                    </small>
                                </div>
                            </div>

                            <ul class="header-dropdown mb-0">
                                <li class="dropdown">
                                    <a href="#" onclick="return false;" class="dropdown-toggle"
                                        data-bs-toggle="dropdown" role="button" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        @can('gallery-edit')
                                            <li>
                                                <a href="{{ route('gallery.edit', $row->id) }}">Edit</a>
                                            </li>
                                        @endcan
                                        @can('gallery-delete')
                                            <li>
                                                <a href="javascript:;"
                                                    onclick="deletemodal('{{ route('gallery.destroy', $row->id) }}', `{{ route('get.gallery') }}`)">Delete</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="body p-0">
                        <div class="featured-img">
                            <img class="h-100" width="100%"
                                src="{{ $thumbnail ? asset($thumbnail->file_path) : '/placeholder-image.jpg' }}"
                                alt="Thumbnail">
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
                                <label class="d-block m-0 font-weight-bold">Photos/Videos</label>
                                {{ $row->getUniqueFileCount('image') }} Photos / {{ $row->getUniqueFileCount('video') }}
                                Videos

                                {{--                            @if ($imageCount > 0) --}}
                                {{--                                    {{ $imageCount }} {{ Str::plural('Photo', $imageCount) }} --}}
                                {{--                                @endif --}}

                                {{--                                @if ($imageCount > 0 && $videoCount > 0) --}}
                                {{--                                    , --}}
                                {{--                                @endif --}}

                                {{--                                @if ($videoCount > 0) --}}
                                {{--                                    {{ $videoCount }} {{ Str::plural('Video', $videoCount) }} --}}
                                {{--                                @endif --}}
                            </div>

                            <div class="col-6">
                                <label class="d-block m-0 font-weight-bold">Event Name</label>
                                {{ optional($row->event)->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <tr>
            <td colspan="8" class="text-center py-5 error-box-table">
                No record found
            </td>
        </tr>
    @endif
    <div class="col-12">
        <div id="paginationLinks">

        </div>
    </div>
</div>



<style>
    .header-dropdown {
        position: unset !important
    }
</style>

{{-- @if (count($galleries) != 0) --}}
{{--    @foreach ($galleries as $row) --}}
{{--        @php --}}
{{--            $thumbnail = $row->media->where('is_thumbnail', 1)->first(); --}}

{{--            // Count media items for images and videos --}}
{{--            $imageCount = $row->media->where('file_type', 'image')->count(); --}}
{{--            $videoCount = $row->media->where('file_type', 'video')->count(); --}}
{{--        @endphp --}}

{{--        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> --}}
{{--            <div class="card"> --}}
{{--                <div class="header pt-2 pb-0"> --}}
{{--                    <div class="d-flex justify-content-between w-100 align-items-center"> --}}

{{--                        <h2> --}}
{{--                            <a href="javascript:;" --}}
{{--                               onclick="openModal('{{ route('gallery.edit', $row->id) }}', 'View Event', true)"> --}}
{{--                                <img src="data:image/png;base64,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" --}}
{{--                                     alt=""> --}}
{{--                                {{ $row->name }} --}}
{{--                            </a> --}}
{{--                            <small> --}}
{{--                                {{ \Carbon\Carbon::parse($row->created_at)->format('Y-m-d') }} --}}
{{--                            </small> --}}
{{--                        </h2> --}}

{{--                        <ul class="header-dropdown mb-0"> --}}
{{--                            <li class="dropdown"> --}}
{{--                                <a href="#" onclick="return false;" class="dropdown-toggle" --}}
{{--                                   data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> --}}
{{--                                    <i class="material-icons">more_vert</i> --}}
{{--                                </a> --}}
{{--                                <ul class="dropdown-menu pull-right"> --}}
{{--                                    <li> --}}
{{--                                        <a href="{{ route('gallery.edit', $row->id) }}">Edit</a> --}}
{{--                                    </li> --}}
{{--                                    <li> --}}
{{--                                        <a --}}
{{--                                                onclick="deletemodal('{{ route('gallery.destroy', $row->id) }}', `{{ route('get.gallery') }}`)">Delete</a> --}}
{{--                                    </li> --}}
{{--                                </ul> --}}
{{--                            </li> --}}
{{--                        </ul> --}}
{{--                    </div> --}}

{{--                </div> --}}
{{--                <div class="body"> --}}

{{--                    <div> --}}
{{--                        <img width="100%" --}}
{{--                             src="{{ $thumbnail ? asset($thumbnail->file_path) : '/public/default-thumbnail.png' }}" --}}
{{--                             alt="Thumbnail"> --}}
{{--                    </div> --}}
{{--                    <div> --}}
{{--                        --}}{{-- Display the count of images and videos only if they exist --}}
{{--                        @if ($imageCount > 0) --}}
{{--                            {{ $imageCount }} {{ Str::plural('Photo', $imageCount) }} --}}
{{--                        @endif --}}

{{--                        @if ($imageCount > 0 && $videoCount > 0) --}}
{{--                            , --}}
{{--                        @endif --}}

{{--                        @if ($videoCount > 0) --}}
{{--                            {{ $videoCount }} {{ Str::plural('Video', $videoCount) }} --}}
{{--                        @endif --}}
{{--                    </div> --}}

{{--                </div> --}}
{{--            </div> --}}
{{--        </div> --}}
{{--    @endforeach --}}
{{-- @else --}}
{{--    <tr> --}}
{{--        <td colspan="8" class="text-center py-5 error-box-table"> --}}
{{--            No record found --}}
{{--        </td> --}}
{{--    </tr> --}}
{{-- @endif --}}

{{-- <table class="table tab-des">
    <thead>
        <tr>
            <th class="text-center">Thumbnail</th>
            <th colspan="1">Event Name</th>
            <th>Date</th>
            <th>Role</th>
            <th>Location</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @if (count($galleries) != 0)
            @foreach ($galleries as $row)
                <tr>
                    <td width="10%" class="td-set new-lead text-center">
                        <img width="100%" src="{{ url($row->thumbnail) }}" alt="Thumbnail">
                    </td>
                    <td class="td-set new-lead">
                        <a href="javascript:;"
                            onclick="openModal('{{ route('gallery.edit', $row->id) }}', 'View Event', true)">
                            {{ $row->name }}
                        </a>
                    </td>
                    <td class="td-set new-lead">
                        {{ \Carbon\Carbon::parse($row->gallery_date)->format('Y-m-d') }}
                    </td>
                    <td class="td-set new-lead">
                        {{ $row->gallery_role->name }}
                    </td>
                    <td class="td-set new-lead">
                        {{ $row->gallery_location->name }}
                    </td>
                    <td class="text-center">
                        @if ($row->status == 1)
                            <label class="badge badge-success">Active</label>
                        @else
                            <label class="badge badge-danger">Draft</label>
                        @endif
                    </td>
                    <td class="text-center">
                        @can('gallery-delete')
                            <button class="btn-sm btn-danger"
                                onclick="deletemodal('{{ route('gallery.destroy', $row->id) }}', `{{ route('get.gallery') }}`)">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        @endcan
                        @can('gallery-edit')
                            <button class="btn-sm btn-primary"
                                onclick="openModal('{{ route('gallery.edit', $row->id) }}', 'Edit Event')">
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                        @endcan
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8" class="text-center py-5 error-box-table">
                    No record found
                </td>
            </tr>
        @endif
    </tbody>
</table> --}}

<div id="paginationLinks">
    {{ $galleries->links() }}
</div>
