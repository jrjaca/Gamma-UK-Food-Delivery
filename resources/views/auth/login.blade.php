@extends('layouts.app')

@section('title')
    {{ $site_setting->main_title }} Food Delivery
@endsection

@push('css-bottom')
    <style>
        /*Main Top Center - main_head_topv_image_path*/
        .bg-image--11 {
            background-image: url({{ asset($site_setting->main_head_topv_image_path) }});
        }

        /*Main Middle - main_middle_image_path*/
        .bg-image--12 {
            background-image: url({{ asset($site_setting->main_middle_image_path) }});
        }
    </style>
@endpush

@section('content')

    <!-- Start Slider Area -->
    <div class="slider__area slider--three">
        <div class="slider__activation--1">
            <!-- Start Single Slide -->
            <div class="slide slider__fixed--height bg-image--11 poss--relative"> {{--main_head_topv_image_path--}}
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="slider__content">
                                <div class="slider__inner">
                                    {{--<h2>We Are,</h2>--}}
                                    <h5>“{{ $site_setting->main_title }}”</h5>
                                    <div class="slider__btn">
                                        {{--<a class="food__btn" href="#">Learn More</a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide__pizza--2 wow fadeInLeft" data-wow-delay="0.4s">
                    <img src="{{ $site_setting->main_head_top_left_image_path  }}" alt="pizza images" style="width: 915px; height: 958px;">
                </div>
                <div class="slide__pizza--3 wow fadeInRight" data-wow-delay="0.4s">
                    <img src="{{ $site_setting->main_head_bottom_right_image_path  }}" alt="pizza images" style="width: 1370px; height: 648px;">
                </div>
            </div>
            <!-- End Single Slide -->
        </div>
    </div>
    <!-- End Slider Area -->

    <section class="food__about__us__area section-padding--lg bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__title title__style--2 service__align--center">
                        <h4 class="title__line">
                            You have to login first.
                        </h4>
                        <p><a href="{{ route('index') }}">BACK TO MAIN PAGE</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script-bottom')
    <script type="text/javascript">
        $( document ).ready(function() {
            $("#login_register_modal_div").trigger("click");
        });
    </script>
@endpush
