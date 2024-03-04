@extends('backend.layouts.app')

@section('title', 'Create New Food Type')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">FOOD TYPE</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.food-type.index') }}">List of Food Types</a></li>
                        <li class="breadcrumb-item active">Add New Food Type</li>
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

                    <h4 class="card-title mb-4">Add New</h4>
                    <form class="needs-validation repeater" action="{{ route('admin.food-type.store') }}" method="post" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div data-repeater-list="group-a">
                            <div data-repeater-item class="row">
                                {{--<div class="form-group col-lg-2">
                                    <label for="icon_path">Icon</label>
                                    <input type="file" class="form-control-file" id="icon_path" name="icon_path" required>
                                    <div class="invalid-feedback">
                                        Please provide icon.
                                    </div>
                                </div>--}}
                                <div class="form-group col-lg-1">
                                    <img src="" id="icon_prev" name="icon_prev">
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="icon_path">Icon</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="icon_path" required onchange="readUrlIcon(this);">
                                        <label class="custom-file-label" for="customFile" name="icon_path_label">Choose Image</label>

                                        <div class="invalid-feedback">
                                            Please provide icon.
                                        </div>
                                    </div>
                                </div>

                                <div  class="form-group col-lg-2">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" autocomplete="name" placeholder="Pizza, Bread & Bun, etc.." autofocus required/>
                                    <div class="invalid-feedback">
                                        Please provide name type.
                                    </div>
                                </div>

                                <div class="form-group col-lg-2">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control" autocomplete="description"></textarea>
                                </div>

                                {{--<div class="form-group col-lg-2">
                                    <label for="image_path">Image</label>
                                    <input type="file" class="form-control-file" id="image_path" name="image_path" required>
                                    <div class="invalid-feedback">
                                        Please provide image.
                                    </div>
                                </div>--}}

                                <div class="form-group col-lg-2">
                                    <label for="image_path">Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="image_path" required onchange="readUrlImage(this);">
                                        <label class="custom-file-label" for="customFile" name="image_path_label">Choose Image</label>
                                        <div class="invalid-feedback">
                                            Please provide image.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-lg-1">
                                    <img src="" id="image_prev" name="image_prev">
                                </div>

                                <div class="col-sm-1 align-self-center">
                                    <input data-repeater-delete type="button" class="btn btn-danger btn-block" value="Delete"/>
                                </div>
                            </div>

                        </div>
                        <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Add"/>

                        <hr>

                        <div class="text-center">
                            <button class="btn btn-danger" type="button" onclick='window.location.href=window.location.href' style="float: right;">Clear</button>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->

@endsection

@push('script')
    <!-- validation -->
        <script src="{{ asset('backend') }}/libs/parsleyjs/parsley.min.js"></script>
        <script src="{{ asset('backend') }}/js/pages/form-validation.init.js"></script>

    <!-- repeater -->
        <!-- form mask -->
        <script src="{{ asset('backend') }}/libs/jquery.repeater/jquery.repeater.min.js"></script>
        <!-- form mask init -->
        <script src="{{ asset('backend') }}/js/pages/form-repeater.int.js"></script>

    <!-- bs custom file input plugin -->
        <script src="{{ asset('backend') }}/libs/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <script src="{{ asset('backend') }}/js/pages/form-element.init.js"></script>
@endpush


@push('script-bottom')
    {{-- For viewing uploading at file--}}
    <script type="text/javascript">

        function readUrlIcon(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {

                    //$('#icon_prev')
                    /*$('[name="group-a[0]icon_prev"]')
                        .attr('src', e.target.result)
                        .width(40)
                        .height(55);*/

                    //alert(this.result); //src url long file
                    //alert(e.target.result);  src url long file
                    //alert(input.value); // actual full filename of image
                    //alert(input.name); // name of input/file

                    //Display image
                    //get index id of input/file
                    var regex = /\d+/g;
                    var string = input.name;
                    var indexId = string.match(regex);

                    document.getElementsByName("group-a["+indexId+"][icon_prev]")[0].src = e.target.result;
                    document.getElementsByName("group-a["+indexId+"][icon_prev]")[0].width = 65;
                    document.getElementsByName("group-a["+indexId+"][icon_prev]")[0].height = 50;

                    //get image filename and passed to label
                    var name = input.value.split('\\').pop();
                    //name=name.split('.')[0];
                    document.getElementsByName("group-a["+indexId+"][icon_path_label]")[0].innerHTML = name;

                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readUrlImage(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {

                    //Display image
                    //get index id of input/file
                    var regex = /\d+/g;
                    var string = input.name;
                    var indexId = string.match(regex);

                    document.getElementsByName("group-a["+indexId+"][image_prev]")[0].src = e.target.result;
                    document.getElementsByName("group-a["+indexId+"][image_prev]")[0].width = 65;
                    document.getElementsByName("group-a["+indexId+"][image_prev]")[0].height = 50;

                    //get image filename and passed to label
                    var name = input.value.split('\\').pop();
                    //name=name.split('.')[0];
                    document.getElementsByName("group-a["+indexId+"][image_path_label]")[0].innerHTML = name;

                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endpush

