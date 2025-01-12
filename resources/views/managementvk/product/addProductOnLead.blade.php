@include('management.theme.includes.error_success')
<form class="example" id="quick_add" method="post" action="{{route('product.store')}}">
    @csrf
{{--    <input type="hidden" id="url" value="{{ route('product.index') }}"/>--}}
    <div class="row form-mar">
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Product Name">
            </div>
        </div>

        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Description</label>
                <textarea type="text" name="description" class="form-control" placeholder="Description"></textarea>
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Cost</label>
                <input type="text" name="cost" class="form-control" placeholder="Cost">
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" class="form-control" placeholder="Price">
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Stock</label>
                <input type="text" name="stock" class="form-control" placeholder="Stock">
            </div>
        </div>
    </div>
    <div class="row text-center center">
        <div class="col-12">
            <button type="submit" class="btn-theme">Save</button>
            <a href="{{route('product')}}" class="btn-white" data-close="modeel">Cancel</a>
        </div>
    </div>
</form>
