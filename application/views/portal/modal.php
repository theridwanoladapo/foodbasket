		<script type="text/javascript">
			function showAjaxModal(url)
			{
				// SHOWING AJAX PRELOADER IMAGE
				jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin:20% auto;"><img src="dist/img/preloader.gif" /></div>');
				
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
		
		<!-- (Show Ajax Modal)-->
		<div class="modal fade" id="modal_ajax">
			<div class="modal-dialog modal-dialog-scrollable modal-lg">
				<div class="modal-content">
					
					<div class="modal-header">
						<h4 class="modal-title"><?php echo ucwords($system_name);?></h4>
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
			function confirm_modal(delete_url)
			{
				jQuery('#modal_confirm').modal('show', {backdrop: 'static'});
				document.getElementById('delete_link').setAttribute('href' , delete_url);
			}
		</script>
		
		<!-- (Confirm Modal)-->
		<div class="modal fade" id="modal_confirm">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<div class="modal-header justify-content-center">
						<h5 class="modal-title"> Are you sure to delete this information? </h5>
					</div>
					
					<div class="modal-footer justify-content-center">
						<a href="#" class="btn btn-danger" id="delete_link"> Delete </a>
						<button type="button" class="btn btn-info" data-dismiss="modal"> Cancel </button>
					</div>
					
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->