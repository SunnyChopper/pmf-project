@extends('layouts.public-app')

@section('content')
	@include('layouts.public-header')

	<div class="container mt-32 mb-32">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="col-lg-10 col-lg-offset-1 col-md-8 offset-md-2 col-sm-12 col-xs-12" style="background-color: #EAEAEA; padding: 24px; border-radius: 8px;">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h2>Checkout</h2>
							<p>Included is a 30 day free trial. Billing will start to occur after your 30 day free trial membership is over.</p>
							<p style="margin-bottom: 4px;">Your total after the free 30 day trial is...</p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<form action="/test" method="POST" id="payment-form">
								@csrf
								<div style="background-color: white; padding: 16px; border-radius: 8px;">
									<input type="hidden" name="user_id"
									<input type="hidden" name="stripeToken">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>First Name<span style="color: red;">*</span>:</label>
												<input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" required>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Last Name<span style="color: red;">*</span>:</label>
												<input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required>
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label>Email<span style="color: red;">*</span>:</label>
												<input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
											</div>
										</div>

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
									</div>
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p id="card_errors"></p>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-lg-offset-3 col-md-8 offset-md-2 col-sm-12 col-xs-12">
											<input type="submit" id="submit_button" class="btn btn-success" style="width: 100%;" value="Checkout">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection