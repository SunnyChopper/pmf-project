@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2 class="title-1">Create New Idea</h2>
				<p class="mt-2">Everything starts with an idea, however, before you go all in your idea, it is wise to validate your idea with the market. Let's get started.</p>
				<hr />
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
				<form action="/idea/create" method="post" id="new_idea_form">
					@csrf
					<div class="row">
						<div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Name of Idea:</label>
								<input type="text" name="name" class="form-control" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Description of Idea:</label>
								<textarea name="description" form="new_idea_form" class="form-control" rows="4"></textarea>
							</div>
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