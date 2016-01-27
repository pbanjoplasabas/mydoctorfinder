<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{ (isset($title) ? $title : 'My Doctor Finder') }}</title>
	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('jasny-bootstrap/css/jasny-bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">

	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
	<link rel="stylesheet" href="{{ asset('css/home.css') }}">
	<link rel="stylesheet" href="{{ asset('css/awesome-bootstrap-checkbox.css') }}" />

	<script type="text/javascript" src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('jasny-bootstrap/js/jasny-bootstrap.min.js') }}"></script>

	{{-- Selectize Plugin --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('selectize/css/selectize.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('selectize/css/selectize.default.css') }}" />
	<script type="text/javascript" src="{{ asset('selectize/js/selectize.js') }}"></script>
	<script type="text/javascript" src="{{ asset('selectize/js/standalone/selectize.js') }}"></script>

	{{-- Javascript for google maps APIv3 --}}
	<!-- <script src="https://maps.googleapis.com/maps/api/js"></script> -->
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	@include('layout.header-main')

	@include('layout.map-container')

	@yield('content')

	@include('layout.footer-main')

</body>
</html>