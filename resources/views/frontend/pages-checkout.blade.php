@extends('layouts.app')

@section('title')
    {{ $site_setting->main_title }} Food Delivery || Checkout
@endsection

@push('css-bottom')
    <style>
        /*Pages Checkout Top Center - pages_checkout_head_top_image_path*/
        .bg-image--18 {
            background-image: url({{asset($site_setting->pages_checkout_head_top_image_path) }});
        }

        /*billing address full*/
        .billing-method h5 {
            font-size: 16px;
            text-transform: capitalize;
            margin-bottom: 15px;
            font-weight: 700;
            font-style: italic; }

        /*payment-form is in style.css*/

        /*paypal-form is only here*/
        .paypal-form {
            float: left;
            width: 100%;
            /*display: none;*/ }
        .paypal-form label {
            display: block;
            font-size: 15px; }
        .paypal-form input {
            width: 100%;
            border: 1px solid #ededed;
            background-color: #ffffff;
            height: 40px;
            line-height: 24px;
            padding: 7px 15px;
            color: #959595;
            font-size: 15px;
            float: left; }
        .paypal-form select {
            -moz-appearance: none;
            -webkit-appearance: none;
            appearance: none;
            background: rgba(0, 0, 0, 0) asset("{{ asset('frontend') }}/images/icons/select-arrow-down-2.png") no-repeat scroll right 5px center;
            width: 100%;
            border: 1px solid #ededed;
            background-color: #ffffff;
            height: 40px;
            line-height: 24px;
            padding: 7px 15px;
            color: #959595;
            font-size: 15px;
            float: left; }
        .paypal-form select option {
            padding: 5px 15px; }
        .paypal-form a {
            color: #d50c0d;
            font-size: 15px;
            margin-top: 5px; }

        /*stripe-form is only here*/
        .stripe-form {
            float: left;
            width: 100%;
            display: none; }
        .stripe-form label {
            display: block;
            font-size: 15px; }
        .stripe-form input {
            width: 100%;
            border: 1px solid #ededed;
            background-color: #ffffff;
            height: 40px;
            line-height: 24px;
            padding: 7px 15px;
            color: #959595;
            font-size: 15px;
            float: left; }
        .stripe-form select {
            -moz-appearance: none;
            -webkit-appearance: none;
            appearance: none;
            background: rgba(0, 0, 0, 0) asset("{{ asset('frontend') }}/images/icons/select-arrow-down-2.png") no-repeat scroll right 5px center;
            width: 100%;
            border: 1px solid #ededed;
            background-color: #ffffff;
            height: 40px;
            line-height: 24px;
            padding: 7px 15px;
            color: #959595;
            font-size: 15px;
            float: left; }
        .stripe-form select option {
            padding: 5px 15px; }
        .stripe-form a {
            color: #d50c0d;
            font-size: 15px;
            margin-top: 5px; }
    </style>

@endpush

