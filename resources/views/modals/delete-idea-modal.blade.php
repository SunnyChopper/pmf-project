<div class="modal fade" id="delete_idea_modal" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Are you sure?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="/idea/delete" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="idea_id">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<p>You are about to delete an idea. This will delete the corresponding opt-in pages as well, however, the sign-ups gained with this idea will not be deleted. Are you sure you want to delete?</p>
						</div>
					</div>
					<div class="row mt-8">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<input type="submit" value="Yes, delete!" class="btn btn-danger">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>