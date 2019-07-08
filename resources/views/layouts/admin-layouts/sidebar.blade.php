<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
      <li class="active"><a href="index.html"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>ประเภทสินค้า</span> <span class="label label-important">3</span></a>
        <ul>
          <li><a href="{{ url('/admin/add-category') }}">เพิ่มประเภทสินค้า</a></li>
          <li><a href="{{ url('/admin/show-category') }}">แสดงประเภทสินค้าทั้งหมด</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>สินค้า</span> <span class="label label-important">3</span></a>
        <ul>
          <li><a href="{{ url('/admin/add-product') }}">เพิ่มสินค้า</a></li>
          <li><a href="{{ url('/admin/list-product') }}">แสดงสินค้าทั้งหมด</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Banner</span> <span class="label label-important">3</span></a>
        <ul>
          <li><a href="{{ url('/admin/add-banner') }}">เพิ่ม Banner</a></li>
          <li><a href="{{ url('/admin/list-banner') }}">แสดง Banner ทั้งหมด</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <!--sidebar-menu-->
