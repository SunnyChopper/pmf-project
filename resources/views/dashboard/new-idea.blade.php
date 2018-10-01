@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2 class="title-1">Create New Value Idea</h2>
				<p class="mt-2">It is extremely important that you provide value to your audience so you can build a large following that you can then later leverage to further grow your brand or sell to. Let's get started.</p>
				<hr />
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
				<form action="/idea/create" method="post" id="new_idea_form">
					@csrf
					<div class="row mb-16">
						<div class="col-lg-10 col-md-12s col-sm-12 col-xs-12">
							<ul class="list-group">
								<li class="list-group-item">
									<div class="form-group">
										<h5>Name of Value Idea:</h5>
										<p>Give this Value Idea a name. Don't worry, you can change it later.</p>
										<input type="text" name="name" class="form-control" required>
									</div>
								</li>
								<li class="list-group-item">
									<div class="form-group">
										<h5>Description of Idea:</h5>
										<p>Let's get a bit specific with this. The more specific you are, the better your vision will come out. Who will benefit? What is it that you're offering? Where will they receive that value? Why do you think they will like your offer?</p>
										<textarea name="description" form="new_idea_form" class="form-control" rows="4"></textarea>
									</div>
								</li>
							</ul>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<input type="submit" class="btn btn-success" value="Submit">
						</div>
					</div>
				</form>
			</div>
		</div>

		@include('layouts.footer')
	</div>
@endsection