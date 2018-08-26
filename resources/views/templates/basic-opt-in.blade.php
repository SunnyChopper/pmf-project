<html>
	<head>
		<!-- Required meta tags-->
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    <title>{{ config('app.name') }}</title>

	    <!-- Bootstrap CSS-->
    	<link href="{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h1 id="title">{{ $xml_data["title"] }}</h1>
					<p id="description">{{ $xml_data["description"] }}</p>
					<h3 id="benefit_title">{{ $xml_data["benefit_title"] }}</h3>
					<p id="benefit_description">{{ $xml_data["benefit_description"] }}</p>
				</div>
			</div>
		</div>
	</body>
</html>