
    @stack('css')
    <!-- spinner/waiting -->
        <!-- Core stylesheet -->
        <link rel="stylesheet" href="{{ asset('spinner') }}/css/modal-loading.css">
        <!-- CSS3 animations -->
        <link rel="stylesheet" href="{{ asset('spinner') }}/css/modal-loading-animate.css">
    <!-- /spinner/waiting -->

    <!-- Toastr Notification css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/libs/toastr/build/toastr.min.css">
    {{--<!-- chart -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">--}}

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/plugins.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/style.css">

    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/custom.css">

    @stack('css-bottom')

    <!-- Modernizer js -->
    <script src="{{ asset('frontend') }}/js/vendor/modernizr-3.5.0.min.js"></script>
