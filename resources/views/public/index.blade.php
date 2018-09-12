@extends('layouts.public-app')

@section('content')
	@include('layouts.public-hero')

	<div class="container mt-64 mb-64">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2 class="text-center">Spend Less, Make More</h2>
				<hr />
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="feature-box">
					<i class="icon-spinner10"></i>
					<h3>Test Quickly</h3>
					<p>By being able to quickly create opt-in pages, you can quickly test which ideas are getting more attention and create more content for that</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="feature-box">
					<i class="icon-stats-bars"></i>
					<h3>Analytics</h3>
					<p>Get meaningful data and analytics on your opt-in pages that will help you determine how to properly split test and which ideas are worthwhile</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="feature-box">
					<i class="icon-users"></i>
					<h3>Build Audience</h3>
					<p>Quickly build an audience as the tool gathers lead information for you which you can then import into your favorite email auto-responder</p>
				</div>
			</div>
		</div>
	</div>
@endsection