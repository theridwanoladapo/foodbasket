<div class="app-main" id="main">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin row -->
		<div class="row">
			<div class="col-md-12 m-b-30">
				<!-- begin page title -->
				<div class="d-block d-lg-flex flex-nowrap align-items-center">
					<div class="page-title mr-4 pr-4 border-right">
						<h1>Credits</h1>
					</div>
					<div class="breadcrumb-bar align-items-center">
						<nav>
							<ol class="breadcrumb p-0 m-b-0">
								<li class="breadcrumb-item">
									<a href><i class="ti ti-home"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">User Credits</li>
							</ol>
						</nav>
					</div>
					<div class="ml-auto d-flex align-items-center secondary-menu text-center">
						<a href="<?php echo base_url() . '?admin/credit';?>" class="btn btn-primary btn-block">
							<i class="fa fa-exchange"></i> Credit a User
						</a>
					</div>
				</div>
				<!-- end page title -->
			</div>
		</div>
		<!-- end row -->
		
		<!-- begin row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						
						<div class="datatable-wrapper table-responsive">
							<table id="credit" class="table table-hover">
								<thead>
									<tr>
										<th>Trans ID</th>
										<th>User</th>
										<th>Amount</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$credits = $this->db->get_where('transactions', array('sender' => 1), array('id', 'DESC'))->result_object();
										foreach($credits as $credit):
									?>
									<tr>
										<td><?php echo $credit->reference;?></td>
										<td>
											<?php $usr = $this->db->get_where('user', array('account_no' => $credit->recipient))->row(); ?>
											<div><?php echo ucwords($usr->firstname.' '.$usr->lastname.' ('.$usr->username.')');?></div>
											<small><?php echo strtoupper($usr->category).' | ';?></small>
											<small><?php echo 'ID: '.$usr->referral_code;?></small>
										</td>
										<td><?php echo '&#x20A6;&nbsp;'.number_format($credit->amount);?></td>
										<td><?php echo date('Y/m/d h:i a', $credit->datetime);?></td>
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