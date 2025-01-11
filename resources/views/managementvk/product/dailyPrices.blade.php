
    <div class="card p-1">
        <div class="body p-0">
            <h2 class="mb-4">Edit Product</h2>
            <form class="example" id="subm" method="post" action="{{ route('product.updateDailyPrices', $product->id) }}">
                @csrf
                @method('POST')
                 <input type="hidden" id="url" value="{{ route('product.index') }}" />
                <div class="row">
                    @for ($i = 1; $i <= 30; $i++)
                        <div class="col-12 col-sm-3">
                            <div class="form-group">
                                <label for="price_day_{{ $i }}">Price for Day {{ $i }}</label>
                                <input type="number" id="price_day_{{ $i }}" name="prices[{{ $i }}]"
                                    class="form-control" placeholder="Price for Day {{ $i }}"
                                    value="{{ isset($product->prices, json_decode($product->prices, true)[$i]) ? json_decode($product->prices, true)[$i] : '' }}"
                                    required>
                            </div>
                        </div>
                    @endfor

                    <div class="col-12 col-sm-3">
                        <label for="additional_charge">Additional charges</label>
                        <input type="number" id="additional_charge" name="additional_charge" class="form-control"
                            placeholder="Additional charges" value="{{ $product->additional_charge ?? '' }}">
                    </div>
                </div>
                <div class="row text-center center ">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-close="model">Cancel</button>
                    </div>
                </div>
{{--                <div class="row text-center center">--}}
{{--                    <div class="col-12">--}}
{{--                        <button type="submit" class="btn btn-primary">Update</button>--}}
{{--                        <a href="{{ route('product.index') }}" class="btn btn-danger">Cancel</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </form>
        </div>
</div>


@section('script')
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            let transferRequiredCheckbox = document.getElementById('transferRequiredCheckbox');

            transferRequiredCheckbox.addEventListener('change', function() {
                transferRequiredCheckbox.value = transferRequiredCheckbox.checked ? 1 : 0;
            });

            transferRequiredCheckbox.value = transferRequiredCheckbox.checked ? 1 : 0;
        });
    </script>
@endsection
