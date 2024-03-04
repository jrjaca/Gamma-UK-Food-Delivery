@extends('backend.layouts.app')

@section('title', 'Create Product (Meal)')

@push('css')
    <!-- Form Advanced -->
        <link href="{{ asset('backend') }}/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend') }}/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="{{ asset('backend') }}/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="{{ asset('backend') }}/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
@endpush

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">PRODUCT (MEAL)</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.meal.index') }}">List of Products</a></li>
                        <li class="breadcrumb-item active">Add New Meal</li>
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
                        <div class="alert alert-danger alert-dismissible fade show col-lg-10 text-left" role="alert"
                            style="width: 50%; margin: 0 auto; margin-top: 1px; margin-bottom: 10px;">
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

                    <form class="needs-validation outer-repeater" action="{{ route('admin.meal.store') }}" method="post" enctype="multipart/form-data" novalidate>
                        @csrf

                        <h4 class="card-title mb-4">Add New</h4>
                        <div data-repeater-list="outer-group" class="outer">
                            <div data-repeater-item class="outer">

                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label for="name">Name<span style="color: red;">*</span> :</label>
                                        <input type="text" class="form-control" id="name" name="name" autocomplete="name" placeholder="Enter a name..." autofocus required>
                                        <div class="invalid-feedback">
                                            Please provide name.
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label class="control-label">Food Type<span style="color: red;">*</span> :</label>
                                        <select class="form-control select2-search-disable" name="food_type_id"
                                                data-placeholder="Select..."  required style="width: 100%"> <!--select2-search-disable-->
                                            <option value="">Select...</option>
                                            @foreach($food_types as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please provide food type.
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label class="control-label">Meal Type (Choose 1 or more.)<span style="color: red;">*</span> :</label>
                                        <select class="select2 form-control select2-multiple" multiple="multiple" name="meal_type_id"
                                                data-placeholder="Choose..." required style="width: 100%">
                                            <option value="">Choose...</option>
                                            @foreach($meal_types as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please provide name.
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label for="description">Description<span style="color: red;">*</span> :</label>
                                        <textarea class="form-control" id="description" name="description" autocomplete="description" required></textarea>
                                        <div class="invalid-feedback">
                                            Please provide description.
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label for="regular_price">Regular Price<span style="color: red;">*</span> :</label>
                                        <input id="regular_price" class="form-control input-mask text-left" name="regular_price" placeholder="0.00" maxlength="9"
                                               data-inputmask="'alias': 'numeric', 'placeholder': '0.00'" required>{{--'digits': 2,--}}
                                        {{--'prefix': '$ ',--}}   {{--data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"--}}
                                        <div class="invalid-feedback">
                                            Please provide regular price.
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label for="discounted_price">Discounted Price :</label>
                                        <input id="discounted_price" class="form-control input-mask text-left" name="discounted_price" placeholder="0.00" maxlength="9"
                                               data-inputmask="'alias': 'numeric', 'placeholder': '0.00'">{{--'digits': 2,--}}
                                        <div class="invalid-feedback">
                                            Discounted Price.
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label for="delivery_cost">Delivery Cost :</label>
                                        <input id="delivery_cost" class="form-control input-mask text-left" name="delivery_cost" placeholder="0.00" maxlength="9"
                                               data-inputmask="'alias': 'numeric', 'placeholder': '0.00'">{{--'digits': 2,--}}
                                        <div class="invalid-feedback">
                                            Delivery Cost.
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label for="delivery_time">Delivery Time(min) :</label>
                                        <input id="delivery_time" class="form-control input-mask text-left" name="delivery_time" placeholder="000" maxlength="4"
                                               data-inputmask="'alias': 'numeric'">
                                                 {{--, 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'placeholder': '0'--}}
                                        <div class="invalid-feedback">
                                            Delivery Time.
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label for="tag_new" style="float: left;">Tag as New Product (Main Page) : &nbsp;&nbsp;</label>
                                        <input type="checkbox" id="tag_new" name="tag_new" switch="warning" checked/>
                                        <label for="tag_new" data-on-label="Yes" style="float: right;"
                                        data-off-label="No"></label>
                                    </div></div>

                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label for="tag_hot" style="float: left;">Tag as Hot Product (Main Page) : &nbsp;&nbsp;</label>
                                        <input type="checkbox" id="tag_hot" name="tag_hot" switch="warning" checked/>
                                        <label for="tag_hot" data-on-label="Yes" style="float: right;"
                                        data-off-label="No"></label>
                                    </div></div>

                                <hr>

                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label for="tag_special_offer" style="float: left;">Tag as Special Offer (Menu Grid) : &nbsp;&nbsp;</label>
                                        <input type="checkbox" id="tag_special_offer" name="tag_special_offer" switch="warning" checked/>
                                        <label for="tag_special_offer" data-on-label="Yes" style="float: right;"
                                               data-off-label="No"></label>
                                    </div></div>

                                <hr>

                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label for="tag_popular_menu" style="float: left;">Appear as Popular Menu (Product Details) : &nbsp;&nbsp;</label>
                                        <input type="checkbox" id="tag_popular_menu" name="tag_popular_menu" switch="warning" checked/>
                                        <label for="tag_popular_menu" data-on-label="Yes" style="float: right;"
                                        data-off-label="No"></label>
                                    </div></div>

                                <hr>

                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label for="tag_our_gallery_footer" style="float: left;">Appear in Our Gallery (Footer) : &nbsp;&nbsp;</label>
                                        <input type="checkbox" id="tag_our_gallery_footer" name="tag_our_gallery_footer" switch="warning" checked/>
                                        <label for="tag_our_gallery_footer" data-on-label="Yes" style="float: right;"
                                        data-off-label="No"></label>
                                    </div></div>

                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label for="tag_latest_menu_footer" style="float: left;">Appear in Latest Menu (Footer) : &nbsp;&nbsp;</label>
                                        <input type="checkbox" id="tag_latest_menu_footer" name="tag_latest_menu_footer" switch="warning" checked/>
                                        <label for="tag_latest_menu_footer" data-on-label="Yes" style="float: right;"
                                        data-off-label="No"></label>
                                    </div></div>

                                <hr>

                                <!-- Image Repeater class="inner-repeater mb-4-->
                                {{--<div class="row">--}}

                                    <div class="inner-repeater mb-4" >
                                        <div data-repeater-list="inner-group" class="inner form-group">

                                            <div class="form-group col-lg-12" style="text-align: center">
                                                <label for="images_path">Attach Image/s Here</label>
                                            </div>
                                            <div data-repeater-item class="inner mb-3 row">

                                                <div class="form-group col-lg-1" style="text-align: center">
                                                    <input data-repeater-delete type="button" class="btn btn-primary btn-block inner" value="Delete" /> {{--style="position: absolute; top: 40%; left: 0%;"--}}
                                                </div>

                                                <div class="form-group col-lg-3">
                                                    <input type="text" class="form-control" name="name_image" autocomplete="name_image" placeholder="Enter a image name...">
                                                </div>

                                                <div class="form-group col-lg-3">
                                                    <input type="text" class="form-control" name="name_description" autocomplete="name_description" placeholder="Enter image description...">
                                                </div>

                                                <div class="form-group col-lg-3">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile" name="images_path" required onchange="readUrlImage(this);">
                                                        <label class="custom-file-label" for="customFile" name="image_path_label">Choose Image</label>
                                                        <div class="invalid-feedback">
                                                            Please provide image.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-1" style="text-align: center">
                                                    <img src="" id="image_prev" name="image_prev" >{{--style="position: absolute; top: 20%; left: 0%;"--}}
                                                </div>

                                            </div>

                                        </div>
                                        <input data-repeater-create type="button" class="btn btn-success inner" value="Add Image Field"/>
                                    </div>
                               {{-- </div>--}}
                                <!-- /Image Repeater class="inner-repeater mb-4-->

                                <hr>

                                <div class="text-center">
                                    <button class="btn btn-danger" type="button" onclick='window.location.href=window.location.href' style="float: right;">Clear</button>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                            <!-- data-repeater-item class="outer" -->
                        </div>
                        <!-- data-repeater-list="outer-group" class="outer" -->

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

    <!-- Form Advanced -->
        <script src="{{ asset('backend') }}/libs/select2/js/select2.min.js"></script>
        <script src="{{ asset('backend') }}/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="{{ asset('backend') }}/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="{{ asset('backend') }}/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="{{ asset('backend') }}/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="{{ asset('backend') }}/js/pages/form-advanced.init.js"></script>

    <!-- form mask -->
        <script src="{{ asset('backend') }}/libs/inputmask/min/jquery.inputmask.bundle.min.js"></script>
        <!-- form mask init -->
        <script src="{{ asset('backend') }}/js/pages/form-mask.init.js"></script>
@endpush

@push('script-bottom')
    {{-- For viewing uploading at file--}}
    <script type="text/javascript">

        function readUrlImage(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {

                    //Display image
                    //get index id of input/file
                    var file_name = (input.name).substr(25, 35); //get string between  'up][...' and 'prev]'
                    var regex = /\d+/g;
                    var indexId = file_name.match(regex); //get the number within

                   /* name="outer-group[0][inner-group][0][image_path]"*/
                    document.getElementsByName("outer-group[0][inner-group]["+indexId+"][image_prev]")[0].src = e.target.result;
                    document.getElementsByName("outer-group[0][inner-group]["+indexId+"][image_prev]")[0].width = 65;
                    document.getElementsByName("outer-group[0][inner-group]["+indexId+"][image_prev]")[0].height = 50;

                    //get image filename and passed to label
                    var name = input.value.split('\\').pop();
                    //name=name.split('.')[0];
                    document.getElementsByName("outer-group[0][inner-group]["+indexId+"][image_path_label]")[0].innerHTML = name;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endpush
