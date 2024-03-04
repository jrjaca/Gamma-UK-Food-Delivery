@extends('layouts.app')

@section('title')
    {{ $site_setting->main_title }} Food Delivery || Contact
@endsection

@push('css-bottom')
    <style>
        /*Contact Top Center - contact_head_top_image_path*/
        .bg-image--24 {
            background-image: url({{ asset($site_setting->contact_head_top_image_path) }});
        }
    </style>
@endpush

@section('content')

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--24">
        <div class="ht__bradcaump__wrap d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="bradcaump__inner text-center brad__white">
                            <h2 class="bradcaump-title">contact us</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('index') }}">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
                                <span class="breadcrumb-item active">contact us</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Contact Map -->
    <div class="contact__map__area" style="margin-bottom: 50px;">
        <div class="contact__map__wrapper d-flex flex-wrap">
            <div class="contact__map__left">
                <div class="map__thumb">
                    <img src="{{ asset($site_setting->contact_middle_left_image_path) }}" alt="images" style="width: 770px; height: 500px">
                </div>
            </div>
            {{--<div class="contact__map__right">
                <div class="htc__google__map">
                    <div class="map-contacts">
                        <div id="googlemap"></div>
                    </div>
                </div>
            </div>--}}

            <div class="col-lg-5" style="text-align: center" style="margin-top: 40px;">
                <div class="contact__form__wrap">
                    <h2>Get In Touch With {{ $site_setting->main_title }}</h2>
                    <div class="contact__form__inner">
                        <form action="{{ route('contact.send') }}" method="POST"><!--id="contact-form"-->
                            @csrf
                            <div class="single-contact-form">
                                <div class="contact-box name d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                                    <input type="text" name="name" placeholder="Your Name*" required autofocus>
                                    <input type="email" name="email" placeholder="E-mail*" required>
                                    <input type="text" name="phone" placeholder="Phone">
                                </div>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box message">
                                    <textarea name="message" placeholder="Message*" required></textarea>
                                </div>
                            </div>
                            <div class="contact-btn">
                                <button type="submit" class="food__btn">submit</button>
                            </div>
                        </form>
                    </div>
                    {{--<div class="form-output">
                        <p class="form-messege"></p>
                    </div>--}}
                </div>
            </div>


        </div>
    </div>
    <!-- End Contact Map -->
    {{--<!-- Start Address -->
    <div class="food__contact">
        <div class="food__contact__wrapper d-flex flex-wrap flex-lg-nowrap">
            <!-- Start Single Contact -->
            <div class="contact">
                <div class="ct__icon">
                    <i class="zmdi zmdi-phone"></i>
                </div>
                <div class="ct__address">
                    <p><a href="#">+088 01673-453290</a></p>
                    <p><a href="#">+088 01773-458290</a></p>
                </div>
            </div>
            <!-- End Single Contact -->
            <!-- Start Single Contact -->
            <div class="contact">
                <div class="ct__icon">
                    <i class="zmdi zmdi-home"></i>
                </div>
                <div class="ct__address">
                    <p>Elizabeth Tower. 6th Floor <br> Medtown, New York</p>
                </div>
            </div>
            <!-- End Single Contact -->
            <!-- Start Single Contact -->
            <div class="contact">
                <div class="ct__icon">
                    <i class="zmdi zmdi-email"></i>
                </div>
                <div class="ct__address">
                    <p><a href="#">delivery@e-mail.com</a></p>
                    <p><a href="#">Aahar@e-mail.com</a></p>
                </div>
            </div>
            <!-- End Single Contact -->
        </div>
    </div>
    <!-- End Address -->--}}
    {{--<section class="food__contact__form bg--white section-padding--lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__wrap">
                        <h2>Get In Touch With Aahar</h2>
                        <div class="contact__form__inner">
                            <form id="contact-form" action="mail.php" method="post">
                                <div class="single-contact-form">
                                    <div class="contact-box name d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                                        <input type="text" name="name" placeholder="Your Name">
                                        <input type="email" name="email" placeholder="E-mail">
                                        <input type="text" name="phone" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="single-contact-form">
                                    <div class="contact-box message">
                                        <textarea name="message"  placeholder="Message*"></textarea>
                                    </div>
                                </div>
                                <div class="contact-btn">
                                    <button type="submit" class="food__btn">submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="form-output">
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}

@endsection
