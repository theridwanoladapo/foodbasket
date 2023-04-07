	<!--start login contant-->
	<div class="app-contant">
		<div class="bg-white">
			<div class="container-fluid p-0">
				<div class="row no-gutters">
					<div class="col-sm-6 col-lg-5 col-xxl-3 align-self-center order-2 order-sm-1">
						<div class="d-flex align-items-center app-wrap">
							<div class="register p-5">
								<img src="assets/img/logo-light.png" class="img-fluid logo-desktop mb-2" width="200px" alt="logo" />
								<h4>Register as a Member</h4>
								<p class="font-17">Welcome, Please create your account.</p>
								<form method="post" action="<?php echo base_url().'index.php?register/signup/member';?>" id="membersignup" class="mt-5 mt-sm-5">
									<div class="row">
										<div class="col-12 col-sm-6">
											<div class="form-group">
												<label class="control-label">First Name</label>
												<input type="text" name="firstname" class="form-control" placeholder="Enter your first name" tabindex="1" autocomplete="off" required>
											</div>
										</div>
										<div class="col-12 col-sm-6">
											<div class="form-group">
												<label class="control-label">Last Name</label>
												<input type="text" name="lastname" class="form-control" placeholder="Enter your last name" tabindex="2" autocomplete="off" required>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label class="control-label">Email</label>
												<input type="email" name="email" class="form-control" placeholder="Enter your email address" tabindex="3" autocomplete="off" required>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label class="control-label">Phone Number</label>
												<input type="text" name="mobile" class="form-control" placeholder="Provide your phone number" tabindex="4" autocomplete="off" required>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<!-- referrer id -->
												<input type="hidden" name="referrer" pattern="[0-9]{7}" class="form-control" maxlength="7" value="<?php if(isset($ref)) echo $ref;?>">

												<label class="control-label">Username</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"> @</span>
													</div>
													<input type="text" name="username" class="form-control" placeholder="Choose a username" tabindex="5" autocomplete="off" required>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label class="control-label">Pin</label>
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text"> <i class="fa fa-key"></i> </span>
													</div>
													<input type="password" name="upin" inputmode="numeric" pattern="[0-9]{6}" class="form-control" placeholder="Set your 6 digits pin" maxlength="6" tabindex="6" onKeyPress="return onlyNumberKey(event)" autocomplete="off" required>
												</div>
											</div>
										</div>
										<div class="col-12 mt-3">
											<button type="submit" class="btn btn-primary btn-lg text-uppercase">Sign up</button>
										</div>
										<div class="col-12 mt-3">
											<p>Already have an account ? <a href="<?php echo base_url().'?login';?>">Sign In</a></p>
										</div>
									</div>
								</form>
								<div class="row pt-3">
									<div class="col-md-6"><a href="<?php echo base_url().'?register/merchant';?>" class="btn btn-outline-primary btn-block mb-3 mb-md-0">Sign up as a merchant</a></div>
									<div class="col-md-6"><a href="<?php echo base_url().'?register/agent';?>" class="btn btn-outline-primary btn-block">Sign up as an agent</a></div>
								</div>
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
			// Only ASCII charactar in that range allowed 
			var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
			if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
				return false;

			return true; 
		}
		
		$(document).ready(function() {
			$("#membersignup").submit(function(e) {
				e.preventDefault();
				
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
						if(data.type == 'success')
						{
							swal({
								type: data.type,
								title: data.title,
								html: data.text,
								footer: data.footer,
								allowOutsideClick: false
							}).then((result) => {
								if (result.value) {
									window.location = "<?php echo base_url().'?login'?>"
								}
							});
						}
						else if(data.type == 'error')
						{
							swal({
								type: data.type,
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