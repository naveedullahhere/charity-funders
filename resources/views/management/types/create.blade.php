<form action="{{ route('types.store') }}" method="POST" id="ajaxSubmit" autocomplete="off">
  @csrf
  <input type="hidden" id="listRefresh" value="{{ route('get.types') }}" />

<div class="row form-mar">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group ">
            <label>Name:</label>
            <input type="text" name="name" value="" placeholder="Name" class="form-control" />
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group ">
            <label>Address <small>(Optional)</small>:</label>
            <textarea name="description" row="2" class="form-control" placeholder="Description"></textarea>
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


