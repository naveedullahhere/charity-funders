@include('management.theme.includes.error_success')
<form class="example" id="subm" method="post" action="{{route('supplier.update',$supplier->id)}}">
    @csrf
    @method('PUT')
    <input type="hidden" id="url" value="{{ route('supplier.index') }}"/>
    <div class="row form-mar">
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{$supplier->name}}" class="form-control" placeholder="Category Title">
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Description</label>
                <textarea type="text" name="description" class="form-control" placeholder="Description">{{$supplier->description}}</textarea>
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
