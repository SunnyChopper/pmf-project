<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags-->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Get started with OptinDev as the onboarding process explains what everything is.">
		<meta name="author" content="OptinDev">

		<!-- Page data -->
		<title>{{ $page_title }}</title>

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-P9B5TN3');</script>
		<!-- End Google Tag Manager -->

		<!-- Bootstrap CSS -->
		<link href="{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.css?v=2') }}" rel="stylesheet" media="all">

		<!-- Main CSS -->
		<link href="{{ URL::asset('css/style.css?v=2') }}" rel="stylesheet" media="all">

		<style type="text/css">
			body {
				/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ffffff+0,e5e5e5+100 */
				background: #ffffff; /* Old browsers */
				background: -moz-radial-gradient(center, ellipse cover, #ffffff 0%, #e5e5e5 100%); /* FF3.6-15 */
				background: -webkit-radial-gradient(center, ellipse cover, #ffffff 0%,#e5e5e5 100%); /* Chrome10-25,Safari5.1-6 */
				background: radial-gradient(ellipse at center, #ffffff 0%,#e5e5e5 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e5e5e5',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
			}
		</style>
	</head>
	<body>
		<div class="container mt-64 mb-64">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h2 class="text-center">Welcome to Optin Dev</h2>

					<p class="text-center">Let's get you started</p>

					<div class="row mt-8 mb-8">
						<div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-xs-12">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: {{ ($step_number/4) * 100 }}%;" aria-valuenow="{{ ($step_number/4) * 100 }}" aria-valuemin="0" aria-valuemax="100">{{ ($step_number/4) * 100 }}%</div>
							</div>
							<p class="text-center mb-0"><small>Step {{ $step_number }} of 4</small></p>
						</div>
					</div>
					<hr />
				</div>
			</div>
			
			@yield('content')
		</div>

		<script src="{{ URL::asset('vendor/jquery-3.2.1.min.js?v=1') }}"></script>
		<script src="{{ URL::asset('js/custom.js') }}"></script>
	</body>
</html>