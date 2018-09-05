@extends('layouts.public-app')

@section('content')
	@include('layouts.public-header')

	<div class="container mt-64 mb-64">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3 col-md-8 col-mf-offset-2 col-sm-12 col-xs-12">
				<div class="jumbotron">
					<form action="/register/free-trial" method="post" id="start_trial_form">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
								<label>First Name<span class="red">*</span>:</label>
								<input type="text" name="first_name" class="form-control" required>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
								<label>Last Name<span class="red">*</span>:</label>
								<input type="text" name="last_name" class="form-control" required>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
								<label>Email<span class="red">*</span>:</label>
								<input type="email" name="email" class="form-control" required>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
								<label>Password<span class="red">*</span>:</label>
								<input type="password" name="password" class="form-control" required>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<p class="text-center red" id="error"></p>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
								<input type="submit" class="btn btn-success center-button" value="Start My Trial">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script type="text/javascript">
		/* -------------------------- *\
			Checkout AJAX
		\* -------------------------- */

		$("#start_trial_form").on('submit', function(e) {
			// Prevent from sending
			e.preventDefault();

			// Clear out error
			$("#error").html("");

			// Get data
			var _token = $("input[name=_token]").val();
			var first_name = $("input[name=first_name]").val();
			var last_name = $("input[name=last_name]").val();
			var email = $("input[name=email]").val();
			var password = $("input[name=password]").val();

			// Submit using AJAX
			$.ajax({
				url: '/register/free-trial',
				type: 'POST',
				data: {
					_token: _token,
					first_name: first_name,
					last_name: last_name,
					email: email,
					password: password
				},
				success: function(data) {
					if (data == "Duplicate email") {
						$("#error").html("An account is already associated with this email.");
					} else {
						window.location.replace('{{ url('/dashboard/') }}');
					}
				}
			});
		});
	</script>
@endsection