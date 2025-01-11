@include('management/layouts/header')
<div class="main-panel">
    <div class="wrapper">
            @include('management/layouts/navigation')
        <!-- BEGIN : Main Content-->
        <div class="main-content py-4">
            <div class="content-overlay"></div>
            @yield('content')
        </div>
    </div>
</div>
@include('management/layouts/footer')

@yield('scripts')
@include('management/layouts/modals')
