@extends('layouts.app')

@section('title')
    {{ $site_setting->main_title }} Food Delivery || Menu List
@endsection

@push('css-bottom')
    <style>
        /*Menu List Top Center - menu_head_top_list_image_path*/
        .bg-image--18 {
            background-image: url({{ asset($site_setting->menu_head_top_list_image_path) }});
        }
    </style>
@endpush

@section('content')
    {{--{{ dd($allmealtypesorderbyname) }}--}}
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--18">
        <div class="ht__bradcaump__wrap d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="bradcaump__inner text-center brad__white">
                            <h2 class="bradcaump-title">menu List view</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('index') }}">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
                                <span class="breadcrumb-item active">menu List view</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start List Grid Area -->
    <section class="food__menu__grid__area section-padding--lg">
        <!--container-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    {{--<div class="food__nav nav nav-tabs" role="tablist">--}}
                    {{--  <a class="active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab">All</a>
                      <a id="nav-breakfast-tab" data-toggle="tab" href="#nav-breakfast" role="tab">Breakfast</a>
                      <a id="nav-lunch-tab" data-toggle="tab" href="#nav-lunch" role="tab">Lunch</a>
                      <a id="nav-dinner-tab" data-toggle="tab" href="#nav-dinner" role="tab">Dinner</a>
                      <a id="nav-coffee-tab" data-toggle="tab" href="#nav-coffee" role="tab">Coffee</a>
                      <a id="nav-snacks-tab" data-toggle="tab" href="#nav-snacks" role="tab">Snacks</a>--}}

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <!--navigation-->
                        <!--All NAV-->
                            <li class="nav-item">
                                <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true"><h5>All</h5></a>
                            </li>
                        <!--/All NAV-->
                        <!--Meal Type NAV-->
                            @foreach($allmealtypesorderbyname as $row)
                                <li class="nav-item">
                                    <a class="nav-link" id="{{ $row->id.substr($row->name, 0, 2) }}-tab" data-toggle="tab" href="#{{ $row->id.substr($row->name, 0, 2) }}" role="tab" aria-controls="{{ $row->id.substr($row->name, 0, 2) }}" aria-selected="false"><h5>{{ $row->name }}</h5></a>
                                </li>
                            @endforeach
                        <!--/Meal Type NAV-->
                        <!--Food Type NAV-->
                            @foreach($allfoodtypesorderbyname as $row)
                                <li class="nav-item">
                                    <a class="nav-link" id="{{ $row->id.substr($row->name, 0, 2) }}-tab" data-toggle="tab" href="#{{ $row->id.substr($row->name, 0, 2) }}" role="tab" aria-controls="{{ $row->id.substr($row->name, 0, 2) }}" aria-selected="false"><h5>{{ $row->name }}</h5></a>
                                </li>
                            @endforeach
                        <!--/Food Type NAV-->
                    <!--/navigation-->
                    </ul>
                    <div class="tab-content" id="myTabContent">
                    <!--div, content-->
                        <!--All DIV Content-->
                            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                <div class="row mt--30">
                                    <div class="col-lg-12">
                                    @foreach($allmealslist as $row)
                                        <!-- Start Single Food -->
                                            <div class="single__food__list d-flex wow fadeInUp">
                                                <div class="food__list__thumb">
                                                    <a href="{{ url('menu-details/'.$row->id) }}">
                                                        <img src="{{ asset($row->image_path)  }}" alt="list food images" style="width: 469px; height: 253px;"> {{--style="width: 469px; height: 253px;"--}}
                                                    </a>
                                                </div>
                                                <div class="food__list__inner d-flex align-items-center justify-content-between">
                                                    <div class="food__list__details">
                                                        <h2><a href="{{ url('menu-details/'.$row->id) }}">{{ $row->name }}</a></h2>
                                                        <p>{{ $row->description }}</p>
                                                        <input type="hidden" readonly id="qty_new" value="1">
                                                        <div class="list__btn">
                                                            {{--<a class="food__btn grey--btn theme--hover" href="menu-details.html">Add to Cart</a>--}}
                                                            <a class="food__btn grey--btn theme--hover" href="javascript:void(0)"
                                                               id="{{ $row->id }}"
                                                               onclick="addToCart(this.id)"
                                                            >Add to Cart</a>
                                                        </div>
                                                    </div>
                                                    <div class="food__rating">
                                                        <div class="list__food__prize">
                                                            <span>£{{ $row->regular_price }}</span>
                                                        </div>
                                                        {{--<ul class="rating">
                                                            <li><i class="zmdi zmdi-star"></i></li>
                                                            <li><i class="zmdi zmdi-star"></i></li>
                                                            <li><i class="zmdi zmdi-star"></i></li>
                                                            <li><i class="zmdi zmdi-star"></i></li>
                                                            <li class="rating__opasity"><i class="zmdi zmdi-star"></i></li>
                                                        </ul>--}}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Single Food -->
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        <!--/All DIV Content-->
                    <!--Meal Type DIV Content--> {{--{{dd($allmealsandmealtypeslistview)    mmt_id mmt_meal_id mmt_mt_id',}}--}}
                        @foreach($allmealtypesorderbyname as $mealtype)
                            <div class="tab-pane fade" id="{{ $mealtype->id.substr($mealtype->name, 0, 2) }}" role="tabpanel" aria-labelledby="{{ $mealtype->id.substr($mealtype->name, 0, 2) }}-tab">
                                <div class="row mt--30">
                                    <div class="col-lg-12">
                                        @foreach($allmealsandmealtypeslistview as $meal)
                                            @if($mealtype->id == $meal->mmt_mt_id)
                                                <!-- Start Single Food -->
                                                <div class="single__food__list d-flex wow fadeInUp">
                                                    <div class="food__list__thumb">
                                                        <a href="{{ url('menu-details/'.$meal->id) }}">
                                                            <img src="{{ asset($meal->image_path)  }}" alt="list food images" style="width: 469px; height: 253px;">
                                                        </a>
                                                    </div>
                                                    <div class="food__list__inner d-flex align-items-center justify-content-between">
                                                        <div class="food__list__details">
                                                            <h2><a href="{{ url('menu-details/'.$meal->id) }}">{{ $meal->name }}</a></h2>
                                                            <p>{{ $meal->description }}</p>
                                                            <input type="hidden" readonly id="qty_new" value="1">
                                                            <div class="list__btn">
                                                                {{--<a class="food__btn grey--btn theme--hover" href="menu-details.html">Add to Cart</a>--}}
                                                                <a class="food__btn grey--btn theme--hover" href="javascript:void(0)"
                                                                   id="{{ $meal->id }}"
                                                                   onclick="addToCart(this.id)"
                                                                >Add to Cart</a>
                                                            </div>
                                                        </div>
                                                        <div class="food__rating">
                                                            <div class="list__food__prize">
                                                                <span>£{{ $meal->regular_price }}</span>
                                                            </div>
                                                            <ul class="rating">
                                                                <li><i class="zmdi zmdi-star"></i></li>
                                                                <li><i class="zmdi zmdi-star"></i></li>
                                                                <li><i class="zmdi zmdi-star"></i></li>
                                                                <li><i class="zmdi zmdi-star"></i></li>
                                                                <li class="rating__opasity"><i class="zmdi zmdi-star"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Food -->
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    <!--/Meal Type DIV Content-->
                    <!--Food Type DIV Content-->
                        @foreach($allfoodtypesorderbyname as $foodtype)
                            <div class="tab-pane fade" id="{{ $foodtype->id.substr($foodtype->name, 0, 2) }}" role="tabpanel" aria-labelledby="{{ $foodtype->id.substr($foodtype->name, 0, 2) }}-tab">
                                <div class="row mt--30">
                                    <div style="text-align: center;">
                                        <h5 class="title__line">{!! $foodtype->description !!}</h5>
                                    </div>

                                    <div class="col-lg-12">
                                    @foreach($allmealslist as $meal)
                                        @if($foodtype->id == $meal->food_type_id)
                                            <!-- Start Single Food -->
                                                <div class="single__food__list d-flex wow fadeInUp">
                                                    <div class="food__list__thumb">
                                                        <a href="{{ url('menu-details/'.$meal->id) }}">
                                                            <img src="{{ asset($meal->image_path)  }}" alt="list food images" style="width: 469px; height: 253px;">
                                                        </a>
                                                    </div>
                                                    <div class="food__list__inner d-flex align-items-center justify-content-between">
                                                        <div class="food__list__details">
                                                            <h2><a href="{{ url('menu-details/'.$meal->id) }}">{{ $meal->name }}</a></h2>
                                                            <p>{{ $meal->description }}</p>
                                                            <input type="hidden" readonly id="qty_new" value="1">
                                                            <div class="list__btn">
                                                                {{--<a class="food__btn grey--btn theme--hover" href="menu-details.html">Add to Cart</a>--}}
                                                                <a class="food__btn grey--btn theme--hover" href="javascript:void(0)"
                                                                   id="{{ $meal->id }}"
                                                                   onclick="addToCart(this.id)"
                                                                >Add to Cart</a>
                                                            </div>
                                                        </div>
                                                        <div class="food__rating">
                                                            <div class="list__food__prize">
                                                                <span>£{{ $meal->regular_price }}</span>
                                                            </div>
                                                            {{--<ul class="rating">
                                                                <li><i class="zmdi zmdi-star"></i></li>
                                                                <li><i class="zmdi zmdi-star"></i></li>
                                                                <li><i class="zmdi zmdi-star"></i></li>
                                                                <li><i class="zmdi zmdi-star"></i></li>
                                                                <li class="rating__opasity"><i class="zmdi zmdi-star"></i></li>
                                                            </ul>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Single Food -->
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    <!--/Food Type DIV Content-->

                    <!--/div, content-->
                    </div>

                    {{--</div>--}}
                </div>
            </div>

            {{--<div class="row">
                <div class="col-lg-12">
                    <ul class="food__pagination d-flex justify-content-center align-items-center mt--130">
                        <li><a href="#"><i class="zmdi zmdi-chevron-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li class="active"><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">...</a></li>
                        <li><a href="#">7</a></li>
                        <li><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>--}}
        </div>
        <!--/container-->
    </section>
    <!-- End List Grid Area -->


    {{--<style>
        .controls a{
            padding:3px;
            border:1px solid gray;
            margin:2px;
            color:black;
            text-decoration:none
        }
        .active{
            background:darkblue;
            color:white !important;
        }
    </style>

        <div class="pagnation">
        <div class="newsbox">div1</div>
        <div class="newsbox">div2</div>
        <div class="newsbox">div3</div>
        <div class="newsbox">div4</div>
        <div class="newsbox">div5</div>
        <div class="newsbox">div6</div>
        <div class="newsbox">div7</div>
        <div class="newsbox">div8</div>
        <div class="newsbox">div9</div>
        <div class="newsbox">div10</div>
        <div class="newsbox">div11</div>
        <div class="newsbox">div12</div>
        <div class="newsbox">div13</div>
        <div class="newsbox">div15</div>
        <div class="newsbox">div15</div>
    </div>--}}
@endsection
{{--

@section('script-bottom')
    --}}
{{-- For viewing uploading at file--}}{{--

    <script type="text/javascript">

        $(document).ready(function() {

            var show_per_page = 5;
            var number_of_items = $('.pagnation').children('.newsbox').size();
            var number_of_pages = Math.ceil(number_of_items / show_per_page);

            $('body').append('<div class=controls></div><input id=current_page type=hidden><input id=show_per_page type=hidden>');
            $('#current_page').val(0);
            $('#show_per_page').val(show_per_page);

            var navigation_html = '<a class="prev" onclick="previous()">Prev</a>';
            var current_link = 0;
            while (number_of_pages > current_link) {
                navigation_html += '<a class="page" onclick="go_to_page(' + current_link + ')" longdesc="' + current_link + '">' + (current_link + 1) + '</a>';
                current_link++;
            }
            navigation_html += '<a class="next" onclick="next()">Next</a>';

            $('.controls').html(navigation_html);
            $('.controls .page:first').addClass('active');

            $('.pagnation').children().css('display', 'none');
            $('.pagnation').children().slice(0, show_per_page).css('display', 'block');

        });

        function go_to_page(page_num) {
            var show_per_page = parseInt($('#show_per_page').val(), 0);

            start_from = page_num * show_per_page;

            end_on = start_from + show_per_page;

            $('.pagnation').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');

            $('.page[longdesc=' + page_num + ']').addClass('active').siblings('.active').removeClass('active');

            $('#current_page').val(page_num);
        }

        function previous() {

            new_page = parseInt($('#current_page').val(), 0) - 1;
            //if there is an item before the current active link run the function
            if ($('.active').prev('.page').length == true) {
                go_to_page(new_page);
            }

        }

        function next() {
            new_page = parseInt($('#current_page').val(), 0) + 1;
            //if there is an item after the current active link run the function
            if ($('.active').next('.page').length == true) {
                go_to_page(new_page);
            }

        }
    </script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
@endsection
--}}
