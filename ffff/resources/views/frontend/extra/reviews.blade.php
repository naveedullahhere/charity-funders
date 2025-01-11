<?php
use App\Models\Review;
$review = Review::where('status',1)->get();
?>

<section class="py-lg-9 py-5 bg-primary-blend-gradient text-dark">
    <div class="container">
        <div class="row align-items-center mb-lg-7 mb-5">
            <div class="col-xl-6 col-lg-5 col-md-12">
                <div class="mb-4 mb-lg-0 text-center text-lg-start">
                    <small class="text-uppercase ls-md fw-semibold">REVIEWS</small>
                    <h2 class="mt-4">
                        Air Parking Services Clients
                    </h2>
                    <p class="mb-0">I bring solutions to make life easier for our customers.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($review as $rev)
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body">
                        <div class="star">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rev->rating)
                                    <img src="{{asset('/star_voted.png')}}" style="width: 20px;">
                                @else
                                    <img src="{{asset('/star_blank.png')}}" style="width: 20px;">
                                @endif
                            @endfor
                        </div>
                            <p class="mb-4">{{$rev->review}}</p>
                        <h5 class="mb-0">{{$rev->name}}</h5>
{{--                        <small>Manchester LCS Meet and Greet</small>--}}
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>