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
				$(".failure-message").html('Uh oh, there was an error somewhere! We\'re working on it, try again soon...');
			}
		}
	});
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