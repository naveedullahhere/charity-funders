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
    @if (count($funders) != 0)
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
    @else

        <div class="my-5 py-5 text-center">
            <svg width="150" height="150" viewBox="0 0 64 41" xmlns="http://www.w3.org/2000/svg">
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
            <p class="ant-empty-description d-block">No data</p>
        </div>
    @endif





<div class="row d-flex w-100 mx-auto" id="paginationLinks" style="background: #f3f3f3;">

    <div class="col-md-12 text-right">
        <div id="">
            {{ $funders->links() }}
        </div>
    </div>
</div>


</div>