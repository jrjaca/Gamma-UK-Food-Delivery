
    <!-- Start Footer Area -->
    <footer class="footer__area footer--1">
        <div class="footer__wrapper bg__cat--1 section-padding--lg">
            <div class="container">
                <div class="row">
                    <!-- Start Single Footer -->
                    <div class="col-md-6 col-lg-3 col-sm-12">
                        <div class="footer">
                            <h2 class="ftr__title">About {{ $site_setting->main_title }}</h2>
                            <div class="footer__inner">
                                <div class="ftr__details">
                                    <p>{{--Lorem ipsum dolor sit amconsectetur adipisicing elit,--}}
                                        <a href="{{ route('about') }}">{!! str_limit($site_setting->about_content, $limit=50) !!}<a></p>
                                    <div class="ftr__address__inner">
                                        <div class="ftr__address">
                                            <div class="ftr__address__icon">
                                                <i class="zmdi zmdi-home"></i>
                                            </div>
                                            <div class="frt__address__details">
                                                <p>{{ $site_setting->address }}</p>
                                            </div>
                                        </div>
                                        <div class="ftr__address">
                                            <div class="ftr__address__icon">
                                                <i class="zmdi zmdi-phone"></i>
                                            </div>
                                            <div class="frt__address__details">
                                                <p><a href="#">{{ $site_setting->phone }}</a></p>
                                                {{--<p><a href="#">+088 01773-458290</a></p>--}}
                                            </div>
                                        </div>
                                        <div class="ftr__address">
                                            <div class="ftr__address__icon">
                                                <i class="zmdi zmdi-email"></i>
                                            </div>
                                            <div class="frt__address__details">
                                                <p><a href="#">{{ $site_setting->email }}</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="social__icon">
                                        @if(trim($site_setting->facebook) != "")
                                            <li><a href="{{ $site_setting->facebook }}"><i class="zmdi zmdi-facebook"></i></a></li>
                                        @endif
                                        @if(trim($site_setting->youtube) != "")
                                            <li><a href="{{ $site_setting->youtube }}"><i class="zmdi zmdi-youtube"></i></a></li>
                                        @endif
                                        @if(trim($site_setting->instagram) != "")
                                            <li><a href="{{ $site_setting->instagram }}"><i class="zmdi zmdi-instagram"></i></a></li>
                                        @endif
                                        {{--<li><a href="#"><i class="zmdi zmdi-rss"></i></a></li>--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer -->
                    <!-- Start Single Footer -->
                    <div class="col-md-6 col-lg-3 col-sm-12 sm--mt--40">
                        <div class="footer gallery">
                            <h2 class="ftr__title">Our Gallery</h2>
                            <div class="footer__inner">
                                <ul class="sm__gallery__list">
                                    @foreach($gallery_footer_images as $row)
                                        <li><a href="{{ route('gallery') }}"><img src="{{ asset($row->image_path) }}" alt="gallery images" style="width: 86px; height: 80px;"></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer -->
                    <!-- Start Single Footer -->
                    <div class="col-md-6 col-lg-3 col-sm-12 md--mt--40 sm--mt--40">
                        <div class="footer">
                            <h2 class="ftr__title">Opening Time</h2>
                            <div class="footer__inner">
                                <ul class="opening__time__list">
                                    @if(trim($site_setting->open_time_saturday) != "")
                                        <li>Saturday<span>.......</span>{{ $site_setting->open_time_saturday }}</li>
                                    @endif
                                    @if(trim($site_setting->open_time_sunday) != "")
                                        <li>Sunday<span>.........</span>{{ $site_setting->open_time_sunday }}</li>
                                    @endif
                                    @if(trim($site_setting->open_time_monday) != "")
                                        <li>Monday<span>.........</span>{{ $site_setting->open_time_monday }}</li>
                                    @endif
                                    @if(trim($site_setting->open_time_tuesday) != "")
                                        <li>Tuesday<span>........</span>{{ $site_setting->open_time_tuesday }}</li>
                                    @endif
                                    @if(trim($site_setting->open_time_wednesday) != "")
                                        <li>Wednesday<span>......</span>{{ $site_setting->open_time_wednesday }}</li>
                                    @endif
                                    @if(trim($site_setting->open_time_thursday) != "")
                                        <li>Thursday<span>.......</span>{{ $site_setting->open_time_thursday }}</li>
                                    @endif
                                    @if(trim($site_setting->open_time_friday) != "")
                                        <li>Friday<span>.........</span>{{ $site_setting->open_time_friday }}</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer -->
                    <!-- Start Single Footer -->
                    <div class="col-md-6 col-lg-3 col-sm-12 md--mt--40 sm--mt--40">
                        <div class="footer">
                            <h2 class="ftr__title">Latest Menu<!--Post--></h2>
                            <div class="footer__inner">
                                <div class="lst__post__list">
                                    @foreach($latest_menu_footer_images as $row)
                                        <div class="single__sm__post" style="float: left; text-align: left">
                                            <div class="sin__post__thumb">
                                                <a href="{{ url('menu-details/'.$row->id) }}">
                                                    <img src="{{ asset($row->image_path) }}" alt="blog images" style="width: 70px; height: 70px;">
                                                </a>
                                            </div>
                                            <div class="sin__post__details">
                                                <h6><a href="{{ url('menu-details/'.$row->id) }}">{{ $row->name }} </a></h6>
                                                <p style="float: left; text-align: left">{{ str_limit($row->description, $limit=10) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer -->
                </div>
            </div>
        </div>
        <div class="copyright bg--theme">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="copyright__inner">
                            <div class="cpy__right--left">
                                <p>@All Right Reserved.&nbsp;<a href="<!--https://devitems.com-->">VMJDev</a></p>
                            </div>
                            <div class="cpy__right--right">
                                <a href="#">
                                    {{--<img src="{{ asset('frontend') }}/images/icon/shape/2.png" alt="payment images">--}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer Area -->
