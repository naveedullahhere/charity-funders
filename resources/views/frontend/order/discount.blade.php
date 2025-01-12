@php
    $discountPrice = (int)$basket->product_price * ((int)$basket->discount_percentage / 100);
    $price = ((int)$basket->product_price - (int)$discountPrice);
@endphp

@if ($basket->discount_code && $basket->discount_percentage)
    <div class="mt-5" id="discount_sec">
        <div class="rounded-md bg-gray-50 px-3 py-3">
            <div class="sm:flex">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-sm leading-5 font-medium text-gray-900 d-flex justify-content-between">
                        <span class="font-bold">Coupon: (<span id="dis">{{ $basket->discount_code }}</span>)
                        </span> <span>-{{ $discountPrice }} £
                            ({{ $basket->discount_percentage }}%)</span>
                    </div>
                    <div class="mt-1 text-sm leading-5 sm:flex align-items-center text-gray-900">
                        <button class="btn btn-sm btn-transparent" id="removeCoupon" onclick="removeCode()">x</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="mt-5" id="coupon_sec">
        <div class="rounded-md bg-gray-50 px-3 py-3">
            <div class="sm:flex">
                <div class="flex-1">
                    <label for="coupon" class="form-label">Apply coupon</label>
                    <div>
                        <input type="text" class="form-control input-date" id="coupon" name="coupon">
                        <button type="button" class="btn btn-primary me-2 mt-3 check-fou-coupon"
                            onclick="applyCode(true)">Apply</button>
                    </div>
                    <div class="invalid-feedback">Please enter phone.</div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="mt-5">
    <div class="rounded-md border-t-2 border-gray-100 px-3 py-3">
        <div class="sm:flex">
            <div class="flex-1">
                <div class="text-sm leading-5 font-medium d-flex justify-content-between text-gray-900">
                    <input type="hidden" name="product_price" value="{{ $price }}">
                    <span class="font-semibold text-xl">Total</span><span class="font-medium text-xl">£ <span
                            id="prices">{{ $price }}</span></span>
                </div>
            </div>
        </div>
    </div>
</div>
