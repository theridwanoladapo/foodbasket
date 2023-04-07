	<div class="app-main" id="main">
		<!-- begin container-fluid -->
		<div class="container-fluid">
			<!-- begin row -->
			<div class="row">
				<div class="col-md-12 m-b-30">
					<!-- begin page title -->
					<div class="d-block d-lg-flex flex-nowrap align-items-center">
						<div class="page-title mr-4 pr-4 border-right">
							<h1>Users</h1>
						</div>
						<div class="breadcrumb-bar align-items-center">
							<nav>
								<ol class="breadcrumb p-0 m-b-0">
									<li class="breadcrumb-item">
										<a href><i class="ti ti-home"></i></a>
									</li>
									<li class="breadcrumb-item">Users</li>
									<li class="breadcrumb-item active" aria-current="page">Merchants</li>
								</ol>
							</nav>
						</div>
					</div>
					<!-- end page title -->
				</div>
			</div>
			<!-- end row -->

			<!-- begin row -->
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-body">
							
							<div class="tab nav-bt">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active show" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All Merchants</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="new-tab" data-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="false">Inactive Merchants</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="false">Active Merchants</a>
									</li>
								</ul>
								
								<div class="tab-content">
									<div class="tab-pane fade py-3 px-3 active show" id="all" role="tabpanel" aria-labelledby="all-tab">
										<?php 
											$where = array('category' => 'merchant');
											$orderby = array('user_id', 'DESC');
											$users = $this->db->get_where('user', $where, $orderby)->result_object();
										?>
										<div class="datatable-wrapper table-responsive">
											<table id="merchants" class="table table-hover">
												<thead>
													<tr>
														<th>User</th>
														<th>Store</th>
														<th>Level</th>
														<th>Stage</th>
														<th>Referral ID</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($users as $usr):?>
													<tr>
														<td>
															<div><?php echo ucwords($usr->firstname . ' ' . $usr->lastname);?></div>
															<small><?php echo 'ID: '.$usr->referral_code;?></small>
														</td>
														<?php $store = $this->db->get_where('stores', array('user_id' => $usr->user_id))->row();?>
														<td>
															<div><?php echo ucwords($store->name);?></div>
															<small><?php echo ucwords($store->location);?></small>
														</td>
														<td><?php echo $usr->level;?></td>
														<td><?php echo $usr->stage;?></td>
														<td><?php echo $usr->referral_code;?></td>
														<td>
															<button class="btn btn-primary btn-sm" onClick="showModalCenter('<?php echo base_url().'index.php?modal/popup/view_user/'.$usr->user_id;?>')">View</button>
															<?php if ($usr->status == 1):?>
															<span class="btn btn-inverse-success btn-sm">Active</span>
															<?php elseif ($usr->status == 0):?>
															<span class="btn btn-inverse-danger btn-sm">Inactive</span>
															<button class="btn btn-success btn-sm" value="1" onClick="action_modal('<?php echo base_url().'index.php?admin/activate/'.$usr->user_id;?>')">Activate</button>
															<?php endif;?>
														</td>
													</tr>
													<?php endforeach;?>
												</tbody>
											</table>
										</div>
									</div>
									
									<div class="tab-pane fade py-3 px-3" id="new" role="tabpanel" aria-labelledby="new-tab">
										<?php 
											$where = array('category' => 'merchant', 'status' => 0);
											$orderby = array('user_id', 'DESC');
											$users = $this->db->get_where('user', $where, $orderby)->result_object();
										?>
										<div class="datatable-wrapper table-responsive">
											<table id="merchants" class="table table-hover">
												<thead>
													<tr>
														<th>User</th>
														<th>Store</th>
														<th>Level</th>
														<th>Stage</th>
														<th>Referral ID</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($users as $usr):?>
													<tr>
														<td>
															<div><?php echo ucwords($usr->firstname . ' ' . $usr->lastname);?></div>
															<small><?php echo 'ID: '.$usr->referral_code;?></small>
														</td>
														<?php $store = $this->db->get_where('stores', array('user_id' => $usr->user_id))->row();?>
														<td>
															<div><?php echo ucwords($store->name);?></div>
															<small><?php echo ucwords($store->location);?></small>
														</td>
														<td><?php echo $usr->level;?></td>
														<td><?php echo $usr->stage;?></td>
														<td><?php echo $usr->referral_code;?></td>
														<td>
															<button class="btn btn-primary btn-sm" onClick="showModalCenter('<?php echo base_url().'index.php?modal/popup/view_user/'.$usr->user_id;?>')">View</button>
															<?php if ($usr->status == 1):?>
															<span class="btn btn-inverse-success btn-sm">Active</span>
															<?php elseif ($usr->status == 0):?>
															<span class="btn btn-inverse-danger btn-sm">Inactive</span>
															<button class="btn btn-success btn-sm" value="1" onClick="action_modal('<?php echo base_url().'index.php?admin/activate/'.$usr->user_id;?>')">Activate</button>
															<?php endif;?>
														</td>
													</tr>
													<?php endforeach;?>
												</tbody>
											</table>
										</div>
									</div>
									
									<div class="tab-pane fade py-3 px-3" id="active" role="tabpanel" aria-labelledby="active-tab">
										<?php 
											$where = array('category' => 'merchant', 'status' => 1);
											$orderby = array('user_id', 'DESC');
											$users = $this->db->get_where('user', $where, $orderby)->result_object();
										?>
										<div class="datatable-wrapper table-responsive">
											<table id="merchants" class="table table-hover">
												<thead>
													<tr>
														<th>User</th>
														<th>Store</th>
														<th>Level</th>
														<th>Stage</th>
														<th>Referral ID</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach($users as $usr):?>
													<tr>
														<td>
															<div><?php echo ucwords($usr->firstname . ' ' . $usr->lastname);?></div>
															<small><?php echo 'ID: '.$usr->referral_code;?></small>
														</td>
														<?php $store = $this->db->get_where('stores', array('user_id' => $usr->user_id))->row();?>
														<td>
															<div><?php echo ucwords($store->name);?></div>
															<small><?php echo ucwords($store->location);?></small>
														</td>
														<td><?php echo $usr->level;?></td>
														<td><?php echo $usr->stage;?></td>
														<td><?php echo $usr->referral_code;?></td>
														<td>
															<button class="btn btn-primary btn-sm" onClick="showModalCenter('<?php echo base_url().'index.php?modal/popup/view_user/'.$usr->user_id;?>')">View</button>
															<?php if ($usr->status == 1):?>
															<span class="btn btn-inverse-success btn-sm">Active</span>
															<?php elseif ($usr->status == 0):?>
															<span class="btn btn-inverse-danger btn-sm">Inactive</span>
															<button class="btn btn-success btn-sm" value="1" onClick="action_modal('<?php echo base_url().'index.php?admin/activate/'.$usr->user_id;?>')">Activate</button>
															<?php endif;?>
														</td>
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

	<?php if($this->session->flashdata('flash_message')): ?>
		<script type="text/javascript">
			$(function () {
				swal({
					type: 'success',
					title: 'Success',
					text: '<?php echo $this->session->flashdata('flash_message'); ?>'
				});

				//toastr.options = {positionClass: 'toast-top-center', tapToDismiss: true};
				//toastr.success('<?php //echo $this->session->flashdata('flash_message'); ?>', 'Success');
			});
		</script>
	<?php endif;?>

	<!-- Vertical Center Modal -->
	<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">View User</h5>
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