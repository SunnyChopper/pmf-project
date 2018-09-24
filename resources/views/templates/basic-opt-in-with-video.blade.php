<html>
	<head>
		<!-- Required meta tags-->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>{{ $xml_data["page_title"] }}</title>

		<!-- Bootstrap CSS-->
		<link href="{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

		<!-- Main CSS -->
		<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" media="all">

		<!--  Custom CSS -->
		<link href="{{ URL::asset('css/basic-opt-in-with-video.css') }}" rel="stylesheet" media="all">

		@if($landing_page->google_analytics_code != "")
			{!! $landing_page->google_analytics_code !!}
		@endif
	</head>
	<body>
		<div style="width: 100%; height: 100%;" class="parent">
			<div class="container child">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
						<h2 id="title">{{ $xml_data["title"] }}</h2>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-12 col-xs-12 text-center">
						<p id="description">{{ $xml_data["description"] }}</p>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-12 col-xs-12">
						<div class="videoWrapper">
							<!-- Copy & Pasted from YouTube -->
							<iframe width="560" height="349" src="http://www.youtube.com/embed/{{ $xml_data['youtube_video_id'] }}" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
				</div>

				<div class="row mt-16">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
						<h4 id="benefit_title">{{ $xml_data["benefit_title"] }}</h4>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-12 col-xs-12 text-center">
						<p id="benefit_description">{{ $xml_data["benefit_description"] }}</p>
					</div>
				</div>

				<form id="signup_form" method="post">
					<div class="row">
						<div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-12 col-xs-12">
							<input type="text" name="name" class="form-control" placeholder="Name" required>
						</div>
					</div>

					<div class="row mt-8">
						<div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-12 col-xs-12">
							<input type="email" name="email" class="form-control" placeholder="Email" required>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-12 col-xs-12">
							<p class="text-center success-message green"></p>
							<p class="text-center error-message red"></p>
						</div>
					</div>

					<div class="row mt-8">
						<div class="col-lg-2 offset-lg-5 col-md-4 offset-md-4 col-sm-12 col-xs-12">
							<input value="{{ $xml_data['button_text'] }}" type="submit" class="btn btn-primary center-button"> 
						</div>
					</div>
				</form>
			</div>
		</div>

		<script src="{{ URL::asset('vendor/jquery-3.2.1.min.js?v=1') }}"></script>
		<script src="{{ URL::asset('js/custom.js') }}"></script>
	</body>
</html>