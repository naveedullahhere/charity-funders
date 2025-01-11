{{-- @include('management.theme.includes.error_success') --}}
{!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id], 'id' => 'ajaxSubmit']) !!}
<input type="hidden" id="listRefresh" value="{{ route('get.roles') }}" />

<div class="row form-mar">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Name:</label>
            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}

        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group errorappend">
            <label>Description:</label>
            {!! Form::textarea('description', null, [
                'placeholder' => 'Description',
                'class' => 'form-control',
                'rows' => 3,
            ]) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">
            <label>Permission:</label>
            <br />
            @foreach ($permission as $value)
                @if ($value->parent_id === null)
                    <div class="permission-container errorappend list-group">

                        <div class="custom-accordion row w-100 mx-auto py-0">
                            <label class="col-11 py-2  text-capitalize">
                                {{ Form::checkbox('permission[]', $value->name, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'parent']) }}
                                <span>{{ $value->name }}</span></label>
                            @if ($permission->where('parent_id', $value->id)->count() != 0)
                                <span
                                    class="material-symbols-outlined pl-3 col-1 text-right d-flex align-items-center border-left"><i
                                        class="ft-chevron-down"></i></span>
                            @endif
                        </div>
                        <div class="sub-permissions" style="display: none">
                            @foreach ($permission as $subPermission)
                                @if ($subPermission->parent_id == $value->id)
                                    <label
                                        class="pl-5 py-2">{{ Form::checkbox('permission[]', $subPermission->name, in_array($subPermission->id, $rolePermissions) ? true : false, ['class' => 'child']) }}
                                        <span> {{ $subPermission->name }} </span></label>
                                    <br />
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach


        </div>
    </div>
</div>
<div class="row bottom-button-bar">
    <div class="col-12">
        <a type="button" class="btn btn-danger modal-sidebar-close position-relative top-1 closebutton" >Close</a>
        <button type="submit" class="btn btn-primary submitbutton">Save</button>
    </div>
</div>
{!! Form::close() !!}


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