@section('content')
    @php
        use Illuminate\Support\Facades\Session;

        $name_billing = "";
        $company_name_billing = "";
        $street_address_billing = "";
        $apartment_unit_billing = "";
        $town_city_billing = "";
        $state_country_billing = "";
        $post_zipcode_billing = "";
        $email_billing = "";
        $phone_billing = "";
        $billing_address_full = "";

        $name_shipping = "";
        $company_name_shipping = "";
        $street_address_shipping = "";
        $apartment_unit_shipping = "";
        $town_city_shipping = "";
        $state_country_shipping = "";
        $post_zipcode_shipping = "";
        $email_shipping = "";
        $phone_shipping = "";
        $shipping_address_full = "";

        if (Auth::check()){ // authenticated
            //---- Billing ----//
            //check first if billing session is set
            if (Session::has('b_address')) {
                $name_billing = Session::get('b_address')['name_billing'];
                $company_name_billing = Session::get('b_address')['company_name_billing'];
                $street_address_billing = Session::get('b_address')['street_address_billing'];
                $apartment_unit_billing = Session::get('b_address')['apartment_unit_billing'];
                $town_city_billing = Session::get('b_address')['town_city_billing'];
                $state_country_billing = Session::get('b_address')['state_country_billing'];
                $post_zipcode_billing = Session::get('b_address')['post_zipcode_billing'];
                $email_billing = Session::get('b_address')['email_billing'];
                $phone_billing = Session::get('b_address')['phone_billing'];

                $billing_address_full =
                    $apartment_unit_billing.", ".
                    $street_address_billing.", ".
                    $town_city_billing.", ".
                    $state_country_billing.", ".
                    $post_zipcode_billing.".";
            } else {
                if ($billing === null){ //not exist
                    $name_billing = Auth::user()->name;
                    $email_billing = Auth::user()->email;
                } else { //exist

                    $name_billing = $billing->name;
                    $company_name_billing = $billing->company_name;
                    $street_address_billing = $billing->street_address;
                    $apartment_unit_billing = $billing->apartment_unit;
                    $town_city_billing = $billing->town_city;
                    $state_country_billing = $billing->state_country;
                    $post_zipcode_billing = $billing->post_zipcode;
                    $email_billing = $billing->email;
                    $phone_billing = $billing->phone;

                    $billing_address_full =
                        $apartment_unit_billing.", ".
                        $street_address_billing.", ".
                        $town_city_billing.", ".
                        $state_country_billing.", ".
                        $post_zipcode_billing.".";

                    //set to session, so no need to save if filled up
                    Session::put('b_address',[
                        'name_billing' => $name_billing,
                        'company_name_billing' => $company_name_billing,
                        'street_address_billing' => $street_address_billing,
                        'apartment_unit_billing' => $apartment_unit_billing,
                        'town_city_billing' => $town_city_billing,
                        'state_country_billing' => $state_country_billing,
                        'post_zipcode_billing' => $post_zipcode_billing,
                        'email_billing' => $email_billing,
                        'phone_billing' => $phone_billing
                    ]);
                }
            }

            //check first if shipping session is set
            if (Session::has('s_address')) {
                $name_shipping = Session::get('s_address')['name_shipping'];
                $company_name_shipping = Session::get('s_address')['company_name_shipping'];
                $street_address_shipping = Session::get('s_address')['street_address_shipping'];
                $apartment_unit_shipping = Session::get('s_address')['apartment_unit_shipping'];
                $town_city_shipping = Session::get('s_address')['town_city_shipping'];
                $state_country_shipping = Session::get('s_address')['state_country_shipping'];
                $post_zipcode_shipping = Session::get('s_address')['post_zipcode_shipping'];
                $email_shipping = Session::get('s_address')['email_shipping'];
                $phone_shipping = Session::get('s_address')['phone_shipping'];

                $shipping_address_full =
                    $apartment_unit_shipping.", ".
                    $street_address_shipping.", ".
                    $town_city_shipping.", ".
                    $state_country_shipping.", ".
                    $post_zipcode_shipping.".";
            } else {
                if ($billing === null){ //not exist
                    $name_shipping = Auth::user()->name;
                    $email_shipping = Auth::user()->email;
                } else { //exist
                    $name_shipping = $shipping->name;
                    $company_name_shipping = $shipping->company_name;
                    $street_address_shipping = $shipping->street_address;
                    $apartment_unit_shipping = $shipping->apartment_unit;
                    $town_city_shipping = $shipping->town_city;
                    $state_country_shipping = $shipping->state_country;
                    $post_zipcode_shipping = $shipping->post_zipcode;
                    $email_shipping = $shipping->email;
                    $phone_shipping = $shipping->phone;

                    $shipping_address_full =
                        $apartment_unit_shipping.", ".
                        $street_address_shipping.", ".
                        $town_city_shipping.", ".
                        $state_country_shipping.", ".
                        $post_zipcode_shipping.".";

                    //set to session, so no need to save if filled up
                    Session::put('s_address', [
                        'name_shipping' => $name_shipping,
                        'company_name_shipping' => $company_name_shipping,
                        'street_address_shipping' => $street_address_shipping,
                        'apartment_unit_shipping' => $apartment_unit_shipping,
                        'town_city_shipping' => $town_city_shipping,
                        'state_country_shipping' => $state_country_shipping,
                        'post_zipcode_shipping' => $post_zipcode_shipping,
                        'email_shipping' => $email_shipping,
                        'phone_shipping' => $phone_shipping
                    ]);
                }
            }

        } else { //not auth

            if (Session::has('b_address')) {
                $name_billing = Session::get('b_address')['name_billing'];
                $company_name_billing = Session::get('b_address')['company_name_billing'];
                $street_address_billing = Session::get('b_address')['street_address_billing'];
                $apartment_unit_billing = Session::get('b_address')['apartment_unit_billing'];
                $town_city_billing = Session::get('b_address')['town_city_billing'];
                $state_country_billing = Session::get('b_address')['state_country_billing'];
                $post_zipcode_billing = Session::get('b_address')['post_zipcode_billing'];
                $email_billing = Session::get('b_address')['email_billing'];
                $phone_billing = Session::get('b_address')['phone_billing'];

                $billing_address_full =
                    $apartment_unit_billing.", ".
                    $street_address_billing.", ".
                    $town_city_billing.", ".
                    $state_country_billing.", ".
                    $post_zipcode_billing.".";
            }

            if (Session::has('s_address')) {
                $name_shipping = Session::get('s_address')['name_shipping'];
                $company_name_shipping = Session::get('s_address')['company_name_shipping'];
                $street_address_shipping = Session::get('s_address')['street_address_shipping'];
                $apartment_unit_shipping = Session::get('s_address')['apartment_unit_shipping'];
                $town_city_shipping = Session::get('s_address')['town_city_shipping'];
                $state_country_shipping = Session::get('s_address')['state_country_shipping'];
                $post_zipcode_shipping = Session::get('s_address')['post_zipcode_shipping'];
                $email_shipping = Session::get('s_address')['email_shipping'];
                $phone_shipping = Session::get('s_address')['phone_shipping'];

                $shipping_address_full =
                    $apartment_unit_shipping.", ".
                    $street_address_shipping.", ".
                    $town_city_shipping.", ".
                    $state_country_shipping.", ".
                    $post_zipcode_shipping.".";
            }
        }

    @endphp

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--18">
        <div class="ht__bradcaump__wrap d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="bradcaump__inner text-center brad__white">
                            <h2 class="bradcaump-title">Checkout</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('index') }}">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
                                <span class="breadcrumb-item active">service</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <section class="htc__checkout bg--white section-padding--lg">
        <!-- Checkout Section Start-->
        <div class="checkout-section">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 mb-30">

                        <!-- Checkout Accordion Start -->
                        <div id="checkout-accordion">

                            <!-- Checkout Method -->
                            @if(!Auth::check())
                                <div class="single-accordion">
                                    <a class="accordion-head" data-toggle="collapse" data-parent="#checkout-accordion" href="#checkout-method">1. checkout method</a>

                                    <div id="checkout-method" class="collapse show">
                                        <div class="checkout-method accordion-body fix">

                                            <ul class="checkout-method-list">
                                                <li class="active" data-form="checkout-login-form">Login</li>
                                                <li data-form="checkout-register-form">Register</li>
                                            </ul>

                                            <form action="{{ route('checkout.login') }}" method="POST" class="checkout-login-form">
                                                @csrf
                                                <div class="row">
                                                    <div class="input-box col-md-6 col-12 mb--20"><input type="email" placeholder="Email Address" name="email" required autocomplete="email"></div>
                                                    <div class="input-box col-md-6 col-12 mb--20"><input type="password" placeholder="Password" name="password" required autocomplete="password"></div>
                                                    <div class="input-box col-12"><input type="submit" value="Login"></div>
                                                </div>
                                            </form>

                                            <form action="{{ route('checkout.register') }}" method="POST" class="checkout-register-form">
                                                @csrf
                                                <div class="row">
                                                    <div class="input-box col-md-6 col-12 mb--20"><input type="text" placeholder="Your Name" name="name" required autocomplete="email"></div><!--name="name"-->
                                                    <div class="input-box col-md-6 col-12 mb--20"><input type="email" placeholder="Email Address" name="email" required autocomplete="email"></div><!--name="email"-->
                                                    <div class="input-box col-md-6 col-12 mb--20"><input type="password" placeholder="Password" name="password" required></div><!--name="password"-->
                                                    <div class="input-box col-md-6 col-12 mb--20"><input type="password" placeholder="Confirm Password" name="password_confirmation" required></div><!--name="password_confirmation"-->
                                                    <div class="input-box col-12"><input type="submit" value="Register"></div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                </div>
                            @endif

                            <!-- Billing Method -->
                            <div class="single-accordion">
                                <a class="accordion-head collapsed" data-toggle="collapse" data-parent="#checkout-accordion" href="#billing-method">{{ (!Auth::check())  ? '2' : '1' }}. billing information</a>
                                <div id="billing-method" class="collapse">

                                    <div class="accordion-body billing-method fix">
                                        <h5>Billing Address: </h5>
                                        <p>{{--<span>address&nbsp;</span>--}}&emsp;&emsp; {{ $billing_address_full }}</p>
                                        <br/>

                                        <form action="{{ route('billing.address') }}" class="billing-form checkout-form" method="POST">
                                            @csrf
                                            <div class="row">
                                                {{--<div class="col-12 mb--20">
                                                    <select>
                                                        <option value="1">Select a country</option>
                                                        <option value="2">bangladesh</option>
                                                        <option value="3">Algeria</option>
                                                        <option value="4">Afghanistan</option>
                                                        <option value="5">Ghana</option>
                                                        <option value="6">Albania</option>
                                                        <option value="7">Bahrain</option>
                                                        <option value="8">Colombia</option>
                                                        <option value="9">Dominican Republic</option>
                                                    </select>
                                                </div>--}}
                                                <div class="col-md-12 col-12 mb--20">
                                                    <input type="text" placeholder="First Name" name="name_billing" value="{{ $name_billing }}">
                                                </div>
                                                {{--<div class="col-md-6 col-12 mb--20">
                                                    <input type="text" placeholder="Last Name">
                                                </div>--}}
                                                <div class="col-12 mb--20">
                                                    <input type="text" placeholder="Company Name" name="company_name_billing" value="{{ $company_name_billing }}">
                                                </div>
                                                <div class="col-12 mb--20">
                                                    <input placeholder="Street address" type="text" name="street_address_billing" required value="{{ $street_address_billing }}">
                                                </div>
                                                <div class="col-12 mb--20">
                                                    <input placeholder="Apartment, suite, unit etc." type="text" name="apartment_unit_billing" required value="{{ $apartment_unit_billing }}">
                                                </div>
                                                <div class="col-12 mb--20">
                                                    <input placeholder="Town / City" type="text" name="town_city_billing" required value="{{ $town_city_billing }}">
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <input type="text" placeholder="State / County" name="state_country_billing" value="{{ $state_country_billing }}">
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <input placeholder="Postcode / Zip" type="text" name="post_zipcode_billing" required value="{{ $post_zipcode_billing }}">
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <input type="email" placeholder="Email Address" name="email_billing" value="{{ $email_billing }}">
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <input placeholder="Phone Number" type="text" name="phone_billing" value="{{ $phone_billing }}">
                                                </div>
                                            </div>
                                            <br/>
                                            <ul>
                                                <li><button type="submit" class="food__btn">Save</button></li></ul>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Method -->
                            <div class="single-accordion">
                                <a class="accordion-head collapsed" data-toggle="collapse" data-parent="#checkout-accordion" href="#shipping-method">{{ (!Auth::check())  ? '3' : '2' }}. shipping information</a>
                                <div id="shipping-method" class="collapse">
                                    <div class="accordion-body shipping-method fix">

                                        <h5>shipping address: </h5>
                                        <p>{{--<span>address&nbsp;</span>--}}&emsp;&emsp; {{ $shipping_address_full }}</p>
                                        <br/>
                                        <button class="shipping-form-toggle">Ship to a different address?</button>

                                        <form action="{{ route('shipping.address') }}" class="shipping-form checkout-form" method="POST">
                                            @csrf
                                            <div class="row">
                                                {{--<div class="col-12 mb--20">
                                                    <select>
                                                        <option value="1">Select a country</option>
                                                        <option value="2">bangladesh</option>
                                                        <option value="3">Algeria</option>
                                                        <option value="4">Afghanistan</option>
                                                        <option value="5">Ghana</option>
                                                        <option value="6">Albania</option>
                                                        <option value="7">Bahrain</option>
                                                        <option value="8">Colombia</option>
                                                        <option value="9">Dominican Republic</option>
                                                    </select>
                                                </div>--}}
                                                <div class="col-md-12 col-12 mb--20">
                                                    <input type="text" placeholder="First Name" name="name_shipping" value="{{ $name_shipping }}">
                                                </div>
                                                {{--<div class="col-md-6 col-12 mb--20">
                                                    <input type="text" placeholder="Last Name">
                                                </div>--}}
                                                <div class="col-12 mb--20">
                                                    <input type="text" placeholder="Company Name" name="company_name_shipping" value="{{ $company_name_shipping }}">
                                                </div>
                                                <div class="col-12 mb--20">
                                                    <input placeholder="Street address" type="text" name="street_address_shipping" required value="{{ $street_address_shipping }}">
                                                </div>
                                                <div class="col-12 mb--20">
                                                    <input placeholder="Apartment, suite, unit etc." type="text" name="apartment_unit_shipping" required value="{{ $apartment_unit_shipping }}">
                                                </div>
                                                <div class="col-12 mb--20">
                                                    <input placeholder="Town / City" type="text" name="town_city_shipping" required value="{{ $town_city_shipping }}">
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <input type="text" placeholder="State / County" name="state_country_shipping" value="{{ $state_country_shipping }}">
                                                </div>
                                                <div class="col-md-6 col-12 mb--20">
                                                    <input placeholder="Postcode / Zip" type="text" name="post_zipcode_shipping" required value="{{ $post_zipcode_shipping }}">
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <input type="email" placeholder="Email Address" name="email_shipping" value="{{ $email_shipping }}">
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <input placeholder="Phone Number" type="text" name="phone_shipping" value="{{ $phone_shipping }}">
                                                </div>
                                            </div>
                                            <br/>
                                            <ul>
                                                <li><button type="submit" class="food__btn">Save</button></li></ul>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div class="single-accordion">
                                <a class="accordion-head" data-toggle="collapsed" data-parent="#checkout-accordion" href="#payment-method">{{ (!Auth::check())  ? '4' : '3' }}. Payment method</a>{{--class="accordion-head collapsed"--}}
                                <div id="payment-method"><!--class="collapse"-->
                                    <div class="accordion-body payment-method fix">

                                        <ul class="payment-method-list">
                                            <li class="paypal-form-toggle active">Paypal</li><br/>
                                            <li class="stripe-form-toggle">Stripe</li><br/>
                                        </ul>
                                    <!--paypal-->
                                        <form action="{{ route('checkout.paypal') }}" method="POST" class="paypal-form" id="paypalForm">
                                            @csrf
                                            <input type="hidden" readonly name="shipping_charge" value="{{ $site_setting->checkout_shipping_charge }}">
                                            <input type="hidden" readonly name="vat_amount" value="{{ $site_setting->checkout_vat }}">
                                            <input type="hidden" readonly name="phone_setting" value="{{ $site_setting->phone }}">
                                            <input type="hidden" readonly name="email_setting" value="{{ $site_setting->email }}">
                                            <input type="hidden" readonly name="logo_path_setting" value="{{ $site_setting->logo_path }}">
                                            <br/>
                                            <div style="text-align: center;"><img src="{{ asset('frontend') }}/images/payment/PayPal.png" alt="images" style="width: 300px; height: 140px;"></div>
                                            <br/><br/>
                                            <div id="paypal_div" style="text-align: center;">
                                                <ul><li><button type="submit" id="paypalButton" class="food__btn">place order</button></li></ul>
                                            </div>
                                        </form>
                                    <!--/paypal-->
                                    <!--stripe-->
                                        <form action="{{ route('checkout.stripe') }}" class="stripe-form" method="POST" id="paymentForm">
                                            @csrf
                                            <input type="hidden" readonly name="shipping_charge" value="{{ $site_setting->checkout_shipping_charge }}">
                                            <input type="hidden" readonly name="vat_amount" value="{{ $site_setting->checkout_vat }}">
                                            <input type="hidden" readonly name="phone_setting" value="{{ $site_setting->phone }}">
                                            <input type="hidden" readonly name="email_setting" value="{{ $site_setting->email }}">
                                            <input type="hidden" readonly name="logo_path_setting" value="{{ $site_setting->logo_path }}">
                                            {{--is in stripe.blade
                                                <input type="hidden" name="payment_method" id="paymentMethod">--}}

                                            <div style="text-align: center;"><img src="{{ asset('frontend') }}/images/payment/Stripe.png" alt="images" style="width: 190px; height: 190px;"></div>

                                            {{--<div class="row">--}}

                                             <!-- Stripe Payment Gateway HTML, see css, html and js in views\frontend\payment\stripe.blade.php-->
                                             @include('frontend.payment.stripe')

                                            {{--</div>--}}
                                            <br/>
                                            <div id="stripe_div" style="text-align: center;">
                                                <ul>
                                                    <li><button type="submit" id="paymentButton" class="food__btn">place order</button></li></ul>
                                            </div>
                                        </form>
                                    <!--/stripe-->
                                    </div>
                                </div>
                            </div>

                        </div><!-- Checkout Accordion Start -->
                    </div>

                    <!-- Order Details -->
                    <div class="col-lg-6 col-12 mb-30">

                        <div class="order-details-wrapper">
                            <h2>your order
                                &nbsp;&nbsp;<a href="{{ route('show.cart') }}">
                                    <span style="font-size: 1.5em; color: white;">
                                          <i class="fa fa-pencil-square-o" title="Edit from Cart"></i>
                                    </span>
                                </a>
                            </h2>
                            <div class="order-details">
                                <form action="#">
                                    <ul>
                                        <li><p class="strong">product</p><p class="strong">total</p></li>

                                        @foreach($cart as $row)
                                            <li><p>
                                                    <a href="{{ url('menu-details/'.$row->id) }}">
                                                        {{ $row->name }}
                                                    </a>
                                                     x ({{ $row->qty }})</p><p>£{{ number_format(($row->qty*$row->price),2, '.', ',') }}</p></li>
                                        @endforeach
                                        <li><p class="strong">cart subtotal</p><p class="strong">£{{ Cart::subtotal() }}</p></li>
                                        <li><p class="strong">&emsp;&emsp;VAT</p><p class="strong">£{{ $vat }}</p></li>
                                        <li><p class="strong">&emsp;&emsp;Shipping Charge</p><p class="strong">£{{ $shipping_charge }}</p></li>
                                                {{--<input type="radio" name="order-shipping" id="flat" /><label for="flat">VAT £ {{ $shipping_charge }}</label><br />
                                                <input type="radio" name="order-shipping" id="free" /><label for="free">Shipping £ {{ $vat }} </label>--}}
                                            {{--</p></li>--}}
                                        <li><p class="strong">order total</p><p class="strong">£ {{$grandTotal}}</p></li>
                                        {{--<li><button class="food__btn">place order</button></li>--}}
                                    </ul>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div><!-- Checkout Section End-->
    </section>


    <!--post-data-->
    {{--<div id="messages"></div>
    <form data-route="{{ route('postData') }}" method="POST" id="form-data">
        @method('get')
        @csrf
        <input type="text" name="value" value="10">
        <input type="text" name="currency" value="GBP">

        <label>Name: </label>
        <input type="text" name="person_name"><br/>

        <label>Email: </label>
        <input type="email" name="person_email"><br/>

        <button type="submit" >Submit</button>

    </form>--}}
    <!--/post-data-->
