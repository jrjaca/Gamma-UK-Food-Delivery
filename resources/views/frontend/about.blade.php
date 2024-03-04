@extends('layouts.app')

@section('title')
    {{ $site_setting->main_title }} Food Delivery
@endsection

@push('css-bottom')
    <style>
        /*Aboutus Top Center - about_head_top_image_path*/
        .bg-image--20 {
            background-image: url({{ asset($site_setting->about_head_top_image_path) }});
        }
    </style>
@endpush

@section('content')

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--20">
        <div class="ht__bradcaump__wrap d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="bradcaump__inner text-center brad__white">
                            <h2 class="bradcaump-title">about us</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('index') }}">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
                                <span class="breadcrumb-item active">about us</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start About Us Area  -->
    <section class="food__about__us__area section-padding--lg bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__title title__style--2 service__align--center">
                        <h2 class="title__line">{{ $site_setting->about_title }}</h2>
                        <p>{{ $site_setting->about_subtitle }} </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="choose__wrap text-center mt--50">
                        <p>{!! $site_setting->about_content !!}</p>
                    </div>
                </div>
            </div>
            {{--<div class="row mt--80">
                <div class="col-lg-6 col-sm-12 col-md-12 align-self-center">
                    <div class="food__container">
                        <div class="food__inner">
                            <h2>Watch Videos to Know more About Aahar</h2>
                            <p>Lorem ipsum dolor sit amsa vadip isicing elit, seddei han  liqua. Ut enim ad miveniam, quis noion ullam.</p>
                        </div>
                        <div class="food__details">
                            <p>Lorem ipliqua. Ut enim ad minim veniam, quis nostr</p>
                        </div>
                        <div class="food__tab">
                            <div class="food__nav nav nav-tabs d-block" role="tablist">
                                <a class="active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">1. History of Aahar (2000-2017)</a>

                                <a id="nav-prepare-tab" data-toggle="tab" href="#prepare" role="tab" aria-controls="prepare" aria-selected="false">2. How  We prepare your meals</a>

                                <a id="nav-meals-tab" data-toggle="tab" href="#meals" role="tab" aria-controls="meals" aria-selected="false">3. How  We prepare your meals</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-12">
                    <div class="food__video__wrap tab-content" id="nav-tabContent">
                        <!-- Start Single Video -->
                        <div class="video__owl__activation tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="about__video__activation owl-carousel owl-theme">
                                <div class="about__video__inner">
                                    <div class="about__video__thumb">
                                        <img src="images/about/video/1.jpg" alt="video images">
                                        <a class="video-play-button" href="https://www.youtube.com/watch?v=wJ9Ll8uD07I"><img src="images/icon/play.png" alt="viveo play icon"></a>
                                    </div>
                                    <div class="about__video__content">
                                        <span>1</span>
                                    </div>
                                </div>
                                <div class="about__video__inner">
                                    <div class="about__video__thumb">
                                        <img src="images/about/video/2.jpg" alt="video images">
                                        <a class="video-play-button" href="https://www.youtube.com/watch?v=wJ9Ll8uD07I"><img src="images/icon/play.png" alt="viveo play icon"></a>
                                    </div>
                                    <div class="about__video__content">
                                        <span>2</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Video -->
                        <!-- Start Single Video -->
                        <div class="video__owl__activation tab-pane fade" id="prepare" role="tabpanel" aria-labelledby="nav-prepare-tab">
                            <div class="about__video__activation owl-carousel owl-theme">
                                <div class="about__video__inner">
                                    <div class="about__video__thumb">
                                        <img src="images/about/video/2.jpg" alt="video images">
                                        <a class="video-play-button" href="https://www.youtube.com/watch?v=wJ9Ll8uD07I"><img src="images/icon/play.png" alt="viveo play icon"></a>
                                    </div>
                                    <div class="about__video__content">
                                        <span>1</span>
                                    </div>
                                </div>
                                <div class="about__video__inner">
                                    <div class="about__video__thumb">
                                        <img src="images/about/video/3.jpg" alt="video images">
                                        <a class="video-play-button" href="https://www.youtube.com/watch?v=wJ9Ll8uD07I"><img src="images/icon/play.png" alt="viveo play icon"></a>
                                    </div>
                                    <div class="about__video__content">
                                        <span>2</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Video -->
                        <!-- Start Single Video -->
                        <div class="video__owl__activation tab-pane fade" id="meals" role="tabpanel" aria-labelledby="nav-meals-tab">
                            <div class="about__video__activation owl-carousel owl-theme">
                                <div class="about__video__inner">
                                    <div class="about__video__thumb">
                                        <img src="images/about/video/3.jpg" alt="video images">
                                        <a class="video-play-button" href="https://www.youtube.com/watch?v=wJ9Ll8uD07I"><img src="images/icon/play.png" alt="viveo play icon"></a>
                                    </div>
                                    <div class="about__video__content">
                                        <span>1</span>
                                    </div>
                                </div>
                                <div class="about__video__inner">
                                    <div class="about__video__thumb">
                                        <img src="images/about/video/1.jpg" alt="video images">
                                        <a class="video-play-button" href="https://www.youtube.com/watch?v=wJ9Ll8uD07I"><img src="images/icon/play.png" alt="viveo play icon"></a>
                                    </div>
                                    <div class="about__video__content">
                                        <span>2</span>
                                    </div>
                                </div>
                                <div class="about__video__inner">
                                    <div class="about__video__thumb">
                                        <img src="images/about/video/2.jpg" alt="video images">
                                        <a class="video-play-button" href="https://www.youtube.com/watch?v=wJ9Ll8uD07I"><img src="images/icon/play.png" alt="viveo play icon"></a>
                                    </div>
                                    <div class="about__video__content">
                                        <span>2</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Video -->
                    </div>
                </div>
            </div>--}}
        </div>
    </section>
    <!-- End About Us Area  -->

@endsection
