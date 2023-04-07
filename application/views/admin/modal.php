	<!-- (Show Ajax Modal)-->
	<div class="modal fade" id="modal_ajax">
		<div class="modal-dialog modal-dialog-scrollable modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- Modal Body -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<script type="text/javascript">
		function showAjaxModal(url)
		{
			// LOADING THE AJAX MODAL
			jQuery('#modal_ajax').modal('show', {backdrop: 'true'});

			// SHOW AJAX RESPONSE ON REQUEST SUCCESS
			$.ajax({
				url: url,
				success: function(response)
				{
					jQuery('#modal_ajax .modal-body').html(response);
				}
			});
		}
	</script>



	<!-- (Confirm Modal)-->
	<div class="modal fade" id="modal_action">
		<div class="modal-dialog modal-sm modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header justify-content-center">
					<h5 class="modal-title"> Are you sure? </h5>
				</div>
				<div class="modal-footer justify-content-center">
					<a href="#" class="btn btn-success" id="action_link"> Yes, Confirm </a>
					<button type="button" class="btn btn-danger" data-dismiss="modal"> No </button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<script type="text/javascript">
		function action_modal(action_url)
		{
			jQuery('#modal_action').modal('show', {backdrop: 'static'});
			document.getElementById('action_link').setAttribute('href' , action_url);
		}
	</script>
