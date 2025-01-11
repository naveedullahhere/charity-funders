@include('management.theme.includes.error_success')
<form class="example" id="subm" method="post" action="{{route('page.update',$page->id)}}">
    @csrf
    @method('PUT')
    <input type="hidden" id="url" value="{{ route('page.index') }}"/>
    <div class="row form-mar">
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="{{$page->title}}" class="form-control" placeholder="Title">
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Description</label>
                <textarea type="text" name="description" class="form-control ckeditor" placeholder="Description">{{$page->description}}</textarea>
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <label class="">Placement</label>
            <div class="form-group">
                <label class="mr-4">
                    <input name="header" {{$page->header == 1 ? 'checked' : ''}} value="1" type="checkbox" >
                    <span>Header</span>
                </label>


                <label>
                    <input name="footer" {{$page->footer == 1 ? 'checked' : ''}} value="1" type="checkbox" >
                    <span>Footer</span>
                </label>
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Meta Title</label>
                <input type="text"  value="{{$page->meta_title}}" name="meta_title" class="form-control" placeholder="Title">
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Meta Description</label>
                <textarea type="text" name="meta_description" class="form-control" placeholder="Description">{{$page->meta_description}}</textarea>
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Meta Keyword</label>
                <textarea type="text" name="meta_keyword" class="form-control" placeholder="Description">{{$page->meta_keyword}}</textarea>
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
