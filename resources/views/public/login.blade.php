@extends('layouts.public-app')

@section('content')
	@include('layouts.public-header')

	<div class="container mt-64 mb-64">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
				<div class="well">
					<form id="login_form" method="post" action="/login/attempt">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
								<label>Email:</label>
								<input type="text" name="email" class="form-control" required>
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
								<label>Password:</label>
								<input type="password" name="password" class="form-control" required>
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<p id="error" class="red"></p>
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
								<input type="submit" value="Login" class="btn btn-primary center-button">
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
		$("#login_form").on('submit', function(e) {
			// Prevent from sending
			e.preventDefault();

			// Clear out error
			$("#error").html("");

			// Get data
			var _token = $("input[name=_token]").val();
			var email = $("input[name=email]").val();
			var password = $("input[name=password]").val();

			// Submit using AJAX
			$.ajax({
				url: '/login/attempt',
				type: 'POST',
				data: {
					_token: _token,
					email: email,
					password: password
				},
				success: function(data) {
					if (data != "Success") {
						$("#error").html(data);
					} else {
						window.location.replace('{{ url('/dashboard/') }}');
					}
				}
			});
		});
	</script>
@endsection