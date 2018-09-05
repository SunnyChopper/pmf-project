@extends('layouts.public-app')

@section('content')
	@include('layouts.public-header')

	<div class="container mt-64 mb-64">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<div class="blog-box">
					<div class="blog-image">
						<img src="https://www.topgear.com/sites/default/files/styles/16x9_1280w/public/images/cars-road-test/2015/11/b31bcdd6d33d967fbe09c4bf1f9f0d1e/gm8a2383.jpg?itok=FOqCNkMC">
					</div>
					<div class="blog-info">
						<h3>Sample Article</h3>
						<p>This is a sample short description.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection