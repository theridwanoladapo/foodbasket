<!-- begin app -->
<div class="app">
	<!-- begin app-wrap -->
	<div class="app-wrap">
		<!-- begin pre-loader -->
		<div class="loader">
			<div class="h-100 d-flex justify-content-center">
				<div class="align-self-center">
					<img src="assets/img/loader/loader.svg" alt="loader">
				</div>
			</div>
		</div>
		<!-- end pre-loader -->
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
									<form action="#member" class="mt-5 mt-sm-5">
										<div class="row">
											<div class="col-12">
												<div class="form-group">
													<label class="control-label">Username</label>
													<div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"> @</span>
                                                        </div>
														<input type="text" name="uname" class="form-control" placeholder="Your username" tabindex="1" required>
													</div>
												</div>
											</div>
											<div class="col-12">
												<div class="form-group">
													<label class="control-label">Pin</label>
													<label class="float-right"><a href="" class="text-primary">Forgot Pin?</a></label>
													<div class="input-group">
														<div class="input-group-prepend">
															<span class="input-group-text"> <i class="fa fa-key"></i> </span>
														</div>
														<input type="password" name="upin" class="form-control" placeholder="Your 6 digit pin" maxlength="6" tabindex="2" required>
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
											<div class="col-12 mt-3">
												<button type="reset" class="btn btn-primary btn-lg text-uppercase">Sign in</button>
											</div>
											<div class="col-12  mt-3">
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
	</div>
	<!-- end app-wrap -->
</div>
<!-- end app -->