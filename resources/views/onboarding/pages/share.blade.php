@extends('onboarding.layouts.app')

@section('content')
	<div class="row mt-16">
		<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
			<h3>All Done! Let's Share It!</h3>
			<p>Congratulations, you've just setup your first opt-in page all ready to go with analytics, psychological biases, and a mobile friendly design.</p>
			<p>Now, having an opt-in page isn't enough, you need to be able to drive people from the Internet to your opt-in page so you can start to gather contact information and give more value to people.</p>
			<p>Copy the link below and then share it to a social media platform.</p>
			<h5 class="mt-4">Step 1: Copy this URL</h5>
			<input type="text" value="{{ $url }}" class="form-control" disabled>

			<h5 class="mt-4">Step 2: Share to a Social Media Platform</h5>
			<div class="row mt-16">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					<a href="https://www.facebook.com" class="btn btn-sm btn-primary center-button">Facebook</a>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					<a href="https://www.twitter.com" class="btn btn-sm btn-primary center-button">Twitter</a>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					<a href="https://www.instagram.com" class="btn btn-sm btn-primary center-button">Instagram</a>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
					<a href="https://www.linkedin.com" class="btn btn-sm btn-primary center-button">LinkedIn</a>
				</div>
			</div>

			<h5 class="mt-4">Step 3: Go to Your Dashboard</h5>
			<a class="btn btn-success" href="{{ url('/dashboard/') }}">Go to Dashboard</a>
		</div>
	</div>
@endsection