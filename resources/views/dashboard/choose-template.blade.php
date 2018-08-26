@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h2 class="title-1">Choose a Template</h2>
				<p class="mt-2">Pick a pre-made template that you can use to quickly get your landing page up and running.</p>
				<hr />
			</div>
		</div>

		@if(count($templates) == 0)
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="well">
						<p class="text-center">Unfortunately there are no active templates right now...</p>
					</div>
				</div>
			</div>
		@else
			<div class="row">
				@foreach($templates as $template)
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="template-box" id="{{ $template->id }}" onclick="next_step(this.id);">
							<div class="template-box-image">
								<img src="{{ $template->preview_link }}">
							</div>
							<div class="template-box-info">
								<h4>{{ $template->name }}</h4>
								<hr />
								<p>{{ $template->description }}</p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@endif

		@include('layouts.footer')
	</div>

	<script type="text/javascript">
		function next_step(template_id) {
			// Send to next page with proper URL
			window.location.href = '/dashboard/lp/create/customize/' + template_id; 
		}
	</script>
@endsection