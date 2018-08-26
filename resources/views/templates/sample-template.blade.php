<html>
	<head>
		<title>{{ config('app.name') }}</title>

		<!-- Bootstrap CSS-->
    	<link href="{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h2 id="title">{{ $node_array["title"] }}</h2>
					<h4 id="title-2">{{ $node_array["title-2"] }}</h4>
					<p id="description">{{ $node_array["description"] }}</p>
				</div>
			</div>
		</div>
	</body>
</html>