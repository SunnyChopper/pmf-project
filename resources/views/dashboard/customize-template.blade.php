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

		<div class="row">
			<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
				<form id="create_lp_form" method="post" action="/lp/render/{{ $template_id }}">
					@csrf
					<div class="row">
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
				</form>
			</div>
		</div>

		@include('layouts.footer')
	</div>
@endsection