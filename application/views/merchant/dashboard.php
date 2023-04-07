<div class="app-main" id="main">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin row -->
		<div class="row">
			<div class="col-md-12 m-b-30">
				<!-- begin page title -->
				<div class="d-block d-lg-flex flex-nowrap align-items-center">
					<div class="page-title mr-4 pr-4 border-right">
						<h1>Dashboard</h1>
					</div>
					<div class="breadcrumb-bar align-items-center">
						<nav>
							<ol class="breadcrumb p-0 m-b-0">
								<li class="breadcrumb-item">
									<a href><i class="ti ti-home"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</nav>
					</div>
					<div class="ml-auto d-flex align-items-center secondary-menu text-center">
						<a href="<?php echo base_url() . '?merchant/transfer';?>" class="btn btn-primary btn-block">
							<i class="fa fa-exchange"></i> Transfer
						</a>
						<!--<a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Todo list">
							<i class="fe fe-edit btn btn-icon text-primary"></i>
						</a>
						<a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Projects">
							<i class="fa fa-lightbulb-o btn btn-icon text-success"></i>
						</a>
						<a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Task">
							<i class="fa fa-check btn btn-icon text-warning"></i>
						</a>
						<a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Calendar">
							<i class="fa fa-calendar-o btn btn-icon text-cyan"></i>
						</a>
						<a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Analytics">
							<i class="fa fa-bar-chart-o btn btn-icon text-danger"></i>
						</a>-->
					</div>
				</div>
				<!-- end page title -->
			</div>
		</div>
		<!-- end row -->
		

		<!-- begin row -->
		<div class="row">
			<?php
				$user_id = $this->session->userdata('merchant_login_id');
				$merchant = $this->db->get_where('user', array('user_id' => $user_id))->row();
			?>
			<div class="col-md-12">
				<div class="card">
					<div class="card-body m-sm-4">
						<div class="row counter-wrapper">
							<div class="col-sm-6 mb-3">
								<div class="border-primary rounded text-center p-3">
									<h3><?php echo ucwords($merchant->firstname.' '.$merchant->lastname);?></h3>
									<h4><span class="text-primary">Email:</span> <?php echo $merchant->email;?></h4>
									<h4><span class="text-primary">Account No.:</span> <?php echo $merchant->account_no;?></h4>
								</div>
							</div>
							<div class="col-sm-3 mb-3">
								<div class="card-body border-primary rounded text-center">
									<a href>
										<div class="bg-img m-auto">
											<img src="assets/img/megaphone.svg" class="img-fluid">
										</div>
										<h5 class="pt-2">Referrals</h5>
									</a>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="card-body border-primary rounded text-center">
									<a href>
										<div class="bg-img m-auto">
											<img src="assets/img/megaphone.svg" class="img-fluid">
										</div>
										<h5 class="pt-2">Referral Tree</h5>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body m-sm-4">
						<div class="row">
							<div class="col-md-5">
								<label>Your Referral Link</label>
								<div class="input-group mb-3">
									<input type="text" id="txt" class="form-control" value="<?php echo base_url().'?register/ref/'.$merchant->referral_code;?>">
									<div class="input-group-append">
										<button class="btn btn-primary" data-clipboard-action="copy" data-clipboard-target="#txt" type="button" id="copy">Copy</button>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<label>Referral Level & Stage</label>
								<span class="btn btn-outline-primary btn-block btn-lg text-center mb-3">
									<?php echo 'Level #' . $merchant->level . ', Stage #' . $merchant->stage;?>
								</span>
							</div>
							<div class="col-md-2">
								<label>Total Referrals</label>
								<span class="btn btn-outline-primary btn-block btn-lg text-center mb-3">
									<?php $referrer = $this->db->get_where('user', array('referrer' => $merchant->referral_code))->num_rows(); ?>
									<?php echo $referrer;?>
								</span>
							</div>
							<div class="col-md-2">
								<label>Account Balance</label>
								<span class="btn btn-outline-primary btn-block btn-lg text-center mb-3">
									<?php $account = $this->db->get_where('user_accounts', array('user_id' => $user_id))->row(); ?>
									<?php echo '&#x20A6; '.number_format($account->balance);?>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end row -->
		
		<!-- begin row -->
		<div class="row">
			<div class="col-md-12 mb-3">
				<!-- begin page title -->
				<div class="d-block d-lg-flex flex-nowrap align-items-center">
					<div class="page-title mr-4 pr-4">
						<h3>Referred Users</h3>
					</div>
				</div>
			</div>
			
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<?php 
							$where = array('referrer' => $merchant->referral_code);
						 	$orderby = array(); $groupby = array(); $limits = 5;
							$referral = $this->db->get_where('user', $where, $orderby, $groupby, $limits)->result_object();
						?>
						<div class="datatable-wrapper table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>User</th>
										<th>Level</th>
										<th>Stage</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($referral as $ref):?>
									<tr>
										<td><?php echo ucwords($ref->firstname . ' ' . $ref->lastname);?></td>
										<td><?php echo $ref->level;?></td>
										<td><?php echo $ref->stage;?></td>
										<td>
											<?php if ($ref->status == 1):?>
											<span class="btn btn-inverse-success btn-sm">Active</span>
											<?php elseif ($ref->status == 0):?>
											<span class="btn btn-inverse-danger btn-sm">Inactive</span>
											<?php endif;?>
										</td>
									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer bg-white">
						<a href="<?php echo base_url() . '?merchant/referral';?>"><i class="fa fa-angle-down"></i> &nbsp; View more referral</a>
					</div>
				</div>
			</div>
		</div>
		<!-- end row -->
	</div>
	<!-- end container-fluid -->
</div>