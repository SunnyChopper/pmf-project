@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2>Signups</h2>
			</div>
		</div>

		<div class="row m-t-25">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive table--no-card m-b-40">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                            	<th>Date</th>
                                <th>Idea</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>August 3rd, 2018</td>
                                <td>Product-Market Fit Software Tool</td>
                                <td>Sunny Singh</td>
                                <td>ishy.singh@gmail.com</td>
                                <td><a href="" class="btn btn-danger">Delete</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>
@endsection