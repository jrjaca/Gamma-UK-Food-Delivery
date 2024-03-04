
    <!-- From other page Css -->
    @stack('css')
    <!-- Sweet Alert-->
        <link href="{{ asset('backend') }}/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- Toastr Notification css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/libs/toastr/build/toastr.min.css">

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend') }}/css/bootstrap-dark.min.css" id="bootstrap-dark" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/css/bootstrap.min.css" id="bootstrap-light" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="{{ asset('backend') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/css/app-rtl.min.css" id="app-rtl" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/css/app-dark.min.css" id="app-dark" rel="stylesheet" type="text/css" />

    <!-- App Css-->
    <link href="{{ asset('backend') }}/css/app.min.css" id="app-light" rel="stylesheet" type="text/css" />

    {{--
    <!-- Bootstrap Css -->
    --}}
    {{--<link href="{{ asset('backend') }}/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />--}}{{--

    <link href="{{ asset('backend') }}/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend') }}/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />--}}

    @stack('css-bottom')
