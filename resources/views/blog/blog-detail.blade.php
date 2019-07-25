@extends('layouts.fontend-design')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.fontend-menuleft')
            </div>
            <div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">{{ $blogDetail['title'] }}</h2>
						<div class="single-blog-post">
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Admin</li>
									<li><i class="fa fa-calendar"></i> {{ $blogDetail['created_at'] }}</li>
									<li><i class="fa fa-calendar"></i> {{ $blogDetail['updated_at'] }}</li>
								</ul>
								<span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</span>
							</div>
							<a href="#">
								<img style="width: 904px; height: 480px" src="{{ asset('images/backend_images/blog/'.$blogDetail['image']) }}" alt="">
							</a>
							<span>{!! $blogDetail['description'] !!}</span>
                        </div>
                        <div class="addthis_inline_share_toolbox_17du"></div>

					</div><!--/blog-post-area-->
				</div>
        </div>
    </div>
</section>

@endsection
