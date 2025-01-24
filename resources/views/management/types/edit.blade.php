
<form method="POST" action="{{route('types.update', $type->id)}}" id="ajaxSubmit" enctype="multipart/form-data"> 
@method('PUT')
<input type="hidden" id="listRefresh" value="{{ route('get.types') }}" />

<div class="row form-mar">
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group ">
            <label>Name:</label>
            <input type="text" name="name" value="{{$type->name}}" placeholder="Name" class="form-control" />
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group ">
            <label>Description <small>(Optional)</small>:</label>
            <textarea name="description" row="2" class="form-control" placeholder="Description">{{$type->description}} </textarea>
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

<script>
    $(document).ready(function() {
        $('.parent').change(function() {
            $(this).parents('.permission-container').find('.sub-permissions').find('.child').prop(
                'checked', $(this).prop('checked'));
        });
        $('.child').change(function() {
            var parentCheckbox = $(this).closest('.permission-container').find('.parent');
            parentCheckbox.prop('checked', $(this).closest('.sub-permissions').find('.child:checked')
                .length > 0);
        });
    });
    $('.custom-accordion > span').on('click', function() {
        $(this).parents('.custom-accordion').siblings('.sub-permissions').toggle('slow');
    })
</script>
