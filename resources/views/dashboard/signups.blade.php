@extends('layouts.app')

@section('content')
    @include('modals.delete-signup-modal')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2>Signups</h2>
                <p class="mt-2">These are the leads that have been collected from opt-in pages that do not use ManyChat. You may delete data if requested by the user.</p>
                <hr />
			</div>
		</div>

        @if(count($signups) != 0)
		<div class="row m-t-25">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive table--no-card m-b-40">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                            	{{-- <th>Date</th> --}}
                                <th>Name</th>
                                <th>Email</th>
                                <th>Opt-in Page</th>
                                {{-- <th>Marketing Consent</th> --}}
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($signups as $signup)
                                <tr>
                                    {{-- <td>{{ $signup->created_at->format('F d, Y')}}</td> --}}
                                    <td>{{ $signup->first_name }} {{ $signup->last_name }}</td>
                                    <td>{{ $signup->email }}</td>
                                    <td>{{ App\LandingPage::where('id', $signup->landing_page_id)->first()->name }}</td>
                                    {{-- @if($signup->marketing_consent == 1)
                                    <td>Yes</td>
                                    @else
                                    <td>No</td>
                                    @endif --}}
                                    <td><button class="btn btn-sm btn-danger" id="{{ $signup->id }}" onclick="showDeleteSignupModal(this.id);">Delete</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
        @else
        <div class="row mt-32">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="well">
                    <p class="text-center mb-0">Seems like you don't have any signups. Create an idea and a landing page and start sending traffic to it.</p>
                </div>
            </div>
        </div>
        @endif
	</div>
@endsection