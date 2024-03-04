@extends('layouts.app')

@section('title')
    {{--{{ $site_setting->main_title }} ||--}} Order Details
@endsection

@section('content')

<br /><br />
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-12 mb-30"> <!--sidenav-->
            <h4>PAYMENT DETAILS</h4> <br/><br/>

            {{--$payment_detail =  $this->getUserPurchasedByPaymentId($payment_id);
            $table->string('balance_transaction')->nullable();
            $table->string('payment_status')->nullable()->comment('returned status from api of paypal and stripe');   stripe_status->payment_status
            $table->string('vat_amount')->nullable();
            $table->string('subtotal_amount');
            $table->integer('status_code')->default(0)->comment('0-new, 1-Payment accepted, 2-for delivery, 3-delivered, 4-canceled, 5-for return')--}}
            <h5><strong>Payment ID:</strong></h5>
            <p style="font-style: italic">{{ $payment_detail->payment_id }}</p> <br/>

            <h5><strong>Payment Type:</strong></h5>
            <p style="font-style: italic">{{ $payment_detail->payment_type }}</p> <br/>

            <h5><strong>Order ID:</strong></h5>
            <p style="font-style: italic">{{ $payment_detail->order_id }}</p> <br/>

            <h5><strong>Shipping Charge:</strong></h5>
            <p style="font-style: italic">£{{ $payment_detail->shipping_charge }}</p> <br/>

            <h5><strong>VAT:</strong></h5>
            <p style="font-style: italic">£{{ $payment_detail->vat_amount }}</p> <br/>

            <h5><strong>Total Amount:</strong></h5>
            <p style="font-style: italic">£{{ $payment_detail->total_amount }}</p> <br/>

            <h5><strong>Tracking Code:</strong></h5>
            <p style="font-style: italic">{{ $payment_detail->tracking_code }}</p> <br/>

            <h5><strong>Date of Payment:</strong></h5>
            <p style="font-style: italic">{{ date('M d, Y', strtotime($payment_detail->payment_date)) }}</p> <br/>


            @php
                $b_apartment_unit = $order_billing_address['apartment_unit'].', ';
                if ($b_apartment_unit == ", "){ $b_apartment_unit = ""; }
                $b_street_address = $order_billing_address['street_address'].', ';
                if ($b_street_address == ", "){ $b_street_address = ""; }
                $b_town_city = $order_billing_address['town_city'].', ';
                if ($b_town_city == ", "){ $b_town_city = ""; }
                $b_state_country = $order_billing_address['state_country'].', ';
                if ($b_state_country == ", "){ $b_state_country = ""; }
                $b_post_zipcode = $order_billing_address['post_zipcode'];
                $b_address = $b_apartment_unit.$b_street_address.$b_town_city.$b_state_country.$b_post_zipcode;

                $s_apartment_unit = $order_shipping_address['apartment_unit'].', ';
                if ($s_apartment_unit == ", "){ $s_apartment_unit = ""; }
                $s_street_address = $order_shipping_address['street_address'].', ';
                if ($s_street_address == ", "){ $s_street_address = ""; }
                $s_town_city = $order_shipping_address['town_city'].', ';
                if ($s_town_city == ", "){ $s_town_city = ""; }
                $s_state_country = $order_shipping_address['state_country'].', ';
                if ($s_state_country == ", "){ $s_state_country = ""; }
                $s_post_zipcode = $order_shipping_address['post_zipcode'];
                $s_address = $s_apartment_unit.$s_street_address.$s_town_city.$s_state_country.$s_post_zipcode;
            @endphp

            <h5><strong>Billing Details:</strong></h5>
            <p style="font-style: italic">
                &emsp;&nbsp;<b>Name:</b> {{ $order_billing_address['name'] }}<br />
                &emsp;&nbsp;<b>Email:</b> {{ $order_billing_address['email'] }}<br />
                &emsp;&nbsp;<b>Phone No.:</b> {{ $order_billing_address['phone'] }}<br />
                &emsp;&nbsp;<b>Company Name:</b> {{ $order_billing_address['company_name'] }}<br />
                &emsp;&nbsp;<b>Address:</b> {{ $b_address }}
            </p><br/>

            <h5><strong>Shipping Details:</strong></h5>
            <p style="font-style: italic">
                &emsp;&nbsp;<b>Name:</b> {{ $order_shipping_address['name'] }}<br />
                &emsp;&nbsp;<b>Email:</b> {{ $order_shipping_address['email'] }}<br />
                &emsp;&nbsp;<b>Phone No.:</b> {{ $order_shipping_address['phone'] }}<br />
                &emsp;&nbsp;<b>Company Name:</b> {{ $order_shipping_address['company_name'] }}<br />
                &emsp;&nbsp;<b>Address:</b> {{ $s_address }}
            </p><br/>

        </div>

        <div class="col-lg-8 col-12 mb-30">
            <h4>ORDER DETAILS{{--<small>Order Details</small>--}}</h4>
            <div style="text-align: right;"><a href="{{ route('home') }}">Back to list</a></div>
            <br/><br/>
            <div class="col-8 card">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Single Price</th>
                            <th scope="col">Total Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $subTotal = 0;
                        @endphp

                        @foreach($order_details as $key=>$row)
                            @php
                                $subTotal += str_replace(',', '', $row->price_total);
                            @endphp
                            <tr>
                                <th scope="row">{{ $key +1 }}</th>
                                {{--<td scope="col"></td>--}}
                                <td scope="col" style="text-align: center;">
                                    <a href="{{ url('menu-details/'.$row->meal_id) }}">
                                        <img src="{{ asset($row->image_path) }}" alt="popular food" style="width: 80px; height: 70px;">
                                    </a>
                                </td>
                                <td scope="col"><a href="{{ url('menu-details/'.$row->meal_id) }}">{{ $row->meal_name }}</a></td>
                                <td scope="col" style="text-align: center;">{{ $row->quantity }}</td>
                                <td scope="col" style="text-align: right;">{{ number_format(($row->price_single),2, '.', ',') }}</td>
                                <td scope="col" style="text-align: right;">{{ number_format(($row->quantity*$row->price_single),2, '.', ',') }}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <th></th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Subtotal:</td>
                                <td scope="col"><b>{{ number_format(($subTotal),2, '.', ',') }}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div> <br /><br /><br />
@endsection
