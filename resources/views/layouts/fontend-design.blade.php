
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('css/fontend_css') }}/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/fontend_css') }}/prettyPhoto.css" rel="stylesheet">
    <link href="{{ asset('css/fontend_css') }}/price-range.css" rel="stylesheet">
    <link href="{{ asset('css/fontend_css') }}/animate.css" rel="stylesheet">
	<link href="{{ asset('css/fontend_css') }}/main.css" rel="stylesheet">
    <link href="{{ asset('css/fontend_css') }}/responsive.css" rel="stylesheet">
    <link href="{{ asset('vendor/tailwind') }}/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome') }}/all.css" rel="stylesheet">

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
    <script src="{{ asset('vendor/sweetalert') }}/sweetalert2@8.js"></script>
    <script src="{{ asset('vendor/fontawesome') }}/all.js"></script>

</body>
</html>
