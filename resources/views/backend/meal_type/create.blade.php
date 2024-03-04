@extends('backend.layouts.app')

@section('title', 'Create New Meal Type')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">MEAL TYPE</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.meal-type.index') }}">List of Meal Types</a></li>
                        <li class="breadcrumb-item active">Add New Meal Type</li>
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
                    <form action="{{ route('admin.meal-type.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div data-repeater-list="group-a">
                            <div data-repeater-item class="row">

                                <div  class="form-group col-lg-2">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" autocomplete="name" placeholder="Breakfast, Dinner, etc.." autofocus required/>
                                    <div class="invalid-feedback">
                                        Please provide name type.
                                    </div>
                                </div>

                                <div class="col-lg-2 align-self-center">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>

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
@endpush
