@extends('layouts.app')

@section('title')
    {{ $site_setting->main_title }} Food Delivery || Service Page
@endsection

@push('css-bottom')
    <style>
        /*Pages Service Top Center - pages_service_head_top_image_path*/
        .bg-image--19 {
            background-image: url({{ asset($site_setting->pages_service_head_top_image_path) }});
        }
    </style>
@endpush

@section('content')

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--19">
        <div class="ht__bradcaump__wrap d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="bradcaump__inner text-center brad__white">
                            <h2 class="bradcaump-title">service</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('index') }}">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
                                <span class="breadcrumb-item active">service</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Service Area -->
    <section class="food__service bg--white section-padding--lg">
        <div class="container service__container">
            <div class="row">
                <!-- Start Single Service -->
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="service--2">
                        <div class="service__inner">
                            <div class="service__content">
                                <h2><a href="service-details.html">fast delivery</a></h2>
                                <div class="ser__icon">
                                    <img src="images/shape/service/1.png" alt="icon images">
                                </div>
                            </div>
                            <div class="service__hover__action d-flex align-items-center">
                                <div class="service__hover__inner">
                                    <h4><a href="service-details.html">fast delivery</a></h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna Ut eniad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                                    <ul>
                                        <li><a href="#">1.Low cost Shipping</a></li>
                                        <li><a href="#">2.On time delivery</a></li>
                                        <li><a href="#">3.Transport : Container Van / By cycle / Others</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Single Service -->
                <!-- Start Single Service -->
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="service--2">
                        <div class="service__inner">
                            <div class="service__content">
                                <h2><a href="service-details.html">quality food</a></h2>
                                <div class="ser__icon">
                                    <img src="images/shape/service/3.png" alt="icon images">
                                </div>
                            </div>
                            <div class="service__hover__action d-flex align-items-center">
                                <div class="service__hover__inner">
                                    <h4><a href="service-details.html">quality food</a></h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna Ut eniad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                                    <ul>
                                        <li><a href="#">1.Low cost Shipping</a></li>
                                        <li><a href="#">2.On time delivery</a></li>
                                        <li><a href="#">3.Transport : Container Van / By cycle / Others</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Single Service -->
                <!-- Start Single Service -->
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="service--2">
                        <div class="service__inner">
                            <div class="service__content">
                                <h2><a href="service-details.html">various menu</a></h2>
                                <div class="ser__icon">
                                    <img src="images/shape/service/4.png" alt="icon images">
                                </div>
                            </div>
                            <div class="service__hover__action d-flex align-items-center">
                                <div class="service__hover__inner">
                                    <h4><a href="service-details.html">various menu</a></h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna Ut eniad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                                    <ul>
                                        <li><a href="#">1.Low cost Shipping</a></li>
                                        <li><a href="#">2.On time delivery</a></li>
                                        <li><a href="#">3.Transport : Container Van / By cycle / Others</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Single Service -->
                <!-- Start Single Service -->
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="service--2">
                        <div class="service__inner">
                            <div class="service__content">
                                <h2><a href="service-details.html">well service</a></h2>
                                <div class="ser__icon">
                                    <img src="images/shape/service/4.png" alt="icon images">
                                </div>
                            </div>
                            <div class="service__hover__action d-flex align-items-center">
                                <div class="service__hover__inner">
                                    <h4><a href="service-details.html">well service</a></h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna Ut eniad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                                    <ul>
                                        <li><a href="#">1.Low cost Shipping</a></li>
                                        <li><a href="#">2.On time delivery</a></li>
                                        <li><a href="#">3.Transport : Container Van / By cycle / Others</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Single Service -->
            </div>
        </div>
    </section>
    <!-- End Service Area -->

@endsection
