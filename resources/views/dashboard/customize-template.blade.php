@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2 class="title-1">Customize Your Template</h2>
				<p class="mt-2">Fields with <span class="red">*</span> are required.</p>
				<hr />
			</div>
		</div>

		<form id="create_lp_form" method="post" action="/lp/render/{{ $template_id }}/save">
			@csrf
			<div class="row">
				<div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
					<h4>Landing Page Meta Information</h4>
					<ul class="list-group mt-16">
						<li class="list-group-item">
							<div class="form-group">
								<h5>Select Value Idea<span class='red'>*</span>:</h5>
								<p class="mb-2">The landing page will belong to the chosen Value Idea.</p>
								<select form="create_lp_form"  class="form-control" name="idea_id">
									@foreach($ideas as $idea)
										<option value="{{ $idea->id }}">{{ $idea->name }}</option>
									@endforeach
								</select>
							</div>
						</li>

						<li class="list-group-item">
							<div class="form-group">
								<h5>Name of Landing Page<span class="red">*</span>:</h5>
								<p class="mb-2">This is how you will identify the landing page in your admin dashboard. Your audience will not see this.</p>
								<input type="text" name="landing_page_name" class="form-control" required>
							</div>
						</li>

						<li class="list-group-item">
							<div class="form-group">
								<h5>Google Analytics Code</h5>
								<p class="mb-2">If you would like to track users that come to your landing page using Google Analytics, you can input the code snippet here.</p>
								<textarea form="create_lp_form" name="google_analytics_code" class="form-control" rows="4"></textarea>
							</div>
						</li>
					</ul>
				</div>
			</div>

			@if(count($ideas) != 0)
			<div class="row mt-16">
				<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
					<h4>Landing Page Fields</h4>
						<ul class="list-group mt-16 mb-16">
							@foreach($xml_tags as $tag => $tag_data)
								<?php
									switch ($tag_data[0]) {
										case "text":
											echo "<li class='list-group-item'>";
												echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
													echo "<div class='form-group'>";
														echo "<h5>" . $tag_data[1] . "<span class='red'>*</span>:</h5>";
														echo "<p>" . $tag_data[2] . "</p>";
														echo "<input type='text' class='form-control' name='" . $tag ."' required>";
													echo "</div>";
												echo "</div>";
											echo "</li>";
											break;
										case "textarea":
											echo "<li class='list-group-item'>";
												echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
													echo "<div class='form-group'>";
														echo "<h5>" . $tag_data[1] . "<span class='red'>*</span>:</h5>";
														echo "<p>" . $tag_data[2] . "</p>";
														echo "<textarea form='create_lp_form' class='form-control' name='" . $tag ."' required></textarea>";
													echo "</div>";
												echo "</div>";
											echo "</li>";
											break;
										case "date":
											echo "<li class='list-group-item'>";
												echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
													echo "<div class='form-group'>";
														echo "<h5>" . $tag_data[1] . "<span class='red'>*</span>:</h5>";
														echo "<p>" . $tag_data[2] . "</p>";
														echo "<input type='date' class='form-control' name='" . $tag . "' required>";
													echo "</div>";
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