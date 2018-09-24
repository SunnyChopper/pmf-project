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
		<link href="{{ URL::asset('css/countdown-timer.css') }}" rel="stylesheet" media="all">

		@if($landing_page->google_analytics_code != "")
			<!-- Google Analytics code -->
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
						<p id="countdown" class="text-center" style="font-size: 24px;"></p>
					</div>
				</div>

				<form id="signup_form" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="landing_page_id" value="{{ $landing_page_id }}">
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
							<input id="submit-button" value="{{ $xml_data['button_text'] }}" type="submit" class="btn btn-primary center-button create-signup"> 
						</div>
					</div>
				</form>
			</div>
		</div>

		<script src="{{ URL::asset('vendor/jquery-3.2.1.min.js?v=1') }}"></script>
		<script src="{{ URL::asset('js/custom.js') }}"></script>

		<script type="text/javascript">
			// Set the date we're counting down to
			var expiry_date = new Date("{{ $xml_data["expiry_date"] }}").getTime();

			// Update the count down every 1 second
			var x = setInterval(function() {

				// Get todays date and time
				var now = new Date().getTime();

				// Find the distance between now and the count down date
				var distance = expiry_date - now;

				// Time calculations for days, hours, minutes and seconds
				var days = Math.floor(distance / (1000 * 60 * 60 * 24));
				var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);

				// Display the result in the element with id="demo"
				document.getElementById("countdown").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

				// If the count down is finished, write some text 
				if (distance < 0) {
					clearInterval(x);
					$("#countdown").html('EXPIRED');
					$("#submit-button").attr('disabled', true);
					$("#submit-button").attr('value', 'EXPIRED');
					$("input[name=name]").attr('disabled', true);
					$("input[name=email]").attr('disabled', true);
				}
			}, 1000);
		</script>
	</body>
</html>