@endsection

@push('script-bottom')
    {{--toggle place order button--}}
    <script type="text/javascript">
        /*---disable button upon click (paypal)---*/
        const paypalForm = document.getElementById('paypalForm'); //from form in blade, id of form
        const paypalButton = document.getElementById('paypalButton'); //from form in blade, id of submit button
        //disable button upon click
        $("#paypalButton").one('click', function (event) {
            event.preventDefault();
            //do something
            paypalForm.submit();
            $(this).prop('disabled', true);
        });
        /*---/disable button upon click (paypal)---*/

        $(document).ready(function(){

            /*original is from frontend\js\active.js*/
            function paymentMethodToggle(){
                var paymentMethodList = $('.payment-method-list li');

                var paypalFormToggle = $('.paypal-form-toggle');
                var stripeFormToggle = $('.stripe-form-toggle');

                var paypalForm = $('.paypal-form');
                var stripeForm = $('.stripe-form');
                paymentMethodList.on('click', function() {
                    paymentMethodList.removeClass('active');
                    $(this).addClass('active');

                    if( $(this).hasClass('paypal-form-toggle')) {
                        $("#paypal_div").show();
                        $("#stripe_div").hide();

                        paypalForm.slideDown();
                        stripeForm.slideUp();
                    } else if( $(this).hasClass('stripe-form-toggle')) {
                        $("#paypal_div").hide();
                        $("#stripe_div").show();

                        paypalForm.slideUp();
                        stripeForm.slideDown();
                    } else {
                        $("#paypal_div").show();
                        $("#stripe_div").hide();

                        paypalForm.slideDown();
                        stripeForm.slideUp();
                    }
                });
            }
            paymentMethodToggle();

        });
    </script>

  {{--  <script type="text/javascript">
        $(document).ready(function () {
            $('#paymentButton').on('click', function () {
                var myForm = $("#paymentForm");
                if (myForm) {
                    $(this).prop('disabled', true);
                    $(myForm).submit();
                }
            });
        });
    </script>--}}
    {{--<script>
        $(document).ready(function(){
        //$(function () {

            $('#form-data').submit(function (e) {
                //enableSpinner('Please wait...');

                var route = $('#form-data').data('route');//define action route in form

                var form_data = $(this); //all inputs
                $('.alert').remove();//remove old messages from <p class=alert>
                $.ajax({
                    type: 'GET',
                    url: route,
                    data:form_data.serialize(),
                    success: function (Response) {
                        console.log(Response); //display in F12 browser

                        //validation fails person_name
                        if (Response.person_name){
                            $('#messages').append('<p class="alert">'+Response.person_name+'</p>');
                        }
                        //validation fails person_email
                        if (Response.person_email){
                            $('#messages').append('<p class="alert">'+Response.person_email+'</p>');
                        }

                        //SUCCESS
                        if (Response.success){
                            $('#messages').append('<p class="alert">'+Response.success+'</p>');
                        }

                        //disableSpinner('loading');
                    }
                });

                //e.preventDefault(); //Prevent a link from opening the URL:, specially if you are using submit button
            });

        })
    </script>
--}}
@endpush
