@include('management.theme.includes.error_success')
<form class="example" id="subm" method="post" action="{{ route('discount.store') }}">
    @csrf
    <input type="hidden" id="url" value="{{ route('discount.index') }}" />
    <div class="row form-mar">
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Discount code <span class="text-danger"> *</span></label>
                <input type="text" name="discount_code" class="form-control" placeholder="Discount code">
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Discount percentage <span class="text-danger"> *</span></label>
                <input type="number"  step="0.05" name="discount_percentage" class="form-control" placeholder="Discount percentage">
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option selected value="1">Active</option>
                    <option value="0">Draft</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row text-center center">
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-close="model">Cancel</button>
        </div>
    </div>
</form>
