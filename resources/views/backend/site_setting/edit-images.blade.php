@extends('backend.layouts.app')

@section('title', 'Edit Site Setting Images')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Site Setting Images</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Images</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    {{--<h4 class="card-title">Select2</h4>
                    <p class="card-title-desc">A mobile and touch friendly input spinner component for Bootstrap</p>--}}

                    <!-- form -->
                    <form action="{{ route('admin.site-setting.images.update') }}" method="post" class="needs-validation repeater" enctype="multipart/form-data" novalidate>
                        @csrf
                        <!-- NAV -->
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                   role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-about-tab" data-toggle="pill" href="#pills-about"
                                   role="tab" aria-controls="pills-about" aria-selected="false">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-menu-tab" data-toggle="pill" href="#pills-menu"
                                   role="tab" aria-controls="pills-menu" aria-selected="false">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-gallery-tab" data-toggle="pill" href="#pills-gallery"
                                   role="tab" aria-controls="pills-gallery" aria-selected="false">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-pages-tab" data-toggle="pill" href="#pills-pages"
                                   role="tab" aria-controls="pills-pages" aria-selected="false">Pages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                   role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                            </li>
                        </ul>
                            <!-- tab-content -->
                            <div class="tab-content" id="pills-tabContent">

                                <!--HOME-->
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="margin-top: 30px;">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Current Image</th>
                                                <th>Upload</th>
                                                <th>New Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr><td><div class="col-md-3">
                                                        <img src="{{ asset($site_setting->logo_path) }}" height="90px" width="125px"></div></td>
                                                <td><div class="col-md-7" >
                                                        <input type="hidden" name="logo_path_old" readonly value="{{ $site_setting->logo_path }}">
                                                        <label for="logo_path_new">Logo</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="logo_path_new" onchange="readMainLogoNew(this);">
                                                            <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                                <td><div class="col-md-3"><img src="" id="mainlogo_prev"></div></td></tr>

                                            <tr><td><div class="col-md-3">
                                                        <img src="{{ asset($site_setting->main_head_topv_image_path) }}" height="90px" width="125px"></div></td>
                                                <td><div class="col-md-7" >
                                                        <input type="hidden" name="main_head_topv_image_path_old" readonly value="{{ $site_setting->main_head_topv_image_path }}">
                                                        <label for="main_head_topv_image_path_new">Top Center</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="main_head_topv_image_path_new" onchange="readMainTopCenterNew(this);">
                                                            <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                                <td><div class="col-md-3"><img src="" id="maintopcenter_prev"></div></td></tr>

                                            <tr><td><div class="col-md-3">
                                                        <img src="{{ asset($site_setting->main_head_top_left_image_path) }}" height="90px" width="125px"></div></td>
                                                <td><div class="col-md-7" >
                                                        <input type="hidden" name="main_head_top_left_image_path_old" readonly value="{{ $site_setting->main_head_top_left_image_path }}">
                                                        <label for="main_head_top_left_image_path_new">Top Left</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="main_head_top_left_image_path_new" onchange="readMainTopLeftNew(this);">
                                                            <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                                <td><div class="col-md-3"><img src="" id="maintopleft_prev"></div></td></tr>

                                            <tr><td><div class="col-md-3">
                                                        <img src="{{ asset($site_setting->main_middle_image_path) }}" height="90px" width="125px"></div></td>
                                                <td><div class="col-md-7" >
                                                        <input type="hidden" name="main_middle_image_path_old" readonly value="{{ $site_setting->main_middle_image_path }}">
                                                        <label for="main_middle_image_path_new">Middle</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="main_middle_image_path_new" onchange="readMainMiddleNew(this);">
                                                            <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                                <td><div class="col-md-3"><img src="" id="mainmiddle_prev"></div></td></tr>

                                            <tr><td><div class="col-md-3">
                                                        <img src="{{ asset($site_setting->main_head_bottom_right_image_path) }}" height="90px" width="125px"></div></td>
                                                <td><div class="col-md-7" >
                                                        <input type="hidden" name="main_head_bottom_right_image_path_old" readonly value="{{ $site_setting->main_head_bottom_right_image_path }}">
                                                        <label for="main_head_bottom_right_image_path_new">Top Right</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="main_head_bottom_right_image_path_new" onchange="readMainTopRightNew(this);">
                                                            <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                                <td><div class="col-md-3"><img src="" id="maintopright_prev"></div></td></tr>

                                            <tr><td><div class="col-md-3">
                                                        <img src="{{ asset($site_setting->ychose_below_left_image_path) }}" height="90px" width="125px"></div></td>
                                                <td><div class="col-md-7" >
                                                        <input type="hidden" name="ychose_below_left_image_path_old" readonly value="{{ $site_setting->ychose_below_left_image_path }}">
                                                        <label for="ychose_below_left_image_path_new">Bottom Left</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="ychose_below_left_image_path_new" onchange="readMainBottomLeftNew(this);">
                                                            <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                                <td><div class="col-md-3"><img src="" id="mainbottomleft_prev"></div></td></tr>

                                            <tr><td><div class="col-md-3">
                                                        <img src="{{ asset($site_setting->ychose_below_right_image_path) }}" height="90px" width="125px"></div></td>
                                                <td><div class="col-md-7" >
                                                        <input type="hidden" name="ychose_below_right_image_path_old" readonly value="{{ $site_setting->ychose_below_right_image_path }}">
                                                        <label for="ychose_below_right_image_path_new">Bottom Right</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="ychose_below_right_image_path_new" onchange="readMainBottomRightNew(this);">
                                                            <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                                <td><div class="col-md-3"><img src="" id="mainbottomright_prev"></div></td></tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!--/HOME-->

                                <!--ABOUT-->
                                <div class="tab-pane fade" id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab" style="margin-top: 30px;">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>Current Image</th>
                                            <th>Upload</th>
                                            <th>New Image</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <tr><td><div class="col-md-3">
                                                        <img src="{{ asset($site_setting->about_head_top_image_path) }}" height="90px" width="125px"></div></td>
                                                <td><div class="col-md-7" >
                                                        <input type="hidden" name="about_head_top_image_path_old" readonly value="{{ $site_setting->about_head_top_image_path }}">
                                                        <label for="about_head_top_image_path_new">Top Center</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="about_head_top_image_path_new" onchange="readAboutTopNew(this);">
                                                            <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                                <td><div class="col-md-3"><img src="" id="abouttop_prev"></div></td></tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!--/ABOUT-->

                                <!--MENU-->
                                <div class="tab-pane fade" id="pills-menu" role="tabpanel" aria-labelledby="pills-menu-tab" style="margin-top: 30px;">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>Current Image</th>
                                            <th>Upload</th>
                                            <th>New Image</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <tr><td><div class="col-md-3">
                                                        <img src="{{ asset($site_setting->menu_head_top_grid_image_path) }}" height="90px" width="125px"></div></td>
                                                <td><div class="col-md-7" >
                                                        <input type="hidden" name="menu_head_top_grid_image_path_old" readonly value="{{ $site_setting->menu_head_top_grid_image_path }}">
                                                        <label for="menu_head_top_grid_image_path_new">Top Center (Menu Grid Page)</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="menu_head_top_grid_image_path_new" onchange="readMenuGridTopNew(this);">
                                                            <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                                <td><div class="col-md-3"><img src="" id="menugridtop_prev"></div></td></tr>

                                        <tr><td><div class="col-md-3">
                                                    <img src="{{ asset($site_setting->menu_head_top_list_image_path) }}" height="90px" width="125px"></div></td>
                                            <td><div class="col-md-7" >
                                                    <input type="hidden" name="menu_head_top_list_image_path_old" readonly value="{{ $site_setting->menu_head_top_list_image_path }}">
                                                    <label for="menu_head_top_list_image_path_new">Top Center (Menu List Page)</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile" name="menu_head_top_list_image_path_new" onchange="readMenuListTopNew(this);">
                                                        <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                            <td><div class="col-md-3"><img src="" id="menulisttop_prev"></div></td></tr>

                                        <tr><td><div class="col-md-3">
                                                    <img src="{{ asset($site_setting->menu_head_top_details_image_path) }}" height="90px" width="125px"></div></td>
                                            <td><div class="col-md-7" >
                                                    <input type="hidden" name="menu_head_top_details_image_path_old" readonly value="{{ $site_setting->menu_head_top_details_image_path }}">
                                                    <label for="menu_head_top_details_image_path_new">Top Center (Menu Details Page)</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile" name="menu_head_top_details_image_path_new" onchange="readMenuDetailsTopNew(this);">
                                                        <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                            <td><div class="col-md-3"><img src="" id="menudetailstop_prev"></div></td></tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!--/MENU-->

                                <!--GALLERY-->
                                <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab" style="margin-top: 30px;">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>Current Image</th>
                                            <th>Upload</th>
                                            <th>New Image</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <tr><td><div class="col-md-3">
                                                        <img src="{{ asset($site_setting->gallery_head_top_image_path) }}" height="90px" width="125px"></div></td>
                                                <td><div class="col-md-7" >
                                                        <input type="hidden" name="gallery_head_top_image_path_old" readonly value="{{ $site_setting->gallery_head_top_image_path }}">
                                                        <label for="gallery_head_top_image_path_new">Top Center</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="gallery_head_top_image_path_new" onchange="readGalleryTopNew(this);">
                                                            <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                                <td><div class="col-md-3"><img src="" id="gallerytop_prev"></div></td></tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!--/GALLERY-->

                                <!--PAGES-->
                                <div class="tab-pane fade" id="pills-pages" role="tabpanel" aria-labelledby="pills-pages-tab" style="margin-top: 30px;">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>Current Image</th>
                                            <th>Upload</th>
                                            <th>New Image</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <tr><td><div class="col-md-3">
                                                        <img src="{{ asset($site_setting->pages_service_head_top_image_path) }}" height="90px" width="125px"></div></td>
                                                <td><div class="col-md-7" >
                                                        <input type="hidden" name="pages_service_head_top_image_path_old" readonly value="{{ $site_setting->pages_service_head_top_image_path }}">
                                                        <label for="pages_service_head_top_image_path_new">Top Center (Service)</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="pages_service_head_top_image_path_new" onchange="readPagesServiceTopNew(this);">
                                                            <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                                <td><div class="col-md-3"><img src="" id="pagesservicetop_prev"></div></td></tr>

                                            <tr><td><div class="col-md-3">
                                                        <img src="{{ asset($site_setting->pages_cart_head_top_image_path) }}" height="90px" width="125px"></div></td>
                                                <td><div class="col-md-7" >
                                                        <input type="hidden" name="pages_cart_head_top_image_path_old" readonly value="{{ $site_setting->pages_cart_head_top_image_path }}">
                                                        <label for="pages_cart_head_top_image_path_new">Top Center (Cart)</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="pages_cart_head_top_image_path_new" onchange="readPagesCartTopNew(this);">
                                                            <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                                <td><div class="col-md-3"><img src="" id="pagescarttop_prev"></div></td></tr>

                                            <tr><td><div class="col-md-3">
                                                        <img src="{{ asset($site_setting->pages_checkout_head_top_image_path) }}" height="90px" width="125px"></div></td>
                                                <td><div class="col-md-7" >
                                                        <input type="hidden" name="pages_checkout_head_top_image_path_old" readonly value="{{ $site_setting->pages_checkout_head_top_image_path }}">
                                                        <label for="pages_checkout_head_top_image_path_new">Top Center (Checkout)</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="pages_checkout_head_top_image_path_new" onchange="readPagesCheckoutTopNew(this);">
                                                            <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                                <td><div class="col-md-3"><img src="" id="pagescheckouttop_prev"></div></td></tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!--/PAGES-->

                                <!--CONTACT-->
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" style="margin-top: 30px;">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>Current Image</th>
                                            <th>Upload</th>
                                            <th>New Image</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <tr><td><div class="col-md-3">
                                                        <img src="{{ asset($site_setting->contact_head_top_image_path) }}" height="90px" width="125px"></div></td>
                                                <td><div class="col-md-7" >
                                                        <input type="hidden" name="contact_head_top_image_path_old" readonly value="{{ $site_setting->contact_head_top_image_path }}">
                                                        <label for="contact_head_top_image_path_new">Top Center</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="contact_head_top_image_path_new" onchange="readContactTopNew(this);">
                                                            <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                                <td><div class="col-md-3"><img src="" id="contacttop_prev"></div></td></tr>

                                            <tr><td><div class="col-md-3">
                                                        <img src="{{ asset($site_setting->contact_middle_left_image_path) }}" height="90px" width="125px"></div></td>
                                                <td><div class="col-md-7" >
                                                        <input type="hidden" name="contact_middle_left_image_path_old" readonly value="{{ $site_setting->contact_middle_left_image_path }}">
                                                        <label for="contact_middle_left_image_path_new">Top Middle Left</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="contact_middle_left_image_path_new" onchange="readContactMiddleNew(this);">
                                                            <label class="custom-file-label" for="customFile">Choose Image</label></div></div></td>
                                                <td><div class="col-md-3"><img src="" id="contactmiddle_prev"></div></td></tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!--/CONTACT-->

                            <!-- tab-content -->
                        <!-- /NAV -->
                            <br>
                            <hr>
                            <div class="text-center" style="margin-top: 40px;">
                                <button class="btn btn-danger" type="button" onclick='window.location.href=window.location.href' style="float: right;">Cancel</button>
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>

                    </form>
                    <!-- /form -->
                </div>
                <!-- /card-body -->
            </div>
            <!-- /card -->
        </div>
        <!-- /ol-lg-12 -->
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

