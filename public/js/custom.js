/* -------------------------- *\
	Signup AJAX
\* -------------------------- */

$("#signup_form").on('submit', function(e) {
	// Prevent from submitting
	e.preventDefault();
});

$(".create-signup").on('click', function() {
	// Get relevant data
	var _token = $("input[name=_token]").val();
	var name = $("input[name=name]").val();
	var email = $("input[name=email]").val();
	var landing_page_id = $("input[name=landing_page_id]").val();
	var marketing_consent = 1;

	console.log("Token: " + _token);
	console.log("Name: " + name);
	console.log("Email: " + email);
	console.log("Landing Page ID: " + landing_page_id);
	console.log("Marketing consent: " + marketing_consent);

	// Create AJAX request
	$.ajax({
		url: '/signups/create',
		method: 'post',
		data: {
			_token: _token,
			name: name,
			email: email,
			landing_page_id: landing_page_id,
			marketing_consent: marketing_consent
		},
		success: function(data) {
			if (data == "Successful") {
				$(".success-message").html('Successfully submitted.');
			} else {
				$(".failure-message").html(data);
			}
		}
	});
});

/* -------------------------- *\
	Checkout functions
\* -------------------------- */

$("#submit_button").on('click', function() {
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
		// Not a trial
		var stripeToken = $("input[name=stripeToken]").val();

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
					window.location.replace(window.location.hostname + '/dashboard/');
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
					window.location.replace(window.location.hostname + '/dashboard/');
				}
			}
		});
	}
});


/* -------------------------- *\
	Modal functions
\* -------------------------- */

function showDeleteSignupModal(signup_id) {
	// Set the hidden input
	$("input[name=signup_id]").val(signup_id);

	// Show the modal
	$("#delete_signup_modal").appendTo("body");
	$("#delete_signup_modal").modal('show');
}