
<input type="hidden" id="totalPages" value="{{$purchaseddrive->lastPage()}}">
<input type="hidden" id="currentPage" value="{{$purchaseddrive->currentPage()}}">


@foreach ($purchaseddrive as $item)
    <div class="col-md-4 my-1 px-md-1">
        @if ($item->item_type == 'media')
            <div class="card folder py-2 px-2">
                <a href="{{ asset($item->file_path) }}" data-lightbox="media" data-title="Image - {{ basename($item->file_path) }}">
                    <img class="w-100" src="{{asset($item->file_path)}}" alt="">
                </a>
            </div>
        @elseif($item->item_type == 'event')
            <div class="card folder p-3">
                <div class="row align-items-center m-0">
                    <div class="col-md-2 p-0">
                        <svg focusable="false" viewBox="0 0 24 24" height="30px" width="30px" fill="currentColor" class="a-s-fa-Ha-pa"><g><path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"></path><path d="M0 0h24v24H0z" fill="none"></path></g></svg>
                    </div>
                    <div class="col-md-10">
                        <div class="foldertile">
                            {{ $item->event_name }}
                        </div>
                    </div>
                </div>
            </div>
        @elseif($item->item_type == 'collection')
            <div class="card folder p-3">
                <div class="row align-items-center m-0">
                    <div class="col-md-2 p-0">
                        <svg focusable="false" viewBox="0 0 24 24" height="30px" width="30px" fill="currentColor" class="a-s-fa-Ha-pa"><g><path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"></path><path d="M0 0h24v24H0z" fill="none"></path></g></svg>
                    </div>
                    <div class="col-md-10">
                        <div class="foldertile">
                            {{ $item->collection_name }}
                        </div>

                    </div>
                </div>
            </div>
        @else
            Unnamed Item
        @endif
        {{--        <div class="line-item-grey">--}}
        {{--            <small>--}}
        {{--                @if ($item->item_type == 'media')--}}
        {{--                    {{ basename($item->media->file_path) }}--}}
        {{--                @elseif($item->item_type == 'event')--}}
        {{--                    {{ $item->event->name }}--}}
        {{--                @elseif($item->item_type == 'collection')--}}
        {{--                    {{ $item->collection->collection_name }}--}}
        {{--                @else--}}
        {{--                    Unnamed Item--}}
        {{--                @endif--}}

        {{--                <span class="badge bg-dark">{{ ucwords($item->item_type) }}--}}
        {{--                    {{ $item->quantity > 1 ? '(' . $item->quantity . ')' : '' }}</span>--}}
        {{--            </small>--}}
        {{--            <small>${{ number_format($item->price, 2) }}--}}
        {{--            </small>--}}
        {{--        </div>--}}
    </div>
@endforeach
