@extends('layouts.app')

@section('title')
    {{ $site_setting->main_title }} Food Delivery || Gallery
@endsection

@push('css-bottom')
    <style>
        /*Gallery Top Center - gallery_head_top_image_path*/
        .bg-image--18 {
            background-image: url({{ asset($site_setting->gallery_head_top_image_path) }});
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
                            <h2 class="bradcaump-title">our gallery</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('index') }}">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
                                <span class="breadcrumb-item active">our gallery</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> {{--{{dd($allmealtypesandmealmealtypesgalleryview)}}--}}
    <!-- End Bradcaump area -->
    <!-- Start Gallery Area -->
    <div class="food__gallery__area section-padding--lg bg--white">
        <div class="container portfolio__area">
            <div class="row">
                <div class="col-lg-12">
                    <div class="portfolio__menu d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-center">
                        <button data-filter="*"  class="is-checked">View All</button>
                        @foreach($allmealtypesorderbyname as $row)
                            <button data-filter=".{{ $row->id.substr($row->name, 0, 2) }}">{{ $row->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row portfolio__wrap mt--50">
                @php
                    //width
                    $initial = false;
                    $seven = false;
                    $five = false;

                    //image style, seven670x410, five470x410
                    $initial2 = false;
                    $seven2 = false;
                    $five2 = false;
                @endphp
                @foreach($allmealslist as $meal)
                    <!-- Start Single Images -->
                    <div class="
                                @php
                                if (!$initial){
                                    if (!$seven){
                                        echo " col-lg-7 ";
                                        $seven = true;
                                    } elseif (!$five){
                                        echo " col-lg-5 ";
                                        $seven = false;
                                        $initial = true;
                                    }
                                } elseif (!$five){
                                    echo " col-lg-5 ";
                                    $five = true;
                                } elseif (!$seven){
                                    echo " col-lg-7 ";
                                    $five = false;
                                    $initial = false;
                                }
                            @endphp
                                pro__item
                            @foreach($allmealtypesandmealmealtypesgalleryview as $mealtypemealmealtype)
                                @if($meal->id == $mealtypemealmealtype->m_mt_meal_id)
                                    {{ " ".$mealtypemealmealtype->id.substr($mealtypemealmealtype->name, 0, 2)." " }}
                                @endif
                            @endforeach
                        ">
                        <div class="portfolio foo">
                            <img src="{{ asset($meal->image_path) }}" alt="portfolio images"
                                @php
                                    if (!$initial2){
                                        if (!$seven2){
                                            //echo " style='width: 670px; height: 410px;' ";
                                            //echo " style='width: 67%; height: 41%;' ";
                                            echo " style='width: 100%; height: 410px;' ";
                                            $seven2 = true;
                                        } elseif (!$five2){
                                            //echo " style='width: 470px; height: 410px;' ";
                                            //echo " style='width: 47%; height: 41%;' ";
                                            echo " style='width: 100%; height: 410px;' ";
                                            $seven2 = false;
                                            $initial2 = true;
                                        }
                                    } elseif (!$five2){
                                        //echo " style='width: 470px; height: 410px;' ";
                                        //echo " style='width: 47%; height: 41%;' ";
                                        echo " style='width: 100%; height: 410px;' ";
                                        $five2 = true;
                                    } elseif (!$seven2){
                                        //echo " style='width: 670px; height: 410px;' ";
                                        //echo " style='width: 67%; height: 41%;' ";
                                        echo " style='width: 100%; height: 410px;' ";
                                        $five2 = false;
                                        $initial2 = false;
                                    }
                                @endphp
                            >
                            <div class="portfolio__hover">
                                <div class="portfolio__action">
                                    <ul class="portfolio__list">
                                        <li>
                                            @foreach($allmealimages as $image)
                                                @if($image['meal_id'] == $meal->id)
                                                    <a href="{{ asset($image['path']) }}" data-lightbox="grportimg" data-title="{{ $image['name'] }}">
                                                        <i class="fa fa-eye"></i></a>
                                                @endif
                                            @endforeach
                                        </li>
                                        <li><a href="{{ url('menu-details/'.$meal->id) }}"><i class="fa fa-link"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Images -->
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Gallery Area -->

@endsection
