<!DOCTYPE html>
<html lang="en">

    <head>
        @php
            //for footer form
            $site_setting = App\Helpers\TraitMyFunctions::getSiteSettings();
        @endphp

        <meta charset="utf-8" />
        <title> Admin Page || @yield('title') </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        @yield('meta')

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset($site_setting->logo_path) }}">
        @include('backend.layouts.header-css')
    </head>

    {{--@section('body')
    @show--}}

    <body data-sidebar="dark">

        {{--<div id="preloader">
            <div id="status">
                <div class="spinner-chase">
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                </div>
            </div>
        </div>--}}

        <!-- Begin page layout wrapper -->
        <div id="layout-wrapper">

            <!-- ========== Top Bar ========== -->
            @include('backend.layouts.topbar')
            <!-- ========== /Top Bar ========== -->

            <!-- ========== Left Sidebar ========== -->
            @include('backend.layouts.sidebar-left')
            <!-- ========== /Left Sidebar ========== -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <!-- /ain content-->
            <div class="main-content">
                <!-- Page-content -->
                <div class="page-content">
                    <!-- container-fluid -->
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!-- /container-fluid -->
                </div>
                <!-- /Page-content -->

                <!-- Modal -->
                @include('backend.layouts.modal')
                <!--/Modal -->

                <!-- footer -->
                @include('backend.layouts.footer')
                <!-- /footer -->
            </div>
            <!-- /main content-->

        </div>
        <!-- /Begin page layout wrapper -->

        <!-- Sidebar Right-->
        @include('backend.layouts.sidebar-right')
        <!-- /Sidebar Right -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        @include('backend.layouts.footer-script')
    </body>

</html>
