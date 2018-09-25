@extends('layouts.app')

@section('content')
	@include('modals.copy-url-modal')
	<div class="container">
		<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="overview-wrap">
                    <h2 class="title-1">Landing Pages</h2>
                    @if(count($landing_pages) != 0)
                    <a href="/dashboard/lp/create/choose-template"><button class="au-btn au-btn-icon au-btn--blue"><i class="zmdi zmdi-plus"></i>New Landing Page</button></a>
                    @endif
                </div>
            </div>
        </div>

        @if(count($landing_pages) != 0)
			<div class="row m-t-40">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="table-responsive table--no-card m-b-40">
						<table class="table table-borderless table-striped table-earning">
							<thead>
								<tr>
									<th>Actions</th>
									<th>Created On</th>
									<th>Name</th>
									<th>Idea</th>
									<th>Reach</th>
									<th>Impressions</th>
									<th>Signups</th>
								</tr>
							</thead>
							<tbody>
								@foreach($landing_pages as $landing_page)
									<tr>
										<td>
											<a href="/dashboard/lp/edit/{{ $landing_page->id }}" class="btn btn-sm btn-warning">Edit</a>
											<a href="/lp/{{ Session::get('user_id') }}/{{ $landing_page->id }}" class="btn btn-sm btn-primary">View</a>
											<button class="btn btn-sm btn-success" id="{{ Session::get('user_id') }}/{{ $landing_page->id }}" onclick="showCopyURLModal(this.id);">Copy URL</button>
										</td>
										<td>{{ $landing_page->created_at->format('F d, Y') }}</td>
										<td>{{ $landing_page->name }}</td>
										<td>{{ $landing_page->idea_name }}</td>
										<td>{{ $landing_page->reach }}</td>
										<td>{{ $landing_page->impressions }}</td>
										<td>{{ $landing_page->signups }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		@else
			<div class="row mt-16">
	            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                <div class="well">
	                    <p class="text-center">Seems like you haven't created any landing pages yet. Click below to get started.</p>
	                    <div class="row">
	                        <div class="col-lg-2 offset-lg-5">
	                            <a href="/dashboard/lp/create/choose-template" class="btn btn-primary center-button mt-16">Get Started</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
		@endif
	</div>
@endsection

@section('page_js')
<script type="text/javascript">
	function copyURL(url_extension) {
		// Create dummy input object to copy from
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val(url).select();
		document.execCommand("copy");
		$temp.remove();	
	}
</script>
@endsection