@extends('backend.layouts.app')

@section('title', 'List of Products')

@section('meta')
    <!-- For Multiple Delete in table -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@push('css')
    <!-- DataTables -->
    <link href="{{ asset('backend') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('backend') }}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">PRODUCTS</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">List of Products</h4>
                    <p class="card-title-desc">You can edit, view, temporary and permanently delete the product here.</p>

                    <button style="margin-bottom: 10px" class="btn btn-danger delete_all"
                            data-url="{{ url('admin/meal/delete-all-selected') }}">Delete All Selected</button>
                    <table id="datatable-buttons" class="table table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Select</th>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Food Type</th>
                            {{--<th>Meal Type</th>--}}
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody> {{--{{ dd($meals) }}--}}
                        @foreach($meals as $key => $row)
                            <tr id="tr_{{$row->id}}">
                                <td><input type="checkbox" class="sub_chk" data-id="{{$row->id}}"></td>
                                <td>{{ $key +1 }}</td>
                                <td>
                                    <img src="{{ asset($row->image_path) }}" height="50px" width="65px" alt="">
                                </td>
                                <td>{{ $row->name }}</td>
                                <td>{!! str_limit($row->description, $limit=20) !!}</td>
                                <td>{{ $row->food_type_name }}</td>
                                {{--<td>{{ $row->meal_type_name }}</td>--}}
                                <td>
                                    @if( $row->deleted_at == null )
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Temporarily Deleted</span>
                                    @endif
                                </td>
                                <td><!--URL::to('admin/show/product/'.$row->id)-->
                                    {{--<a href="#" onclick='showDetail({{$row->id}});'> <!--class="btn btn-sm btn-info"-->
                                        <span style="font-size: 1.2em; color: Dodgerblue;">
                                                      <i class="fa fa-eye" title="Show"></i>
                                                </span>
                                    </a>&nbsp;--}}
                                    <a href="{{ url('admin/meal/show/'.$row->id) }}">
                                        <span style="font-size: 1.2em; color: Dodgerblue;">
                                              <i class="fa fa-search" title="Show"></i>
                                        </span>
                                    </a>&nbsp;

                                    @if( $row->deleted_at == null )
                                        <a href="{{ url('admin/meal/edit/'.$row->id) }}" >
                                                <span style="font-size: 1.2em; color: Dodgerblue;">
                                                      <i class="fa fa-edit" title="Edit"></i>
                                                </span>
                                        </a>&nbsp;
                                    @endif

                                    @if( $row->deleted_at == null )
                                        <a href="{{ url('admin/meal/enablesoftdelete/'.$row->id) }}" id="sa-custom-enableSoftDelete">
                                                   <span style="font-size: 1.2em; color: Dodgerblue;">
                                                      <i class="fa fa-unlock" title="Temporarily delete"></i>
                                                   </span></a>
                                    @else
                                        <a href="{{ url('admin/meal/disablesoftdelete/'.$row->id) }}" id="sa-custom-disableSoftDelete">
                                                   <span style="font-size: 1.2em; color: Red;">
                                                      <i class="fa fa-lock" title="Restore"></i>
                                                   </span></a>
                                    @endif
                                    &nbsp;
                                    {{--<a href="{{ URL::to('admin/meal/delete/'.$row->id) }}" id="sa-custom-delete">
                                                <span style="font-size: 1.2em; color: Red;">
                                                      <i class="fa fa-trash" title="Permanently Delete"></i>
                                                </span>
                                    </a>--}}

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--</form>--}}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

