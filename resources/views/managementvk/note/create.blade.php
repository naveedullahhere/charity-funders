@include('management.theme.includes.error_success')
<form class="example" id="subm" method="post" action="{{route('note.store')}}">
    @csrf
    <input type="hidden" id="url" value="{{ url()->current() }}">
    <div class="row form-mar">
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label>Note</label>
                <textarea type="text" name="description" class="form-control" placeholder="Description"></textarea>
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
