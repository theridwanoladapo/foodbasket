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
										<a class="btn btn-primary" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/expense_add/');"  data-toggle="modal">
											<i class="fas fa-plus-circle"></i>
											Add New Expense
										</a>
									</div>
								</div>
									
								<div class="card-body table-responsive">
									<table id="expense" class="table table-bordered table-striped projects">
										<thead>
											<tr>
												<th> # </th>
												<th> Title </th>
												<th> Category </th>
												<th> Method </th>
												<th> Amount </th>
												<th> Date </th>
												<th> Options </th>
											</tr>
										</thead>
										
										<tbody>
											<?php
												$count = 1;
												$where = array('year' => $running_year);
												$order_by = array('timestamp', 'DESC');
												$expenses = $this->db->get_where('expense', $where, $order_by)->result_array();
												foreach($expenses as $row):
											?>
											<tr>
												<td><?php echo $count++;?></td>
												<td><?php echo ucwords($row['title']);?></td>
												<td>
												<?php 
													if ($row['expense_category_id'] != 0 || $row['expense_category_id'] != '')
														echo ucwords($this->db->get_where('expense_category', array('expense_category_id' => $row['expense_category_id']))->row()->name);
												?>
												</td>
												<td>
													<?php 
														if ($row['method'] == 1)
															echo 'Cash';
														if ($row['method'] == 2)
															echo 'Check';
														if ($row['method'] == 3)
															echo 'Card';
													?>
												</td>
												<td><?php echo $row['amount'];?></td>
												<td><?php echo date('d M, Y', $row['timestamp']);?></td>
												<td>
													<div class="btn-group">
														<button type="button" class="btn btn-info btn-sm">Action</button>
														<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
															<span class="caret"></span>
															<span class="sr-only">Toggle Dropdown</span>
														</button>
														
														<div class="dropdown-menu" role="menu">
															<a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/expense_edit/<?php echo $row['expense_id'];?>');">
																<i class="fas fa-pencil-alt"></i> &nbsp; Edit Invoice
															</a>
															
															<div class="dropdown-divider"></div>
															
															<a class="dropdown-item" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/expense/delete/<?php echo $row['expense_id'];?>');">
																<i class="fas fa-trash"></i> &nbsp; Delete
															</a>
														</div>
													</div>
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
				$('#expense').DataTable();
			});
		</script>