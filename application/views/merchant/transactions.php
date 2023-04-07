<?php $usr_id = $this->session->userdata('merchant_login_id');?>

<div class="app-main" id="main">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin row -->
		<div class="row">
			<div class="col-md-12 m-b-30">
				<!-- begin page title -->
				<div class="d-block d-lg-flex flex-nowrap align-items-center">
					<div class="page-title mr-4 pr-4 border-right">
						<h1>Transactions</h1>
					</div>
					<div class="breadcrumb-bar align-items-center">
						<nav>
							<ol class="breadcrumb p-0 m-b-0">
								<li class="breadcrumb-item">
									<a href><i class="ti ti-home"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Transactions</li>
							</ol>
						</nav>
					</div>
					<div class="ml-auto d-flex align-items-center secondary-menu text-center">
						<a href="<?php echo base_url() . '?merchant/transfer';?>" class="btn btn-primary btn-block">
							<i class="fa fa-exchange"></i> Transfer
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
						<div class="tab nav-bt">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active show" id="credits-tab" data-toggle="tab" href="#credits" role="tab" aria-controls="credits" aria-selected="true">Credit</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="debits-tab" data-toggle="tab" href="#debits" role="tab" aria-controls="debits" aria-selected="false">Debit</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade py-3 px-3 active show" id="credits" role="tabpanel" aria-labelledby="credits-tab">
									<div class="datatable-wrapper table-responsive">
										<table id="credit" class="table table-hover">
											<thead>
												<tr>
													<th>Trans ID</th>
													<th>Type</th>
													<th>From</th>
													<th>Amount</th>
													<th>Date</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$usr = $this->db->get_where('user', array('user_id' => $usr_id))->row()->account_no;
													$credits = $this->db->get_where('transactions', array('recipient' => $usr))->result_object();
													foreach($credits as $credit):
												?>
												<tr>
													<td><?php echo $credit->reference;?></td>
													<td>Credit</td>
													<td>
														<?php 
															$from = $this->db->get_where('user', array('account_no' => $credit->sender))->row();
															echo ucwords($from->firstname.' '.$from->lastname.' ('.$from->username.')');
														?>
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
								<div class="tab-pane fade py-3 px-3" id="debits" role="tabpanel" aria-labelledby="debits-tab">
									<div class="datatable-wrapper table-responsive">
										<table id="debit" class="table table-hover">
											<thead>
												<tr>
													<th>Trans ID</th>
													<th>Type</th>
													<th>To</th>
													<th>Amount</th>
													<th>Date</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													$usr = $this->db->get_where('user', array('user_id' => $usr_id))->row()->account_no;
													$debits = $this->db->get_where('transactions', array('sender' => $usr))->result_object();
													foreach($debits as $debit):
												?>
												<tr>
													<td><?php echo $debit->reference;?></td>
													<td>Debit</td>
													<td>
														<?php 
															$to = $this->db->get_where('user', array('account_no' => $debit->recipient))->row();
															echo ucwords($to->firstname.' '.$to->lastname.' ('.$to->username.')');
														?>
													</td>
													<td><?php echo '&#x20A6;&nbsp;'.number_format($debit->amount);?></td>
													<td><?php echo date('Y/m/d h:i a', $debit->datetime);?></td>
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
				</div>
			</div>
		</div>
		<!-- end row -->
	</div>
	<!-- end container-fluid -->
</div>