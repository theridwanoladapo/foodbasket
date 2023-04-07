	<!--start login contant-->
	<div class="app-contant">
		<div class="bg-white">
			<div class="container-fluid p-0">
				<div class="row no-gutters">
					<div class="col-sm-6 col-lg-5 col-xxl-3 align-self-center order-2 order-sm-1">
						<div class="d-flex align-items-center h-100-vh">
							<div class="register p-5">
								<img src="assets/img/logo-light.png" class="img-fluid logo-desktop mb-2" width="200px" alt="logo" />
								<p class="font-17">Welcome, Please login to your account.</p>
								<form method="post" action="<?php echo base_url();?>index.php?login/signin" id="user-signin" class="mt-5 mt-sm-5">
									<div class="row">
										<div class="col-12">
											<div class="form-group">
												<label class="control-label">Username</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"> @</span>
													</div>
													<input type="text" name="uname" class="form-control" placeholder="Your username" tabindex="1" autocomplete="off" required>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label class="control-label">Pin</label>
												<label class="float-right"><a href="<?php echo base_url();?>index.php?login/forgot_pin" class="text-primary">Forgot Pin?</a></label>
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"> <i class="fa fa-key"></i> </span>
													</div>
													<input type="password" name="upin" inputmode="numeric" pattern="[0-9]{6}" class="form-control" placeholder="Your 6 digits pin" maxlength="6" tabindex="6" onKeyPress="return onlyNumberKey(event)" autocomplete="off" required>
												</div>
											</div>
										</div>
										<div class="col-12 col-sm-6">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="gridCheck">
												<label class="form-check-label" for="gridCheck">
												Remember Me
												</label>
											</div>
										</div>
										<div class="col-12">
											<div id="message"></div>
										</div>
										<div class="col-12 mt-3">
											<button type="submit" name="login" class="btn btn-primary btn-lg text-uppercase">Sign in</button>
										</div>
										<div class="col-12 mt-3">
											<p>Don't have an account ?<a href="<?php echo base_url();?>?register"> Sign Up</a></p>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-xxl-9 col-lg-7 bg-gradient o-hidden order-1 order-sm-2">
						<div class="row align-items-center h-100 p-5">
							<div class="col-7 mx-auto ">
								<img class="img-fluid" src="assets/img/bg/login.svg" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		function onlyNumberKey(evt) { 
			// Only ASCII character in that range allowed 
			var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
			if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
				return false;

			return true; 
		}
		
		$(document).ready(function() {
			$("#user-signin").submit(function(e) {
				e.preventDefault();

				$("#message").hide();
				$("#message").removeClass();
				
				var form = $(this);

				$.ajax(
				{
					url: form.attr('action'),
					type: 'POST',
					data: form.serialize(),
					cache: false,
					success: function(response)
					{
						var data = JSON.parse(response);
						if(data.status == 'success')
						{
							$("#message").html(data.message);
							$("#message").addClass('alert alert-inverse-success');
							$("#message").show();
							setTimeout(
								window.location = data.redirect,
								3000
							);
						}
						else if(data.status == 'error')
						{
							$("#message").html(data.message);
							$("#message").addClass('alert alert-inverse-danger');
							$("#message").show();
						}
						else if(data.status == 'info')
						{
							swal({
								type: data.status,
								title: data.title,
								html: data.text,
								footer: data.footer,
								allowOutsideClick: false
							});
						}
					}
				});
			});
		});
	</script>