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
						<a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Todo list">
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
						</a>
					</div>
				</div>
				<!-- end page title -->
			</div>
		</div>
		<!-- end row -->
		
		<!-- begin row -->
		<div class="row">
			<div class="col-lg-6 col-xxl-3 m-b-30">
				<div class="card card-statistics h-100 mb-0">
					<div class="card-header">
						<h4 class="card-title">Users</h4>
					</div>
					<div class="card-body pt-0">
						<div class="apexchart-wrapper">
							<div id="jobportaldemo3"></div>
						</div>
						<div class="row text-center justify-content-center">
							<div class="col ml-3">
								<?php $totalmember = $this->db->get_where('user', array('category' => 'member'))->num_rows();?>
								<h4 class="mb-0"><?php echo number_format($totalmember); ?></h4>
								<span> <i class="fa fa-square pr-1 text-primary"></i> Members </span>
							</div>
							<div class="col">
								<?php $totalmerchant = $this->db->get_where('user', array('category' => 'merchant'))->num_rows();?>
								<h4 class="mb-0"><?php echo number_format($totalmerchant); ?></h4>
								<span> <i class="fa fa-square pr-1 text-success"></i> Merchants </span>
							</div>
							<div class="col">
								<?php $totalagent = $this->db->get_where('user', array('category' => 'agent'))->num_rows();?>
								<h4 class="mb-0"><?php echo number_format($totalagent); ?></h4>
								<span> <i class="fa fa-square pr-1 text-secondary"></i> Agents </span>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-6 col-xxl-3 m-b-30">
				<div class="card card-statistics h-100 mb-0 widget-income-list">
					<div class="card-body d-flex align-itemes-center">
						<div class="media align-items-center w-100">
							<div class="text-left">
								<?php $pending_users = $this->db->get_where('user', array('status' => 0))->num_rows();?>
								<h3 class="mb-0"> <?php echo number_format($pending_users); ?> </h3>
								<span>Pending Users</span>
							</div>
							<div class="img-icon bg-pink ml-auto">
								<i class="ti ti-user text-white"></i>
							</div>
						</div>
					</div>
					
					<div class="card-body d-flex align-itemes-center">
						<div class="media align-items-center w-100">
							<div class="text-left">
								<h3 class="mb-0">0 </h3>
								<span>New Users</span>
							</div>
							<div class="img-icon bg-primary ml-auto">
								<i class="ti ti-tag text-white"></i>
							</div>
						</div>
					</div>
					
					<div class="card-body d-flex align-itemes-center">
						<div class="media align-items-center w-100">
							<div class="text-left">
								<?php $suspended_users = $this->db->get_where('user', array('status' => 2))->num_rows();?>
								<h3 class="mb-0"> <?php echo number_format($suspended_users); ?> </h3>
								<span>Suspended Users</span>
							</div>
							<div class="img-icon bg-orange ml-auto">
								<i class="ti ti-wallet text-white"></i>
							</div>
						</div>
					</div>
					
					<div class="card-body d-flex align-itemes-center">
						<div class="media align-items-center w-100">
							<div class="text-left">
								<?php $active_users = $this->db->get_where('user', array('status' => 1))->num_rows();?>
								<h3 class="mb-0"> <?php echo number_format($active_users); ?> </h3>
								<span>Active Users</span>
							</div>
							<div class="img-icon bg-info ml-auto">
								<i class="ti ti-slice text-white"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xxl-6 m-b-30">
				<div class="card card-statistics site-visitor h-100 mb-0">
					<div class="card-header">
						<h4 class="card-title">Statistics</h4>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-4 mb-3 mb-sm-0">
								<?php $totalusers = $this->db->get('user')->num_rows();?>
								<h2 class="mb-0"><?php echo number_format($totalusers); ?></h2>
								<span>Total user</span>
							</div>
							<div class="col-sm-8 ml-auto">
								<div class="row">
									<div class="border-right col mr-4">
										<?php $totalmember = $this->db->get_where('user', array('category' => 'member'))->num_rows();?>
										<h4 class="mb-0"><?php echo number_format($totalmember); ?></h4>
										<span> <i class="fa fa-square pr-1 text-primary"></i> Members </span>
									</div>
									<div class="border-right col mr-4">
										<?php $totalmerchant = $this->db->get_where('user', array('category' => 'merchant'))->num_rows();?>
										<h4 class="mb-0"><?php echo number_format($totalmerchant); ?></h4>
										<span> <i class="fa fa-square pr-1 text-success"></i> Merchants </span>
									</div>
									<div class="col">
										<?php $totalagent = $this->db->get_where('user', array('category' => 'agent'))->num_rows();?>
										<h4 class="mb-0"><?php echo number_format($totalagent); ?></h4>
										<span> <i class="fa fa-square pr-1 text-secondary"></i> Agents </span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-header border-top">
						<h5 class="card-title">Daily Register Statistics</h4>
					</div>
					<div class="card-body pb-0">
						<div class="apexchart-wrapper">
							<div id="apexdemo3" class="chart-fit"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end row -->
		<div class="row">
			<div class="col-12">
				<div class="card">
					
				</div>
			</div>
		</div>
		<!-- begin row -->
		<div class="row">
			<div class="col-xxl-6 m-b-30">
				<div class="card card-statistics h-100 mb-0">
					<div class="card-header d-flex align-items-center justify-content-between">
						<div class="card-heading">
							<h4 class="card-title">Latest Users</h4>
						</div>
					</div>
					
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-borderless table-striped mb-0">
								<thead>
									<tr>
										<th class="py-3">Name</th>
										<th class="py-3">ID</th>
										<th class="py-3">Category</th>
										<th class="py-3">Status</th>
									</tr>
								</thead>
								
								<tbody>
									<?php 
										$orderby = array('user_id', 'DESC');
										$limit = 5;
										$users = $this->db->get('user', $orderby, $limit)->result_object();
										
										foreach($users as $usr):
									?>
									<tr>
										<td class="py-4">
											<?php echo ucwords($usr->firstname . ' ' . $usr->lastname . ' (' . $usr->username . ')');?>
										</td>
										<td class="py-4"><?php echo $usr->referral_code;?></td>
										<td class="py-4"><?php echo ucwords($usr->category);?></td>
										<td class="py-4">
											<?php if ($usr->status == 1):?>
											<label class="badge badge-success-inverse mb-0">Active</label>
											<?php elseif ($usr->status == 0):?>
											<label class="badge badge-warning-inverse mb-0">Pending</label>
											<?php endif;?>
										</td>
									</tr>
									<?php
										endforeach;
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end row -->
	</div>
	<!-- end container-fluid -->
</div>