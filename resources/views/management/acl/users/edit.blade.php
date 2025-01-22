{!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'id' => 'ajaxSubmit']) !!}
<input type="hidden" id="url" value="{{ route('users.index') }}" />

<div class="row">
<div class="col-md-12 -auto">
                                                <div class="avatar-upload">
                                                    <div class="avatar-edit">
                                                        <input type='file' id="imageUpload" name="profile_image"
                                                            accept=".png, .jpg, .jpeg" />
                                                        <label for="imageUpload">
                                                           <i class="ft-camera"></i>
                                                        </label>
                                                    </div>
                                                    <div class="avatar-preview">
                                                        <div id="imagePreview"
                                                            style="background-image: url('{{ image_path(auth()->user()->profile_image) }}');">
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-center mt-2">{{'@'.auth()->user()->username}}</p>
                                            </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Name:</label>
            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Email:</label>
            {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Password:</label>
            {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Confirm Password:</label>
            {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
        </div>
    </div>
    {{--        <div class="col-xs-12 col-sm-12 col-md-12"> --}}
    {{--            <div class="form-group"> --}}
    {{--                <strong>Role:</strong> --}}
    {{--                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!} --}}
    {{--            </div> --}}
    {{--        </div> --}}
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Roles:</label>
            <br>
            @foreach ($roles as $roleId => $roleName)
                <label>
                    {!! Form::checkbox('roles[]', $roleId, in_array($roleId, $userRole)) !!}
                    <span>{{ $roleName }}</span>
                </label>
                <br>
            @endforeach
        </div>
    </div>
</div>


<div class="row bottom-button-bar">
    <div class="col-12">
        <a type="button" class="btn btn-danger modal-sidebar-close position-relative top-1 closebutton">Close</a>
        <button type="submit" class="btn btn-primary submitbutton">Save</button>
    </div>
</div>
{!! Form::close() !!}
