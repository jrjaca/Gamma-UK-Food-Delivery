@extends('backend.layouts.app')

@section('title', 'List of Meal Type')

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
                <h4 class="mb-0 font-size-18">MEAL TYPE</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">List of Meal Types</li>
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

                    <h4 class="card-title">List of Meal Types</h4>
                    <p class="card-title-desc">You can edit, view, and delete the item here.</p>
                    {{--  id="datatable"   datatable-buttons--}}  <!--class="table-striped"-->
                    <table id="datatable-buttons" class="table table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($meal_types as $key => $row)
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>
                                        @if( $row->deleted_at == null )
                                            <a href="" data-toggle="modal" data-target="#editModal"
                                               data-mealid="{{ @$row->id }}"
                                               data-mealname="{{ @$row->name }}">
                                                <span style="font-size: 1.2em; color: Dodgerblue;">
                                                    <i class="fa fa-edit" title="Edit"></i>
                                                </span>
                                            </a>&nbsp;
                                        @endif

                                        @if( $row->deleted_at == null )
                                            <a href="{{ url('admin/meal-type/enablesoftdelete/'.$row->id) }}" id="sa-custom-enableSoftDelete">
                                                   <span style="font-size: 1.2em; color: Dodgerblue;">
                                                      <i class="fa fa-unlock" title="Temporarily delete"></i>
                                                   </span></a>
                                        @else
                                            <a href="{{ url('admin/meal-type/disablesoftdelete/'.$row->id) }}" id="sa-custom-disableSoftDelete">
                                                   <span style="font-size: 1.2em; color: Red;">
                                                      <i class="fa fa-lock" title="Restore"></i>
                                                   </span></a>
                                        @endif

                                        {{--<a href="{{ URL::to('admin/meal-type/delete/'.$row->id) }}" id="sa-custom-delete">
                                            <span style="font-size: 1.2em; color: Red;">
                                                  <i class="fa fa-trash" title="Delete"></i>
                                            </span>
                                        </a>--}}

                                    </td>
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

@push('script-bottom')

    <!-- validation -->
    <script src="{{ asset('backend') }}/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('backend') }}/js/pages/form-validation.init.js"></script>

    <!-- MODAL EDIT BUTTON LINK-->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Meal Type Update</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.meal-type.update') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body pd-20">

                        <input type="hidden" id="id" name="id" readonly>

                        <div  class="form-group col-lg-6">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" autocomplete="name" placeholder="Breakfast, Dinner, etc.." autofocus required/>
                            <div class="invalid-feedback">
                                Please provide name type.
                            </div>
                        </div>

                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                        <button type="button" class="btn btn-danger pd-x-20" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->

    <script>
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            //var recipient = button.data('whatever') // Extract info from data-* attributes
            var vMealId = button.data('mealid')
            var vMealName = button.data('mealname')

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('#id').val(vMealId)
            modal.find('#name').val(vMealName)
        })
    </script>
    <!-- /MODAL EDIT BUTTON LINK-->
@endpush
