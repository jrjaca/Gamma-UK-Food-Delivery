@extends('backend.layouts.app')

@section('title', 'List of Registered Users')

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
                <h4 class="mb-0 font-size-18">REGISTERED USER</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">List of Registered Users</li>
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

                    <!-- Start Display Error Message-->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show col-lg-10 text-left" role="alert" style="width: 50%; margin: 0 auto; margin-top: 1px; margin-bottom: 10px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                @endif
                <!-- END Display Error Message-->

                    <h4 class="card-title">List of Registered Users</h4>
                {{--  id="datatable"   datatable-buttons--}}  <!--class="table-striped"-->
                    <table id="datatable-buttons" class="table table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date Registered</th>
                            <th>Confirmed Email</th>
                            <th>Provider</th>
                            <th>Provider ID</th>
                            <th>Status</th>
                            {{--<th>Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $row)
                            <tr>
                                <td>{{ $key +1 }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone }}</td>
                                <td>{{ date('M d, Y', strtotime($row->created_at)) }}</td>
                                <td>
                                    @if($row->email_verified_at != null)
                                        {{ date('M d, Y', strtotime($row->email_verified_at)) }}
                                    @endif
                                </td>
                                <td>{{ $row->provider }}</td>
                                <td>{{ $row->provider_id }}</td>
                                <td>
                                    @if( $row->deleted_at == null )
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Temporarily Deleted</span>
                                    @endif
                                </td>

                                {{--<td>--}}
                                    {{--<a href="" data-toggle="modal" data-target="#editModal"
                                       data-mealid="{{ @$row->id }}"
                                       data-mealname="{{ @$row->name }}">
                                            <span style="font-size: 1.2em; color: Dodgerblue;">
                                                <i class="fa fa-edit" title="Edit"></i>
                                            </span>
                                    </a>&nbsp;
                                    <a href="{{ URL::to('admin/meal-type/delete/'.$row->id) }}" id="sa-custom-delete">
                                            <span style="font-size: 1.2em; color: Red;">
                                                  <i class="fa fa-trash" title="Delete"></i>
                                            </span>
                                    </a>--}}

                               {{-- </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
