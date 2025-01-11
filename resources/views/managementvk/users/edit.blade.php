@include('management.theme.includes.error_success')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id], 'id' => 'subm']) !!}
<input type="hidden" id="url" value="{{ route('users.index') }}"/>

<div class="row form-mar">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Name:</label>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Email:</label>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Password:</label>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Confirm Password:</label>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
    {{--        <div class="col-xs-12 col-sm-12 col-md-12">--}}
    {{--            <div class="form-group">--}}
    {{--                <strong>Role:</strong>--}}
    {{--                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}--}}
    {{--            </div>--}}
    {{--        </div>--}}
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Roles:</label>
            <br>
            @foreach($roles as $roleId => $roleName)
                <label>
                    {!! Form::checkbox('roles[]', $roleId, in_array($roleId, $userRole)) !!}
                    <span>{{ $roleName }}</span>
                </label>
                <br>
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


