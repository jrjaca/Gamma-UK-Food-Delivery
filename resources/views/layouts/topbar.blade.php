
    <header class="htc__header bg--white">
        <!-- Start Mainmenu Area -->
        <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
            <div class="container">
                <div class="row"> {{--style="width: 120%" vmj--}}
                    <div class="col-lg-2 col-sm-4 col-md-6 order-1 order-lg-1"> {{--col-lg-2 at left vmj--}}
                        <div class="logo">
                            <a href="{{ route('index') }}">
                                <img src="{{ asset($site_setting->logo_path) }}" alt="logo images" style="width: 123px; height: 72px;">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-sm-4 col-md-2 order-3 order-lg-2"> {{--col-lg-9 at left vmj--}}
                        <div class="main__menu__wrap">
                            <nav class="main__menu__nav d-none d-lg-block">
                                <ul class="mainmenu">
                                    <li class="drop"><a href="{{ route('index') }}">Main</a>
                                        {{-- <ul class="dropdown__menu">
                                             <li><a href="index.html">Home Food Delivery</a></li>
                                             <li><a href="index-2.html">Home Pizza Delivery</a></li>
                                             <li><a href="index-3.html">Home Backery Delivery</a></li>
                                             <li><a href="index-4.html">Home Box Layout</a></li>
                                         </ul>--}}
                                    </li>
                                    <li><a href="{{ route('about') }}">About</a></li>
                                    <li class="drop"><a href="{{ route('menu.grid') }}">Menu</a>
                                        <ul class="dropdown__menu">
                                            <li><a href="{{ route('menu.grid') }}">Menu Grid</a></li>
                                            <li><a href="{{ route('menu.list') }}">Menu List</a></li>
                                            {{--<li><a href="{{ route('menu.details') }}">Menu Details</a></li>--}}
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('gallery') }}">Gallery</a></li>
                                    {{--<li class="drop"><a href="blog-list.html">Blog</a>
                                        <ul class="dropdown__menu">
                                            <li><a href="blog-list.html">Blog List</a></li>
                                            <li><a href="blog-mesonry.html">Blog mesonry</a></li>
                                            <li><a href="blog-grid-left-sidebar.html">Blog Grid</a></li>
                                            <li><a href="blog-list-right-sidebar.html">Blog List with right sidebar</a></li>
                                            <li><a href="blog-details.html">Blog Details</a></li>
                                        </ul>
                                    </li>--}}
                                    {{--<li class="drop"><a href="#">Pages</a>
                                        <ul class="dropdown__menu">
                                            --}}{{--<li><a href="{{ route('pages.service') }}">Service</a></li>--}}{{--
                                            <li><a href="{{ route('show.cart') }}">Cart Page</a></li>
                                            <li><a href="{{ route('show.checkout') }}">Checkout Page</a></li>
                                            --}}{{--<li><a href="contact.html">Contact Page</a></li>--}}{{--
                                        </ul>
                                    </li>--}}
                                    <li class="drop"><a href="{{ route('show.cart') }}">Cart</a></li>
                                    <li class="drop"><a href="{{ route('show.checkout') }}">Checkout</a></li>
                                    <li><a href="{{ route('contact') }}">Contact</a></li>

                                    @if (Auth::check())
                                        <li class="drop"><a href="{{ route('home') }}">Profile</a>
                                            <ul class="dropdown__menu">
                                                @if (Auth::user()->access_code == 1)
                                                    <li><a href="{{ route('admin.home') }}">Switch to Admin Page</a></li>
                                                @endif
                                                <li><a href="{{ route('change.password') }}">Change Password</a></li>
                                                <li>
                                                    <a href="javascript:void(0)" role="button" data-toggle="modal" data-target="#editModal"
                                                       data-id="{{ @Auth::id() }}"
                                                       data-name="{{ @Auth::user()->name }}"
                                                       data-email="{{ @Auth::user()->email }}"
                                                       data-phone_no="{{ @Auth::user()->phone_no }}"
                                                    >Edit Profile</a>
                                                </li>
                                                <li>
                                                    <!--Logout-->
                                                    <a href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                    <!--Logout-->
                                                </li>
                                            </ul>
                                        </li>
                                    @endif

                                </ul>
                            </nav>

                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-4 col-md-4 order-2 order-lg-3"> {{--col-lg-3  at left vmj--}}
                        <div class="header__right d-flex justify-content-end">
                            @if (Auth::check())
                                {{--<div class="log__in" style="margin-right: 20px;">
                                    <a href="{{ route('home') }}">Welcome :&nbsp;&nbsp; <h10> {{ Auth::user()->name }} </h10></a>
                                </div>--}}
                            @else
                                <div class="log__in">
                                    <a class="accountbox-trigger" href="#" id="login_register_modal_div" ><i class="zmdi zmdi-account-o"></i></a>
                                </div>
                            @endif
                            <div class="shopping__cart">
                                {{--<a class="minicart-trigger" href="javascript:void(0)" id="cart_modal_div" onclick="showCart();"><i class="zmdi zmdi-shopping-basket"></i></a>--}}{{--class="minicart-trigger"--}}
                                <a class="minicart-trigger" href="javascript:void(0)" ><i class="zmdi zmdi-shopping-basket"></i></a>
                                <div class="shop__qun">
                                    <span>{{ Cart::content()->count() }}</span><!--Cart::count()-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Mobile Menu -->
                <div class="mobile-menu d-block d-lg-none"></div>
                <!-- Mobile Menu -->
            </div>
        </div>
        <!-- End Mainmenu Area -->
    </header>


