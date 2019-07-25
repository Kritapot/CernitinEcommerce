<?php use App\Gallery;  ?>

<section class="gallery-index">
    <div class="container gallery-pic">
        <h2 class="title text-center">ตัวอย่างจากผู้ใช้จริง</h2>
        <?php $getGallery   =   Gallery::getGallery(); ?>
        <div class="top">
            <ul>
                @foreach ($getGallery as $key => $value)
                    <li><a href="#img_{{ $value['id'] }}"><img src="{{ asset('images/backend_images/gallery/small/'.$value['image']) }}"></a></li>
                @endforeach
            </ul>
            @foreach ($getGallery as $key => $value)
                <a href="#_{{ $value['id'] }}" class="lightbox trans" id="img_{{ $value['id'] }}"><img src="{{ asset('images/backend_images/gallery/medium/'.$value['image']) }}"></a>
            @endforeach
        </div>
    </div>
</section>
