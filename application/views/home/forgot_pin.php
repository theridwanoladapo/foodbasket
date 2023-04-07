
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="row">
					<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
						<div class="card card-primary">
							<div class="card-header">
								<h4>Forgot Pin</h4>
							</div>
							<div class="card-body">
								<p class="text-muted mb-3">We will send you a new pin to login</p>
								<form method="POST" action="<?php echo base_url();?>index.php?login/reset_pin">
									<div class="form-group">
										<label for="email">Email</label>
										<input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="2">
											Reset Pin
										</button>
									</div>
								</form>
								<p class="text-muted mb-3">Remember your pin? Go to <a href="<?php echo base_url();?>index.php?login/" class="btn btn-primary btn-sm">Login</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<?php if($this->session->flashdata('reset_success')): ?>
		<script type="text/javascript">
			$(function () {
				swal({
					type: 'success',
					title: 'Pin has been reset',
					text: '<?php echo $this->session->flashdata('reset_success'); ?>'
				});
			});
		</script>
	<?php endif;?>


	<?php if($this->session->flashdata('reset_error')): ?>
		<script type="text/javascript">
			$(function () {
				swal({
					type: 'error',
					title: 'Pin Reset Error',
					text: '<?php echo $this->session->flashdata('reset_error'); ?>'
				});
			});
		</script>
	<?php endif;?>