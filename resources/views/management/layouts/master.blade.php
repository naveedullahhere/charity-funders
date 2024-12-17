@include('management/layouts/header')
@include('management/layouts/sidebar')
@include('management.theme.includes.modals')
<section class="content">
    @yield('content')
</section>
@include('management/layouts/footer')
@yield('scripts')