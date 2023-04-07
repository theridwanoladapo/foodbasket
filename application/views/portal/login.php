<?php
	$system_name = $this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="shortcut icon" href="uploads/logo.png">
		
	<title> Login | <?php echo ucwords($system_name); ?> </title>
	<?php include 'include_top.php'; ?>
</head>

<body class="hold-transition layout-top-nav">
	
	<div class="wrapper">
		<!-- Main Content -->
		<section class="content home-box mt-6">
			<div class="container-fluid">
				<div class="row">
					
					<div class="col-md-6">
						<div class="login-box">
							<div class="login-logo">
								<a href="<?php echo base_url(); ?>index.php?login">
									<img src="uploads/logo.png" style="max-width:80px">
								</a>
								<h3><?php echo ucwords($system_name); ?></h3>
							</div>
							<!-- /.login-logo -->
							<div class="card">
								<div class="card-body login-card-body">
									<p class="login-box-msg">Sign in to start your session</p>
									
									<form method="post" action="<?php echo base_url(); ?>index.php?login/validate_login">
										<label for="inputEmail" class="control-label"> Email </label>
										<div class="input-group mb-4">
											<input type="email" class="form-control" id="inputEmail" name="email" placeholder="Your email address" required>
											<div class="input-group-append">
												<div class="input-group-text">
													<span class="fas fa-envelope"></span>
												</div>
											</div>
										</div>
										<label for="inputPass" class="control-label"> Password </label>
										<div class="input-group mb-4">
											<input type="password" class="form-control" id="inputPass" name="password" placeholder="Your password" required>
											<div class="input-group-append">
												<div class="input-group-text">
													<span class="fas fa-lock"></span>
												</div>
											</div>
										</div>
										<div class="input-group mb-4">
											<button type="submit" class="btn btn-primary btn-block rounded-pill"> Sign In </button>
										</div>
									</form>
									
									<p class="mb-1">
										<a href="<?php echo base_url(); ?>index.php?login/forgot_password"> I forgot my password </a>
									</p>
								</div>
								<!-- /.login-card-body -->
							</div>
						</div>
						<!-- /.login-box -->
					</div>
					
					<div class="col-md-6">
						<div class="home-img">
							<img class="card-img-top img-fluid" src="dist/img/school.png" alt="">
						</div>
					</div>
					
				</div>
			</div>
		</section>
		<!-- /Main Content -->
	</div>
	<!-- ./wrapper -->
	<?php include 'include_bottom.php'; ?>
	
	<?php if($this->session->flashdata('login_error') != ''){ ?>
	<script>
		$(function(){
			toastr.error('<?php echo $this->session->flashdata('login_error'); ?>')
		});
	</script>
	<?php } ?>
</body>
</html>