<?php
	header('X-XSS-Protection:0');
?>
<html>
	<head>
		<!-- Required meta tags-->
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    <title>{{ config('app.name') }}</title>

	    <!-- Bootstrap CSS-->
    	<link href="{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    	<!-- Main CSS -->
    	<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" media="all">

    	<!--  Custom CSS -->
    	<link href="{{ URL::asset('css/basic-opt-in.css') }}" rel="stylesheet" media="all">

    	{!! $data->manychat_code !!}
	</head>
	<body>
		@include('layouts.preview-navbar')
		<div style="width: 100%; height: 100%;" class="parent">
			<div class="container child">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
						<h2 id="title">{{ $data->title }}</h2>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-12 col-xs-12 text-center">
						<p id="description">{{ $data->description }}</p>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
						<h4 id="benefit_title">{{ $data->benefit_title }}</h4>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-12 col-xs-12 text-center">
						<p id="benefit_description">{{ $data->benefit_description }}</p>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-xs-12">
						{!! $data->manychat_button_code !!}
					</div>
				</div>

				@if($data->privacy_policy_link != "")
				<div class="row	">
					<div class="col-lg-2 offset-lg-5 col-md-4 offset-md-4 col-sm-12 col-xs-12">
						<p class="text-center mt-2 mb-8"><small><a style="color: #8A8A8A;" href="{{ $data->privacy_policy_link }}">Privacy Policy</a></small></p> 
					</div>
				</div>
				@endif
			</div>
		</div>

		<script src="{{ URL::asset('vendor/jquery-3.2.1.min.js?v=1') }}"></script>
		<script src="{{ URL::asset('js/custom.js') }}"></script>
	</body>
</html>