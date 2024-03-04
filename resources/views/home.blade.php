@extends('layouts.app')

@section('title')
    {{--{{ $site_setting->main_title }} ||--}} Home
@endsection

@section('content')

    @push('css')
        <!-- DataTables -->
        <link href="{{ asset('backend') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend') }}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ asset('backend') }}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    @endpush

        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card overflow-hidden">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-3">
                                       {{-- <h5 class="text-primary">Profile Page</h5>--}}
                                        {{--<p>Skote Dashboard</p>--}}
                                        <div class="col-sm-12"> <!--4-->
                                            <div class="avatar-md profile-user-wid mb-4">
                                                <img src="{{ Gravatar::src(Auth::user()->email) }}"style="border-radius: 50%; width: 50px; height: 50px;" alt="" class="img-thumbnail rounded-circle">
                                            </div>
                                            <h5 class="font-size-15" style="white-space: nowrap;">{{ Auth::user()->name }}</h5>
                                            @if(Auth::user()->access_code == 1)
                                                <p class="text-muted mb-0">Administrator</p>
                                            @endif
                                            <p class="text-muted mb-0" style="font-size: 1em; white-space: nowrap;"><i class="zmdi zmdi-email"></i>&nbsp;&nbsp;&nbsp;{{ Auth::user()->email }}</p>
                                            <p class="text-muted mb-0" style="font-size: 1em; white-space: nowrap;"><i class="zmdi zmdi-phone"></i>&nbsp;&nbsp;&nbsp;{{ Auth::user()->phone_no }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end" style="text-align: right;">
                                    <img src="{{ asset('backend') }}/images/profile-img.png" alt="" class="img-fluid" style="width: 60%; height: 60%;">

                                </div>
                            </div>
                        </div>
                        {{--<div class="card-body pt-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <img src="{{ Gravatar::src(Auth::user()->email) }}"style="border-radius: 50%; width: 50px; height: 50px;" alt="" class="img-thumbnail rounded-circle">
                                    </div>
                                    <h5 class="font-size-15 text-truncate">{{ Auth::user()->name }}</h5>
                                    <p class="text-muted mb-0 text-truncate">Administrator</p>
                                </div>--}}

                                {{--<div class="col-sm-8">
                                    <div class="pt-4">

                                        <div class="row">
                                            <div class="col-6">
                                                <h5 class="font-size-15">
                                                    <a href="{{ route('admin.user.messages') }}" >{{ $data['total_messages'] }}</a>
                                                </h5>
                                                <p class="text-muted mb-0">Messages</p>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="font-size-15">
                                                    <a href="{{ route('admin.users') }}" >{{ $data['total_registered_users'] }}</a></h5>
                                                <p class="text-muted mb-0">Users</p>
                                            </div>
                                        </div>
                                        --}}{{--<div class="mt-4">
                                            <a href="" class="btn btn-primary waves-effect waves-light btn-sm">View Profile <i class="mdi mdi-arrow-right ml-1"></i></a>
                                        </div>--}}{{--
                                    </div>
                                </div>--}}
                            {{--</div>
                        </div>--}}
                    </div>
                </div>
            </div>

            <br/>
            <p style="text-align: center;">PURCHASED HISTORY</p>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <table id="paymentTbl" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"> <!--datatable-->
                        <thead>
                        <tr>
                            <th></th>
                            <th style="text-align: center;">Date of Purchased</th>
                            <th style="text-align: center;">Total Amount</th>
                            <th style="text-align: center;">Payment Status</th>
                            <th style="text-align: center;">Stage</th>
                            <th style="text-align: center;">Tracking No.</th>
                            <th style="text-align: center;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payment_details as $key=>$row)
                            <tr>
                                <td style="text-align: center;">{{ $key +1 }}</td>
                                <td style="text-align: center;">{{ date('M d, Y', strtotime($row->created_at)) }}</td>
                                <td scope="col" style="text-align: right;">{{ $row->total_amount }}</td>
                                <td style="text-align: center;">
                                    @php
                                        $statusCode = $row->status_code;

                                        $payment_stat = strtoupper($row->payment_status);
                                        $payment_desc = strtoupper($row->payment_status);
                                        if ($payment_stat == "SUCCEEDED" || $payment_stat == "COMPLETED"){ //Paypal and Stripe status
                                            $payment_desc = "SUCCEEDED";
                                        }
                                    @endphp

                                    @if( $payment_stat == "SUCCEEDED" || $payment_stat == "COMPLETED")
                                        <span class="badge badge-success">{{ $payment_desc }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $payment_desc }}</span>
                                    @endif
                                </td>

                                <td scope="col" style="text-align: center;">
                                    @if( $row->status_code == 0 )
                                        <span class="badge badge-warning">IN-PROCESS</span>
                                    @elseif( $row->status_code == 1 )
                                        <span class="badge badge-primary">ACCEPTED</span>
                                    @elseif( $row->status_code == 2 )
                                        <span class="badge badge-secondary">FOR DELIVERY</span>
                                    @elseif( $row->status_code == 3 )
                                        <span class="badge badge-success">DELIVERED</span>
                                    @elseif( $row->status_code == 4 )
                                        <span class="badge badge-danger">CANCELLED</span>
                                    @elseif( $row->status_code == 5 )
                                        <span class="badge badge-info">RETURNED</span>
                                        {{--@elseif( $row->status_code == 6 )
                                            <span class="badge badge-info">Returned</span>--}}
                                    @else
                                        <span class="badge badge-dark">NO STATUS</span>
                                    @endif
                                </td>
                                <td scope="col" style="text-align: center;">{{ $row->tracking_code }}</td>
                                <td style="text-align: center;">

                                    <a href="javascript:void(0)" onclick='showOrderDetails({{$row->id}});'> <!--class="btn btn-sm btn-info"-->
                                        <span style="font-size: 1.2em; color: Dodgerblue;">
                                              <i class="fa fa-search" title="Show order details"></i>
                                        </span>
                                    </a>&nbsp;

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--</form>--}}
                </div>
            </div>
        </div>
        <br />

   {{-- <br />
    <a href="javascript:;" class="btn2" onclick="enableSpinner('Loading...');">Loading Spinner</a><br />--}}

    @push('script')

        <!-- Required datatable js -->
        <script src="{{ asset('backend') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('backend') }}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('backend') }}/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{{ asset('backend') }}/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="{{ asset('backend') }}/libs/jszip/jszip.min.js"></script>
        <script src="{{ asset('backend') }}/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="{{ asset('backend') }}/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="{{ asset('backend') }}/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="{{ asset('backend') }}/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="{{ asset('backend') }}/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

        <!-- Responsive examples -->
        <script src="{{ asset('backend') }}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{ asset('backend') }}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="{{ asset('backend') }}/js/pages/datatables.init.js"></script>

        <!-- For Datepicker date format / showOrderDetails-->
        <script src="{{ asset('js') }}/jquery-ui.min.js"></script>

    @endpush

    @push('script-bottom')

        <script>
            $(document).ready(function() {
                $('#paymentTbl').DataTable( {
                    "searching": false,
                    //"paging":   false,
                    //"ordering": false,
                    //"info":     false
                } );
            } );
        </script>

        {{-- <div id="productModal" class="modal fade"><!-- modal -->
             <div class="modal-dialog modal-lg" role="document">!-- modal-dialog -->
                 <div class="modal-content tx-size-sm"><!-- modal-dialog -->
                     <div class="modal-header pd-x-20">--}}

        <!-- Order Details Modal -->
        <div id="orderDetails" class="modal fade orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <p class="mb-1">User Name: <span class="text-primary" id="user_name"></span></p>
                        <p class="mb-1">Email / Phone: <span class="text-primary" id="user_email"></span>&nbsp;/&nbsp;<span class="text-primary" id="user_phone_no"></span></p>
                        <hr>
                        <p class="mb-1">Date of Payment: <span class="text-primary" id="pay_payment_date"></span></p>
                        <p class="mb-1">Payment Type / Status: <span class="text-primary" id="pay_payment_type"></span>&nbsp;/&nbsp;
                            <span id="pay_payment_status"></span></p>
                        <p class="mb-1">Payment ID : <span class="text-primary" id="pay_payment_id"></span></p>
                        {{--<p class="mb-1">Order ID: <span class="text-primary"  id="pay_order_id"></span></p>--}}
                        <p class="mb-1">Tracking No. / Stage: <span class="text-primary" id="pay_tracking_code"></span>&nbsp;/&nbsp;<span id="pay_status_code">d</span></p>
                        <hr>

                        <p class="mb-1">Billing Details:<br/>
                            &emsp;&emsp;Name: <span class="text-primary" id="b_name"></span><br/>
                            &emsp;&emsp;Email / Phone: <span class="text-primary" id="b_email"></span>&nbsp;/&nbsp;<span class="text-primary" id="b_phone"></span><br/>
                            &emsp;&emsp;Company Name: <span class="text-primary" id="b_company_name"></span><br/>
                            &emsp;&emsp;Address: <span class="text-primary" id="bfull_address"></span>
                        </p><br/>
                        <p class="mb-1">Shipping Details:<br/>
                            &emsp;&emsp;Name: <span class="text-primary" id="s_name"></span><br/>
                            &emsp;&emsp;Email / Phone: <span class="text-primary" id="s_email"></span>&nbsp;/&nbsp;<span class="text-primary" id="s_phone"></span><br/>
                            &emsp;&emsp;Company Name: <span class="text-primary" id="s_company_name"></span><br/>
                            &emsp;&emsp;Address: <span class="text-primary" id="sfull_address"></span>
                            <br/>
                        </p>

                        <br />
                        <div class="table-responsive">
                            <div id="someContainer">
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Order Details Modal -->

            <script>

                /*<!-- Order Details Script -->*/
                function showOrderDetails(payment_id){
                    spinner('Loading...');
                    $.ajax({
                        type:"GET",
                        url: "{{ url('order/details/') }}"+"/"+payment_id,
                        dataType: "json",
                        cache: false,
                        success: function(result){
                            //alert(JSON.stringify(result));
                            //------ result[0] = Get the first only ---------//
                            $('#user_name').html(result[0]['user_name']);
                            $('#user_email').html(result[0]['user_email']);
                            $('#user_phone_no').html(result[0]['user_phone_no']);

                            var datePay = $.datepicker.formatDate( "MM dd, yy", new Date(result[0]['pay_payment_date']));
                            $('#pay_payment_date').html(datePay);
                            $('#pay_payment_type').html(result[0]['pay_payment_type']);

                            var payStatusCode = result[0]['pay_payment_status'];
                            var payment_stat = payStatusCode.toUpperCase();
                            var payment_desc = payStatusCode.toUpperCase();
                            if (payment_stat == "SUCCEEDED" || payment_stat == "COMPLETED"){ //stripe and paypal status
                                $('#pay_payment_status').html(payment_desc);
                                $('#pay_payment_status').removeClass().addClass('badge badge-success');
                            } else {
                                $('#pay_payment_status').html(payment_desc);
                                $('#pay_payment_status').removeClass().addClass('badge badge-danger');
                            }

                            $('#pay_payment_id').html(result[0]['pay_payment_id']);
                            /*$('#pay_order_id').html(result[0]['pay_order_id']);*/

                            $('#pay_tracking_code').html(result[0]['pay_tracking_code']);

                            var stageCode = result[0]['pay_status_code'];
                            if (stageCode == 0){
                                $('#pay_status_code').html('NEW');
                                $('#pay_status_code').removeClass().addClass('badge badge-warning');
                            } else if (stageCode == 1){
                                $('#pay_status_code').html('ACCEPTED');
                                $('#pay_status_code').removeClass().addClass('badge badge-primary');
                            } else if (stageCode == 2){
                                $('#pay_status_code').html('FOR DELIVERY');
                                $('#pay_status_code').removeClass().addClass('badge badge-secondary');
                            } else if (stageCode == 3){
                                $('#pay_status_code').html('DELIVERED');
                                $('#pay_status_code').removeClass().addClass('badge badge-success');
                            } else if (stageCode == 4){
                                $('#pay_status_code').html('CANCELLED');
                                $('#pay_status_code').removeClass().addClass('badge badge-danger');
                            } else if (stageCode == 5){
                                $('#pay_status_code').html('RETURNED');
                                $('#pay_status_code').removeClass().addClass('badge badge-info');
                            } else {
                                $('#pay_status_code').html('NO STATUS');
                                $('#pay_status_code').removeClass().addClass('badge badge-dark');
                            }

                            var b_apartment_unit = result[0]['b_apartment_unit']+", ";
                            if (result[0]['b_apartment_unit'] == "" || result[0]['b_apartment_unit'] == null){ b_apartment_unit = ""; }
                            var b_street_address = result[0]['b_street_address']+", ";
                            if (result[0]['b_street_address'] == "" || result[0]['b_street_address'] == null){ b_street_address = ""; }
                            var b_town_city = result[0]['b_town_city']+", ";
                            if (result[0]['b_town_city'] == "" || result[0]['b_town_city'] == null){ b_town_city = ""; }
                            var b_state_country = result[0]['b_state_country']+", ";
                            if (result[0]['b_state_country'] == "" || result[0]['b_state_country'] == null){ b_state_country = ""; }
                            var b_post_zipcode = result[0]['b_post_zipcode'];
                            $('#b_name').html(result[0]['b_name']);
                            $('#b_email').html(result[0]['b_email']);
                            $('#b_phone').html(result[0]['b_phone']);
                            $('#b_company_name').html(result[0]['b_company_name']);
                            $('#bfull_address').html(
                                b_apartment_unit+
                                b_street_address+
                                b_town_city+
                                b_state_country+
                                b_post_zipcode
                            );

                            var s_apartment_unit = result[0]['s_apartment_unit']+", ";
                            if (result[0]['s_apartment_unit'] == "" || result[0]['s_apartment_unit'] == null){ s_apartment_unit = ""; }
                            var s_street_address = result[0]['s_street_address']+", ";
                            if (result[0]['s_street_address'] == "" || result[0]['s_street_address'] == null){ s_street_address = ""; }
                            var s_town_city = result[0]['s_town_city']+", ";
                            if (result[0]['s_town_city'] == "" || result[0]['s_town_city'] == null){ s_town_city = ""; }
                            var s_state_country = result[0]['s_state_country']+", ";
                            if (result[0]['s_state_country'] == "" || result[0]['s_state_country'] == null){ s_state_country = ""; }
                            var s_post_zipcode = result[0]['s_post_zipcode'];
                            $('#s_name').html(result[0]['s_name']);
                            $('#s_email').html(result[0]['s_email']);
                            $('#s_phone').html(result[0]['s_phone']);
                            $('#s_company_name').html(result[0]['s_company_name']);
                            $('#sfull_address').html(
                                s_apartment_unit+
                                s_street_address+
                                s_town_city+
                                s_state_country+
                                s_post_zipcode
                            );

                            /*---- order details table ----*/
                            var urlImg = "";
                            var tableBody="<table class='table table-centered table-nowrap'>";
                            tableBody+="<thead><tr>";
                            tableBody+="<th scope='col'>Product</th>";
                            tableBody+= "<th scope='col'>Product Name</th>";
                            tableBody+= "<th scope='col'>Price</th>";
                            tableBody+="</tr></thead><tbody>";
                            for(var i=0; i < result.length; i++){
                                urlImg = "{{ asset('') }}"+result[i].image_path;
                                tableBody+="<tr>";
                                tableBody+="<th scope='row'>";
                                tableBody+="<div>";
                                tableBody+="<a href='{{ url('') }}"+"/menu-details/"+result[i].meal_id+"'>";
                                tableBody+="<img src='"+urlImg+"' height='50px' width='65px' alt=''>";
                                tableBody+="</a>";
                                tableBody+="</div>";
                                tableBody+="</th>";

                                tableBody+="<td>";
                                tableBody+="<div>";
                                tableBody+="<h5 class='text-truncate font-size-14'>";
                                tableBody+="<a href='{{ url('') }}"+"/menu-details/"+result[i].meal_id+"'>";
                                tableBody+=result[i].meal_name;
                                tableBody+="</a>";
                                tableBody+="</h5>";
                                tableBody+="<p class='text-muted mb-0'>";
                                tableBody+='£'+result[i].price_single+' x '+result[i].quantity;
                                tableBody+="</p>";
                                tableBody+="</div>";
                                tableBody+="</td>";

                                tableBody+="<td>";
                                tableBody+='£'+result[i].price_total;
                                tableBody+="</td>";
                                tableBody+="</tr>";
                            }

                            tableBody+="<tr>";
                            tableBody+="<td colspan='2'>";
                            tableBody+="<h6 class='m-0 text-right'>Sub Total:</h6>";
                            tableBody+="</td>";
                            tableBody+="<td>";
                            tableBody+='£'+result[0].pay_subtotal_amount;
                            tableBody+="</td>";
                            tableBody+="</tr>";

                            tableBody+="<tr>";
                            tableBody+="<td colspan='2'>";
                            tableBody+="<h6 class='m-0 text-right'><i>Shipping:</i></h6>";
                            tableBody+="</td>";
                            tableBody+="<td><i>";
                            tableBody+='£'+result[0].pay_shipping_charge;
                            tableBody+="</i></td>";
                            tableBody+="</tr>";

                            tableBody+="<tr>";
                            tableBody+="<td colspan='2'>";
                            tableBody+="<h6 class='m-0 text-right'><i>VAT:</i></h6>";
                            tableBody+="</td>";
                            tableBody+="<td><i>";
                            tableBody+='£'+result[0].pay_vat_amount;
                            tableBody+="</i></td>";
                            tableBody+="</tr>";

                            tableBody+="<tr>";
                            tableBody+="<td colspan='2'>";
                            tableBody+="<h6 class='m-0 text-right'><b>Total:</b></h6>";
                            tableBody+="</td>";
                            tableBody+="<td><b>";
                            tableBody+='£'+result[0].pay_total_amount;
                            tableBody+="</b></td>";
                            tableBody+="</tr>";

                            tableBody+='</tbody></table>';
                            $('#someContainer').html(tableBody);
                            /*---- /order details table ----*/

                            // Display Modal
                            $('#orderDetails').modal('show');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        },
                    });
                }
                /*<!-- /Order Details Script -->*/

            </script>

    @endpush
@endsection
