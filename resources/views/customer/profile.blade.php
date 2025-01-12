@extends('customer.layouts.master')
@section('title')
    My Account
@endsection
@section('content')

    <div class="cont">
        <div class="mb-4">
            <h1 class="mb-0 h3">Hey, {{auth()->user()->name}}! Welcome to {{config('app.name')}}.</h1>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-lg-5">
                <div class="mb-5">
                    <h4 class="mb-1">Account Information</h4>
{{--                    <p class="mb-0 fs-6">Edit your personal information and address.</p>--}}
                </div>
                <form class="row g-3 needs-validation" novalidate>
                    <div class="col-lg-12 col-md-12">
                        <label for="profileFirstNameInput" class="form-label">Name</label>
                        <input type="text" class="form-control" id="profileFirstNameInput" value="{{auth()->user()->name}}" required />
                        <div class="invalid-feedback">Please enter name.</div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <label for="profileLastNameInput" class="form-label">Email</label>
                        <input type="text" class="form-control" id="profileLastNameInput"  value="{{auth()->user()->email}}" required />
                        <div class="invalid-feedback" >Please enter email.</div>
                    </div>
{{--                    <div class="col-lg-12">--}}
{{--                        <label for="profilePhoneInput" class="form-label">Phone</label>--}}
{{--                        <input type="text" class="form-control input-phone" id="profilePhoneInput" placeholder="+1 4XX XXX XXXX" required />--}}
{{--                        <div class="invalid-feedback">Please enter phone.</div>--}}
{{--                    </div>--}}

{{--                    <div class="col-12 mt-4">--}}
{{--                        <button class="btn btn-primary me-2" type="submit">Save Changes</button>--}}
{{--                    </div>--}}
                </form>
            </div>
        </div>
    </div>
@endsection


