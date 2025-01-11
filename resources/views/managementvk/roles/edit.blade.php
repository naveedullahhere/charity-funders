@include('management.theme.includes.error_success')
{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id],'id'=>'subm']) !!}
<input type="hidden" id="listRefresh" value="{{ route('get.roles') }}" />

<div class="row form-mar">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Name:</label>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <label>Permission:</label>

            <br/>

            {{--            @foreach($permission as $value)--}}
            {{--                <label>{{ Form::checkbox('permission[]', $value->name, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}--}}

            {{--                    {{ $value->name }}</label>--}}
            {{--                <br/>--}}
            {{--            @endforeach--}}


            @foreach($permission as $value)
                @if($value->parent_id === null)
                    <div class="permission-container">

                        <div class="custom-accordion row py-0">
                            <label class="col-11 py-2  text-capitalize">
                                {{ Form::checkbox('permission[]', $value->name, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'parent')) }}
                                <span>{{ $value->name }}</span></label>
                            @if($permission->where('parent_id',$value->id)->count() != 0)
                                <span class="material-symbols-outlined pl-3 col-1 text-right d-flex align-items-center border-left">expand_more</span>
                            @endif                        </div>
                        <div class="sub-permissions" style="display: none">
                            @foreach($permission as $subPermission)
                                @if($subPermission->parent_id == $value->id)
                                    <label class="pl-5 py-2">{{ Form::checkbox('permission[]', $subPermission->name, in_array($subPermission->id, $rolePermissions) ? true : false, array('class' => 'child')) }}
                                        <span> {{ $subPermission->name }} </span></label>
                                    <br/>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach


        </div>
    </div>
</div>
<div class="row text-center center">
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-danger" data-close="model">Cancel</button>
    </div>
</div>
{!! Form::close() !!}


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.parent').change(function() {
            $(this).parents('.permission-container').find('.sub-permissions').find('.child').prop('checked', $(this).prop('checked'));
        });
        $('.child').change(function() {
            var parentCheckbox = $(this).closest('.permission-container').find('.parent');
            parentCheckbox.prop('checked', $(this).closest('.sub-permissions').find('.child:checked').length > 0);
        });
    });
    $('.custom-accordion > span').on('click',function(){
        $(this).parents('.custom-accordion').siblings('.sub-permissions').toggle('slow');
    })
</script>


