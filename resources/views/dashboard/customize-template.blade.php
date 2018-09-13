@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2 class="title-1">Customize Your Template</h2>
				<p class="mt-2">Fill in the fields, click on next, and it will render your landing page.</p>
				<hr />
			</div>
		</div>

		<form id="create_lp_form" method="post" action="/lp/render/{{ $template_id }}/save">
			@csrf
			<div class="row">
				<div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
					<h4>Landing Page Meta Information</h4>
					<div class="form-group mt-8">
						<label>Select Idea</label>
						<select form="create_lp_form"  class="form-control" name="idea_id">
							@foreach($ideas as $idea)
								<option value="{{ $idea->id }}">{{ $idea->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group mt-8">
						<label>Name of Landing Page</label>
						<input type="text" name="landing_page_name" class="form-control">
					</div>
				</div>
			</div>

			@if(count($ideas) != 0)
			<div class="row mt-16">
				<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
					<h4>Landing Page Fields</h4>
					<div class="row mt-8">
						@foreach($xml_tags as $tag => $tag_data)
							<?php
								switch ($tag_data[0]) {
									case "text":
										echo "<div class='col-lg-8 col-md-10 col-sm-12 col-xs-12'>";
											echo "<div class='form-group'>";
												echo "<label>" . $tag_data[1] . ":</label>";
												echo "<input type='text' class='form-control' name='" . $tag ."' required>";
											echo "</div>";
										echo "</div>";
										break;
									case "textarea":
										echo "<div class='col-lg-10 col-md-12 col-sm-12 col-xs-12'>";
											echo "<div class='form-group'>";
												echo "<label>" . $tag_data[1] . ":</label>";
												echo "<textarea form='create_lp_form' class='form-control' name='" . $tag ."' required></textarea>";
											echo "</div>";
										echo "</div>";
										break;
									case "date":
										echo "<div class='col-lg-6 col-md-8 col-sm-12 col-xs-12'>";
											echo "<div class='form-group'>";
												echo "<label>" . $tag_data[1] . ":</label>";
												echo "<input type='date' class='form-control' name='" . $tag . "' required>";
											echo "</div>";
										echo "</div>";
										break;
									default:
										break;
								}
							?>
						@endforeach
					</div>

					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
							<input type="submit" class="btn btn-primary" value="Preview Landing Page">
						</div>
					</div>
				</div>
			</div>
			@else
			<div class="row mt-32">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="well">
						<p class="text-center">Uh oh! Seems like you haven't created any ideas. You must first create an idea before you can add landing pages!</p>
					</div>
				</div>
			</div>
			@endif
		</form>

		@include('layouts.footer')
	</div>
@endsection