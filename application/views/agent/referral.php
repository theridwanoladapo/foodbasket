<div class="app-main" id="main">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin row -->
		<div class="row">
			<div class="col-md-12 m-b-30">
				<!-- begin page title -->
				<div class="d-block d-lg-flex flex-nowrap align-items-center">
					<div class="page-title mr-4 pr-4 border-right">
						<h1>Referral List</h1>
					</div>
					<div class="breadcrumb-bar align-items-center">
						<nav>
							<ol class="breadcrumb p-0 m-b-0">
								<li class="breadcrumb-item">
									<a href><i class="ti ti-home"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Referral List</li>
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
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<?php 
							$where = array('referrer' => $agent->referral_code);
						 	$orderby = array('user_id', 'DESC');
							$referral = $this->db->get_where('user', $where, $orderby)->result_object();
						?>
						<div class="datatable-wrapper table-responsive">
							<table id="referrals" class="table table-hover">
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
				</div>
			</div>
		</div>
		<!-- end row -->
	</div>
	<!-- end container-fluid -->
</div>