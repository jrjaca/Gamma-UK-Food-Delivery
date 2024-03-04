@extends('layouts.app')

@section('title')
    {{ $site_setting->main_title }} Food Delivery
@endsection

@push('css-bottom')
    <style>
        /*Main Top Center - main_head_topv_image_path*/
        .bg-image--11 {
            background-image: url({{ asset($site_setting->main_head_topv_image_path) }});
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
        }

        /*Main Middle - main_middle_image_path*/
        .bg-image--12 {
            background-image: url({{ asset($site_setting->main_middle_image_path) }});
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
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
                                    <h1>“{{ $site_setting->main_title }}”</h1>
                                    <div class="slider__btn">
                                        {{--<a class="food__btn" href="#">Learn More</a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide__pizza--2 wow fadeInLeft" data-wow-delay="0.4s">
                    <img src="{{ asset($site_setting->main_head_top_left_image_path)  }}" alt="pizza images" style="width: 915px; height: 958px;">
                </div>
                <div class="slide__pizza--3 wow fadeInRight" data-wow-delay="0.4s">
                    <img src="{{ asset($site_setting->main_head_bottom_right_image_path)  }}" alt="pizza images" style="width: 1370px; height: 648px;">
                </div>
            </div>
            <!-- End Single Slide -->
        </div>
    </div>
    <!-- End Slider Area -->

    <!-- Start Feature Area -->
    <section class="food__feature__area section-padding--lg bg--white">
        <div class="container">
{{--{{dd($food_types_welcome)}}--}}

            <div class="row">

                {{--@if($key == 0 || $key == 3)--}}  {{--break after 3 items  --}}
                <div class="row mt--30">
                {{--@endif--}}
                    @foreach($food_types_welcome as $key => $row)
                        <!-- Start Single Feature -->
                        <div class="col-md-6 col-lg-4 col-sm-12">{{--col-md-6 col-lg-4 col-sm-12 sm--mt--40  /  col-md-6 col-lg-4 col-sm-12 sm--mt--40 md--mt--40--}}
                            <div class="square">
                                <div class="feature text-center">
                                    <div class="feature__thumb">
                                        <a href="{{ url('food-type/'.$row->id) }}">
                                            <img src="{{ asset($row->image_path) }}" alt="feature images" style="width: 85%; height: 100%;">{{--style="width: 172px; height: 199px;"   style="width: 280px; height: 200px;"--}}
                                        </a>
                                    </div>
                                    <div class="feature__details">
                                        <h4><a href="{{ url('food-type/'.$row->id) }}">{{ $row->name }}</a></h4>
                                        {{--<h6>All types of Bread Iteam are available</h6>--}}
                                        <p>{!! str_limit($row->description, $limit=150) !!}</p>
                                    </div>
                                </div><br/>
                            </div>
                        </div>
                    @endforeach
                    <!-- End Single Feature -->
                {{--@if($key == 2 || $key == 5)--}}  {{--break after 3 items  --}}
                </div>
                {{--@endif--}}

            </div>
            <br/>
            {{ $food_types_welcome->links() }}

        </div>
    </section>
    <!-- End Feature Area -->

    <!-- Start Choose us Area OLD LOCATION-->

    <!-- End Choose us Area OLD LOCATION-->

    <!-- Start Special Offer -->
    {{--<section class="food__special__offer bg--white section-padding--lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="section__title title__style--2 service__align--center">
                        <h2 class="title__line">Our Special Offer</h2>
                        <p>The process of our service </p>
                    </div>
                </div>
            </div>
            <div class="row mt--40">
                <!-- Start Single Offer -->
                <div class="col-md-6 col-sm-12 col-lg-3">
                    <div class="food__offer text-center foo">
                        <div class="offer__thumb poss--relative">
                            <img src="{{ asset('frontend') }}/images/product/offer-product/1.jpg" alt="offer images">
                            <div class="offer__product__prize">
                                <span>$25</span>
                            </div>
                        </div>
                        <div class="offer__details">
                            <h2><a href="menu-details.html">Pastry Combo Pack</a></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                            <div class="offer__btn">
                                <a class="food__btn grey--btn mid-height" href="menu-details.html">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Single Offer -->
                <!-- Start Single Offer -->
                <div class="col-md-6 col-sm-12 col-lg-3">
                    <div class="food__offer text-center foo">
                        <div class="offer__thumb poss--relative">
                            <img src="{{ asset('frontend') }}/images/product/offer-product/2.jpg" alt="offer images">
                            <div class="offer__product__prize">
                                <span>$25</span>
                            </div>
                        </div>
                        <div class="offer__details">
                            <h2><a href="menu-details.html">Mixed Fruits Pie</a></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                            <div class="offer__btn">
                                <a class="food__btn grey--btn mid-height" href="menu-details.html">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Single Offer -->
                <!-- Start Single Offer -->
                <div class="col-md-6 col-sm-12 col-lg-3">
                    <div class="food__offer text-center foo">
                        <div class="offer__thumb poss--relative">
                            <img src="{{ asset('frontend') }}/images/product/offer-product/3.jpg" alt="offer images">
                            <div class="offer__product__prize">
                                <span>$25</span>
                            </div>
                        </div>
                        <div class="offer__details">
                            <h2><a href="menu-details.html">Wheat Bread</a></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                            <div class="offer__btn">
                                <a class="food__btn grey--btn mid-height" href="menu-details.html">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Single Offer -->
                <!-- Start Single Offer -->
                <div class="col-md-6 col-sm-12 col-lg-3">
                    <div class="food__offer text-center foo">
                        <div class="offer__thumb poss--relative">
                            <img src="{{ asset('frontend') }}/images/product/offer-product/4.jpg" alt="offer images">
                            <div class="offer__product__prize">
                                <span>$25</span>
                            </div>
                        </div>
                        <div class="offer__details">
                            <h2><a href="menu-details.html">Wheat Bread</a></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
                            <div class="offer__btn">
                                <a class="food__btn grey--btn mid-height" href="menu-details.html">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Single Offer -->
            </div>
        </div>
        <!-- Start Banner Area -->
        <div class="banner__area mt--40">
            <div class="container">
                <div class="row">
                    <!-- Start Single Banner -->
                    <div class="col-md-6 col-lg-3 col-sm-12">
                        <div class="banner--2 foo">
                            <div class="banner__thumb">
                                <a href="#"><img src="{{ asset('frontend') }}/images/banner/bann-2/1.jpg" alt="banner images"></a>
                            </div>
                            <div class="banner__hover__action banner__left__bottom">
                                <div class="banner__hover__inner">
                                    <span>20%</span>
                                    <p>off for festival</p>
                                    <h2 class="coffee-text">off for festival</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Banner -->
                    <!-- Start Single Banner -->
                    <div class="col-md-6 col-lg-3 col-sm-12">
                        <div class="banner--2 foo">
                            <div class="banner__thumb">
                                <a href="#"><img src="{{ asset('frontend') }}/images/banner/bann-2/2.jpg" alt="banner images"></a>
                            </div>
                            <div class="banner__hover__action banner__left__top">
                                <div class="banner__hover__inner">
                                    <h4>colorful</h4>
                                    <h2 class="pink-text">donut’s</h2>
                                    <p>get it till the stock full</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Banner -->
                    <!-- Start Single Banner -->
                    <div class="col-md-12 col-lg-6 col-sm-12">
                        <div class="banner--2 foo">
                            <div class="banner__thumb">
                                <a href="#"><img src="{{ asset('frontend') }}/images/banner/bann-2/3.jpg" alt="banner images"></a>
                            </div>
                            <div class="banner__hover__action banner__right__bottom">
                                <div class="banner__hover__inner">
                                    <h4 class="vanilla">vanilla</h4>
                                    <h2 class="pink-text">MAFFIN</h2>
                                    <p>Lovely Food for Food lover</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Banner -->
                </div>
            </div>
        </div>
        <!-- End Banner Area -->
    </section>--}}
    <!-- End Special Offer -->
    <!-- Start Popular Food Area -->
    <section class="popular__food__area section-padding--lg bg-image--12">
        <div class="container">
            {{--<div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="section__title title__style--2 service__align--center section__bg__black">
                        <h2 class="title__line">--}}{{--Our Special Offer--}}{{--Main Offer</h2>
                        <p>The process of our service </p>
                    </div>
                </div>
            </div>--}}

            {{--{{dd($meals_welcome)}}--}}



                {{--@if($key == 0 || $key == 3 || $key == 6)--}}  {{--break after 3 items  --}}
               <div class="row mt--30">
                    @foreach($meals_welcome as $key => $row)
               {{-- @endif--}}
                        <!-- Start Single Popular Food -->
                        <div class="col-lg-4 col-md-6 col-sm-12 foo">
                            <div class="popular__food">
                                <div class="pp_food__thumb">
                                    <a href="{{ url('menu-details/'.$row->id) }}">
                                        <img src="{{ asset($row->image_path) }}" alt="popular food" style="width: 100%; height: 300px;">
                                    </a>
                                    <!--if new or hot, and no discount set as active-->
                                    <!--if with discount or tag_new or tag_hot set 'offer'-->
                                    <div class="pp__food__prize
                                        @if(($row->tag_new > 0 || $row->tag_hot > 0) && ($row->discounted_price <= 0 || $row->discounted_price == null))
                                            active
                                        @endif

                                        @if($row->discounted_price > 0 || $row->discounted_price != null || $row->tag_new > 0 || $row->tag_hot > 0)
                                            offer
                                        @endif
                                    ">
                                        <span class="new">
                                            @if($row->discounted_price > 0)
                                                Off
                                            @elseif($row->tag_new > 0)
                                                New
                                            @elseif($row->tag_hot > 0)
                                                Hot
                                            @endif
                                        </span>
                                        <span>
                                            £{{ $row->discounted_price > 0 ? $row->discounted_price : $row->regular_price }}
                                        </span>
                                    </div>
                                    {{--
                                     <div class="pp__food__prize active offer">
                                        <span class="new">new</span>
                                        <span>$50</span>
                                    </div>
                                    <div class="pp__food__prize offer">
                                        <span class="new">off</span>
                                        <span>$50</span>
                                    </div>
                                    <div class="pp__food__prize offer">
                                        <span class="new">hot</span>
                                        <span>$50</span>
                                    </div>
                                    <div class="pp__food__prize active">
                                        <span>$40</span>
                                    </div>
                                    <div class="pp__food__prize">
                                        <span>$40</span>
                                    </div>--}}
                                </div>
                                <div class="pp__food__inner">
                                    <div class="pp__fd__icon">
                                        <img src="{{ asset($row->food_type_icon) }}" alt="icon images">
                                    </div>
                                    <div class="pp__food__details">
                                        <h4><a href="{{ url('menu-details/'.$row->id) }}">{{ $row->name }}{{-- ({{ $row->food_type_name }})--}}</a></h4>
                                        {{--<h5><a href="menu-details.html">Food Type : ({{ $row->food_type_name }})</a></h5>--}}
                                       {{-- <ul class="rating">
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li class="rating__opasity"><i class="zmdi zmdi-star"></i></li>
                                        </ul>--}}
                                        <p>Delivery Time : {{ $row->delivery_time }}min, {{ $row->delivery_cost != null ? 'Delivery charge: £'.$row->delivery_cost : 'Free Delivery' }}</p>
                                        <div class="pp__food__bottom d-flex justify-content-between align-items-center">
                                            {{--<div class="pp__btn">
                                                <a class="food__btn btn--transparent btn__hover--theme btn__hover--theme"
                                                   id="{{ $row->id }}"
                                                   onclick="addToCart(this.id)"
                                                >Add to Cart</a> <!--href="#"-->
                                            </div>--}}

                                            <input type="hidden" readonly id="qty_new" value="1">
                                            <div class="pp__btn">
                                                <button class="food__btn btn--transparent btn__hover--theme btn__hover--theme"
                                                    id="{{ $row->id }}"
                                                    onclick="addToCart(this.id)"
                                                >Add to Cart</button>
                                            </div>
                                            {{--id="{{ $product->id }}" onclick="productCartView(this.id)"--}}
                                            {{--<ul class="pp__meta d-flex">
                                                <li><a href="#"><i class="zmdi zmdi-comment-outline"></i>03</a></li>
                                                <li><a href="#"><i class="zmdi zmdi-favorite-outline"></i>04</a></li>
                                            </ul>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- End Single Popular Food -->
               {{-- @if($key == 2 || $key == 5 || $key == 8)--}}  {{--break after 3 items  --}}
               </div>
               {{-- @endif--}}
            <br/>
            {{--<div class="row mt--30">--}}
                {{ $meals_welcome->links() }}
            {{--</div>--}}
        </div>
    </section>
    <!-- End Popular Food Area -->

    <!-- Start Choose us Area -->
    <section class="food__choose__us__area section-padding--lg bg__cat--4 poss--relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-lg-12">
                    <div class="section__title title__style--2 service__align--center">
                        <h2 class="title__line">{{ $site_setting->about_title }}</h2>
                        <p>{{ $site_setting->about_subtitle }} </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="choose__wrap text-center mt--50">
                        <p>{!! str_limit($site_setting->about_content, $limit=150) !!}</p>
                        {{--<ul class="fd__choose__list d-flex justify-content-center">
                            <li>1. Ontime Delivery</li>
                            <li>2. Free Delivery Cost</li>
                            <li>3. Best Quality Food</li>
                        </ul>
                        <p>t voluptatem accusantium doloremque laudantium, totaeaque ipsa quae ab illo
                            inventore veritarchibeatae vitae dicta
                            sunt explicabo.  voluptat evoluptas sit aspernatur aut odit aut fugit,
                            seconsequumagni dolores eosvolupadipisci velit,
                            sed quia non numquam eius modi tempora incidunt ut labore.</p>--}}
                        <div class="chooseus__btn">
                            <a class="food__btn" href="{{ route('about') }}">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="choose__img--1 wow fadeInRight" data-wow-delay="0.2s">
            {{--<img src="{{ asset($site_setting->ychose_below_right_image_path) }}" alt="banner images" style="width: 451px; height: 645px;">--}}
            <img src="{{ asset($site_setting->ychose_below_right_image_path) }}" alt="banner images">
        </div>
        <div class="choose__img--2 wow fadeInLeft" data-wow-delay="0.3s">
            {{--<img src="{{ asset($site_setting->ychose_below_left_image_path) }}" alt="banner images" style="width: 406px; height: 411px;">--}}
            <img src="{{ asset($site_setting->ychose_below_left_image_path) }}" alt="banner images">
        </div>
    </section>
    <!-- End Choose us Area -->
{{--{{ dd(Cart::content()) }}--}}
    {{--<!-- Start Subscribe Area -->
    <section class="fd__subscribe__wrapper bg__cat--6 poss--relative">
        <div class="fd__subscribe__area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="subscribe__inner subscribe--3">
                            <h2>Subscribe to our newsletter</h2>
                            <div id="mc_embed_signup">
                                <div id="enter__email__address">
                                    <form action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                        <div id="mc_embed_signup_scroll" class="htc__news__inner">
                                            <div class="news__input">
                                                <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Enter Your E-mail Address" required>
                                            </div>
                                            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                                            <div class="clearfix subscribe__btn"><input type="submit" value="Send Now" name="subscribe" id="mc-embedded-subscribe" class="sign__up food__btn">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="subs__address__content d-flex justify-content-between">
                                <div class="subs__address d-flex">
                                    <div class="sbs__address__icon">
                                        <i class="zmdi zmdi-home"></i>
                                    </div>
                                    <div class="subs__address__details">
                                        <p>Elizabeth Tower. 6th Floor <br> Medtown, New York</p>
                                    </div>
                                </div>
                                <div class="subs__address d-flex">
                                    <div class="sbs__address__icon">
                                        <i class="zmdi zmdi-phone"></i>
                                    </div>
                                    <div class="subs__address__details">
                                        <p><a href="#">+088 01673-453290</a></p>
                                        <p><a href="#">+088 01773-458290</a></p>
                                    </div>
                                </div>
                                <div class="subs__address d-flex">
                                    <div class="sbs__address__icon">
                                        <i class="zmdi zmdi-email"></i>
                                    </div>
                                    <div class="subs__address__details">
                                        <p><a href="#">Aahardelivery@email.com</a></p>
                                        <p><a href="#">deliverydotnet@e-mail.com</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           --}}{{-- <div class="subscri__shape--1">
                <img src="{{ asset('frontend') }}/images/banner/bann-4/1.png" alt="banner images">
            </div>
            <div class="subscri__shape--2">
                <img src="{{ asset('frontend') }}/images/banner/bann-4/2.png" alt="banner images">
            </div>--}}{{--
        </div>
    </section>
    <!-- End Subscribe Area -->--}}

@endsection