@push('script')

    {{--<!-- Plugins js -->
    <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{ URL::asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>

    <!-- Init js-->
    <script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>--}}

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

@endpush

@push('script-bottom')
    <!-- SHOW SPECIFIC PRODUCT/MEAL-->
    <!-- LARGE MODAL -->
    {{--<div id="viewModal" class="modal fade"><!-- modal -->
        <div class="modal-dialog modal-lg" role="document">!-- modal-dialog -->
            <div class="modal-content tx-size-sm"><!-- modal-dialog -->
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">PRODUCT DETAILS</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20"><!-- modal-body -->

                    <div class="card pd-20 pd-sm-40 mg-t-25"><!-- card -->

                        --}}{{--<h6 class="card-body-title">Product Name</h6>
                        <p class="mg-b-20 mg-sm-b-30"><div class="product_name"></div></p>--}}{{--

                        <dl class="row">
                            <dt class="col-sm-3 tx-inverse">ID</dt>
                            <dd class="col-sm-9"><div class="id"></div></dd>

                            <dt class="col-sm-3 tx-inverse">Name</dt>
                            <dd class="col-sm-9"><div class="name"></div></dd>

                            --}}{{--<dt class="col-sm-3 tx-inverse">Icon</dt>
                            <dd class="col-sm-9"><img id="icon" height="40" width="55"/></dd>--}}{{--

                            --}}{{--<dt class="col-sm-3 tx-inverse">Details</dt>
                            <dd class="col-sm-9"><p><div class="description"></div></p></dd>

                            <dt class="col-sm-3 tx-inverse">Image</dt>
                            <dd class="col-sm-9"><img id="image"/></dd> --}}{{----}}{{--height="200px" width="250px"--}}{{--

                        </dl>
                    </div><!-- card -->

                </div><!-- modal-body -->
                <div class="modal-footer"><!-- modal-footer -->
                    --}}{{-- <button type="button" class="btn btn-info pd-x-20">Add new product</button>--}}{{--
                    <a href="{{ route('admin.meal.create') }}" class="btn btn-lg btn-success">Add New</a>
                    <a href="#" class="btn btn-lg btn-info" id="editId">Edit</a>
                    <a class="btn btn-lg btn-danger" style="color: white;" data-dismiss="modal">Close</a>
                </div><!-- modal-footer -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->

    <script type="text/javascript">
        function showDetail(meal_id)
        {
            $.ajax({
                type:"GET",
                url: "{{ url('admin/meal/show/') }}"+"/"+meal_id,
                dataType: "json",
                cache: false,
                success: function(result){

                    $('.id').html(result.id);
                    $('.name').html(result.name);
                    $('.name').html(result.name);

                    /*$( "div.description" ).html(result.description);

                    var vImage = result.image_path;
                    if (vImage != "") {
                        var imageUrl = location.protocol+'//'+location.hostname+
                            (location.port ? ':'+location.port: '')+'/'+vImage;
                        $("#image").attr('src', imageUrl);
                    }

                    var vIcon = result.icon_path;
                    if (vImage != "") {
                        var iconUrl = location.protocol+'//'+location.hostname+
                            (location.port ? ':'+location.port: '')+'/'+vIcon;
                        $("#icon").attr('src', iconUrl);
                    }*/

                    //<a> button, edit
                    var url = location.protocol+'//'+location.hostname+
                        (location.port ? ':'+location.port: '')+'/'+'admin/meal/edit/'+meal_id;
                    $("#editId").attr("href", url);

                    // Display Modal
                    $('#viewModal').modal('show');
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                },
            });
        }
    </script>--}}
    <!-- /SHOW SPECIFIC PRODUCT/MEAL-->

    <!-- DELETE SELECTED ITEMS-->
    <script type="text/javascript">
        $(document).ready(function () {

            $('#master').on('click', function(e) {
                if($(this).is(':checked',true))
                {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked',false);
                }
            });

            $('.delete_all').on('click', function(e) {

                var allVals = [];
                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });

                if(allVals.length <=0)
                {
                   alert("Please select row.");
                }  else {

                    var check = confirm("Are you sure you want to delete this row?");
                    if(check == true){

                        var join_selected_values = allVals.join(",");

                        $.ajax({
                            url: $(this).data('url'),
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {
                                if (data['success']) {

                                    window.location.reload(); //below will be no use

                                    $(".sub_chk:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    alert(data['success']);
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });


                        $.each(allVals, function( index, value ) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });

            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.trigger('confirm');
                }
            });

            $(document).on('confirm', function (e) {
                var ele = e.target;
                e.preventDefault();


                $.ajax({
                    url: ele.href,
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        if (data['success']) {
                            $("#" + data['tr']).slideUp("slow");
                            alert(data['success']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });

                return false;
            });
        });
    </script>
    <!-- /DELETE SELECTED ITEMS-->
@endpush
