@extends('onboarding.layouts.app')

@section('content')
	<div class="row mt-16">
		<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
			<h3>Customize Your Template</h3>
			<p>Enter in the values for each of the fields below and then click Render. Included are descriptions to help you come up with text.</p>
			<p>Fields with <span class="red">*</span> are required.</p>
		</div>
	</div>

	<div class="row mt-16">
		<div class="col-lg-8 offset-lg-2 col-md-8 offset-md-2 col-sm-12 col-xs-12">
			<form action="/onboarding/render-optin-page" method="post" id="create_optin_form">
				@csrf
				<input type="hidden" name="template_id" value="{{ $template_id }}">
				<div class="row">
					<ul class="list-group">
						<li class="list-group-item">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-16 mb-16">
								<div class="form-group mt-8">
									<h5>Name of Landing Page<span class="red">*</span>:</h5>
									<p class="mb-2">Your audience won't see this but this is how you will identify this opt-in page.</p>
									<input type="text" name="landing_page_name" class="form-control" required>
								</div>
							</div>
						</li>

						<li class="list-group-item">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group mt-8">
									<h5>Privacy Policy Link:</h5>
									<p class="mb-2">Having a privacy policy link is not required, however, if you want to remain GDRP compliant, it is important to include the URL to your privacy policy. OptinDev is not responsible if you do not comply to GDPR regulations.</p>
									<input type="text" name="privacy_policy_link" value="{{ $landing_page->privacy_policy_link }}" class="form-control" required>
								</div>
							</div>
						</li>

						<li class="list-group-item">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group mt-8">
									<h5>Google Analytics Code:</h5>
									<p class="mb-2">If you would like to track users that come to your landing page using Google Analytics, you can input the code snippet here.</p>
									<textarea form="create_lp_form" name="google_analytics_code" class="form-control" rows="4"></textarea>
								</div>
							</div>
						</li>

						@foreach($xml_tags as $tag => $tag_data)
							<li class="list-group-item">
								<?php
									switch ($tag_data[0]) {
										case "text":
											echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-16 mb-16'>";
												echo "<div class='form-group'>";
													echo "<h5>" . $tag_data[1] . "<span class='red'>*</span>:</h5>";
													echo "<p>" . $tag_data[2] . "</p>";
													echo "<div class='row'>";
														echo "<div class='col-lg-10 col-md-8 col-sm-12 col-xs-12'>";
															echo "<input type='text' class='form-control' name='" . $tag ."' required>";
														echo "</div>";
													echo "</div>";
												echo "</div>";
											echo "</div>";
											break;
										case "textarea":
											echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-16 mb-16'>";
												echo "<div class='form-group'>";
													echo "<h5>" . $tag_data[1] . "<span class='red'>*</span>:</h5>";
													echo "<p>" . $tag_data[2] . "</p>";
													echo "<textarea form='create_optin_form' class='form-control' name='" . $tag ."' required></textarea>";
												echo "</div>";
											echo "</div>";
											break;
										case "date":
											echo "<div class='col-lg-6 col-md-8 col-sm-12 col-xs-12 mt-16 mb-16'>";
												echo "<div class='form-group'>";
													echo "<h5>" . $tag_data[1] . "<span class='red'>*</span>:</h5>";
													echo "<p>" . $tag_data[2] . "</p>";
													echo "<input type='date' class='form-control' name='" . $tag . "' required>";
												echo "</div>";
											echo "</div>";
											break;
										default:
											break;
									}
								?>
							</li>
						@endforeach
					</ul>

					<div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-sm-12 col-xs-12 mt-32">
						<input type="submit" value="Render Opt-in Page" class="btn btn-primary center-button">
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection