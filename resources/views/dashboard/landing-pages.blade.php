@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2>Landing Pages</h2>
			</div>
		</div>

		<div class="row m-t-40">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive table--no-card m-b-40">
					<table class="table table-borderless table-striped table-earning">
						<thead>
							<tr>
								<th>Name</th>
								<th>Idea Campaign</th>
								<th>Funnel</th>
								<th>Impressions</th>
								<th>Signups</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Free Trial Offer</td>
								<td>Product-Market Fit Software Tool</td>
								<td>Trial Funnel</td>
								<td>128</td>
								<td>18</td>
								<td><a href="" class="btn btn-warning">Edit</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection