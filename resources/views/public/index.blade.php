@extends('layouts.public-app')

@section('content')
	@include('layouts.public-hero')

	<div class="container mt-64 mb-64">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2 class="text-center">Connect with Your Audience</h2>
				<hr />
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="feature-box">
					<i class="icon-spinner10"></i>
					<h3>Test Quickly</h3>
					<p>By being able to quickly create opt-in pages, you can quickly test which ideas are getting more attention and create more content for that.</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="feature-box">
					<i class="icon-stats-bars"></i>
					<h3>Analytics</h3>
					<p>Get meaningful data and analytics on your opt-in pages which will help you determine how to properly split test and which ideas are worthwhile.</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="feature-box">
					<i class="icon-users"></i>
					<h3>Build an Audience</h3>
					<p>Quickly build an audience as the tool guides you on how to create value for your audience and then start to collect contact information</p>
				</div>
			</div>
		</div>
	</div>

	<div style="background: #f4f4f4; background: -moz-radial-gradient(center, ellipse cover, #f4f4f4 0%, #dbdbdb 100%); background: -webkit-radial-gradient(center, ellipse cover, #f4f4f4 0%,#dbdbdb 100%); background: radial-gradient(ellipse at center, #f4f4f4 0%,#dbdbdb 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f4f4f4', endColorstr='#dbdbdb',GradientType=1 );" class="pt-64 pb-64">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
					<h3>Provide More Value to Your Audience</h3>
					<hr style="border: 0.5px solid #AAAAAA" />
					<p class="mb-4">As more brands popup all over the Internet, the more your brand gets buried in the sea of social media.</p>
					<p class="mb-4">So how do you stand out in a world where the news feed is always updating with no end in sight?</p>
					<p class="mb-4">You provide more value to your audience and get as much of that value in front of your audience.</p>
					<p class="mb-16">OptinDev helps you do exactly that.</p>
					<a href="/plan/1" class="btn btn-success">Start your Beta Testing</a>
				</div>
				<div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
					<img src="{{ URL::asset('images/Mockup.png') }}" class="regular-image">
				</div>
			</div>
		</div>
	</div>
@endsection