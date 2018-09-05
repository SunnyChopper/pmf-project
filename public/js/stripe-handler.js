function stripeResponseHandler(status, response) {
	var form = $("#payment-form");
	if (response.error) {
		form.find("#card_errors").text(response.error.message);
		form.find("#card_errors").prop('color', 'red');
	} else {
		var token = response['id'];
		$('input[name=stripeToken]').val(token);
		console.log(token);
		form.get(0).submit();
	}
}

$(document).ready(function() {
	Stripe.setPublishableKey('pk_test_WFYehcCYQRc0CBqKKoFunRNr');

	// Event listener
	var form = $("#payment-form");

	form.on('submit', function(e) {
		// Prevent the form from submitting
		e.preventDefault();

		// Disable button
		form.find('#submit_button').prop('disabled', true);

		var card = {
			number: $('input[name=cc_number]').val(),
			cvc: $('input[name=cvc_number]').val(),
			exp_month: $('#expiry_month option:selected').val(),
			exp_year: $('#expiry_year option:selected').val()
		};

		// Create a card with Stripe
		Stripe.createToken(card, stripeResponseHandler);
	});
});