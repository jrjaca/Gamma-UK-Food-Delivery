@extends('backend.layouts.app')

@section('title', 'Edit Site Setting Details')

@push('css')
    <link href="{{ asset('backend') }}/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend') }}/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

    <!-- Summernote css -->
    <link href="{{ asset('backend') }}/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Site Setting Details</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">General Details</a></li>
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
                    <form action="{{ route('admin.site-setting.details.update') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" value="{{ $site_setting->id }}" name="id" readonly />
                        <!-- NAV -->
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-main-tab" data-toggle="pill" href="#pills-main"
                                   role="tab" aria-controls="pills-main" aria-selected="true">Main & About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-opearation-tab" data-toggle="pill" href="#pills-opearation"
                                   role="tab" aria-controls="pills-opearation" aria-selected="false">Date & Time of Operations</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-smedia-tab" data-toggle="pill" href="#pills-smedia"
                                   role="tab" aria-controls="pills-smedia" aria-selected="false">Social Media Links & Business Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-checkout-tab" data-toggle="pill" href="#pills-checkout"
                                   role="tab" aria-controls="pills-checkout" aria-selected="false">Checkout Charges</a>
                            </li>
                        </ul>
                            <!-- tab-content -->
                            <div class="tab-content" id="pills-tabContent">

                                <!-- Main & About -->
                                <div class="tab-pane fade show active" id="pills-main" role="tabpanel" aria-labelledby="pills-main-tab" style="margin-top: 30px;">
                                    <div class="form-group row">
                                        <label for="main_title" class="col-md-2 col-form-label">Main Title</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="main_title" id="defaultconfig" value="{{ $site_setting->main_title }}" maxlength="20" required autofocus/>
                                            <div class="invalid-feedback">
                                                Please provide Main Title.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="about_title" class="col-md-2 col-form-label">About Title</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="about_title" id="defaultconfig" value="{{ $site_setting->about_title }}" maxlength="100" required/>
                                            <div class="invalid-feedback">
                                                Please provide About Title.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="about_subtitle" class="col-md-2 col-form-label">About Subtitle</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="about_subtitle" id="defaultconfig" value="{{ $site_setting->about_subtitle }}" maxlength="100" required/>
                                            <div class="invalid-feedback">
                                                Please provide About Subtitle.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="about_content" class="col-md-2 col-form-label">About Content</label>
                                        <div class="col-md-6" >
                                            {{--<input type="text" class="form-control" name="about_content" id="defaultconfig" maxlength="5000" required/>--}}
                                            <textarea id="elm1" name="about_content" class="form-control" required>{!! $site_setting->about_content !!}</textarea>
                                            {{--<textarea name="about_content" class="form-control" rows="8" cols="50" required>{{ $site_setting->about_subtitle }}</textarea>--}}
                                            {{--<div class="summernote">Hello Summernote</div>--}}
                                            <div class="invalid-feedback">
                                                Please provide About Content.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Date & Time of Operations -->
                                <div class="tab-pane fade" id="pills-opearation" role="tabpanel" aria-labelledby="pills-opearation-tab" style="margin-top: 30px;">

                                    <p class="card-title-desc" style="color:red;">Note: Leave it blank if non-operational</p>

                                    <div class="form-group row">
                                        <label for="open_time_saturday" class="col-md-2 col-form-label">Saturday</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="open_time_saturday" id="defaultconfig"
                                                   maxlength="22" value="{{ $site_setting->open_time_saturday }}" placeholder="E.g. 09:00 AM to 06:00 PM"/>
                                            {{--<input type="time" class="form-control" value="09:00:00" name="open_time_saturday_start">--}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="open_time_sunday" class="col-md-2 col-form-label">Sunday</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="open_time_sunday" id="defaultconfig"
                                                   maxlength="22" value="{{ $site_setting->open_time_sunday }}" placeholder="E.g. 09:00 AM to 06:00 PM"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="about_subtitle" class="col-md-2 col-form-label">Saturday</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="open_time_saturday" id="defaultconfig"
                                                   maxlength="22" value="{{ $site_setting->open_time_saturday }}" placeholder="E.g. 09:00 AM to 06:00 PM"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="open_time_monday" class="col-md-2 col-form-label">Monday</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="open_time_monday" id="defaultconfig"
                                                   maxlength="22" value="{{ $site_setting->open_time_monday }}" placeholder="E.g. 09:00 AM to 06:00 PM"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="open_time_tuesday" class="col-md-2 col-form-label">Tuesday</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="open_time_tuesday" id="defaultconfig"
                                                   maxlength="22" value="{{ $site_setting->open_time_tuesday }}" placeholder="E.g. 09:00 AM to 06:00 PM"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="open_time_wednesday" class="col-md-2 col-form-label">Wednesday</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="open_time_wednesday" id="defaultconfig"
                                                   maxlength="22" value="{{ $site_setting->open_time_wednesday }}" placeholder="E.g. 09:00 AM to 06:00 PM"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="open_time_thursday" class="col-md-2 col-form-label">Thursday</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="open_time_thursday" id="defaultconfig"
                                                   maxlength="22" value="{{ $site_setting->open_time_thursday }}" placeholder="E.g. 09:00 AM to 06:00 PM"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="open_time_friday" class="col-md-2 col-form-label">Friday</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="open_time_friday" id="defaultconfig"
                                                   maxlength="22" value="{{ $site_setting->open_time_friday }}" placeholder="E.g. 09:00 AM to 06:00 PM"/>
                                        </div>
                                    </div>
                                </div>

                                <!-- Social Media Links & Business Contact -->
                                <div class="tab-pane fade" id="pills-smedia" role="tabpanel" aria-labelledby="pills-smedia-tab" style="margin-top: 30px;">
                                    <div class="form-group row">
                                        <label for="address" class="col-md-2 col-form-label">Address</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="address" id="defaultconfig"
                                                   maxlength="200" value="{{ $site_setting->address }}" required/>
                                            <div class="invalid-feedback">
                                                Please provide business address.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-md-2 col-form-label">Phone</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="phone" id="defaultconfig"
                                                   maxlength="50" value="{{ $site_setting->phone }}" required/>
                                            <div class="invalid-feedback">
                                                Please provide business phone number.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-2 col-form-label">Email</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="email" id="defaultconfig"
                                                   maxlength="200" value="{{ $site_setting->email }}" required/>
                                            <div class="invalid-feedback">
                                                Please provide business email address.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="facebook" class="col-md-2 col-form-label">Facebook Link</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="facebook" id="defaultconfig"
                                                   maxlength="300" value="{{ $site_setting->facebook }}" />
                                        </div>
                                    </div>
                                    {{--<div class="form-group row">
                                        <label for="twitter" class="col-md-2 col-form-label">Twitter Link</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="twitter" id="defaultconfig"
                                                   maxlength="300" value="{{ $site_setting->twitter }}" />
                                        </div>
                                    </div>--}}
                                    <div class="form-group row">
                                        <label for="instagram" class="col-md-2 col-form-label">Instagram Link</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="instagram" id="defaultconfig"
                                                   maxlength="300" value="{{ $site_setting->instagram }}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="youtube" class="col-md-2 col-form-label">Youtube Link</label>
                                        <div class="col-md-6" >
                                            <input type="text" class="form-control" name="youtube" id="defaultconfig"
                                                   maxlength="300" value="{{ $site_setting->youtube }}" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Checkout Charges -->
                                <div class="tab-pane fade" id="pills-checkout" role="tabpanel" aria-labelledby="pills-checkout-tab" style="margin-top: 30px;">
                                    <div class="form-group row">
                                        <label for="checkout_shipping_charge" class="col-md-2 col-form-label">Shipping Charge Amount</label>
                                        <div class="col-md-6" >
                                            <input id="input-currency" class="form-control input-mask text-left" name="checkout_shipping_charge"
                                                   value="{{ $site_setting->checkout_shipping_charge }}" placeholder="0.00" maxlength="9"
                                                   data-inputmask="'alias': 'numeric', 'placeholder': '0.00'">
                                            <span class="text-muted">E.g. "0.00"</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="checkout_vat" class="col-md-2 col-form-label">Value Addedd Tax (VAT) Amount</label>
                                        <div class="col-md-6" >
                                            <input id="input-currency" class="form-control input-mask text-left" name="checkout_vat"
                                                   value="{{ $site_setting->checkout_vat }}"  placeholder="0.00" maxlength="9"
                                                   data-inputmask="'alias': 'numeric', 'placeholder': '0.00'">
                                            <span class="text-muted">E.g. "0.00"</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
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
        <!-- /col-lg-12 -->
    </div>
    <!-- end row -->

@endsection

@push('script')
    <!-- validation -->
        <script src="{{ asset('backend') }}/libs/parsleyjs/parsley.min.js"></script>
        <script src="{{ asset('backend') }}/js/pages/form-validation.init.js"></script>

    <!--Summernote-->
        <!--tinymce js-->
        <script src="{{ asset('backend') }}/libs/tinymce/tinymce.min.js"></script>
        <!-- Summernote js -->
        <script src="{{ asset('backend') }}/libs/summernote/summernote-bs4.min.js"></script>
        <!-- init js -->
        <script src="{{ asset('backend') }}/js/pages/form-editor.init.js"></script>

    <!-- form mask -->
        <script src="{{ asset('backend') }}/libs/inputmask/min/jquery.inputmask.bundle.min.js"></script>
        <!-- form mask init -->
        <script src="{{ asset('backend') }}/js/pages/form-mask.init.js"></script>

@endpush

@push('script-bottom')
    <!-- form-advance -->
        <script src="{{ asset('backend') }}/libs/select2/js/select2.min.js"></script>
        <script src="{{ asset('backend') }}/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="{{ asset('backend') }}/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="{{ asset('backend') }}/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="{{ asset('backend') }}/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="{{ asset('backend') }}/js/pages/form-advanced.init.js"></script>
@endpush


