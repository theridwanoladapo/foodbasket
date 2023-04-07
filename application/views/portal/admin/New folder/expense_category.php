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
								<li class="breadcrumb-item active"> Accounting </li>
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
										<a class="btn btn-primary" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/expense_category_add/');"  data-toggle="modal">
											<i class="fas fa-plus-circle"></i>
											Add New Expense Category
										</a>
									</div>
								</div>
									
								<div class="card-body table-responsive">
									<table id="accountant" class="table table-bordered table-striped projects">
										<thead>
											<tr>
												<th> # </th>
												<th> Name </th>
												<th> Options </th>
											</tr>
										</thead>
										
										<tbody>
											<?php
												$count = 1;
												$expense_category = $this->db->get('expense_category')->result_array();
												foreach($expense_category as $row):
											?>
											<tr>
												<td><?php echo $count++;?></td>
												<td><?php echo ucwords($row['name']);?></td>
												<td>
													<a class="btn btn-info btn-sm" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/expense_category_edit/<?php echo $row['expense_category_id'];?>');">
														<i class="fas fa-pencil-alt"></i>
														Edit
													</a>
													<a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/expense_category/delete/<?php echo $row['expense_category_id'];?>');">
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