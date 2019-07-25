@extends('layouts.fontend-design')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.fontend-menuleft')
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">
                        {{ $categoryDetail['name'] }}
                    </h2>
                    <div class="text-left"><span style="font-size: 18px"><a href="{{ url('/') }}">กลับไป</a> | <span style="color: green">{{ $categoryDetail['url'] }}</span></div><br>
                    @if ($countProduct == 0)
                        <br><br><br><span style="font-size: 20px; color: red; margin: 0px 150px;">ขออภัยไม่มีรายการที่แสดง</span>
                    @endif
                    @foreach ($productAll as $key => $value)
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
                </div><!--features_items-->

            </div>
        </div>
    </div>
</section>

@endsection
