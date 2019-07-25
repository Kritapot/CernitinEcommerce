<?php
    use App\Blogger;
    use App\Category;
    use App\CmsPage;
?>

<footer id="footer"><!--Footer-->
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="single-widget">
                        <?php $cmsPageTitle     =   CmsPage::getTitleCmsPage() ?>
                        <h2>เกี่ยวกับเรา</h2>
                        <ul class="nav nav-pills nav-stacked">
                            @foreach ($cmsPageTitle as $key => $value)
                                <li><a href="{{ url('/page/'.$value['url']) }}">{{ $value['title'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="single-widget">
                        <?php $categoryTitle    =   Category::getTitleCategory() ?>
                        <h2>หมวดหมู่สินค้า</h2>
                        <ul class="nav nav-pills nav-stacked">
                            @foreach ($categoryTitle as $key => $value)
                                <li><a href="{{ url('/product/'.$value['url']) }}">{{ $value['name'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="single-widget">
                        <?php $blogTitle    =   Blogger::showBlogHomepage() ?>
                        <h2>บทความน่ารู้</h2>
                        <ul class="nav nav-pills nav-stacked">
                            @foreach ($blogTitle as $key => $value)
                                <li><a href="{{  url('/blog-detail/'.$value['id']) }}">{{ $value['title'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="single-widget">
                        <h2>ติดต่อเรา</h2>
                        <form action="#" class="searchform">
                            <p><a style="color: #8C8C88" href="{{ url('/contact') }}">ฝากข้อความ</a></p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->
