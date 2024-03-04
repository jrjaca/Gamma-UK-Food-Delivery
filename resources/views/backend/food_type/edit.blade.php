@extends('backend.layouts.app')

@section('title', 'Edit Food Type')

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
                        <li class="breadcrumb-item active">Edit Food Type</li>
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

                    <h4 class="card-title mb-4">Update Info.</h4>
                    <form action="{{ route('admin.food-type.update') }}" method="POST" class="needs-validation repeater" enctype="multipart/form-data" novalidate>
                        @csrf

                        <input type="hidden" name="id" value="{{ $food_type->id }}" readonly/>
                        <div data-repeater-list="group-a">
                            <div data-repeater-item class="row">

                                {{--<div class="form-group col-lg-2">
                                    <input type="hidden" name="icon_path_old" readonly value="{{ $food_type->icon_path }}">
                                    <label for="icon_path_new">Icon</label>
                                    <input type="file" class="form-control-file" id="icon_path_new" name="icon_path_new" onchange="readUrlIcon(this);">
                                    <div class="col-lg-6 col-6-sm">
                                        <h5>New:</h5><img src="" id="icon_prev">
                                    </div><!-- col-6 -->
                                    <div class="col-lg-6 col-6-sm">
                                        <h5>Current:</h5><img src="{{ URL::to($food_type->icon_path) }}" height="40px" width="55px">
                                    </div><!-- col-6 -->
                                </div>--}}
                                <div class="form-group col-lg-3">
                                    <input type="hidden" name="icon_path_old" readonly value="{{ $food_type->icon_path }}">
                                    <label for="icon_path_new">Icon</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="icon_path_new" onchange="readUrlIcon(this);">
                                        <label class="custom-file-label" for="customFile">Choose Image</label>
                                        <div class="col-lg-6 col-6-sm">
                                            <h5>New:</h5><img src="" id="icon_prev">
                                        </div><!-- col-6 -->
                                        <div class="col-lg-6 col-6-sm">
                                            <h5>Current:</h5><img src="{{ asset($food_type->icon_path) }}" style="width: 95px; height: 80px;">
                                        </div><!-- col-6 -->
                                    </div>
                                </div>

                                <div  class="form-group col-lg-2">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ $food_type->name }}" autocomplete="name" placeholder="Pizza, Bread & Bun, etc.." autofocus required/>
                                    <div class="invalid-feedback">
                                        Please provide name type.
                                    </div>
                                </div>

                                <div class="form-group col-lg-2">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control" autocomplete="description" >{{ $food_type->description }}</textarea>
                                </div>

                                <div class="form-group col-lg-3">
                                    <input type="hidden" name="image_path_old" readonly value="{{ $food_type->image_path }}" style="width: 95px; height: 80px;">
                                    <label for="image_path_new">Image</label>
{{--
                                    <input type="file" class="form-control-file" id="image_path_new" name="image_path_new" onchange="readUrlImage(this);">
                                    <div class="col-lg-6 col-6-sm">
                                        <h5>New:</h5><img src="" id="image_prev">
                                    </div><!-- col-6 -->
                                    <div class="col-lg-6 col-6-sm">
                                        <h5>Current:</h5><img src="{{ URL::to($food_type->image_path) }}" height="80px" width="95px">
                                    </div><!-- col-6 -->
--}}
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="image_path_new"  onchange="readUrlImage(this);">
                                        <label class="custom-file-label" for="customFile">Choose Image</label>
                                        <div class="col-lg-6 col-6-sm">
                                            <h5>New:</h5><img src="" id="image_prev">
                                        </div><!-- col-6 -->
                                        <div class="col-lg-6 col-6-sm">
                                            <h5>Current:</h5><img src="{{ asset($food_type->image_path) }}" height="80px" width="95px">
                                        </div><!-- col-6 -->
                                    </div>
                                </div>


                                {{--<div class="col-lg-2 align-self-center">
                                    <input data-repeater-delete type="button" class="btn btn-danger btn-block" value="Delete"/>
                                </div>--}}
                            </div>

                        </div>

                        <br>
                        <hr>

                        {{--<input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Add"/>--}}
                        <div class="text-center">
                            <button class="btn btn-danger" type="button" onclick='window.location.href=window.location.href' style="float: right;">Refresh</button>
                            <button class="btn btn-primary" type="submit">Update</button>
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

    <!-- bs custom file input plugin -->
        <script src="{{ asset('backend') }}/libs/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <script src="{{ asset('backend') }}/js/pages/form-element.init.js"></script>

    {{--<!-- repeater -->
    <!-- form mask -->
    <script src="{{ asset('backend') }}/libs/jquery.repeater/jquery.repeater.min.js"></script>
    <!-- form mask init -->
    <script src="{{ asset('backend') }}/js/pages/form-repeater.int.js"></script>--}}
@endpush

@push('script-bottom')
    {{-- For viewing uploading at file--}}
    <script type="text/javascript">

        function readUrlImage(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image_prev')
                        .attr('src', e.target.result)
                        .width(95)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readUrlIcon(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#icon_prev')
                        .attr('src', e.target.result)
                        .width(95)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endpush


