<!--newsletter-->
<?php
use App\Models\Airport;
$airport = Airport::where('status',1)->get();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="bg-light bg-opacity-75 px-5 pt-5 pb-7 mb-2 rounded-3 ">
                <form name="search-airport-providers" class="needs-validation" novalidate id="searchA" action="{{url('search')}}" method="get" onSubmit="return checkSF()">
                    <div class="row g-3 needs-validation d-flex mx-md-7 px-md-4">
                        <div class="col-md-4">
                            <label for="airport" class="form-label">Flying from</label>
                            <select required class="form-select" name="airport" id="airport">
                                <option value="" disabled selected>------- Select UK Airport --------</option>
                                @foreach ($airport as $row)
                                <option value="{{$row->slug}}">{{$row->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="txtFrom" class="form-label">Arrival date</label>
                            <input required type="datetime-local" class="form-control" name="arrival_date" id="arrival_date"
{{--                                   value="{{ date('Y-m-d\TH:i') }}"--}}
                            />
                        </div>
                        <div class="col-md-4">
                            <label for="txtTo" class="form-label">Return date/time</label>
                            <input required type="datetime-local" class="form-control" name="return_date"  id="return_date"
{{--                                   value="{{ date('Y-m-d\TH:i', strtotime('+10 days')) }}" --}}
                            />
                        </div>

{{--                        <div class="col-md-4">--}}
{{--                            <label for="promo" class="form-label">Promotion Code</label>--}}
{{--                            <input type="text" class="form-control" name="promo" id="promo" placeholder="Optional">--}}
{{--                        </div>--}}
                        <div class="col-md-6">
                            <label for="passengers" class="form-label">Passengers</label>
                            <select required name="passengers" id="passengers" class="form-select">
                                <?php for ($i = 1; $i < 8; $i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="d-grid">
                                <label for="airport" class="form-label">Flying from</label>
                                <button class="btn btn-primary shadow-sm" type="submit">Get a quote</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--newsletter-->
