<?php
    use App\Http\Controllers\Controller;
    $maincategories     =   Controller::main_categories();
?>

<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{ url('/') }}"><img style="width: 140px; height: 90px;" src="{{ asset('images/fontend_images') }}/shop/logo.jpg" alt="" /></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                        </div>

                        <div class="btn-group">
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-user"></i> ผู้ใช้งาน</a></li>
                            <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a href="{{ url('/cart') }}"><i class="fas fa-shopping-cart"></i> ตระกร้าสินค้า</a></li>
                            @if (empty(Auth::check()))
                                <li><a href="{{ url('/user-register') }}"><i class="fa fa-lock"></i> เข้าสู่ระบบ</a></li>
                            @else
                                <li><a href="{{ url('account') }}"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a></li>
                                <li><a href="{{ url('/user-logout') }}"><i class="fa fa-lock"></i> ออกจากระบบ</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="index.html" class="active">หน้าหลัก</a></li>
                            <li class="dropdown"><a href="#">หมวดหมู่สินค้า<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach ($maincategories as $key => $value)
                                        @if ($value['status'])
                                            <li><a href="{{ asset('/product/'.$value['url']) }}">{{ $value['name'] }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="#">สาระหน้ารู้</a></li>
                            <li><a href="#">ติดต่อเรา</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Search"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
