<div class="app-main" id="main">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin row -->
		<div class="row">
			<div class="col-md-12 m-b-30">
				<!-- begin page title -->
				<div class="d-block d-lg-flex flex-nowrap align-items-center">
					<div class="page-title mr-4 pr-4 border-right">
						<h1>Profile</h1>
					</div>
					<div class="breadcrumb-bar align-items-center">
						<nav>
							<ol class="breadcrumb p-0 m-b-0">
								<li class="breadcrumb-item">
									<a href><i class="ti ti-home"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Profile</li>
							</ol>
						</nav>
					</div>
				</div>
				<!-- end page title -->
			</div>
		</div>
		<!-- end row -->
		<!-- begin row -->
		<div class="row account-contant">
			<?php
				$agent_id = $this->session->userdata('agent_login_id');
				$agent = $this->db->get_where('user', array('user_id' => $agent_id))->row();
			?>
			<div class="col-12">
				<div class="card card-statistics">
					<div class="card-body p-0">
						<div class="row no-gutters">
							
							<div class="col-xl-6 col-md-6 col-12 border-t border-right">
								<div class="page-account-form">
									<div class="border-bottom p-3 d-flex justify-content-between">
										<h5 class="mb-0 py-2">Personal Profile</h5>
										<a href="<?php echo base_url().'?agent/edit/profile';?>" class="btn btn-outline-primary btn-sm">Edit</a>
									</div>
									<div class="p-4">
										<ul class="list-group rounded">
											<li class="list-group-item"><strong>Name:</strong> <?php echo ucwords($agent->firstname.' '.$agent->lastname);?></li>
											<li class="list-group-item"><strong>Username:</strong> <?php echo $agent->username;?></li>
											<li class="list-group-item"><strong>Email:</strong> <?php echo $agent->email;?></li>
											<li class="list-group-item"><strong>Mobile:</strong> <?php echo $agent->mobile;?></li>
											<li class="list-group-item"><strong>Level:</strong> <?php echo $agent->level;?></li>
											<li class="list-group-item"><strong>Stage:</strong> <?php echo $agent->stage;?></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-xl-6 col-md-6 border-t col-12">
								<div class="page-account-form">
									<div class="border-bottom p-3">
										<h5 class="mb-0 py-2">Account Info</h5>
									</div>
									<div class="p-4 row">
										<?php $account = $this->db->get_where('user_accounts', array('user_id' => $agent_id))->row(); ?>
										<div class="col-lg-6 col-md-12 col-sm-6 col-12 mb-3">
											<p class="h6">Account No.:</p>
											<h4><?php echo $account->account_no;?></h4>
										</div>
										<div class="col-lg-6 col-md-12 col-sm-6 col-12 mb-3">
											<p class="h6">Account Balance:</p>
											<h4><?php echo '&#x20A6;&nbsp;'.number_format($account->balance);?></h4>
										</div>
										<?php $agency_acc = $this->db->get_where('agency_accounts', array('user_id' => $agent_id))->row(); ?>
										<div class="col-lg-6 col-md-12 col-sm-6 col-12 mb-3">
											<p class="h6">Agency Account Balance:</p>
											<h4><?php echo '&#x20A6;&nbsp;'.number_format($agency_acc->balance);?></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--mail-Compose-contant-end-->
	</div>
	<!-- end container-fluid -->
</div>
