<!DOCTYPE html>
<html lang="en">
<head>
<title>Cernitin Administrator</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{ asset('css/backend_css') }}/bootstrap.min.css" />
<link rel="stylesheet" href="{{ asset('css/backend_css') }}/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="{{ asset('css/backend_css') }}/fullcalendar.css" />
<link rel="stylesheet" href="{{ asset('css/backend_css') }}/matrix-style.css" />
<link rel="stylesheet" href="{{ asset('css/backend_css') }}/matrix-media.css" />
<link rel="stylesheet" href="{{ asset('css/backend_css') }}/select2.css" />
<link rel="stylesheet" href="{{ asset('css/backend_css') }}/uniform.css" />
<link rel="stylesheet" href="{{ asset('vendor/tailwind') }}/tailwind.min.css" />
<link href="{{ asset('fonts/backend_fonts') }}/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/backend_css') }}/jquery.gritter.css" />
<link rel="stylesheet" href="{{ asset('vendor/font-style/main-font.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css') }}/bootstrap-wysihtml5.css" />




</head>
<body>
    @include('layouts.admin-layouts.header')
    @include('layouts.admin-layouts.sidebar')
    @yield('content')
    @include('layouts.admin-layouts.footer')

<script src="{{ asset('js/backend_js') }}/jquery.min.js"></script>
<script src="{{ asset('js/backend_js') }}/jquery.ui.custom.js"></script>
<script src="{{ asset('js/backend_js') }}/bootstrap.min.js"></script>
<script src="{{ asset('js/backend_js') }}/jquery.uniform.js"></script>
<script src="{{ asset('js/backend_js') }}/select2.min.js"></script>
<script src="{{ asset('js/backend_js') }}/jquery.validate.js"></script>
<script src="{{ asset('js/backend_js') }}/matrix.js"></script>
<script src="{{ asset('js/backend_js') }}/matrix.form_validation.js"></script>
<script src="{{ asset('js/backend_js') }}/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/backend_js') }}/matrix.tables.js"></script>
<script src="{{ asset('js/backend_js') }}/matrix.popover.js"></script>
<script src="{{ asset('js/backend_js') }}/jquery.validate.js"></script>
<script src="{{ asset('vendor/sweetalert') }}/sweetalert2@8.js"></script>
<script src="{{ asset('js/backend_js') }}/wysihtml5-0.3.0.js"></script>
<script src="{{ asset('js/backend_js') }}/bootstrap-wysihtml5.js"></script>
<script>
	$('.textarea_editor').wysihtml5();
</script>


</html>
