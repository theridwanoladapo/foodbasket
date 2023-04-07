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
										<a href><i class="ti ti-home"></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Withdraw Requests</li>
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
							<?php 
								$orderby = array('id', 'DESC');
								$requests = $this->db->get('requests', $orderby)->result_object();
							?>
							<div class="datatable-wrapper table-responsive">
								<table id="requests" class="table table-hover">
									<thead>
										<tr>
											<th>Request ID</th>
											<th>User</th>
											<th>Amount</th>
											<th>Date</th>
											<th>Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php 
										foreach($requests as $req):
											$usr = $this->db->get_where('user', array('user_id' => $req->user_id))->row();
											$store = $this->db->get_where('stores', array('user_id' => $req->user_id))->row();
										?>
										<tr>
											<td><?php echo $req->reference;?></td>
											<td>
												<div><?php echo ucwords($usr->firstname . ' ' . $usr->lastname);?></div>
												<small><?php echo ucwords($store->name).' ('.$usr->referral_code.')';?></small>
											</td>
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
											<td>
												<?php if ($req->status == 0):?>
												<button class="btn btn-icon btn-outline-success btn-round mr-2" data-toggle="tooltip" data-placement="top" title="Approve Request" onClick="actionModal('approve', '<?php echo base_url().'index.php?admin/request/approve/'.$req->id;?>')">
													<i class="ti ti-check"></i>
												</button>
												<button class="btn btn-icon btn-outline-danger btn-round" data-toggle="tooltip" data-placement="top" title="Disapprove Request" onClick="actionModal('disapprove', '<?php echo base_url().'index.php?admin/request/disapprove/'.$req->id;?>')">
													<i class="ti ti-close"></i>
												</button>
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

	<!-- Center Modal -->
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
	function actionModal(status, url)
	{
		swal({
			type: 'warning',
			title: 'Are you sure?',
			html: '<p>Are you sure you want to '+status+' the request?</p>',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Confirm',
			cancelButtonText: 'No, Cancel',
			confirmButtonClass: 'btn btn-success',
			cancelButtonClass: 'btn btn-danger',
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
			allowOutsideClick: false
		}).then((result) => {
			if (result.value) {
				submit(url);
			} else if (result.dismiss === swal.DismissReason.cancel) {
				swal(
					'Cancelled',
					'',
					'error'
				)
			}
		})
	}
	
	function submit(url)
	{
		$.ajax(
		{
			url: url,
			type: 'POST',
			data: '',
			cache: false,
			success: function(data)
			{
				var val = JSON.parse(data);
				if(val.type == 'success')
				{
					swal({
						type: 'success',
						title: val.title,
						html: val.text,
						allowOutsideClick: false
					}).then((result) => {
						window.location = "<?php echo base_url().'index.php?admin/requests';?>";
					});
				}
			}
		});
	}
	</script>