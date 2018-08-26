<html>
	<head>
		<!-- Required meta tags-->
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    <!-- Bootstrap CSS-->
    	<link href="{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
	</head>
	<body>
		@include('layouts.preview-navbar')
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<h1 id="title">{{ $data->title }}</h1>
					<p id="description">{{ $data->description }}</p>
					<h3 id="benefit-title">{{ $data->benefit_title }}</h3>
					<p id="benefit_description">{{ $data->benefit_description }}</p>
				</div>
			</div>
		</div>
	</body>
</html>