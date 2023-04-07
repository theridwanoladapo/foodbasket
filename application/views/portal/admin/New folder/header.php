<?php
	$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
	$login_type = $this->session->userdata('login_type');
	$login_user_id = $this->session->userdata('login_user_id');
	$data_info = $this->db->get_where($login_type, array($login_type.'_id' => $login_user_id));
	$name = $data_info->row()->name;
?>
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
				</li>
			</ul>
			<!-- Session --->
			<span class="navbar-brand">
				<span class="brand-text font-weight-light"> Running Session: <?php echo $running_year; ?> </span>
			</span>
			
			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown user-menu">
					<a href="" class="nav-link dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo $this->crud_model->get_image_url($login_type, $login_user_id); ?>" class="user-image img-circle elevation-2" alt="User Image">
						<span class="d-none d-md-inline ml-1"> <?php echo ucwords($name); ?> </span>
					</a>
					
					<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<!-- User image -->
						<li class="user-header bg-primary">
							<img src="<?php echo $this->crud_model->get_image_url($login_type, $login_user_id); ?>" class="img-circle elevation-2" alt="User Image">
							<p>
							Admin - <?php echo ucwords($name); ?>
							</p>
						</li>
						
						<!-- Menu Footer-->
						<li class="user-footer">
							<!--a href="" class="btn btn-default btn-flat">Profile</a-->
							<a href="<?php echo base_url();?>index.php?login/logout" class="btn btn-default btn-flat float-right">
								Sign Out 
								<i class="fas fa-sign-out-alt"></i> 
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->
