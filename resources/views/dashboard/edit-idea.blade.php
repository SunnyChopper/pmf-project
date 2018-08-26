@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2 class="title-1">Edit Idea</h2>
				<hr />
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
				<form action="/idea/edit/{{ $idea->id }}" method="post" id="edit_idea_form">
					@csrf
					<div class="row">
						<div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Name of Idea:</label>
								<input type="text" name="name" value="{{ $idea->name }}" class="form-control" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Description of Idea:</label>
								<textarea name="description" form="edit_idea_form" class="form-control" rows="4">{{ $idea->description }}</textarea>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							<input type="submit" class="btn btn-success" value="Save">
						</div>
					</div>
				</form>
			</div>
		</div>

		<div class="row mt-32">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2 class="title-2">Landing Pages</h2>	
			</div>
		</div>

		@if(count($landing_pages) == 0)
			<div class="row mt-16">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<p>You have not created any landing pages yet for this idea...</p>
					<a href="" class="btn btn-sm btn-primary mt-2">New Landing Page</a>
				</div>
			</div>
		@else
		@endif

		@include('layouts.footer')
	</div>
@endsection