@extends('layouts.fontend-design')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.fontend-menuleft')
            </div>
            <?php //dd($categorise) ?>
            <div class="col-sm-9 padding-right">
					<div class="blog-post-area">
                            <h2 class="title text-center">{{ $cmsPageDetail['title'] }}</h2>
                            <div class="single-blog-post">
                                <div class="post-meta">
                                    <ul>
                                        <li><i class="fa fa-user"></i> Admin</li>
                                        <li><i class="fa fa-clock-o"></i> {{ $cmsPageDetail['created_at'] }}</li>
                                        <li><i class="fa fa-calendar"></i> {{ $cmsPageDetail['updated_at'] }}</li>
                                    </ul>
                                    <span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                </div>
                                <a href="">
                                    <img src="images/blog/blog-one.jpg" alt="">
                                </a>
                                <p style="font-size: 20px">
                                    {!! $cmsPageDetail['description'] !!}
                                </p>

                            </div>
                        </div><!--/blog-post-area-->

            </div>
        </div>
    </div>
</section>
@endsection
