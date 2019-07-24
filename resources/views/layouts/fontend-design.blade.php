
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if (!empty($meta_title)) {{ $meta_title }} @else Home | Cernitin @endif</title>
    @if(!empty($meta_description)) <meta name="description" content="{{ $meta_description }}"> @endif
    @if(!empty($meta_key_word)) <meta name="keyword" content="{{ $meta_key_word }}"> @endif

    <link href="{{ asset('css/fontend_css') }}/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/fontend_css') }}/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/fontend_css') }}/prettyPhoto.css" rel="stylesheet">
    <link href="{{ asset('css/fontend_css') }}/price-range.css" rel="stylesheet">
    <link href="{{ asset('css/fontend_css') }}/animate.css" rel="stylesheet">
	<link href="{{ asset('css/fontend_css') }}/main.css" rel="stylesheet">
    <link href="{{ asset('css/fontend_css') }}/responsive.css" rel="stylesheet">
    <link href="{{ asset('css/fontend_css') }}/passtrength.css" rel="stylesheet">
    <link href="{{ asset('vendor/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pridi&display=swap" rel="stylesheet">

</head>

<body>
    @include('layouts.fontend-header')
    @yield('content')
    @include('layouts.fontend-footer')


    <script src="{{ asset('js/fontend_js') }}/jquery.js"></script>
	<script src="{{ asset('js/fontend_js') }}/bootstrap.min.js"></script>
	<script src="{{ asset('js/fontend_js') }}/jquery.scrollUp.min.js"></script>
	<script src="{{ asset('js/fontend_js') }}/price-range.js"></script>
    <script src="{{ asset('js/fontend_js') }}/jquery.prettyPhoto.js"></script>
    <script src="{{ asset('js/fontend_js') }}/main.js"></script>
    <script src="{{ asset('js/fontend_js') }}/jquery.zoom.js"></script>
    <script src="{{ asset('js/fontend_js') }}/jquery.validate.js"></script>
    <script src="{{ asset('js/fontend_js') }}/passtrength.js"></script>
    <script src="{{ asset('vendor/sweetalert') }}/sweetalert2@8.js"></script>
    <script src="{{ asset('vendor/fontawesome') }}/all.js"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}
</body>
</html>
