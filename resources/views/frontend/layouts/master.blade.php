
@include('frontend/layouts/header')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Add this to the <head> section of your layout -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<section class="wrapper main-content">
    @yield('content')
</section>

<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right", // You can change this to top-left, bottom-right, etc.
        "timeOut": "5000", // Duration in milliseconds
    };
</script>

<!-- Add this script block in your layout (e.g., app.blade.php) -->
<script>
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>

{{-- @include('frontend.extra.reviews') --}}
@include('frontend/layouts/footer')