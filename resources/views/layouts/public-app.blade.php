<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>{{ $page_title }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="" />

		<!-- Facebook and Twitter integration -->
		<meta property="og:title" content=""/>
		<meta property="og:image" content=""/>
		<meta property="og:url" content=""/>
		<meta property="og:site_name" content=""/>
		<meta property="og:description" content=""/>
		<meta name="twitter:title" content="" />
		<meta name="twitter:image" content="" />
		<meta name="twitter:url" content="" />
		<meta name="twitter:card" content="" />

		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400" rel="stylesheet">
		
		<!-- Animate.css -->
		<link rel="stylesheet" href="{{ URL::asset('public_site/css/animate.css') }}">
		<!-- Icomoon Icon Fonts-->
		<link rel="stylesheet" href="{{ URL::asset('public_site/css/icomoon.css') }}">
		<!-- Bootstrap  -->
		<link rel="stylesheet" href="{{ URL::asset('public_site/css/bootstrap.css') }}">

		<!-- Magnific Popup -->
		<link rel="stylesheet" href="{{ URL::asset('public_site/css/magnific-popup.css') }}">

		<!-- Owl Carousel -->
		<link rel="stylesheet" href="{{ URL::asset('public_site/css/owl.carousel.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('public_site/css/owl.theme.default.min.css') }}">

		<!-- Theme style  -->
		<link rel="stylesheet" href="{{ URL::asset('public_site/css/style.css') }}">

		<!-- Modernizr JS -->
		<script src="{{ URL::asset('public_site/js/modernizr-2.6.2.min.js') }}"></script>
		<!-- FOR IE9 below -->
		<!--[if lt IE 9]>
		<script src="js/respond.min.js"></script>
		<![endif]-->
		<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" media="all">

	</head>
	<body>
		<div class="colorlib-loader"></div>
		@include('layouts.public-navbar')
		<div class="page">
			@yield('content')
		</div>

		@include('layouts.public-footer')

		<div class="gototop js-top">
			<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
		</div>

		@include('layouts.public-js')
	</body>
</html>