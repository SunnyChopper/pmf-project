<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>{{ $page_title }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Helping personal brands grow their audience." />
		<meta name="keywords" content="personal brands, personal branding, how to grow your personal brand" />
		<meta name="author" content="OptinDev" />

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-P9B5TN3');</script>
		<!-- End Google Tag Manager -->

		<!-- Facebook and Twitter integration -->
		<meta property="og:title" content="Grow Your Personal Brand"/>
		<meta property="og:image" content=""/>
		<meta property="og:url" content=""/>
		<meta property="og:site_name" content="optindev.com"/>
		<meta property="og:description" content="Helping personal brands grow their audience with the power of software and artificial intelligence."/>
		<meta name="twitter:title" content="Grow Your Personal Brand" />
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

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125797404-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-125797404-1');
		</script>

	</head>
	<body>
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P9B5TN3"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		
		<div class="colorlib-loader"></div>
		
		<div class="page">
			@include('layouts.public-navbar')
			@yield('content')
		</div>

		@include('layouts.public-footer')

		<div class="gototop js-top">
			<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
		</div>

		@include('layouts.public-js')
	</body>
</html>