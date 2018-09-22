<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Metatags -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Styling -->
		<style type="text/css">
			@media screen and (max-device-width: 480px) {
				body {
					width: 100%;
				}
			}

			.header {
				background-color: black;
				text-align: center;
				padding: 16px;
				border-top-left-radius: 8px;
				border-top-right-radius: 8px;
				border-top: 2px solid #EEEEEE;
				border-left: 2px solid #EEEEEE;
				border-right: 2px solid #EEEEEE;
			}

			.header > h1 {
				color: white;
				text-align: center;
			}

			.main {
				padding: 16px;
				border-left: 2px solid #EEEEEE;
				border-right: 2px solid #EEEEEE;
			}

			.footer {
				background-color: #EEEEEE;
				text-align: center;
				padding: 16px;
				border-bottom-left-radius: 8px;
				border-bottom-right-radius: 8px;
				border-left: 2px solid #EEEEEE;
				border-right: 2px solid #EEEEEE;
				border-bottom: 2px solid #EEEEEE;
			}

			.footer > p {
				margin-bottom: 2px;
				margin-top: 2px;
				font-size: 12px;
				text-align: center;
			}
		</style>
	</head>
	<body style="width: 80%; display: block; margin-left: auto; margin-right: auto;">
		<div class="header">
			<h1>{{ $header_text }}</h1>
		</div>

		<div class="main">
			<p>Hey {{ $first_name }},</p>
			{!! $body !!}
			<p>Cheers, <br>OptinDev Team</p>
		</div>

		<div class="footer">
			<p>&copy; 2018 OptinDev</p>
			<p>You are receiving this email because you registered for an account at OptinDev. If you wish to turn off email notifications, please click <a href="http://www.google.com">here</a>.</p>
		</div>
	</body>
</html>