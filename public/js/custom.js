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
			// Empty out the fields
			$("input[name=name]").val('');
			$("input[name=email]").val('');

			// Display feedback
			if (data == "Successful") {
				$(".success-message").html('Successfully submitted.');
			} else {
				$(".error-message").html(data);
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
	Editing text functions
\* -------------------------- */

$("#copy_url_referrer").on('input', function() {
	// Get base URL
	var url = $("#copy_url_base").val();

	// Get extension
	var extension = $("#copy_url_referrer").val().toLowerCase();

	// Create full URL
	if (extension != "") {
		var full_url = url + "?ref=" + extension;
		$("#copy_url_final").val(full_url);
	} else {
		$("#copy_url_final").val(url);
	}
});


/* -------------------------- *\
	Modal functions
\* -------------------------- */

function showDeleteIdeaModal(idea_id) {
	// Set the hidden input
	$("input[name=idea_id]").val(idea_id);

	// Show the modal
	$("#delete_idea_modal").appendTo("body");
	$("#delete_idea_modal").modal('show');
}

function showDeleteOptinModal(landing_page_id) {
	// Set the hidden input
	$("input[name=landing_page_id]").val(landing_page_id);

	// Show the modal
	$("#delete_optin_page_modal").appendTo("body");
	$("#delete_optin_page_modal").modal('show');
}

function showCopyURLModal(url_extension) {
	// Create the url
	var host = document.location.host;
	var url = host + "/lp/" + url_extension;

	// Open copy URL modal
	$("#copy_url_modal").appendTo("body");
	$("#copy_url_modal").modal('show');

	// Set disabled input
	$("#copy_url_final").val(url);

	// Set hidden input
	$("#copy_url_base").val(url);
}

function showDeleteSignupModal(signup_id) {
	// Set the hidden input
	$("input[name=signup_id]").val(signup_id);

	// Show the modal
	$("#delete_signup_modal").appendTo("body");
	$("#delete_signup_modal").modal('show');
}