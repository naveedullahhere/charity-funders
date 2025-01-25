
<form method="POST" action="{{route('types.update', $contact->id)}}" id="ajaxSubmit" enctype="multipart/form-data"> 
@method('PUT')
<input type="hidden" id="listRefresh" value="{{ route('get.types') }}" />

<div class="row form-mar">
    
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group ">
            <label>First Name:</label>
            <input type="text" name="first_name" value="{{$contact->first_name}}" placeholder="First Name" class="form-control" />
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group ">
            <label>Last Name:</label>
            <input type="text" name="last_name" value="{{$contact->last_name}}" placeholder="Last Name" class="form-control" />
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group ">
            <label>Email:</label>
            <input type="text" name="email" value="{{$contact->email}}" placeholder="Email" class="form-control" />
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group ">
            <label>Phone No:</label>
            <input type="text" name="phone" value="{{$contact->phone}}" placeholder="Phone no" class="form-control" />
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group ">
            <label>Message <small>(Optional)</small>:</label>
            <textarea name="message" row="2" class="form-control" placeholder="Message">{{$contact->message}} </textarea>
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
