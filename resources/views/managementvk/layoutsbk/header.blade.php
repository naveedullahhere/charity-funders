<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{config('app.name')}}</title>
    <link rel="stylesheet" href="{{asset('assets/css/layout.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/icons.css')}}">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
</head>
<body>
<div style="display: none;" class="loader-container" id="loader-container">
    <div class="spinner-border " role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<div class="right-section">
    <div class="row align-items-center head-topp">
        <div class="col-md-8">
            <div class="search-bar-container active">
                <img src="https://cdn4.iconfinder.com/data/icons/evil-icons-user-interface/64/magnifier-512.png" alt="magnifier"
                     class="magnifier" />
                <input type="text" class="input" placeholder="Search ..." />
                <img src="https://cdn1.iconfinder.com/data/icons/google-s-logo/150/Google_Icons-25-512.png" alt="mic-icon"
                     class="mic-icon" />
            </div>
        </div>
        <div class="col-md-2">
            <div class="clock">
                <p class="x"></p>
            </div>
        </div>
        <div class="col-md-2 text-right">
            <ul class="header-last-content">
                <li>
                    <a data-toggle="tooltip" data-placement="bottom" title="Task Inbox" href="{{url('task-inbox')}}">
                        <span class="material-symbols-outlined">calendar_month</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="material-symbols-outlined">notifications</span>
                    </a>
                </li>
                <li>
                    <label class="dropdown">
                        <div class="dd-button">
                            <img src="{{asset(auth()->user()->profile_image)}}">
                        </div>
                        <input type="checkbox" class="dd-input" id="test">
                        <ul class="dd-menu head-drp">
                            <div class="text-center">
                                <img style="width: 75px;" src="{{asset(auth()->user()->profile_image)}}">
                                <h3>{{auth()->user()->name}}</h3>
                                <h4>{{auth()->user()->roles()->first()->name}}</h4>
                            </div>
                            <div class="mar-tb text-center">
                                <a href="{{url('profile-settings')}}" class="btn-header"><span class="material-symbols-outlined">settings</span> Settings</a>
                                <a href="#" class="btn-header"><span class="material-symbols-outlined">brightness_4</span> Themes</a>
                            </div>
                            <div class="text-center">
                                <a class="btn-theme-black btn-block" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </ul>
                    </label>
                </li>
            </ul>
        </div>
    </div>
    @yield('content')
</div>
