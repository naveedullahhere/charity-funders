@extends('customer.layouts.master')
@section('title')
    Change Password
@endsection
@section('content')
    <div class="cont">
    
        <form class="form-l" id="subm" method="post" action="{{route('updatePassword',auth()->user()->id)}}">
            @csrf
            @method('PUT')
            <div class="card border-0 mb-4 shadow-sm">
                <div class="card-body p-lg-5">
                    <div class="mb-4">
                        <h4 class="mb-1">Change Password</h4>
                        {{-- <p class="mb-0 fs-6">We will email you a confirmation when changing your password, so please expect that email after submitting.</p> --}}
                    </div>
                    <form class="row gy-3 needs-validation" novalidate>
                        <div class="col-lg-7">
                            <label for="securityOldPasswordInput" class="form-label">Old Password</label>
                            <input type="password"  name="old_password"  class="form-control" id="securityOldPasswordInput"  />
{{--                            <div class="invalid-feedback">Please enter old password.</div>--}}
                        </div>

                        <div class="col-lg-7">
                            <label for="securityNewPasswordInput" class="form-label">New Password</label>
                            <input type="password"  name="new_password"  class="form-control" id="securityNewPasswordInput"  />
{{--                            <div class="invalid-feedback">Please enter new password.</div>--}}
                            <div class="form-text">Make sure it's at least 15 characters OR at least 8 characters including a number and a lowercase letter. Learn more.</div>
                        </div>

                        <div class="col-lg-7">
                            <label for="securityConfirmPasswordInput" class="form-label">Confirm New Password</label>
                            <input type="password" name="confirm_password"  class="form-control" id="securityConfirmPasswordInput"  />
{{--                            <div class="invalid-feedback">Please enter confirm password.</div>--}}
                            <div class="form-text">Make sure match with above new password</div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-dark my-3 me-2" type="submit">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </form>
    </div>
@endsection


