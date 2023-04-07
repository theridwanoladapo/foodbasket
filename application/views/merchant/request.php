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
							<h1>Withdraw Requests</h1>
						</div>
						<div class="breadcrumb-bar align-items-center">
							<nav>
								<ol class="breadcrumb p-0 m-b-0">
									<li class="breadcrumb-item">
										<a hreq><i class="ti ti-home"></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Withdraw Requests</li>
								</ol>
							</nav>
						</div>
						<div class="ml-auto d-flex align-items-center secondary-menu text-center">
							<button type="button" class="btn btn-primary btn-block" onClick="showModalCenter('<?php echo base_url().'index.php?modal/popup/request_withdraw/'.$usr_id;?>')">
								<i class="fa fa-money"></i> Request Withdraw
							</button>
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
										<a class="nav-link active show" id="pendings-tab" data-toggle="tab" href="#pendings" role="tab" aria-controls="pendings" aria-selected="true">Pending</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="approve-tab" data-toggle="tab" href="#approve" role="tab" aria-controls="approve" aria-selected="false">Approve</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="disapprove-tab" data-toggle="tab" href="#disapprove" role="tab" aria-controls="disapprove" aria-selected="false">Dispprove</a>
									</li>
								</ul>
								
								<div class="tab-content">
									<div class="tab-pane fade py-3 px-3 active show" id="pendings" role="tabpanel" aria-labelledby="pendings-tab">
										<?php 
											$where = array('user_id' => $usr_id, 'status' => 0);
											$orderby = array('id', 'DESC');
											$requests = $this->db->get_where('requests', $where, $orderby)->result_object();
										?>
										<div class="datatable-wrapper table-responsive">
											<table id="requests" class="table table-hover">
												<thead>
													<tr>
														<th>Request ID</th>
														<th>Amount</th>
														<th>Date</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($requests as $req):?>
													<tr>
														<td><?php echo $req->reference;?></td>
														<td><?php echo '&#x20A6;&nbsp;'.number_format($req->amount);?></td>
														<td><?php echo date('Y/m/d h:i a', $req->date);?></td>
														<td>
															<?php if ($req->status == 2):?>
															<span class="btn btn-inverse-danger btn-sm">Disapprove</span>
															<?php elseif ($req->status == 1):?>
															<span class="btn btn-inverse-success btn-sm">Approve</span>
															<?php elseif ($req->status == 0):?>
															<span class="btn btn-inverse-info btn-sm">Pending</span>
															<?php endif;?>
														</td>
													</tr>
													<?php endforeach;?>
												</tbody>
											</table>
										</div>
									</div>
									
									<div class="tab-pane fade py-3 px-3" id="approve" role="tabpanel" aria-labelledby="approve-tab">
										<?php 
											$where = array('user_id' => $usr_id, 'status' => 1);
											$orderby = array('id', 'DESC');
											$requests = $this->db->get_where('requests', $where, $orderby)->result_object();
										?>
										<div class="datatable-wrapper table-responsive">
											<table id="approved" class="table table-hover">
												<thead>
													<tr>
														<th>Request ID</th>
														<th>Amount</th>
														<th>Date</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($requests as $req):?>
													<tr>
														<td><?php echo $req->reference;?></td>
														<td><?php echo '&#x20A6;&nbsp;'.number_format($req->amount);?></td>
														<td><?php echo date('Y/m/d h:i a', $req->date);?></td>
														<td><span class="btn btn-inverse-success btn-sm">Approve</span></td>
													</tr>
													<?php endforeach;?>
												</tbody>
											</table>
										</div>
									</div>
									
									<div class="tab-pane fade py-3 px-3" id="disapprove" role="tabpanel" aria-labelledby="disapprove-tab">
										<?php 
											$where = array('user_id' => $usr_id, 'status' => 2);
											$orderby = array('id', 'DESC');
											$requests = $this->db->get_where('requests', $where, $orderby)->result_object();
										?>
										<div class="datatable-wrapper table-responsive">
											<table id="disapproved" class="table table-hover">
												<thead>
													<tr>
														<th>Request ID</th>
														<th>Amount</th>
														<th>Date</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($requests as $req):?>
													<tr>
														<td><?php echo $req->reference;?></td>
														<td><?php echo '&#x20A6;&nbsp;'.number_format($req->amount);?></td>
														<td><?php echo date('Y/m/d h:i a', $req->date);?></td>
														<td><span class="btn btn-inverse-danger btn-sm">Disapprove</span></td>
													</tr>
													<?php endforeach;?>
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


	<!-- Center Modal -->
	<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Request Withdrawal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


	<script>
	function showModalCenter(url)
	{
		// LOADING THE AJAX MODAL
		jQuery('#modalCenter').modal('show', {backdrop: 'true'});

		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modalCenter .modal-body').html(response);
			}
		});
	}
	</script>