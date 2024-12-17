<?php
use App\Helpers\CommonHelper;

$basketItemIds = CommonHelper::getBasketItemIds();
?>

<style>
    .media-item {
        position: relative;
        margin-bottom: 20px;
    }

    .picture {
        position: relative;
        overflow: hidden;
        height: 300px;
        /*border-radius: 10px;*/
        /* Rounded corners for images */
    }
    .picture.galleryimage {
        position: relative;
        overflow: hidden;
        height: 370px;
        /*border-radius: 10px;*/
        /* Rounded corners for images */
    }

    .picture img {
        object-fit: cover;
        width: 100%;
        height: 100%;
        /*border-radius: 10px;*/
        /* Ensures the image takes the full height */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .picture img:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        /* Shadow effect on hover */
    }

    .view-details-btn {
        bottom: -50px;
        left: 50%;
        transform: translateX(-50%);
        transition: all 0.3s ease;
        opacity: 0;
        pointer-events: none;
        background-color: #000;
        color: #fff;
        padding: 5px 10px;
        /*border-radius: 25px;*/
    }

    .media-item:hover .view-details-btn {
        bottom: 10px;
        opacity: 1;
        pointer-events: auto;
    }
    .view-details-btn:hover {
        background-color: rgb(81 79 79 / 31%);
        color: #fff;
        /* border-color: white; */
        backdrop-filter: blur(5px);
    }


    /* Custom Checkbox */
    .select-media-checkbox {
        appearance: none;
        position: absolute;
        top: 10px;
        right: 10px;
        width: 20px;
        height: 20px;
        background: #fff;
        border: 2px solid #555;
        border-radius: 50%;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .select-media-checkbox:checked {
        background-color: #F5B801;
        border-color: #F5B801;
        transform: scale(1.3);
        /* Adds a scaling effect when checked */
    }

    .select-media-checkbox:before {
        content: "";
        position: absolute;
        width: 10px;
        height: 10px;
        background-color: #fff;
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        transition: transform 0.2s ease;
    }

    .select-media-checkbox:checked:before {
        transform: translate(-50%, -50%) scale(1);
    }

    /* Event Text */
    .event-text {
        font-size: 14px;
        color: #777;
    }

    /* Event Heading */
    .event-heading {
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
        color: #333;
    }

    /* Responsive design improvements */
    @media (max-width: 768px) {
        .media-item {
            margin-bottom: 30px;
        }

        .picture {
            height: 180px;
        }
    }

    .select-media-checkbox {
        width: 20px !important;
        height: 20px !important;
    }
</style>

@if(count($media) != 0)
    @foreach ($media as $item)
        <div class="col-md-3 col-sm-6 position-relative media-item">

            <div class="picture {{isset($is_event) && $is_event == 1 ? '' : 'galleryimage'}}">
                @if (isset($is_event) && $is_event == 1)
                    <img class="img-fluid" src="{{ asset($item->thumbnail) }}" alt="{{ $item->name }}">
                @else
                    <img src="{{ $item->file_path ? asset($item->file_path) : '/placeholder-image.jpg' }}"
                         alt="{{ $item->name ?? 'Thumbnail' }}">
                @endif

                @if (isset($is_event) && $is_event == 1)
                    <a href="{{ $item->id ? '/event/' . $item->slug : '#' }}"
                       class="btn view-details-btn position-absolute"><i class="fa-regular fa-eye me-1"></i> View Event</a>
                @else
                    <input type="checkbox" class="select-media-checkbox position-absolute" data-id="{{ $item->id }}"
                           data-filetype="{{ $item->file_type }}">
                    <a href="{{ $item->id ? '/media/' . $item->id : '#' }}" class="btn view-details-btn position-absolute">
                        <i class="fa-regular fa-eye me-1"></i> View {{ ucwords($item->file_type) }}
                    </a>
                @endif
            </div>

            @if (isset($item->event_date))
                <div class="mt-2">
                    <p class="event-text">{{ $item->event_date }}</p>
                </div>
                <div class="mt-0">
                    <p class="event-heading">{{ $item->name }}</p>
                </div>
            @endif
        </div>
    @endforeach
@else
    <div class="no-record-found-box text-center">
        <img  class="w-25" src="{{asset('/no-result-data.png')}}" alt="">
        <p class="text-muted text-uppercase">No record found</p>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.select-media-checkbox');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const deltaX = (x - centerX) / centerX;
                const deltaY = (y - centerY) / centerY;

                this.style.transform =
                    `translate(${deltaX * 20}px, ${deltaY * 20}px) scale(1.3)`;
            });

            checkbox.addEventListener('mouseleave', function() {
                this.style.transform = 'translate(0, 0) scale(1)';
            });
        });
    });
</script>
