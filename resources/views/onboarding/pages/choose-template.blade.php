@extends('onboarding.layouts.app')

@section('content')
	<div class="row mt-16">
		<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
			<h3>Choose a Opt-in Page Template</h3>
			<p>In order to give something of value, you must have a place on the Internet where you can exchange your item of value for their contact information. That's where our Opt-in Builder can help you.</p>
			<p>However, just getting someone to your opt-in page isn't enough to make the exchange, sometimes you have to convince them and that's where having knowledge about psychology can help.</p>
			<p>Don't worry though, you don't have to go to school for psychology because our templates come pre-made with all the psychological biases baked into them. All you have to do is come up with the words.</p>
			<p>So let's get right into it. Pick out a starter template.</p>
		</div>
	</div>

	<div class="row mt-16">
		<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
			<ul class="list-group">
				<li class="list-group-item">
					<h4>Basic Opt-in</h4>
					<hr />
					<p class="mb-0">If you are looking for the barebones opt-in page, this is the one for you.</p>
					<p class="mb-2"><small>Psychological biases: <a href="">Reward Bias</a></small></p>
					<a href="/onboarding/edit-template/1" class="btn btn-sm btn-primary">Choose this Template</a>
				</li>

				<li class="list-group-item">
					<h4>Basic Opt-in with Video</h4>
					<hr />
					<p class="mb-0">The Basic Opt-in template with the option to add a YouTube video. Use a video that introduces who you are and what you do and tap into the liking bias.</p>
					<p class="mb-2"><small>Psychological biases: <a href="">Reward Bias</a>, <a href="">Liking Bias</a></small></p>
					<a href="/onboarding/edit-template/2" class="btn btn-sm btn-primary">Choose this Template</a>
				</li>

				<li class="list-group-item">
					<h4>Basic Opt-in with Countdown Timer</h4>
					<hr />
					<p class="mb-0">The Basic Opt-in template with the option to add a countdown timer which adds urgency. Warning: Not a fake timer. It will actually expire and your traffic will not be able to enter their information.</p>
					<p class="mb-2"><small>Psychological biases: <a href="">Reward Bias</a>, <a href="">Urgency Bias</a></small></p>
					<a href="/onboarding/edit-template/3" class="btn btn-sm btn-primary">Choose this Template</a>
				</li>
			</ul>
		</div>
	</div>
@endsection