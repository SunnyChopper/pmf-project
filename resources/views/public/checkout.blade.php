@extends('layouts.public-app')

@section('content')
	@include('layouts.public-header')

	<div class="container mt-32 mb-32">
		<div class="row">
			<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
				<h2>What You Are Getting Today</h2>
				<hr />
				<p>Brands are popping up every single day and the need to stand out is become more crucial. This is the advantage you're getting today by investing in OptinDev:</p>
				<ul class="list-group">
					<li class="list-group-item">
						<h4 class="mb-4">Efficiently create effective opt-in pages</h4>
						<p class="mb-0" style="line-height: 26px;">By utilizing the opt-in page builder, you can create new opt-in pages rapidly and publish for the wider internet.</p>
					</li>
					<li class="list-group-item">
						<h4 class="mb-4">Cutting edge psychology to help you get attention</h4>
						<p class="mb-0" style="line-height: 26px;">Take advantage of psychological biases which will help you convert more visitors to your opt-in pages. No research needed.</p>
					</li>
					<li class="list-group-item">
						<h4 class="mb-4">Artificial intelligence to help you grow faster</h4>
						<p class="mb-0" style="line-height: 26px;">Use the power of artificial intelligence to help you test what resonates with your audience and help you grow even faster.</p>
					</li>
					<li class="list-group-item">
						<h4 class="mb-4">Get the help and support you need to grow</h4>
						<p class="mb-0" style="line-height: 26px;">Having a problem with the software? Is something confusing you? Want to talk strategy? Hit our line and we'll get back to you.</p>
					</li>
				</ul>
			</div>

			<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
				<div style="background-color: #EAEAEA; padding: 24px; border-radius: 8px;">
					<h2 class="mb-4">{{ $plan->title }}</h2>
					<p class="mb-4">Only {{ 75 - $plan->signups }} spots left!</p>
					<div class="progress mb-16">
						<div class="progress-bar" role="progressbar" style="width: {{ ((75 - $plan->signups)/75) * 100 }}%" aria-valuenow="{{ ((75 - $plan->signups)/75) * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<p class="mb-4">{{ $plan->description }}</p>
					@if($plan->trial == 1)
					{{-- <p>Included is a {{ $plan->trial_days }} day free trial. Billing will start to occur after your {{ $plan->trial_days }} day free trial membership is over.</p> --}}
					<p class="mb-16">Your total after the free trial is ${{ $plan->price }}.</p>
					@else
					<p>Your total today will be ${{ $plan->price }}.</p>
					@endif

					<form action="/plan/register/{{ $plan->id }}" method="POST" id="payment-form">
						@csrf
						<div style="background-color: white; padding: 16px; border-radius: 8px;">
							@if((75-$plan->signups) > 0)
								@if($plan->trial == 0)
									<input type="hidden" name="stripeToken">
								@endif
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<div class="form-group">
											<label>First Name<span style="color: red;">*</span>:</label>
											<input type="text" class="form-control" name="first_name" required>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<div class="form-group">
											<label>Last Name<span style="color: red;">*</span>:</label>
											<input type="text" class="form-control" name="last_name" required>
										</div>
									</div>

									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="form-group">
											<label>Email<span style="color: red;">*</span>:</label>
											<input type="email" class="form-control" name="email" required>
										</div>
									</div>

									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="form-group">
											<label>Password<span style="color: red;">*</span>:</label>
											<input type="password" class="form-control" name="password" required>
										</div>
									</div>

									@if($plan->trial == 0)
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Credit Card Number<span style="color: red;">*</span>:</label>
												<input type="text" class="form-control" name="cc_number" data-stripe="number" required>
											</div>
										</div>

										<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Expiry Month<span style="color: red;">*</span>:</label>
												<select id="expiry_month" class="form-control" name="expiry_month" data-stripe="exp_month">
													<option value="01">01</option>
													<option value="02">02</option>
													<option value="03">03</option>
													<option value="04">04</option>
													<option value="05">05</option>
													<option value="06">06</option>
													<option value="07">07</option>
													<option value="08">08</option>
													<option value="09">09</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
												</select>
											</div>
										</div>

										<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Expiry Year<span style="color: red;">*</span>:</label>
												<select id="expiry_year" class="form-control" name="expiry_year" data-stripe="exp_year">
													<option value="2018">18</option>
													<option value="2019">19</option>
													<option value="2020">20</option>
													<option value="2021">21</option>
													<option value="2022">22</option>
													<option value="2023">23</option>
													<option value="2024">24</option>
													<option value="2025">25</option>
													<option value="2026">26</option>
													<option value="2027">27</option>
													<option value="2028">28</option>
													<option value="2029">29</option>
													<option value="2030">30</option>
												</select>
											</div>
										</div>

										<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>CVC Number<span style="color: red;">*</span>:</label>
												<input type="text" class="form-control" name="cvc_number" data-stripe="cvc" required>
											</div>
										</div>
									@endif
								</div>
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<p id="error" style="text-align: center; color: red;"></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-lg-offset-3 col-md-8 offset-md-2 col-sm-12 col-xs-12">
										<input type="submit" id="submit_button" class="btn btn-success" style="width: 100%;" value="Checkout">
									</div>
								</div>
							@else
								<p class="text-center mb-0">Sorry, all beta spots are taken up...</p>
							@endif
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
<script type="text/javascript">
function stripeResponseHandler(status, response) {
	var form = $("#payment-form");
	if (response.error) {
		form.find("#error").text(response.error.message);
		form.find("#error").prop('color', 'red');
	} else {
		var token = response['id'];
		$('input[name=stripeToken]').val(token);
	}
}

$("#submit_button").on('click', function() {
	$("#error").html('');
	$("#payment-form").submit();
});

$("#payment-form").on('submit', function(e) {
	// Prevent from submitting
	e.preventDefault();

	// Get relevant data
	var _token = $("input[name=_token]").val();
	var first_name = $("input[name=first_name]").val();
	var last_name = $("input[name=last_name]").val();
	var email = $("input[name=email]").val();
	var password = $("input[name=password]").val();

	// Check if trial
	if ($("input[name=stripeToken]").length > 0) {
		Stripe.setPublishableKey('pk_test_WFYehcCYQRc0CBqKKoFunRNr');

		// Disable button
		form.find('#submit_button').prop('disabled', true);

		// Get card details
		var card = {
			number: $('input[name=cc_number]').val(),
			cvc: $('input[name=cvc_number]').val(),
			exp_month: $('#expiry_month option:selected').val(),
			exp_year: $('#expiry_year option:selected').val()
		};

		// Create a card with Stripe
		Stripe.createToken(card, stripeResponseHandler);

		// Get token
		var stripeToken = $("input[name=stripeToken]").val();

		console.log($(this).attr('action'));

		// Create AJAX request
		$.ajax({
			url: $(this).attr('action'),
			method: $(this).attr('method'),
			data: {
				_token: _token,
				first_name: first_name,
				last_name: last_name,
				email: email,
				password: password,
				stripeToken: stripeToken
			},
			success: function(data) {
				if (data != "Success") {
					$("#error").html(data);
				} else {
					// Switch to dashboard
					window.location.replace('/login');
				}
			}
		});
	} else {
		// Create AJAX request
		$.ajax({
			url: $(this).attr('action'),
			method: $(this).attr('method'),
			data: {
				_token: _token,
				first_name: first_name,
				last_name: last_name,
				email: email,
				password: password
			},
			success: function(data) {
				if (data != "Success") {
					$("#error").html(data);
				} else {
					// Switch to dashboard
					window.location.replace('/login');
				}
			}
		});
	}
});
</script>
@endsection