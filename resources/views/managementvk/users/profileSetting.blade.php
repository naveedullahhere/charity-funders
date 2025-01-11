@extends('management/layouts/master')
@section('title')
    Users
@endsection
@section('content')
    <style>

        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 5px auto;
        }
        .avatar-upload .avatar-edit {
            position: absolute;
            right: 10%;
            z-index: 1;
            bottom: 10px;
        }
        .avatar-upload .avatar-edit input {
            display: none;
        }
        .avatar-upload .avatar-edit input + label {
            display: inline-flex;
            width: 40px;
            height: 40px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
            align-items: center !important;
            justify-content: center;
            background: #000000;
            color: #fff;
            border: 3px solid white;
            padding: 0;
        }
        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }
        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }
        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

    </style>
    <!-- Center Main Content -->
    <section class="center-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="tab-b">
                        <ul class="tab-product wow fadeInRight">
                            <li data-targetit="box-1" class="current">
                                <a href="#tab-1" data-toggle="tab"><span class="material-symbols-outlined">person</span> Basic Information</a>
                            </li>
                            <li data-targetit="box-2" >
                                <a href="#tab-2" data-toggle="tab"><span class="material-symbols-outlined">lock</span> Change Password</a>
                            </li>
                            {{--                            <li data-targetit="box-3" >--}}
                            {{--                                <a href="#tab-2" data-toggle="tab"><span class="material-symbols-outlined">verified_user</span> Security</a>--}}
                            {{--                            </li>--}}
                            <li data-targetit="box-4" >
                                <a href="#tab-2" data-toggle="tab"><span class="material-symbols-outlined">history</span> Login History</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-b">
                        <div class="box-1 showfirst tab-content card">
                            <div class="container p-5">
                                @include('management.theme.includes.error_success')
                                <form class="form-l" id="subm" method="post" action="{{route('profile-settings',auth()->user()->id)}}">
                                    @csrf
                                    @method('PUT')
{{--                                    <input type="hidden" id="url" value="{{ url('profile-settings') }}"/>--}}

                                    <div class="row">
                                        <div class="col-md-4 -auto">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' id="imageUpload" name="profile_image" accept=".png, .jpg, .jpeg" />
                                                    <label for="imageUpload">
                                                        <span class="material-symbols-outlined">edit</span>
                                                    </label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview" style="background-image: url('{{asset(auth()->user()->profile_image)}}');">
                                                    </div>
                                                </div>
                                            </div>
{{--                                            <h1 class="text-center font-weight-bold my-4">{{auth()->user()->name}}</h1>--}}
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                {{--                                        <div class="col-md-12 mb-3">--}}
                                                {{--                                            <h3>Edit your account information</h3>--}}
                                                {{--                                        </div>--}}
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" value="{{auth()->user()->name ?: ''}}" name="name" class="form-control" placeholder="First Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" value="{{auth()->user()->email ?: ''}}" name="email" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                                {{--                                        <div class="col-md-6">--}}
                                                {{--                                            <div class="form-group">--}}
                                                {{--                                                <label>Contact No.</label>--}}
                                                {{--                                                <input type="text" value="{{auth()->user()->contact_no ?: ''}}" name="contact_no" class="form-control" placeholder="Contact No.">--}}
                                                {{--                                            </div>--}}
                                                {{--                                        </div>--}}
                                                {{--                                        <div class="col-md-6">--}}
                                                {{--                                            <div class="form-group">--}}
                                                {{--                                                <label>CNIC No.</label>--}}
                                                {{--                                                <input type="text" value="{{auth()->user()->nic ?: ''}}" name="nic" class="form-control" placeholder="CNIC No.">--}}
                                                {{--                                            </div>--}}
                                                {{--                                        </div>--}}
                                            </div>
                                        </div>

                                            <div class="col-md-12 text-right">
                                                <button type="submit" class="btn btn-primary">UPDATE</button>
                                            </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                        <div style="display: none" class="box-2 tab-content card">
                            <div class="container p-5">
                                @include('management.theme.includes.error_success')
                                <form class="form-l" id="subm" data-reset="true" method="post" action="{{route('updatePassword',auth()->user()->id)}}">
                                    @csrf
                                    @method('PUT')
{{--                                    <input type="hidden" id="url" value="{{ url('profile-settings') }}"/>--}}

                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <h2>Edit your password</h2>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Old Password</label>
                                                <input type="text" name="old_password" class="form-control" placeholder="Old Password">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="text" name="new_password" class="form-control" placeholder="New Password">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Confirmed New Password</label>
                                                <input type="text" name="confirm_password" class="form-control" placeholder="Confirmed New Password">
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div style="display: none" class="box-3 tab-content">
                            <div class="prfoilesetting-header">
                                <img class="cover-ph" src="assets/images/cover.png">
                                <div class="but-abs">
                                    <a href="#" class="btn-uploadcover"><span class="material-symbols-outlined">photo_camera</span> Upload Cover</a>
                                </div>
                                <div class="profile-abs">
                                    <div class="pfp-set">
                                        <img src="assets/images/profile.png">
                                        <a href="#" class="edit-profile"><span class="material-symbols-outlined">edit</span></a>
                                    </div>
                                    <h1>Alexander Pierce</h1>
                                </div>
                            </div>
                            <div class="profile-form">







                                <form class="form-l">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>Edit your Security</h3>
                                            <h5>Protect your account with 2-Step Verification</h5>
                                        </div>
                                        <div class="col-md-12 mb">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="a" checked> Authentication App
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="a" checked> Authentication Email
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Let’s Set up your Email</label>
                                                <h6>What email do you want to use?</h6>
                                                <input type="text" class="form-control" placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <a href="#" class="btn btn-primary">Save</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div style="display: none" class="box-4 tab-content ">
                            <div class="card">
                                <div class="body">
                                    <div class="profile-form">

                                        @php
                                            use App\Models\User;
                                            use Carbon\Carbon;
                                            $users_data = User::loginHistory();
                                        @endphp





                                        <form class="form-l">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3>Recent activity</h3>
                                                </div>
                                                <div class="col-md-12">
                                                    <table style="font-size: 12px" class="table tab-des login-history">
                                                        <thead>
                                                        <tr>
                                                            <th>Access Type <span>(Browser, Mobile, etc)</span></th>
                                                            <th>Location</th>
                                                            <th>Date/Time <span>(Displayed in your time zone)</span></th>
                                                        </tr>

                                                        </thead>
                                                        <tbody>
                                                        @if(isset($users_data->loginHistories))
                                                            @foreach ($users_data->loginHistories as $item)
                                                                <tr>
                                                                    <td><p>{{ $item->header}}</p></td>
                                                                    <td>{{ $item->location}}</td>
                                                                    @php
                                                                        $createdAt = Carbon::parse($item->created_at);
                                                                        $currentTime = Carbon::now();

                                                                        // Calculate the difference in seconds, minutes, or hours
                                                                        $differenceInSeconds = $createdAt->diffInSeconds($currentTime);
                                                                        $differenceInMinutes = $createdAt->diffInMinutes($currentTime);
                                                                        $differenceInHours = $createdAt->diffInHours($currentTime);

                                                                        // Format the timestamp as "h:i A" (e.g., 1:59 PM)
                                                                        $formattedTime = $createdAt->format('h:i A');

                                                                        // Display the result based on the actual difference
                                                                        $timeDifference = '';
                                                                        if ($differenceInHours > 0) {
                                                                            $timeDifference = $differenceInHours . ' hour' . ($differenceInHours > 1 ? 's' : '');
                                                                        } elseif ($differenceInMinutes > 0) {
                                                                            $timeDifference = $differenceInMinutes . ' minute' . ($differenceInMinutes > 1 ? 's' : '');
                                                                        } else {
                                                                            $timeDifference = $differenceInSeconds . ' second' . ($differenceInSeconds > 1 ? 's' : '');
                                                                        }
                                                                    @endphp

                                                                    <td>{{ $formattedTime }} ({{ $timeDifference }} ago)</td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Center Main content End -->
@endsection






{{--@extends('layouts.app')--}}


{{--@section('content')--}}
{{--    <div class="row">--}}
{{--        <div class="col-lg-12 margin-tb">--}}
{{--            <div class="pull-left">--}}
{{--                <h2>Users Management</h2>--}}
{{--            </div>--}}
{{--            <div class="pull-right">--}}
{{--                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}




{{--    {!! $data->render() !!}--}}


{{--@endsection--}}
<script>

    function previewImage(event) {
        var fileInput = event.target;
        var imagePreview = document.getElementById("account-upload-img");
        // Check if a file is selected
        if (fileInput.files.length > 0) {
            var file = fileInput.files[0];

            // Check if the selected file is an image
            if (file.type.startsWith("image/")) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    // Display the image preview
                    imagePreview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            } else {
                imagePreview.src = "#"; // Clear the image preview
            }
        } else {
            // Clear the image preview if no file is selected
            imagePreview.src = "#";
        }
    }
</script>
