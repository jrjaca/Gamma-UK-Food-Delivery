@extends('backend.layouts.app')

@section('title', 'Product Details')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">PRODUCT DETAILS</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.meal.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">Product Details</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="product-detai-imgs">
                                <div class="row">
                                    <div class="col-md-2 col-sm-3 col-4">
                                        <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                            @foreach($allmealimagesbymealid as $row)
                                                <a class="nav-link {{ $row->position_no == 0 ? 'active' : '' }}" id="product-{{ $row->position_no }}-tab"
                                                   data-toggle="pill" href="#product-{{ $row->position_no }}" role="tab" aria-controls="product-{{ $row->position_no }}"
                                                   aria-selected="{{ $row->position_no == 0 ? 'true' : 'false' }}">
                                                    <img src="{{ asset($row->path) }}" alt="" class="img-fluid mx-auto d-block rounded">
                                                </a>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            @foreach($allmealimagesbymealid as $row)
                                                <div class="tab-pane fade show {{ $row->position_no == 0 ? 'active' : '' }}" id="product-{{ $row->position_no }}" role="tabpanel" aria-labelledby="product-{{ $row->position_no }}-tab">
                                                    <div style="text-align: center;">
                                                        <img src="{{ asset($row->path) }}" alt="" class="img-fluid mx-auto d-block">
                                                        <h5 class="mt-1 mb-2">{{ $row->name }}</h5>
                                                        <p class="text-muted mb-4">{{ $row->description }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{--<div class="text-center">
                                            <button type="button" class="btn btn-primary waves-effect waves-light mt-2 mr-1">
                                                <i class="bx bx-cart mr-2"></i> Add to cart
                                            </button>
                                            <button type="button" class="btn btn-success waves-effect  mt-2 waves-light">
                                                <i class="bx bx-shopping-bag mr-2"></i>Buy now
                                            </button>
                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="mt-4 mt-xl-3">
                                {{--<button class="btn btn-primary" type="button" style="float: right;">Add Another Product</button>
                                <i class="fa fa-plus" aria-hidden="true"></i>--}}

                                <a href="{{ url('admin/meal/create') }}" class="text-primary" title="Click to Add New Product" style="float: right;">
                                    <span style="font-size: 1.2em; color: Dodgerblue;">
                                          <i class="fas fa-plus-square" title="Add New Product">&nbsp;&nbsp;Add new product</i>
                                    </span>
                                </a>

                                @if( $meal->deleted_at == null )
                                    <a href="{{ url('admin/meal/edit/'.$meal->id) }}" class="text-primary" title="Click to Edit">{{ $meal->name }}&nbsp;&nbsp;
                                        <span style="font-size: 1.2em; color: Dodgerblue;">
                                              <i class="fa fa-edit" title="Edit"></i>
                                        </span>
                                    </a>&nbsp;
                                @else
                                    {{ $meal->name }}&nbsp;&nbsp;
                                @endif

                                <h5 class="mt-1 mb-2">{{ $meal->food_type_name }}</h5>
                                <h6 class="mt-1 mb-3">
                                    @foreach($allmealsmealtypesbymealid as $row)
                                        {{ $result[] = $row->meal_type_name.", "  }}
                                    @endforeach
                                </h6>

                                {{--<p class="text-muted float-left mr-3">
                                    <span class="bx bx-star text-warning"></span>
                                    <span class="bx bx-star text-warning"></span>
                                    <span class="bx bx-star text-warning"></span>
                                    <span class="bx bx-star text-warning"></span>
                                    <span class="bx bx-star"></span>
                                </p>
                                <p class="text-muted mb-4">( 152 Customers Review )</p>--}}
                                <p class="text-muted mb-4">{{ $meal->description }}</p>

                                <hr>

                                @if($meal->discounted_price != null) {{--with disc count--}}
                                    <h6 class="text-success text-uppercase">{{ round(((($meal->regular_price - $meal->discounted_price)/$meal->regular_price)*100), 2) }} % Off</h6>
                                    <h5 class="mb-4">Price : <span class="text-muted mr-2"><del>&#163;{{ $meal->regular_price }}</del></span> <b>&#163;{{ $meal->discounted_price }}</b></h5>
                                @else
                                    <h5 class="mb-4">Price : <b>&#163;{{ $meal->regular_price }}</b></h5>
                                @endif

                                @if($meal->delivery_cost != null)
                                    <h6 class="mb-2">Delivery Charge : <b>&#163;{{ $meal->delivery_cost }}</b></h6>
                                @endif

                                @if($meal->delivery_time != null)
                                    <h6 class="mb-4">Delivery Time : <b>{{ $meal->delivery_time }} min.</b></h6>
                                @endif

                                <hr>

                                @php
                                    $yes = "bx bx-cog font-size-16 align-middle text-primary mr-1";
                                    $no = "bx bx-unlink font-size-16 align-middle text-primary mr-1";
                                @endphp
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div>
                                            <p class="text-muted"><i class="{{ $meal->tag_new == 1 ? $yes : $no }}"></i> Tag as New Product </p>
                                            <p class="text-muted"><i class="{{ $meal->tag_hot == 1 ? $yes : $no }}"></i> Tag as Hot Product</p>
                                            <p class="text-muted"><i class="{{ $meal->tag_popular_menu == 1 ? $yes : $no }}"></i> Tag as Popular Menu</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <p class="text-muted"><i class="{{ $meal->tag_special_offer == 1 ? $yes : $no }}"></i> Tag as Special Offer</p>
                                            <p class="text-muted"><i class="{{ $meal->tag_our_gallery_footer == 1 ? $yes : $no }}"></i> Appear in Our Gallery at footer</p>
                                            <p class="text-muted"><i class="{{ $meal->tag_latest_menu_footer == 1 ? $yes : $no }}"></i> Appear in Latest Menu at footer </p>
                                        </div>
                                    </div>
                                </div>

                                {{--<div class="product-color">
                                    <h5 class="font-size-15">Color :</h5>
                                    <a href="#" class="active">
                                        <div class="product-color-item border rounded">
                                            <img src="{{ asset('backend') }}/images/product/img-7.png" alt="" class="avatar-md">
                                        </div>
                                        <p>Black</p>
                                    </a>
                                    <a href="#">
                                        <div class="product-color-item border rounded">
                                            <img src="{{ asset('backend') }}/images/product/img-7.png" alt="" class="avatar-md">
                                        </div>
                                        <p>Blue</p>
                                    </a>
                                    <a href="#">
                                        <div class="product-color-item border rounded">
                                            <img src="{{ asset('backend') }}/images/product/img-7.png" alt="" class="avatar-md">
                                        </div>
                                        <p>Gray</p>
                                    </a>
                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <!-- end row -->


                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
    <!-- /row -->


@endsection
