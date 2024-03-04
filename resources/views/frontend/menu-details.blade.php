@extends('layouts.app')

@section('title')
    {{ $site_setting->main_title }} Food Delivery || Menu Details
@endsection

@push('css-bottom')
    <style>
        /*Menu Details Top Center - menu_head_top_details_image_path*/
        .bg-image--18 {
            background-image: url({{ asset($site_setting->menu_head_top_details_image_path) }});
        }
    </style>
@endpush

@section('content')

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--18">
        <div class="ht__bradcaump__wrap d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="bradcaump__inner text-center brad__white">
                            <h2 class="bradcaump-title">Menu Details</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('index') }}">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
                                <span class="breadcrumb-item active">Menu Details</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Blog List View Area -->
    <section class="blog__list__view section-padding--lg menudetails-right-sidebar bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="food__menu__container">
                        <div class="food__menu__inner d-flex flex-wrap flex-md-nowrap flex-lg-nowrap">
                            <div class="food__menu__thumb">
                                {{--<img src="{{ asset($meal->image_path) }}" alt="images" style="width: 370px; height: 380px;">--}} <!--w370xh380-->
                                <div class="portfolio foo">
                                    <img src="{{ asset($meal->image_path) }}" alt="portfolio images" style="width: 370px; height: 360px;">
                                    <div class="portfolio__hover">
                                        <div class="portfolio__action">
                                            <ul class="portfolio__list">
                                                <li>
                                                    @foreach($allmealimagesbymealidfrontend as $image)
                                                        <a href="{{ asset($image->path) }}" data-lightbox="grportimg" data-title="{{ $image->name }}">
                                                            <i class="fa fa-eye"></i></a>
                                                    @endforeach
                                                </li>
                                                {{--<li><a href="#"><i class="fa fa-link"></i></a></li>--}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="food__menu__details">
                                <div class="food__menu__content">
                                    <h2>{{ $meal->name }}</h2>
                                    <ul class="food__dtl__prize d-flex">
                                        @if($meal->discounted_price > 0)
                                            <li class="old__prize"><del>£{{ $meal->regular_price }}</del></li>
                                            <li>£{{ $meal->discounted_price }}</li>
                                        @else
                                            <li>£{{ $meal->regular_price }}</li>
                                        @endif
                                    </ul>
                                    <ul class="rating" style="width: 360px;">
                                        {{--<li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>--}}
                                    </ul>
                                    {{--<p>{!! $meal->description !!}</p>--}}
                                    <div class="product-action-wrap">
                                        <div class="prodict-statas"><span>Food Type : {{ $meal->food_type_name }}</span></div>
                                        @if($meal->delivery_cost != null)
                                            <div class="prodict-statas"><span>Delivery Cost : £{{ $meal->delivery_cost }}</span></div>
                                        @endif
                                        @if($meal->delivery_time != null)
                                            <div class="prodict-statas"><span>Delivery Time : {{ $meal->delivery_time }} min</span></div>
                                        @endif
                                        <div class="product-quantity">
                                            <form id='myform' method='POST' action='#'>
                                                <div class="product-quantity">
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" type="text" id="qty_new" value="1">
                                                        <div class="add__to__cart__btn">
                                                            <a class="food__btn" href="javascript:void(0)"
                                                               id="{{ $meal->id }}"
                                                               onclick="addToCart(this.id)"
                                                            >Add to Cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Start Product Descrive Area -->
                        <div class="menu__descrive__area">
                            <div class="menu__nav nav nav-tabs" role="tablist">
                                <a class="active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab">Description</a>
                                {{--<a id="nav-breakfast-tab" data-toggle="tab" href="#nav-breakfast" role="tab">Reviews</a>--}}
                            </div>
                            <!-- Start Tab Content -->
                            <div class="menu__tab__content tab-content" id="nav-tabContent">
                                <!-- Start Single Content -->
                                <div class="single__dec__content fade show active" id="nav-all" role="tabpanel">
                                    {!! $meal->description !!}
                                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labor dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliqui comi modo consequat. Duis aute irure
                                        dolor in reprehenderit in voluptate velit esse cillumfugiat nu pariatur.Excepteur
                                        sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                                        anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                        doloremque laudantium,
                                    </p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                        labor dolore magna aliqua. Ut enim  minim veniam,
                                        <strong>“quis nostrud exercitation ullamco laboris nisi ut aliqui ”</strong>
                                        modo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillumfugiat
                                        nu pariatur.Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                        mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                        accusantium doloremque laudantium,
                                    </p>--}}
                                </div>
                                <!-- End Single Content -->
                                <!-- Start Single Content -->
                                {{--<div class="single__dec__content fade" id="nav-breakfast" role="tabpanel">
                                    <div class="review__wrapper">
                                        <!-- Start Single Review -->
                                        <div class="single__review d-flex">
                                            <div class="review__thumb">
                                                <img src="{{ asset('frontend') }}/images/testimonial/rev/1.jpg" alt="review images">
                                            </div>
                                            <div class="review__details">
                                                <h3>Robart Hanson</h3>
                                                <div class="rev__meta d-flex justify-content-between">
                                                    <span>Admin - February  13,  2018</span>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    </ul>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipis icing elit, sed tdomino eiusd tempor incididunt ut labore et dolore magna aliqua. Ut e veniam, quis nostrud exercitation ullamco laboris nisi ut aliquiconsequat.</p>
                                            </div>
                                        </div>
                                        <!-- End Single Review -->
                                        <!-- Start Single Review -->
                                        <div class="single__review d-flex">
                                            <div class="review__thumb">
                                                <img src="{{ asset('frontend') }}/images/testimonial/rev/2.jpg" alt="review images">
                                            </div>
                                            <div class="review__details">
                                                <h3>Robart Hanson</h3>
                                                <div class="rev__meta d-flex justify-content-between">
                                                    <span>Admin - February  13,  2018</span>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    </ul>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipis icing eltempor incididunt labore et dolore magna aliqua. Ut enim adm veniam, quis nostrud exercitation.</p>
                                            </div>
                                        </div>
                                        <!-- End Single Review -->
                                    </div>
                                </div>--}}
                                <!-- End Single Content -->
                            </div>
                            <!-- End Tab Content -->
                        </div>
                        <!-- End Product Descrive Area -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="popupal__menu">
                                <h4>Popular Menu</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row mt--30">

                        @foreach($top3popularmenu as $row)
                            <!-- Start Single Product -->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="beef_product">
                                    <div class="beef__thumb">
                                        <a href="{{ url('menu-details/'.$row->id) }}">
                                            <img src="{{ asset($row->image_path) }}" alt="beef images" style="width: 100%; height: 190px;">
                                        </a>
                                    </div>
                                    @if($row->tag_special_offer == 1)
                                        <div class="beef__hover__info">
                                            <div class="beef__hover__inner">
                                                <span>Special</span>
                                                <span>offer</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="beef__details">
                                        <h4><a href="{{ url('menu-details/'.$row->id) }}">{{ $row->name }}</a></h4>
                                        <ul class="beef__prize">
                                            @if($row->discounted_price > 0)
                                                <li class="old__prize">£{{ $row->regular_price }}</li>
                                                <li>£{{ $row->discounted_price }}</li>
                                            @else
                                                <li>£{{ $row->regular_price }}</li>
                                            @endif
                                        </ul>
                                        <p>{!! str_limit($row->description, $limit=60) !!}</p>
                                        <input type="hidden" readonly id="qty_new" value="1">
                                        <div class="beef__cart__btn">
                                            <a href="javascript:void(0)"
                                               id="{{ $row->id }}"
                                               onclick="addToCart(this.id)"
                                            >Add to Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                        @endforeach

                            {{--<!-- Start Single Product -->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="beef_product">
                                    <div class="beef__thumb">
                                        <a href="menu-details.html">
                                            <img src="{{ asset('frontend') }}/images/beef/2.jpg" alt="beef images">
                                        </a>
                                    </div>
                                    <div class="beef__details">
                                        <h4><a href="menu-details.html">Beef Burger</a></h4>
                                        <ul class="beef__prize">
                                            <li class="old__prize">$30</li>
                                            <li>$30</li>
                                        </ul>
                                        <p>erve armesan may be added to the top of apLem ip, consectetur</p>
                                        <div class="beef__cart__btn">
                                            <a href="cart.html">Add To Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->
                            <!-- Start Single Product -->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="beef_product">
                                    <div class="beef__thumb">
                                        <a href="menu-details.html">
                                            <img src="{{ asset('frontend') }}/images/beef/3.jpg" alt="beef images">
                                        </a>
                                    </div>
                                    <div class="beef__hover__info">
                                        <div class="beef__hover__inner">
                                            <span>Special</span>
                                            <span>offer</span>
                                        </div>
                                    </div>
                                    <div class="beef__details">
                                        <h4><a href="menu-details.html">Beef Burger</a></h4>
                                        <ul class="beef__prize">
                                            <li class="old__prize">$30</li>
                                            <li>$30</li>
                                        </ul>
                                        <p>erve armesan may be added to the top of apLem ip, consectetur</p>
                                        <div class="beef__cart__btn">
                                            <a href="cart.html">Add To Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->--}}

                    </div>
                </div>
                {{--<div class="col-lg-4 col-md-12 col-sm-12 md--mt--40 sm--mt--40">
                    <div class="food__sidebar">
                        <!-- Start Search Area -->
                        <div class="food__search">
                            <h4 class="side__title">Search</h4>
                            <div class="serch__box">
                                <input type="text" placeholder="Search keyword">
                                <a href="#"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <!-- End Search Area -->
                        <!-- Start Recent Post -->
                        <div class="food__recent__post mt--60">
                            <h4 class="side__title">Recent Posts</h4>
                            <div class="recent__post__wrap">
                                <!-- Start Single Post -->
                                <div class="single__recent__post d-flex">
                                    <div class="recent__post__thumb">
                                        <a href="blog-details.html">
                                            <img src="images/blog/sm-img/4.jpg" alt="post images">
                                        </a>
                                    </div>
                                    <div class="recent__post__details">
                                        <span>February  13,  2018</span>
                                        <h4><a href="blog-details.html">Diffrent title gose here. This is demo title.</a></h4>
                                    </div>
                                </div>
                                <!-- End Single Post -->
                                <!-- Start Single Post -->
                                <div class="single__recent__post d-flex">
                                    <div class="recent__post__thumb">
                                        <a href="blog-details.html">
                                            <img src="images/blog/sm-img/5.jpg" alt="post images">
                                        </a>
                                    </div>
                                    <div class="recent__post__details">
                                        <span>February  13,  2018</span>
                                        <h4><a href="blog-details.html">Diffrent title gose here. This is demo title.</a></h4>
                                    </div>
                                </div>
                                <!-- End Single Post -->
                                <!-- Start Single Post -->
                                <div class="single__recent__post d-flex">
                                    <div class="recent__post__thumb">
                                        <a href="blog-details.html">
                                            <img src="images/blog/sm-img/6.jpg" alt="post images">
                                        </a>
                                    </div>
                                    <div class="recent__post__details">
                                        <span>February  13,  2018</span>
                                        <h4><a href="blog-details.html">Diffrent title gose here. This is demo title.</a></h4>
                                    </div>
                                </div>
                                <!-- End Single Post -->
                                <!-- Start Single Post -->
                                <div class="single__recent__post d-flex">
                                    <div class="recent__post__thumb">
                                        <a href="blog-details.html">
                                            <img src="images/blog/sm-img/7.jpg" alt="post images">
                                        </a>
                                    </div>
                                    <div class="recent__post__details">
                                        <span>February  13,  2018</span>
                                        <h4><a href="blog-details.html">Diffrent title gose here. This is demo title.</a></h4>
                                    </div>
                                </div>
                                <!-- End Single Post -->
                            </div>
                        </div>
                        <!-- End Recent Post -->
                        <!-- Start Category Area -->
                        <div class="food__category__area mt--60">
                            <h4 class="side__title">Categories</h4>
                            <ul class="food__category">
                                <li><a href="#">Maxican Food <span>(20)</span></a></li>
                                <li><a href="#">Pizza <span>(30)</span></a></li>
                                <li><a href="#">Food & Beverage <span>(40)</span></a></li>
                                <li><a href="#">Maxican Food <span>(50)</span></a></li>
                                <li><a href="#">Asian Twist <span>(60)</span></a></li>
                                <li><a href="#">Taco Food <span>(20)</span></a></li>
                            </ul>
                        </div>
                        <!-- End Category Area -->
                        <!-- Start Sidebar Contact -->
                        <div class="sidebar__contact mt--60">
                            <div class="sidebar__thumb">
                                <img src="images/blog/sidebar/2.jpg" alt="sidebar images">
                            </div>
                            <div class="sidebar__details">
                                <h4>colorful</h4>
                                <h2>donut’s</h2>
                                <span>get it till the stock full</span>
                            </div>
                            <div class="sidebar__con__btn">
                                <a href="#">Contact Now<i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                        <!-- End Sidebar Contact -->
                        <!-- Start Sidebar Newsletter -->
                        <div class="sidebar__newsletter mt--60">
                            <h4 class="side__title">Newsletter</h4>
                            <div class="sidebar__inbox">
                                <input type="text" placeholder="Enter your E-mail">
                                <a href="#"><i class="fa fa-paper-plane"></i></a>
                            </div>
                        </div>
                        <!-- End Sidebar Newsletter -->
                        <!-- Start Sidebar Instagram -->
                        <div class="sidebar__instagram mt--60">
                            <h4 class="side__title">Instagram</h4>
                            <ul class="instagram__list d-flex flex-wrap">
                                <li><a href="#"><img src="images/blog/instagram/1.jpg" alt="instagram images"></a></li>
                                <li><a href="#"><img src="images/blog/instagram/2.jpg" alt="instagram images"></a></li>
                                <li><a href="#"><img src="images/blog/instagram/3.jpg" alt="instagram images"></a></li>
                                <li><a href="#"><img src="images/blog/instagram/4.jpg" alt="instagram images"></a></li>
                                <li><a href="#"><img src="images/blog/instagram/5.jpg" alt="instagram images"></a></li>
                                <li><a href="#"><img src="images/blog/instagram/6.jpg" alt="instagram images"></a></li>
                            </ul>
                        </div>
                        <!-- End Sidebar Instagram -->
                    </div>
                </div>--}}
            </div>
        </div>
    </section>
    <!-- End Blog List View Area -->

@endsection
