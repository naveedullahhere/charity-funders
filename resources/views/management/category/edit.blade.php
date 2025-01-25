<form method="POST" action="{{route('category.update', $category->id)}}" id="ajaxSubmit" enctype="multipart/form-data">
    @method('PUT')
    <input type="hidden" id="listRefresh" value="{{ route('get.category') }}" />

    <div class="row form-mar">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group ">
                <label>Parent Category <small>(Optional)</small></label>
                <select class="form-control" name="parent_id">
                    <option value="">Select Parent Category</option>
                    @foreach ($categories as $row)
                        <option {{$category->parent && $row->id == $category->parent->id ? 'selected' : ''}} value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group ">
                <label>Name:</label>
                <input type="text" name="name" value="{{$category->name}}" placeholder="Name" class="form-control" autocomplete="off" />
            </div>
        </div>
    </div>
    <div class="row bottom-button-bar">
        <div class="col-12">
            <a type="button" class="btn btn-danger modal-sidebar-close position-relative top-1 closebutton">Close</a>
            <button type="submit" class="btn btn-primary submitbutton">Save</button>
        </div>
    </div>
</form>