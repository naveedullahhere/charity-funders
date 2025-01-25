<div class="searchHeader d-flex justify-content-between align-items-center">
    <div>{{count($funders)}} results</div>
    <div class="d-flex align-items-center gap-3">
        <div>Sort:</div>
        <select name="" id="" class="form-select text-left">
            <option value="">Relevance</option>
        </select>
        

          <select name="per_page" id="per_page" class="form-select text-left">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 / Page</option>
                    <option value="25" {{ request('per_page', 25) == 25 ? 'selected' : '' }}>25 / Page</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 / Page</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 / Page</option>
                </select>
    </div>
</div>

<div>
    @foreach ($funders as $funder)
        <div class="result-card">
            <div class="row align-items-start">
                <!-- Prospect Column -->
                <div class="col-md-3">
                    <h3 class="h5 mb-4 fw-bold">Prospect</h3>

                    <h2 class="h5 mb-0">{{$funder->name ?? 'Unknown'}}</h2>
                    <div class="charity-number">Charity no: {{$funder->charity_no}}</div>
                    <p class="mb-2 fs-6 d-block">
                        {{ Str::words(strip_tags($funder->company_description), 20, '') }}
                    </p>
                    <a href="#" class="read-more">
                        Read more
                        <i class="fas fa-arrow-up txt-primary btn-ico"></i>
                    </a>
                </div>

                <!-- Funding Focus Column -->
                <div class="col-md-3">
                    <h3 class="h5 mb-4 fw-bold">Funding focus</h3>
                    <ul class="funding-list">


                        @if ($funder->workAreas->count() > 0)
                            @foreach ($funder->workAreas->take(3) as $areasOfWork)
                                <li>{{ $areasOfWork->name }}</li>
                            @endforeach

                            @if ($funder->workAreas->count() > 3)
                                <li class="link">
                                    <a href="#" class="more-link">{{ $funder->workAreas->count() - 3 }} more...</a>
                                </li>
                            @endif
                        @else
                            <li>No work areas found.</li>
                        @endif
                    </ul>
                </div>

                <!-- Geographic Preferences Column -->
                <div class="col-md-3">
                    <h3 class="h5 mb-4 fw-bold">Geographic preferences</h3>
                    <div>North Yorkshire</div>
                </div>

                <!-- Annual Spending Column -->
                <div class="col-md-3 text-md-end">
                    <div class="annual-spending">
                        <h3 class="h5 mb-4 fw-bold">Annual spending</h3>
                        <div class="h5 mb-0">£279,800</div>
                        <div class="text-muted">(2021/22)</div>
                        <div class="mt-3">

                            <button class="primaryBtn">Add to favourites <i class="fas fa-arrow-up"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Results -->
    <div class="result-card">
        <div class="row align-items-start">
            <!-- Prospect Column -->
            <div class="col-md-3">
                <h3 class="h5 mb-4 fw-bold">Prospect</h3>

                <h2 class="h5 mb-0">Henry Smith</h2>
                <div class="charity-number">Charity no: 230102</div>
                <p class="mb-2 fs-6 d-block">The trust was established in 1973 and makes grants to
                    organisations within 25-mile radius of York. The trust's areas of support include:</p>
                <a href="#" class="read-more">
                    Read more
                    <i class="fas fa-arrow-up txt-primary btn-ico"></i>
                </a>
            </div>

            <!-- Funding Focus Column -->
            <div class="col-md-3">
                <h3 class="h5 mb-4 fw-bold">Funding focus</h3>
                <ul class="funding-list">
                    <li class="">Art, culture & heritage</li>
                    <li class="">Social welfare</li>
                    <li class="">Natural sciences</li>
                    <li class="link"><a href="#" class="more-link">3 more...</a></li>
                </ul>
            </div>

            <!-- Geographic Preferences Column -->
            <div class="col-md-3">
                <h3 class="h5 mb-4 fw-bold">Geographic preferences</h3>
                <div>North Yorkshire</div>
            </div>

            <!-- Annual Spending Column -->
            <div class="col-md-3 text-md-end">
                <div class="annual-spending">
                    <h3 class="h5 mb-4 fw-bold">Annual spending</h3>
                    <div class="h5 mb-0">£279,800</div>
                    <div class="text-muted">(2021/22)</div>
                    <div class="mt-3">

                        <button class="primaryBtn">Add to favourites <i class="fas fa-arrow-up"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>