<!doctype html>
<html class="no-js" lang="zxx">
    <head>

        @php
            //for footer form
            $site_setting = App\Helpers\TraitMyFunctions::getSiteSettings();
            $gallery_footer_images = App\Helpers\TraitMyFunctions::getGalleryFooterImages();
            $latest_menu_footer_images = App\Helpers\TraitMyFunctions::getLatestMenuFooterImages();

            //Cartbox
            $cart = Cart::content();
            if (Cart::subtotal() <= 0){
                $shipping_charge = 0;
                $vat = 0;
            } else {
                $shipping_charge = $site_setting->checkout_shipping_charge;
                $vat = $site_setting->checkout_vat;
            }

            $grandTotal = number_format(((str_replace(',', '', Cart::subtotal())) +
                                         $vat +
                                         $shipping_charge),2, '.', ',');
        @endphp

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title'){{--Home-3 || Aahar Food Delivery Html5 Template--}}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicons -->
        <link rel="shortcut icon" href="{{ asset($site_setting->logo_path) }}">
        {{--<link rel="apple-touch-icon" href="images/icon.png">--}}

        @include('layouts.header-css')

        {{--<!-- Modernizer js -->
        <script src="{{ asset('frontend') }}/js/vendor/modernizr-3.5.0.min.js"></script>--}}

    </head>

    <body>
        <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <!-- Add your site or application content here -->

        <!-- <div class="fakeloader"></div> -->

        <!-- Main wrapper -->
        <div class="wrapper" id="wrapper">
            <!-- Start Header Area -->
            @include('layouts.topbar')
            <!-- End Header Area -->

            <!-- Start Display Message-->
            @if ($errors->any() || Session::get('success') || Session::get('error') || Session::get('warning') || Session::get('info'))
                <div class="col-lg-10 text-left" role="alert" style="width: 50%; margin: 0 auto; margin-top: 20px; margin-bottom: 20px;">
                    @include('layouts.flash-message')
                </div>
            @endif
            {{--@if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show col-lg-10 text-center" role="alert" style="width: 50%; margin: 0 auto; margin-top: 20px; margin-bottom: 20px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif--}}
            <!-- END Display Message-->

                    @yield('content')

            <!-- Start Footer Area -->
            @include('layouts.footer', ['site_setting' => $site_setting,
                                    'gallery_footer_images' => $gallery_footer_images,
                                    'latest_menu_footer_images' => $latest_menu_footer_images])
            <!-- End Footer Area -->

            <!-- Login Form -->
            <div class="accountbox-wrapper">
                <div class="accountbox text-left">
                    <ul class="nav accountbox__filters" id="myTab" role="tablist">
                        <li>
                            <a class="active" id="log-tab" data-toggle="tab" href="#log" role="tab" aria-controls="log" aria-selected="true">Login</a>
                        </li>
                        <li>
                            <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Register</a>
                        </li>
                    </ul>
                    <div class="accountbox__inner tab-content" id="myTabContent">

                        <!--LOGIN-->
                        <div class="accountbox__login tab-pane fade show active" id="log" role="tabpanel" aria-labelledby="log-tab">
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                               {{-- <div class="single-input">
                                    <input class="cr-round--lg" type="text" placeholder="User name or email">
                                </div>
                                <div class="single-input">
                                    <input class="cr-round--lg" type="password" placeholder="Password">
                                </div>--}}
                                <div class="single-input">
                                    <input id="email" type="email" class="form-control cr-round--lg @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="single-input">
                                    <input id="password" type="password" class="form-control cr-round--lg @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="password" placeholder="Password"> <!--autocomplete="current-password"-->
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="single-input">
                                    <button type="submit" class="food__btn"><span>Login</span></button>

                                   <br>

                                    {{--  <label class="chech_container">Remember me
                                         <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                         <span class="checkmark"></span>
                                     </label>

                                     <br>

                                     <div class="form-check">
                                         <label class="form-check-label" for="remember">
                                             {{ __('Remember Me') }}
                                         </label>
                                         <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                     </div>--}}

                                    <br>

                                    <a href="{{ route('password.request') }}">Forgot your password?</a>


                                    {{--<div class="accountbox-login__others"> --}}{{--style="width: 20%; margin: 0 auto;--}}{{--
                                        <h6>Or login with</h6>
                                        <div class="social-icons">
                                            <ul>
                                                <li class="facebook"><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                                                --}}{{--<li class="twitter"><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>--}}{{--
                                                <li class="pinterest"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>--}}
                                </div>

                                {{--<div class="row">
                                    <div class="form-group">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>

                                    </div>

                                    <div class="form-group">

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif

                                    </div>
                                </div>--}}


                            </form>



                        </div>
                        <!--LOGIN-->

                        <!--REGISTER-->
                        <div class="accountbox__register tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="single-input">
                                    <input type="text" class="form-control cr-round--lg @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="single-input">
                                    <input type="email" class="form-control cr-round--lg @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="single-input">
                                    <input type="password" class="form-control cr-round--lg @error('password') is-invalid @enderror"
                                           name="password" placeholder="Password" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="single-input">
                                    <input type="password" class="form-control cr-round--lg @error('password_confirmation') is-invalid @enderror"
                                           name="password_confirmation" placeholder="Confirm Password" required>
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="single-input">
                                    <button type="submit" class="food__btn"><span>Sign Up</span></button>
                                </div>
                            </form>

                        </div>
                        <!--REGISTER-->

                        <span class="accountbox-close-button"><i class="zmdi zmdi-close"></i></span>
                    </div>
                </div>
            </div><!-- //Login Form -->

            <!-- Cartbox -->
            <div class="cartbox-wrap">
                <div class="cartbox text-right">
                    <button class="cartbox-close"><i class="zmdi zmdi-close"></i></button>
                    <div class="cartbox__inner text-left">
                        <div class="cartbox__items">
                            <a href="javascript:void(0)" onClick="window.location.reload();">
												<span style="font-size: 2.5em; color: Dodgerblue;">
													<i class="fa fa-refresh" title="Refresh"></i>
												</span>
                            </a>
                            @foreach($cart as $row)
                                <!-- Cartbox Single Item 70x70 image-->
                                <div class="cartbox__item">
                                    <div class="cartbox__item__thumb">
                                        <a href="{{ url('menu-details/'.$row->id) }}">
                                            <img src="{{ asset($row->options->image_path) }}" alt="small thumbnail">
                                        </a>
                                    </div>
                                    <div class="cartbox__item__content">
                                        <h5><a href="{{ url('menu-details/'.$row->id) }}" class="product-name">{{ $row->name }}</a></h5>
                                        <p>Qty: <span>{{ $row->qty }}</span></p>
                                        <span class="price">£{{ $row->price }}</span>
                                    </div>
                                    <button class="cartbox__item__remove">
                                        {{--<i class="fa fa-trash"></i>--}}
                                        <a href="{{ url('cart/product/remove/'.$row->rowId) }}">
                                            <i class="fa fa-trash" title="Remove {{ $row->name }}"></i></a>
                                    </button>
                                </div><!-- //Cartbox Single Item -->
                            @endforeach

                        </div>
                        <div class="cartbox__total">
                            <ul>
                                <li><span class="cartbox__total__title">Subtotal</span><span class="price">£{{ Cart::subtotal() }}</span></li>
                                <li class="shipping-charge"><span class="cartbox__total__title">VAT</span><span class="price">£{{ $vat }}</span></li>
                                <li class="shipping-charge"><span class="cartbox__total__title">Shipping Charge</span><span class="price">£{{ $shipping_charge }}</span></li>
                                <li class="grandtotal">Total<span class="price">£{{ $grandTotal }}</span></li>
                            </ul>
                        </div>
                        <div class="cartbox__buttons">
                            <a class="food__btn" href="{{ route('show.cart') }}"><span>View cart</span></a>
                            <a class="food__btn" href="{{ route('show.checkout') }}"><span>Checkout</span></a>
                        </div>
                    </div>
                </div>
            </div><!-- //Cartbox -->
        </div><!-- //Main wrapper -->

        @include('layouts.footer-script')

    </body>
</html>
