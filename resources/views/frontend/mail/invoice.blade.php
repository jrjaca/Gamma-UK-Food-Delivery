<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $info['app_name'] }}</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>

    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0"
               style="border-top: solid 10px red;">
            <!-- DATE LOGO DETAILS-->
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset($info['logo_path_setting']) }}" style="width: 123px; height:72px;">
                            </td>

                            <td>
                                <p style="font-size:90%;">{{ date("F j, Y") }}</p><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- /DATE LOGO DETAILS-->

            <!--NAME ADDRESS DETAILS-->
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <b>Hi {{ $info['name_user'] }},</b><br/><br/>
                                <i style="font-size:90%;"><strong>Shipping Address:</strong><i><br/>
                                <i style="font-size:90%;">{{ $info['shipping_address_arr']['street_address_shipping'].', '.$info['shipping_address_arr']['apartment_unit_shipping'].', '.
                                         $info['shipping_address_arr']['town_city_shipping'].', '.$info['shipping_address_arr']['post_zipcode_shipping']
                                      }}</i><br/>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!--/NAME ADDRESS DETAILS-->

            <!--PAYMENT DETAILS-->
            <tr class="heading">
                <td>
                    Payment Details
                </td>
                <td></td>
            </tr>
                    <tr class="details">
                        <td>
                            Payment Type <br />
                            Payment ID <br />
                            Order ID <br />
                            Date of Payment <br />
                        </td>
                        <td>
                            {{ $info['payment_type'] }} <br />
                            {{ $info['payment_id'] }} <br />
                            {{ $info['order_id'] }} <br />
                            {{ date_format($info['payment_date'], "F j, Y") }} <br />
                        </td>
                    </tr>
            <!--/PAYMENT DETAILS-->

            <!--ITEMS-->
            <tr class="heading">
                <td>Item (Qty)</td>
                <td></td>
            </tr>
                    @foreach($info['cart_content_arr'] as $row)
                        <tr class="item">
                            <td>{{ $row->name."(x".$row->qty.")" }}</td>
                            <td>£{{ number_format(($row->qty*$row->price),2, '.', ',') }}</td>
                        </tr>
                    @endforeach
                    <tr class="item">
                        <td><i style="font-size:90%;">&emsp;&emsp;Shipping charge</i></td>
                        <td><i style="font-size:90%;">£{{ $info['shipping_charge'] }}</i></td>
                    </tr>
                    <tr class="item last">
                        <td><i style="font-size:90%;">&emsp;&emsp;VAT</i></td>
                        <td><i style="font-size:90%;">£{{ $info['vat_amount'] }}</i></td>
                    </tr>
                    <tr class="total">
                        <td></td>
                        <td>Total: £{{ $info['total_amount'] }}</td>
                    </tr>
            <!--/ITEMS-->
        </table><br />

        <p>Regards,</p> <br />
        <b>{{ $info['app_name'] }}</b><br /><br />

        <b style="font-size:80%;">Phone:</b> <i style="font-size:80%;">{{ $info['phone_setting'] }}</i><br />
        <b style="font-size:80%;">Email:</b> <i style="font-size:80%;">{{ $info['email_setting'] }}</i><br /><br />
    </div>
</body>
</html>
