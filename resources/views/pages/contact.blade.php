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
                    @if (Session::has('flash_message_success'))
                    <div class="alert alert-error alert-block" id="message-box" style="background-color: #00C851; font-size: 18px">
                        <strong style="color: white">{!! session('flash_message_success') !!}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (Session::has('flash_message_errors'))
                    <div class="alert alert-error alert-block" id="message-box" style="background-color: #ff4444">
                        <strong style="color: white">{!! session('flash_message_errors') !!}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
					<div class="blog-post-area">
                            <div class="row">
                                    <div class="col-sm-10">
                                        <div class="contact-form">
                                            <h2 class="title text-center">ฝากข้อความถึงเรา</h2>
                                            <div class="status alert alert-success" style="display: none"></div>
                                            <form id="main-contact-form" class="contact-form row" name="contact-form" method="post" action="{{ url('/contact') }}">
                                                @csrf
                                                <div class="form-group col-md-6">
                                                    <input type="text" name="name" class="form-control" required="required" placeholder="ชื่อ">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input type="email" name="email" class="form-control" required="required" placeholder="Email สำหรับติดต่อกลับ">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <input type="text" name="subject" class="form-control" required="required" placeholder="หัวเรื่อง">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="ข้อความของคุณถึงเรา"></textarea>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <button type="submit" class="btn btn-primary pull-right">ส่งข้อความ</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                    </div><!--/blog-post-area-->
            </div>
        </div>
    </div>
</section>
@endsection