@endpush

@push('script-bottom')
    {{-- For viewing uploading at file--}}
    <script type="text/javascript">

        /*-- HOME --*/
        function readMainLogoNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainlogo_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readMainTopCenterNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#maintopcenter_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readMainTopLeftNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#maintopleft_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readMainMiddleNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainmiddle_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readMainTopRightNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#maintopright_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readMainBottomLeftNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainbottomleft_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readMainBottomRightNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainbottomright_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        /*-- /HOME --*/

        /*-- ABOUT --*/
        function readAboutTopNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#abouttop_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        /*-- /ABOUT --*/

        /*-- MENU --*/
        function readMenuGridTopNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#menugridtop_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readMenuListTopNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#menulisttop_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readMenuDetailsTopNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#menudetailstop_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        /*-- /MENU --*/

        /*-- GALLERY --*/
        function readGalleryTopNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#gallerytop_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        /*-- /GALLERY --*/

        /*-- PAGES --*/
        function readPagesServiceTopNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#pagesservicetop_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readPagesCartTopNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#pagescarttop_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readPagesCheckoutTopNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#pagescheckouttop_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        /*-- /PAGES --*/

        /*-- CONTACT --*/
        function readContactTopNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#contacttop_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readContactMiddleNew(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#contactmiddle_prev')
                        .attr('src', e.target.result)
                        .height(90)
                        .width(125);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        /*-- /CONTACT --*/

    </script>

@endpush


