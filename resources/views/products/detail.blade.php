@extends('layouts.fontend-design')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.fontend-menuleft')
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    <!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <span class='zoom' id='ex1'>
                                <img style="width: 300px"
                                    src='{{ asset('images/backend_images/products/medium/'.$productDetail['image']) }}' />
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <form name="add-cart" id="add-product-card" method="post" action="{{ url('/add-cart') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="product_id" value="{{ $productDetail['id'] }}">
                            <input type="hidden" name="product_name" value="{{ $productDetail['product_name'] }}">
                            <input type="hidden" name="product_code" value="{{ $productDetail['product_code'] }}">
                            <input type="hidden" name="product_color" value="{{ $productDetail['product_color'] }}">
                            <input type="hidden" id="price-change" name="price" value="{{ $productDetail['price'] }}">

                            <div class="product-information">
                                <!--/product-information-->
                                <img src="images/product-details/new.jpg" class="newarrival" alt="">
                                <h2>{{ $productDetail['product_name'] }}</h2>
                                <p>
                                    <select id="select-size" name="size"
                                        style="width: 220px; padding: 5px 0px; margin: 3px 0px;">
                                        <option value="">เลือกขนาด</option>
                                        @foreach ($productDetail['product_attributes'] as $key => $value)
                                        <option value="{{ $productDetail['id'] }}-{{ $value['size'] }}">
                                            {{ $value['size'] }}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <p>รหัสสินค้า : {{ $productDetail['product_code'] }}</p>
                                <img src="images/product-details/rating.png" alt="">
                                <span>
                                    <span id="get-price">THB {{ $productDetail['price'] }}</span>
                                </span>
                                <span>
                                    <label>จำนวน:</label>
                                    <input type="text" name="quantity" value="1">
                                    @if ($totalStock > 0)
                                    <button id="cartButton" type="submit" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        เพิ่มเข้าตระกร้า
                                    </button>
                                    @endif
                                </span>
                                <p id="avibility"><b>สถานะสินค้าใน : </b> @if($totalStock>0) <span
                                        style="color: green">ใน stock {{$totalStock}}</span> @else <span
                                        style="color: red">สินค้าหมด stock</span> @endif</p>
                                <p><b>Condition:</b> New</p>
                                <a href=""><img src="images/product-details/share.png" class="share img-responsive"
                                        alt=""></a>
                            </div>
                            <!--/product-information-->
                        </form>
                    </div>
                </div>
                <!--/product-details-->

                <div class="category-tab shop-details-tab">
                    <!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#description" data-toggle="tab">รายละเอียดสินค้า</a></li>
                            <li><a href="#care" data-toggle="tab">ส่วนผสม และการดูแลรักษา</a></li>
                            <li><a href="#deliver" data-toggle="tab">การจัดส่ง</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="description">
                            <div class="col-sm-12">
                                <p>{{ $productDetail['description'] }}</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="care">
                            <div class="col-sm-12">
                                <p>{{ $productDetail['care'] }}</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="deliver">
                            <div class="col-sm-12">

                            </div>
                        </div>
                    </div>
                </div>
                <!--/category-tab-->

                <div class="recommended_items">
                    <!--recommended_items-->
                    <h2 class="title text-center">สินค้าอื่นๆ ที่น่าสนใจ</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php $count =1 ?>
                            @foreach ($productRelated->chunk(3) as $item)
                            <div @if($count==1) class="item active" @else class="item" @endif>
                                @foreach ($item as $product)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img style="width: 230px"
                                                    src="{{ asset('images/backend_images/products/medium/'.$product->image) }}"
                                                    alt="">
                                                <h2>{{ $product->price }}</h2>
                                                <p>{{ $product->product_name }}</p>
                                                <p>
                                                    <a
                                                        href="{{ url('/product-detail/'.$product->id) }}">ดูรายละเอียดสินค้า</a>
                                                </p>
                                                <button type="button" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <?php $count++; ?>
                            @endforeach
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                <!--/recommended_items-->

            </div>
        </div>
    </div>
</section>

@endsection
