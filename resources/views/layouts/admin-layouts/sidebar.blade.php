<?php
    use App\Http\Controllers\Controller;
    $product        =   Controller::count_product();
    $category       =   Controller::count_category();
    $banner         =   Controller::count_banner();

    $url    =   url()->current();
?>

<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
      <li @if (preg_match('/dashboard/i', $url)) class="active" @endif><a href="{{ url('/admin/dashboard') }}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>ประเภทสินค้า</span> <span class="label label-important">{{ $category }}</span></a>
        <ul @if(preg_match('/category/i', $url)) style="display: block"   @endif>
          <li @if (preg_match('/add-category/i', $url)) class="active" @endif><a href="{{ url('/admin/add-category') }}">เพิ่มประเภทสินค้า</a></li>
          <li @if (preg_match('/show-category/i', $url)) class="active" @endif><a href="{{ url('/admin/show-category') }}">แสดงประเภทสินค้าทั้งหมด</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>สินค้า</span> <span class="label label-important">{{ $product }}</span></a>
        <ul @if(preg_match('/product/i', $url)) style="display: block"   @endif>
          <li @if (preg_match('/add-product/i', $url)) class="active" @endif><a href="{{ url('/admin/add-product') }}">เพิ่มสินค้า</a></li>
          <li @if (preg_match('/list-product/i', $url)) class="active" @endif><a href="{{ url('/admin/list-product') }}">แสดงสินค้าทั้งหมด</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Banner</span> <span class="label label-important">{{ $banner }}</span></a>
        <ul @if(preg_match('/banner/i', $url)) style="display: block"   @endif>
          <li @if (preg_match('/add-banner/i', $url)) class="active" @endif><a href="{{ url('/admin/add-banner') }}">เพิ่ม Banner</a></li>
          <li @if (preg_match('/list-banner/i', $url)) class="active" @endif><a href="{{ url('/admin/list-banner') }}">แสดง Banner ทั้งหมด</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <!--sidebar-menu-->
