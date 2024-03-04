@extends('layouts.app')

@section('title')
    {{ $site_setting->main_title }} Food Delivery || Cart
@endsection

@push('css-bottom')
    <style>
        /*Pages Cart Top Center - pages_cart_head_top_image_path*/
        .bg-image--18 {
            background-image: url({{ asset($site_setting->pages_cart_head_top_image_path) }});
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
                            <h2 class="bradcaump-title">Cart</h2>
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
    <!-- cart-main-area start -->
    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ol-lg-12">
                    {{--<form>--}}
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                <tr class="title-top">
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart as $row)
                                    <tr>
                                        <td class="product-thumbnail"><a href="{{ url('menu-details/'.$row->id) }}"><img src="{{ asset($row->options->image_path) }}" alt="product img" style="width: 80px; height: 70px;"/></a></td>
                                        <td class="product-name"><a href="{{ url('menu-details/'.$row->id) }}">{{ $row->name }}</a></td>
                                        <td class="product-price"><span class="amount">£{{ $row->price }}</span></td>
                                        <td class="product-quantity">
                                            <form action="{{ route('quantity.update.cart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="row_id" value="{{ $row->rowId }}" readonly/>
                                                <input type="hidden" name="old_qty" value="{{ $row->qty }}" readonly/>
                                                <input type="number" name="qty" value="{{ $row->qty }}" />
                                                &nbsp;
                                                <button class="btn" type="submit">
                                                    <span style="font-size: 1.3em; color: Dodgerblue;">
                                                          <i class="fa fa-check-square" title="Update quantity for {{ $row->name }}"></i>
                                                       </span>
                                                </button>
                                            </form>
                                        </td>
                                        <td class="product-subtotal">£{{ number_format(($row->qty*$row->price),2, '.', ',') }} </td>
                                        <td class="product-thumbnail"><!--product-remove-->
                                            <a href="{{ url('cart/product/remove/'.$row->rowId) }}">
                                               <span style="font-size: 2em; color: red;">
                                                  <i class="fa fa-minus-square" title="Remove {{ $row->name }}"></i>
                                               </span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="cartbox__btn">
                            <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                                {{--<li><a href="#">Coupon Code</a></li>
                                <li><a href="#">Apply Code</a></li>--}}
                                {{--<li></li>--}}
                                {{--<li><a href="#">Update Cart</a></li>--}}
                                {{--<button type="submit" class="btn btn-outline-primary btn-lg btn-block">Update Quantity</button>--}}
                                {{--<li><a href="#">Check Out</a></li>--}}
                            </ul>
                        </div>
                    {{--</form>--}}
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 offset-lg-6">
                    <div class="cartbox__total__area">
                        <div class="cartbox-total d-flex justify-content-between">
                            <ul class="cart__total__list">
                                <li>Cart total</li>
                                <li>&emsp;&emsp;VAT</li>
                                <li>&emsp;&emsp;Shipping Charge</li>
                                <li>Sub Total</li>
                            </ul>
                            <ul class="cart__total__tk">
                                <li>£{{ Cart::subtotal() }}</li>
                                <li>£{{ $vat }}</li>
                                <li>£{{ $shipping_charge }}</li>
                                <li>£{{ $vat +
                                        $shipping_charge }}</li>
                            </ul>
                        </div>
                        <div class="cart__total__amount">
                            <span>Grand Total</span>
                            <span>£{{ $grandTotal }}</span>
                        </div><br/>
                        {{--<button class="btn btn-outline-primary btn-lg btn-block">Checkout</button>--}}
                        <button class="btn btn-outline-primary btn-lg btn-block"
                            onclick="location.href='{{ route("show.checkout") }}'" type="button"> <!--onclick="window.location-->
                            Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area end -->

@endsection
