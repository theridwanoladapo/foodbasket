
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="row">
					<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
						<div class="card card-primary">
							<div class="card-header">
								<h4>Forgot Password</h4>
							</div>
							<div class="card-body">
								<p class="text-muted">We will send a link to reset your password</p>
								<form method="POST" action="<?php echo base_url();?>index.php?login/reset_password">
									<div class="form-group">
										<label for="email">Email</label>
										<input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="2">
											Forgot Password
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>