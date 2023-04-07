		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
						<h5 class="m-0 text-dark"> <?php echo $page_title; ?> </h5>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php?admin/dashboard">Dashboard</a></li>
								<li class="breadcrumb-item active">Accountant</li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			
			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<!-- Default box -->
							<div class="card card-primary card-outline">
								<div class="card-header">
									<div class="card-title float-right">
										<a class="btn btn-primary" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/accountant_add/');"  data-toggle="modal">
											<i class="fas fa-plus-circle"></i>
											Add New Accountant
										</a>
									</div>
								</div>
									
								<div class="card-body table-responsive">
									<table id="accountant" class="table table-bordered table-striped projects">
										<thead>
											<tr>
												<th> # </th>
												<th> Name </th>
												<th> Email </th>
												<th> Options </th>
											</tr>
										</thead>
										
										<tbody>
											<?php
												$count = 1;
												$accountants = $this->db->get('accountant')->result_array();
												foreach($accountants as $row):
											?>
											<tr>
												<td><?php echo $count++;?></td>
												<td><?php echo ucwords($row['name']);?></td>
												<td><?php echo $row['email'];?></td>
												<td>
													<a class="btn btn-info btn-sm" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/accountant_edit/<?php echo $row['accountant_id'];?>');">
														<i class="fas fa-pencil-alt"></i>
														Edit
													</a>
													<a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/accountant/delete/<?php echo $row['accountant_id'];?>');">
														<i class="fas fa-trash"></i>
														Delete
													</a>
												</td>
											</tr>
											<?php
												endforeach;
											?>
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
					</div>
				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		
		<!-- page script -->
		<script type="text/javascript">
			$(function () {
				$('#accountant').DataTable();
			});
		</script>