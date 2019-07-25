@extends('layouts.fontend-design')

@section('content')
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($banner as $key => $value)
                            <li data-target="#slider-carousel" data-slide-to="0" class="{{ $key == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>

                    <div class="carousel-inner" style="height: 380px">
                        @foreach ($banner as $key => $value)
                        <div class="item {{ $key == 0 ? 'active' : '' }} ">
                            <img src="images/fontend_images/banner/{{ $value['image'] }}"/>
                        </div>

                        @endforeach
                    </div>
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.fontend-menuleft')
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">รายการสินค้า</h2>
                    @foreach ($product as $key => $value)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ asset('images/backend_images/products/small/'.$value['image']) }}" alt="" />
                                            <h2>THB {{ $value['price'] }}</h2>
                                            <p>{{ $value['product_name'] }}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>เพิ่มไปที่ตระกร้าสินค้า</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>{{ $value['price'] }}</h2>
                                                <p>{{ $value['product_name'] }}</p>
                                                <p>
                                                    <a href="{{ url('/product-detail/'.$value['id']) }}">ดูรายละเอียดสินค้า</a>
                                                </p>
                                                <a href="{{ url('/product-detail/'.$value['id']) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>เพิ่มไปที่ตระกร้าสินค้า</a>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-center">{{ $product->links() }}</div>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>
@include('products.card')
@include('gallery.gallery-pic')
@endsection
