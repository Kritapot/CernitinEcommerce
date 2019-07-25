@extends('layouts.admin-layouts.design')
<?php
    use App\Http\Controllers\Controller;
    use App\Order;
    $product        =   Controller::count_product();
    $category       =   Controller::count_category();
    $banner         =   Controller::count_banner();
    $order          =   Controller::count_order();
    $user           =   Controller::count_user();
    $cmsPage        =   Controller::count_cms();
    $blog           =   Controller::count_blog();
    $gallery        =   Controller::count_gallery();


    $countPending   =   Order::countPending();
?>
@section('content')
<div id="content">
    <!--breadcrumbs-->
      <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
      </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
      <div class="container-fluid">
        <div class="quick-actions_homepage">
          <ul class="quick-actions">
            <li class="bg_lb span3"> <a href="{{ url('/admin/add-category') }}"> <i class="icon-plus">{{ $category }}</i> <span class="label label-important"></span> <span style="font-size: 20px">ประเภทสินค้า</span> </a> </li>
            <li class="bg_lg span3"> <a href="{{ url('/admin/add-product') }}"> <i class="icon-plus">{{ $product }}</i> <span style="font-size: 20px">สินค้าทั้งหมด</span></a> </li>
            <li class="bg_ly span3"> <a href="{{ url('/admin/add-product') }}"> <i class="icon-user">{{ $user }}</i><span class="label label-success"></span> <span style="font-size: 20px">รายชื่อสมาชิก</span> </a> </li>
            <li class="bg_lo span3"> <a href="{{ url('/admin/list-user') }}"> <i class="icon-tag">{{ $order }}</i> <span style="font-size: 20px">รายการสั่งซื้อ</span></a> </li>
            <li class="bg_ls"> <a href="{{ url('/admin/list-order') }}"> <i class="icon-repeat">{{ $countPending }}</i> <span style="font-size: 20px">รายการสั่งซื้อที่รอดำเนินการ</span></a> </li>
            <li class="bg_lo span4"> <a href="{{ url('/admin/add-cms') }}"> <i class="icon-plus">{{ $cmsPage }}</i> <span style="font-size: 20px">CMS Page</span></a> </li>
            <li class="bg_ls span4"> <a href="{{ url('/admin/add-banner') }}"> <i class="icon-plus">{{ $banner }}</i> <span style="font-size: 20px">Banner</span></a> </li>
            <li class="bg_lb span4"> <a href="{{ url('/admin/add-blogger') }}"> <i class="icon-plus">{{ $blog }}</i><span style="font-size: 20px">บทความ</span></a> </li>
            <li class="bg_lg span4"> <a href="{{ url('/admin/add-gallery') }}"> <i class="icon-plus">{{ $gallery }}</i> Gallery</a> </li>
            <li class="bg_lr span4"> <a href="error404.html"> <i class="icon-info-sign">30</i> SEO</a> </li>
          </ul>
        </div>
    <!--End-Action boxes-->

        <hr/>
      </div>
    </div>

@endsection
