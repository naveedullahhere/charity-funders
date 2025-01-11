<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>@yield('title') - {{ config('app.name') }}</title>
    <!-- Favicon-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- Plugins Core Css -->
    <link href="{{ asset('management/css/app.min.css') }}" rel="stylesheet">
    <!-- Custom Css -->
    <!-- Theme style. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('management/css/styles/all-themes.css') }}" rel="stylesheet" />
    <link href="{{ asset('management/css/style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

    <link href="{{ asset('management/css/form.min.css') }}" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />
    <link
        href="https://cdn.jsdelivr.net/npm/filepond-plugin-media-preview@1.0.11/dist/filepond-plugin-media-preview.css"
        rel="stylesheet" />

    <!-- FilePond JS -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-media-preview@1.0.11/dist/filepond-plugin-media-preview.js">
    </script>
    <script>
        FilePond.registerPlugin(
            FilePondPluginFileEncode,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview
        );

        let uploadedFileIds = [];
    </script>
</head>
<style>
    .fw-900 {
        font-weight: 900 !important;
    }

    .text-signature {
        color: #E8BC50;
    }

    .bg-signature {
        background: #E8BC50;
    }
</style>

<body class="light">
    <div style="display: none;" class="loader-container" id="loader-container">
        <div class="spinner-border " role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="overlay"></div>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" onClick="return false;" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="#" onClick="return false;" class="bars"></a>
                <a class="navbar-brand" href="/">
                    <img height="35px" src="{{ asset('/management/images/ajp-logo.png') }}"
                        alt="{{ config('app.dashboard') }}" />
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="pull-left">
                    <li>
                        <a href="#" onClick="return false;" class="sidemenu-collapse">
                            <i class="fas fa-align-justify"></i> </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" onclick="return false;" class="dropdown-toggle" data-bs-toggle="dropdown"
                            role="button" aria-expanded="false">
                            <i class="far fa-bell"></i>
                            <span class="label-count bg-orange"></span>
                        </a>
                        <ul class="dropdown-menu pullDown">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <div class="slimScrollDiv"
                                    style="position: relative; overflow: hidden; width: auto; height: 254px;">
                                    <ul class="menu" style="overflow: hidden; width: auto; height: 254px;">
                                        <li>
                                            <a href="#" onclick="return false;">
                                                <span class="table-img msg-user">
                                                    <img src="assets/images/user/user1.jpg" alt="">
                                                </span>
                                                <span class="menu-info">
                                                    <span class="menu-title">Sarah Smith</span>
                                                    <span class="menu-desc">
                                                        <i class="material-icons">access_time</i> 14 mins ago
                                                    </span>
                                                    <span class="menu-desc">Please check your email.</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="return false;">
                                                <span class="table-img msg-user">
                                                    <img src="assets/images/user/user2.jpg" alt="">
                                                </span>
                                                <span class="menu-info">
                                                    <span class="menu-title">Airi Satou</span>
                                                    <span class="menu-desc">
                                                        <i class="material-icons">access_time</i> 22 mins ago
                                                    </span>
                                                    <span class="menu-desc">Please check your email.</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="return false;">
                                                <span class="table-img msg-user">
                                                    <img src="assets/images/user/user3.jpg" alt="">
                                                </span>
                                                <span class="menu-info">
                                                    <span class="menu-title">John Doe</span>
                                                    <span class="menu-desc">
                                                        <i class="material-icons">access_time</i> 3 hours ago
                                                    </span>
                                                    <span class="menu-desc">Please check your email.</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="return false;">
                                                <span class="table-img msg-user">
                                                    <img src="assets/images/user/user4.jpg" alt="">
                                                </span>
                                                <span class="menu-info">
                                                    <span class="menu-title">Ashton Cox</span>
                                                    <span class="menu-desc">
                                                        <i class="material-icons">access_time</i> 2 hours ago
                                                    </span>
                                                    <span class="menu-desc">Please check your email.</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="return false;">
                                                <span class="table-img msg-user">
                                                    <img src="assets/images/user/user5.jpg" alt="">
                                                </span>
                                                <span class="menu-info">
                                                    <span class="menu-title">Cara Stevens</span>
                                                    <span class="menu-desc">
                                                        <i class="material-icons">access_time</i> 4 hours ago
                                                    </span>
                                                    <span class="menu-desc">Please check your email.</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="return false;">
                                                <span class="table-img msg-user">
                                                    <img src="assets/images/user/user6.jpg" alt="">
                                                </span>
                                                <span class="menu-info">
                                                    <span class="menu-title">Charde Marshall</span>
                                                    <span class="menu-desc">
                                                        <i class="material-icons">access_time</i> 3 hours ago
                                                    </span>
                                                    <span class="menu-desc">Please check your email.</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="return false;">
                                                <span class="table-img msg-user">
                                                    <img src="assets/images/user/user7.jpg" alt="">
                                                </span>
                                                <span class="menu-info">
                                                    <span class="menu-title">John Doe</span>
                                                    <span class="menu-desc">
                                                        <i class="material-icons">access_time</i> Yesterday
                                                    </span>
                                                    <span class="menu-desc">Please check your email.</span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="slimScrollBar"
                                        style="background: rgba(0, 0, 0, 0.5); width: 4px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 0px; z-index: 99; right: 1px;">
                                    </div>
                                    <div class="slimScrollRail"
                                        style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                                    </div>
                                </div>
                            </li>
                            <li class="footer">
                                <a href="#" onclick="return false;">View All Notifications</a>
                            </li>
                        </ul>
                    </li>


                    <li class="dropdown user_profile py-2 mt-1 mx-4">
                        <a href="#" onclick="return false;"
                            class="dropdown-toggle d-flex align-items-center  m-0 p-0 " data-bs-toggle="dropdown"
                            role="button">
                            <img src="{{ asset(auth()->user()->profile_image) }}" width="32" height="32"
                                alt="User">
                            <div class="ml-2">
                                {{ auth()->user()->name }}
                                <small class="d-block">{{ auth()->user()->getRoleNames()->first() }}</small>
                            </div>
                        </a>
                        <ul class="dropdown-menu pullDown">
                            <li class="body">
                                <ul class="user_dw_menu">
                                    <li>
                                        <a href="{{ route('profile-settings.index') }}">
                                            <i class="material-icons">person</i>Profile Settings
                                        </a>
                                    </li>
                                    {{--                                    <li> --}}
                                    {{--                                        <a href="#" onclick="return false;"> --}}
                                    {{--                                            <i class="material-icons">feedback</i>Feedback --}}
                                    {{--                                        </a> --}}
                                    {{--                                    </li> --}}
                                    {{--                                    <li> --}}
                                    {{--                                        <a href="#" onclick="return false;"> --}}
                                    {{--                                            <i class="material-icons">help</i>Help --}}
                                    {{--                                        </a> --}}
                                    {{--                                    </li> --}}
                                    <li>
                                        <form class="m-0" method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="#"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i
                                                    class="material-icons">power_settings_new</i><span>{{ __('Logout') }}</span>
                                            </a>
                                        </form>


                                        {{--                                        <a href="#" onclick="return false;"> --}}
                                        {{--                                            <i class="material-icons">power_settings_new</i>Logout --}}
                                        {{--                                        </a> --}}
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
