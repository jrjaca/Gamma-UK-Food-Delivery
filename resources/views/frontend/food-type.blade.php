@extends('layouts.app')

@section('title')
    {{ $site_setting->main_title }} Food Delivery || Food Type
@endsection

@push('css-bottom')
    <style>
        /*Menu Grid Top Center - menu_head_top_grid_image_path*/
        .bg-image--17 {
            background-image: url({{ asset($site_setting->menu_head_top_grid_image_path) }});
        }
    </style>
@endpush

@section('content')

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--17">
        <div class="ht__bradcaump__wrap d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="bradcaump__inner text-center brad__white">
                            <h2 class="bradcaump-title">Food Type</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('index') }}">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
                                <span class="breadcrumb-item active">Food type view</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> {{--{{dd($foodtypesbyid)}}--}}
    <!-- End Bradcaump area -->
    <!-- Start Menu Grid Area -->
    <section class="food__menu__grid__area section-padding--lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__title title__style--2 service__align--center">
                        <h2 class="title__line">{{ $foodtypesbyid->name }}</h2>
                        <p>{{ $foodtypesbyid->description }} </p>
                    </div>
                </div>
            </div>
            {{--<div class="row">
                <div class="col-lg-12">
                    <div class="grid__show d-flex justify-content-between align-items-center">
                        <div class="grid__show__item">
                            <p>Showing 1-{{$allmealsgrid->count()}} of {{$allmealsgrid->total()}} Result </p>
                        </div>
                        --}}{{--<div class="grid__show__btn">
                            <a class="food__btn" href="#">Default Sorting</a>
                        </div>--}}{{--
                    </div>
                </div>
            </div>--}}
            <div class="row mt--30">
                    @php
                        /*set fade in right left up to default*/
                        $left = false;
                        $up = false;
                        $right = false;
                    @endphp
                @foreach($mealbyfoodtypeid as $key => $row)
                    <!-- Start Single Menu Item -->
                    <div class="col-lg-4 col-sm-12 col-md-6">
                        <div class="menu__grid__item wow
                            @php
                                if (!$left){
                                    echo " fadeInLeft ";
                                    $left = true;
                                } elseif (!$up){
                                    echo " fadeInUp ";
                                    $up = true;
                                } elseif (!$right){
                                    echo " fadeInRight ";
                                    $left = false;
                                    $up = false;
                                }
                            @endphp
                        "> {{--fadeInLeft fadeInUp fadeInRight--}}
                            <div class="menu__grid__thumb">
                                <a href="{{ url('menu-details/'.$row->id) }}">
                                    <img src="{{ asset($row->image_path) }}" alt="grid item images" style="width: 100%; height: 270px;">
                                </a>
                                @if($row->tag_special_offer == 1)
                                    <div class="grid__item__offer">
                                        <span>Special</span>
                                        <span>Offer</span>
                                    </div>
                                @endif
                            </div>
                            <div class="menu__grid__inner">
                                <div class="menu__grid__details">
                                    <h2><a href="{{ url('menu-details/'.$row->id) }}">{{ $row->name }}</a></h2>
                                    <ul class="grid__prize__list">
                                        @if($row->discounted_price > 0)
                                            <li class="old__prize">£{{ $row->regular_price }}</li>
                                            <li>£{{ $row->discounted_price }}</li>
                                        @else
                                            <li>£{{ $row->regular_price }}</li>
                                        @endif
                                    </ul>
                                    <p>{!! str_limit($row->description, $limit=100) !!}</p>
                                </div>
                                <input type="hidden" readonly id="qty_new" value="1">
                                <div class="grid__addto__cart__btn">
                                    {{--<a href="cart.html">Add to Cart</a>--}}
                                    <a href="javascript:void(0)"
                                       id="{{ $row->id }}"
                                       onclick="addToCart(this.id)"
                                    >Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Menu Item -->
                @endforeach
            </div>
            <br/>
            {{ $mealbyfoodtypeid->links() }}
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
    </section>
    <!-- End Menu Grid Area -->

@endsection
