@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2 class="title-1">Edit Your Opt-in Page</h2>
				<p class="mt-2">Fields with <span class="red">*</span> are required.</p>
				<hr />
			</div>
		</div>

		<form id="create_lp_form" method="post" action="/lp/render/{{ $template_id }}/edit">
			@csrf
			<input type="hidden" name="landing_page_id" value="{{ $landing_page->id }}">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<h4>Opt-in Page Meta Information</h4>
					<ul class="list-group mt-16">
						<li class="list-group-item">
							<div class="form-group">
								<h5>Select Idea<span class='red'>*</span>:</h5>
								<p class="mb-2">The opt-in page will belong to the chosen Value Idea.</p>
								<select form="create_lp_form"  class="form-control" name="idea_id">
									@foreach($ideas as $idea)
										<option value="{{ $idea->id }}" <?php if($idea->id == $landing_page->idea_id) { echo "selected"; } ?>>{{ $idea->name }}</option>
									@endforeach
								</select>
							</div>
						</li>

						<li class="list-group-item">
							<div class="form-group	">
								<h5>Name of Opt-in Page<span class='red'>*</span>:</h5>
								<p class="mb-2">This is how you will identify the opt-in page in your admin dashboard. Your audience will not see this.</p>
								<input type="text" name="landing_page_name" value="{{ $landing_page->name }}" class="form-control">
							</div>
						</li>

						<li class="list-group-item">
							<div class="form-group">
								<h5>Google Analytics Code:</h5>
								<p class="mb-2">If you would like to track users that come to your opt-in page using Google Analytics, you can input the code snippet here.</p>
								<textarea form="create_lp_form" name="google_analytics_code" class="form-control" rows="4">{{ $landing_page->google_analytics_code }}</textarea>
							</div>
						</li>
					</ul>
				</div>
			</div>

			@if(count($ideas) != 0)
			<div class="row mt-32">
				<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
					<h4>Opt-in Page Fields</h4>
					<ul class="list-group mt-16 mb-16">
						@foreach($xml_tags as $tag => $tag_data)
							<?php
								switch ($tag_data[0]) {
									case "text":
										echo "<li class='list-group-item'>";
											echo "<div class='form-group'>";
												echo "<h5>" . $tag_data[1] . "<span class='red'>*</span>:</h5>";
												echo "<p>" . $tag_data[2] . "</p>";
												echo "<input type='text' class='form-control' name='" . $tag ."' value='" . $xml_data[$tag] . "' required>";
											echo "</div>";
										echo "</li>";
										break;
									case "textarea":
										echo "<li class='list-group-item'>";
											echo "<div class='form-group'>";
												echo "<h5>" . $tag_data[1] . "<span class='red'>*</span>:</h5>";
												echo "<p>" . $tag_data[2] . "</p>";
												echo "<textarea form='create_lp_form' class='form-control' name='" . $tag ."' required>" . $xml_data[$tag] . "</textarea>";
											echo "</div>";
										echo "</li>";
										break;
									case "date":
										echo "<li class='list-group-item'>";
											echo "<div class='form-group'>";
												echo "<h5>" . $tag_data[1] . "<span class='red'>*</span>:</h5>";
												echo "<p>" . $tag_data[2] . "</p>";
												echo "<input type='date' class='form-control' name='" . $tag . "' value='" . $xml_data[$tag] . "' required>";
											echo "</div>";
										echo "</li>";
										break;
									default:
										break;
								}
							?>
						@endforeach
					</ul>

					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
							<input type="submit" class="btn btn-primary" value="Preview Opt-in Page">
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