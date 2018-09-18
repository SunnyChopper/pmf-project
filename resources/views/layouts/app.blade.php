<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags-->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords" content="">

	<!-- Title Page-->
	<title>{{ $page_title }}</title>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-P9B5TN3');</script>
	<!-- End Google Tag Manager -->

	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content="Grow Your Personal Brand"/>
	<meta property="og:image" content="{{ URL::asset('images/icon/og-image.jpg') }}"/>
	<meta property="og:url" content="OptinDev.com"/>
	<meta property="og:site_name" content="optindev.com"/>
	<meta property="og:description" content="Helping personal brands grow their audience with the power of psychology and artificial intelligence."/>
	<meta name="twitter:title" content="Grow Your Personal Brand" />
	<meta name="twitter:image" content="{{ URL::asset('images/icon/og-image.jpg') }}" />
	<meta name="twitter:url" content="OptinDev.com" />
	<meta name="twitter:card" content="Helping personal brands grow their audience with the power of psychology and artificial intelligence." />

	<!-- Fontfaces CSS-->
	<link href="{{ URL::asset('css/font-face.css?v=1') }}" rel="stylesheet" media="all">
	<link href="{{ URL::asset('vendor/font-awesome-4.7/css/font-awesome.min.css?v=1') }}" rel="stylesheet" media="all">
	<link href="{{ URL::asset('vendor/font-awesome-5/css/fontawesome-all.min.css?v=1') }}" rel="stylesheet" media="all">
	<link href="{{ URL::asset('vendor/mdi-font/css/material-design-iconic-font.min.css?v=1') }}" rel="stylesheet" media="all">

	<!-- Bootstrap CSS-->
	<link href="{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.css?v=1') }}" rel="stylesheet" media="all">

	<!-- Vendor CSS-->
	<link href="{{ URL::asset('vendor/animsition/animsition.min.css?v=1') }}" rel="stylesheet" media="all">
	<link href="{{ URL::asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css?v=1') }}" rel="stylesheet" media="all">
	<link href="{{ URL::asset('vendor/wow/animate.css?v=1') }}" rel="stylesheet" media="all">
	<link href="{{ URL::asset('vendor/css-hamburgers/hamburgers.min.css?v=1') }}" rel="stylesheet" media="all">
	<link href="{{ URL::asset('vendor/slick/slick.css?v=1') }}" rel="stylesheet" media="all">
	<link href="{{ URL::asset('vendor/select2/select2.min.css?v=1') }}" rel="stylesheet" media="all">
	<link href="{{ URL::asset('vendor/perfect-scrollbar/perfect-scrollbar.css?v=1') }}" rel="stylesheet" media="all">

	<!-- Main CSS-->
	<link href="{{ URL::asset('css/theme.css?v=1') }}" rel="stylesheet" media="all">
	<link href="{{ URL::asset('css/style.css?v=1') }}" rel="stylesheet" media="all">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125797404-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-125797404-1');
	</script>

</head>
<body class="animsition">
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P9B5TN3"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	@extends('layouts.js')
	<div class="page-wrapper">
		@extends('layouts.navbar')

		<div class="page-container">
			@extends('layouts.header')
			 <div class="main-content">
				<div class="section__content section__content--p30">
					@yield('content')
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>