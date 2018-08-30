/* -------------------------- *\
	Signup AJAX
\* -------------------------- */

$(".create-signup").on('click', function() {
	// Get relevant data
	var _token = $("input[name=token]").val();
	var name = $("input[name=name]").val();
	var email = $("input[name=email]").val();

	// Create AJAX request
	$.ajax({
		url: '/signups/create',
		data: {
			_token: _token,
			name: name,
			email: email
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