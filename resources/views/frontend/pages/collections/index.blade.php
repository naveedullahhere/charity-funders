@php
    use App\Models\Collection;
    use App\Helpers\CommonHelper;

    $collections = Collection::with(['media.event'])
        ->where('status', 0)
        ->get();

    $basketItemIds = CommonHelper::getBasketItemIds()['collection'];
@endphp
<style>
    #selected-media-bar {
        position: fixed;
        bottom: -100%;
        left: 50%;
        background: #F5B801;
        transform: translateX(-50%);
        padding: 12px 18px;
        border-radius: 8px;
        box-shadow: 0px 10px 15px -3px rgb(0 0 0 / 21%);
        color: black;
        z-index: 1039;
        transition: .5s ease;
    }

    #selected-media-bar.visible {
        bottom: 12px;
        animation: twink .5s
    }

    @keyframes twink {
        0% {
            bottom: 12px;
        }

        50% {
            bottom: 24px;
        }

        100% {
            bottom: 12px;
        }
    }

    .select-media-checkbox {
        width: 50px;
        height: 50px;
    }

    #proceed-btn {
        border: 0;
        border-radius: 4px;
        font-size: 14px;
    }

    .btn-grp {
        position: absolute;
        bottom: 3%;
        width: 93%;
    }

    .form-check {
        margin-bottom: 10px;
        padding: 10px;
        background-color: #f9f9f9;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .tuntuna .form-check .form-check-input {
        margin-left: 0;
        margin-right: 8px;
    }

    .form-check-input:checked+.form-check-label {
        font-weight: bold;
        color: #0a4171;
        /* Bootstrap primary color */
    }

    .form-check:hover {
        background-color: #f1f1f1;
    }

    #existing-collections {
        max-height: 20rem;
        overflow: auto;
    }
</style>
<div class="container">
    <div id="selected-media-bar">
        <span id="selected-count">0</span> items selected.
        <span id="video-count">0</span> videos, <span id="image-count">0</span> images selected.
        <span id="total-price">0</span> total price.
        <button id="proceed-btn" class="ms-5" data-bs-toggle="offcanvas" data-bs-target="#sideCanvas">
            <i class="bi bi-eye"></i> View Selected Items
        </button>
    </div>

    <div id="sideCanvas" class="offcanvas offcanvas-end" tabindex="-1" aria-labelledby="sideCanvasLabel">
        <div class="offcanvas-header">
            <h5 id="sideCanvasLabel">Selected Items</h5>
            <button type="button" class="btn-close btn-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h5>Create New Collection</h5>
            <button id="show-create-form" class="btn btn-outline-primary mb-3">Create New</button>
            <h5>Existing Collections</h5>
            <div id="existing-collections" class="form-control mb-3 tuntuna px-2">
                @foreach ($collections as $collection)
                    <div class="form-check"
                        title="{{ in_array($collection->id, $basketItemIds) ? 'Item already in cart. please remove the item from the cart first.' : '' }}"
                        data-toggle="tooltip" data-placement="top" data-html="true">
                        <input class="form-check-input" type="radio" name="collection"
                            id="collection-{{ $collection->id }}" value="{{ $collection->id }}"
                            @disabled(in_array($collection->id, $basketItemIds))>
                        <label class="form-check-label" for="collection-{{ $collection->id }}">
                            {{ $collection->collection_name }}
                            ({{ CommonHelper::getGenericItemsByCollection($collection)['price'] }})
                        </label>
                    </div>
                @endforeach
            </div>
            <form id="create-collection-form" style="display: none;" class="bg-muted p-3 border rounded-2 my-4">
                <div class="form-group">
                    <label for="collection-name">Collection Name</label>
                    <input type="text" id="collection-name" class="form-control w-100" required>
                </div>
                <button type="submit" class="btn btn-dark mt-2 w-100 text-center">Create Collection</button>
            </form>
            <h5 class="d-none">Total Selected Items: <span id="selected-items-list">0</span></h5>
            <form action="/collections/make" method="POST" class="row btn-grp">
                @csrf
                @method('POST')
                <input type="hidden" name="selected_collection" required id="selected-collection">
                <input type="hidden" name="media[]" required>
                <input type="hidden" name="event_id" value="{{ $slug ?? 0 }}" required>
                <div class="col-6 pe-1 ps-0">
                    <button id="checkout-btn" class="btn btn-secondary w-100 mt-3">Add to collection</button>
                </div>
                <div class="col-6 ps-1 pe-0">
                    <a href="/collections" class="btn btn-dark w-100 mt-3 text-white">View all
                        collections</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('show-create-form').addEventListener('click', function() {
        const form = document.getElementById('create-collection-form');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });
</script>
