<div class="modal fade" id="delete_signup_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Are you sure?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="/signups/delete/" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="signup_id">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<p>You are about to delete a signup. Are you sure you want to delete?</p>
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