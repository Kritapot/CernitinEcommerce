<?php
    use App\Http\Controllers\Controller;
    $product        =   Controller::count_product();
    $category       =   Controller::count_category();
    $banner         =   Controller::count_banner();
    $order          =   Controller::count_order();
    $user           =   Controller::count_user();
    $cmsPage        =   Controller::count_cms();
    $blog           =   Controller::count_blog();
    $gallery        =   Controller::count_gallery();


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
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>รายการสั่งซ์้อ</span> <span class="label label-important">{{ $order }}</span></a>
        <ul @if(preg_match('/order/i', $url)) style="display: block"   @endif>
          <li @if (preg_match('/list-order/i', $url)) class="active" @endif><a href="{{ url('/admin/list-order') }}">แสดงรายการสั่งซื้อทั้งหมด</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>รายชือสมาชิก</span> <span class="label label-important">{{ $user }}</span></a>
        <ul @if(preg_match('/user/i', $url)) style="display: block"   @endif>
          <li @if (preg_match('/list-user/i', $url)) class="active" @endif><a href="{{ url('/admin/list-user') }}">แสดงรายชื่อสมาชิกทั้งหมด</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>CMS Page</span> <span class="label label-important">{{ $cmsPage }}</span></a>
        <ul @if(preg_match('/cms/i', $url)) style="display: block"   @endif>
          <li @if (preg_match('/add-cms/i', $url)) class="active" @endif><a href="{{ url('/admin/add-cms') }}">เพิ่มหน้า</a></li>
          <li @if (preg_match('/list-cms/i', $url)) class="active" @endif><a href="{{ url('/admin/list-cms') }}">แสดงหน้าทั้งหมด</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>บทความ</span> <span class="label label-important">{{ $blog }}</span></a>
        <ul @if(preg_match('/blogger/i', $url)) style="display: block"   @endif>
          <li @if (preg_match('/add-blogger/i', $url)) class="active" @endif><a href="{{ url('/admin/add-blogger') }}">เพิ่มบทความ</a></li>
          <li @if (preg_match('/list-blogger/i', $url)) class="active" @endif><a href="{{ url('/admin/list-blogger') }}">แสดงบทความทั้งหมด</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Gallery</span> <span class="label label-important">{{ $gallery }}</span></a>
        <ul @if(preg_match('/gallery/i', $url)) style="display: block"   @endif>
          <li @if (preg_match('/add-gallery/i', $url)) class="active" @endif><a href="{{ url('/admin/add-gallery') }}">เพิ่มรูปภาพ</a></li>
          <li @if (preg_match('/list-gallery/i', $url)) class="active" @endif><a href="{{ url('/admin/list-gallery') }}">แสดงรูปภาพทั้งหมด</a></li>
        </ul>
      </li>


    </ul>
  </div>
  <!--sidebar-menu-->
