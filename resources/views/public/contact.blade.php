@extends('layouts.public-app')

@section('content')
	@include('layouts.public-header')

	<div class="container mt-32 mb-32">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-offset-md-1 col-sm-12 col-xs-12">
				<div class="well">
					<form id="contact_form">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
								<label>Name<span class="red">*</span>:</label>
								<input type="text" name="name" class="form-control" required>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
								<label>Email<span class="red">*</span>:</label>
								<input type="email" name="email" class="form-control" required>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
								<label>Message<span class="red">*</span>:</label>
								<textarea form="contact_form" class="form-control" rows="4"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
								<input type="submit" class="btn btn-primary center-button" value="Submit">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection