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
                            <li><a href="#"><i class="fa fa-phone"></i> +66 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> cernitinth@gmail.com</a></li>
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
                        <a href="{{ url('/') }}"><img style="width: 200px; height: 120px;" src="{{ asset('images/fontend_images/shop/logo.jpg') }}" alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/cart') }}"><i class="fas fa-shopping-cart"></i> ตระกร้าสินค้า</a></li>
                            @if (empty(Auth::check()))
                                <li><a href="{{ url('/user-register') }}"><i class="fa fa-lock"></i> เข้าสู่ระบบ</a></li>
                            @else
                                <li><a href="{{ url('/order-user-page') }}"><i class="fa fa-crosshairs"></i> ประวัติการสั่งซื้อ</a></li>
                                <li><a href="{{ url('account') }}"><i class="fa fa-user"></i>ข้อมูลส่วนตัว ({{ Auth::user()->name }})</a></li>
                                <li><a href="{{ url('/user-logout') }}"><i class="fa fa-lock"></i> ออกจากระบบ</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="btn-group pull-right">
                        <h4 style="line-height: 1.9em">ศูนย์จำหน่าย เซอร์นิติน ของแท้จากบริษัท สนใจสินค้า สั่งซื้อหรือ สอบถามปรึกษาปัญหาสุขภาพ &nbsp;&nbsp;<br>
                        </h4>
                        <i class="fab fa-line" style="color: green; font-size: 30px"></i>&nbsp; <span style="font-size: 20px">id: xxxxxxxxxxxx</span>&nbsp;&nbsp;
                        <i class="fa fa-phone" style="color: green; font-size: 25px"></i>&nbsp; <span style="font-size: 20px">โทร: xxxxxxxxxxxx</span></i>
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
                            <li><a href="{{ url('/') }}" class="active">หน้าหลัก</a></li>
                            <li class="dropdown"><a href="#">หมวดหมู่สินค้า<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach ($maincategories as $key => $value)
                                        @if ($value['status'])
                                            <li><a href="{{ asset('/product/'.$value['url']) }}">{{ $value['name'] }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="#">บทความเกี่ยวกับ Cernitin</a></li>
                            <li><a href="#">ติดต่อเรา</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form action="{{ url('/search-product') }}" method="post">
                            {{ csrf_field() }}
                            <input type="text" placeholder="ค้นหาสินค้า" name="product"/>
                            <button type="submit" style="border-radius: 0; height: 33px; margin-bottom: 6px; margin-left: -5px" class="btn btn-info">ค้นหา</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
