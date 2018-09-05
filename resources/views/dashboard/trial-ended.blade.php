@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="overview-wrap">
					<h2 class="title-1">Uh Oh! Trial Ended!</h2>
				</div>
			</div>
		</div>

		<div class="row mt-32">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="well">
					<p class="text-center">Looks like your trial has ended. You may still access your existing landing pages, however, to create new ideas and edit existing ideas, click below to upgrade to the Pro version.</p>
					<div class="row mt-16">
						<div class="col-lg-4 offset-lg-4 col-md-4 offset-md-4 col-sm-12 col-xs-12">
							<a class="btn btn-primary center-button" href="/checkout/{{ $user->id }}">Upgrade to Pro</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection