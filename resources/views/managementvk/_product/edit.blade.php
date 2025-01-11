@include('management.theme.includes.error_success')
<form class="example" id="subm" method="post" action="{{route('product.update',$product->id)}}">
    @csrf
    @method('PUT')
    <input type="hidden" id="url" value="{{ route('product.index') }}"/>
    <div class="row form-mar">
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{$product->name}}" class="form-control" placeholder="Product Name">
            </div>
        </div>

        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Description</label>
                <textarea type="text" name="description"  class="form-control" placeholder="Description">{{$product->description}}</textarea>
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Cost</label>
                <input type="text" name="cost" value="{{$product->cost}}" class="form-control" placeholder="Cost">
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Price</label>
                <input type="text" name="price" value="{{$product->price}}" class="form-control" placeholder="Price">
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Stock</label>
                <input type="text" name="stock" value="{{$product->stock}}" class="form-control" placeholder="Stock">
            </div>
        </div>
    </div>
    <div class="row text-center center">
        <div class="col-12">
            <button type="submit" class="btn-theme">Save</button>
            <button type="button" class="btn-white" data-close="model">Cancel</button>
        </div>
    </div>
</form>
