<?php
	$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
?>
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
								<div class="card-body">
									<ul class="nav nav-tabs" id="income-tab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="invoices-tab" data-toggle="pill" href="#invoices" role="tab" aria-controls="invoices" aria-selected="true">
												&nbsp; Invoices
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="payment-tab" data-toggle="pill" href="#payment" role="tab" aria-controls="payment" aria-selected="false">
												&nbsp; Payments
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="specific-tab" data-toggle="pill" href="#specific" role="tab" aria-controls="specific" aria-selected="false">
												&nbsp; Specific Student Payments
											</a>
										</li>
									</ul>
									
									<div class="tab-content" id="income-tabContent">
										<div class="tab-pane fade show active" id="invoices" role="tabpanel" aria-labelledby="invoices-tab">
											<div class="card-body table-responsive pl-0 pr-0">
												<table id="invoice_table" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th> # </th>
															<th> Student </th>
															<th> Title </th>
															<th> Total </th>
															<th> Paid </th>
															<th> Status </th>
															<th> Creation Date </th>
															<th> Options </th>
														</tr>
													</thead>
													
													<tbody>
														<?php
															$count = 1;
															$where = array('year' => $running_year);
															$orderby = array('creation_timestamp' => 'DESC');
															$invoices = $this->db->get_where('invoice', $where, $orderby)->result_array();
															foreach($invoices as $row):
														?>
														<tr>
															<td><?php echo $count++;?></td>
															<td><?php echo ucwords(get_type_name_by_id('student', $row['student_id'])); ?></td>
															<td><?php echo ucwords($row['title']); ?></td>
															<td><?php echo $row['amount']; ?></td>
															<td><?php echo $row['amount_paid']; ?></td>
															<td>
																<?php if($row['due'] == 0):?>
																	<button class="btn btn-success btn-xs">Paid</button>
																<?php endif;?>
																<?php if($row['due'] > 0):?>
																	<button class="btn btn-danger btn-xs">Unpaid</button>
																<?php endif;?>
															</td>
															<td><?php echo date('m/d/Y', $row['creation_timestamp']); ?></td>
															<td>
																<div class="btn-group">
																	<button type="button" class="btn btn-info btn-sm">Action</button>
																	<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
																		<span class="caret"></span>
																		<span class="sr-only">Toggle Dropdown</span>
																	</button>
																	
																	<div class="dropdown-menu" role="menu">
																		<?php if($row['due'] > 0):?>
																		<a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_take_payment/<?php echo $row['invoice_id'];?>');">
																			<i class="fas fa-credit-card"></i> &nbsp; Take Payment
																		</a>
																		
																		<div class="dropdown-divider"></div>
																		<?php endif;?>
																		<a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');">
																			<i class="fas fa-eye"></i> &nbsp; View Invoice
																		</a>
																		
																		<a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_invoice/<?php echo $row['invoice_id'];?>');">
																			<i class="fas fa-pencil-alt"></i> &nbsp; Edit Invoice
																		</a>
																		
																		<div class="dropdown-divider"></div>
																		
																		<a class="dropdown-item" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/invoice/delete/<?php echo $row['invoice_id'];?>');">
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
										<!-- /#invoices -->
										
										<div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
											<div class="card-body table-responsive pl-0 pr-0">
												<table id="payment_table" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th> # </th>
															<th> Title </th>
															<th> Description </th>
															<th> Method </th>
															<th> Amount </th>
															<th> Date </th>
															<th>&nbsp;</th>
														</tr>
													</thead>
													
													<tbody>
														<?php
															$count = 1;
															$where = array('year' => $running_year);
															$orderby = array('timestamp' => 'DESC');
															$invoices = $this->db->get_where('payment', $where, $orderby)->result_array();
															foreach($invoices as $row):
														?>
														<tr>
															<td><?php echo $count++;?></td>
															<td><?php echo ucwords($row['title']); ?></td>
															<td><?php echo ucfirst($row['description']); ?></td>
															<td>
																<?php
																	if($row['method'] == 1)
																		echo 'Cash';
																	if($row['method'] == 2)
																		echo 'Check';
																	if($row['method'] == 3)
																		echo 'Card';
																?>
															</td>
															<td><?php echo $row['amount']; ?></td>
															<td><?php echo date('m/d/Y', $row['timestamp']); ?></td>
															<td>
																<a class="btn btn-info btn-sm" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');">
																	<i class="fas fa-eye"></i> &nbsp; View Invoice
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
										<!-- /#payments -->
										
										<div class="tab-pane fade" id="specific" role="tabpanel" aria-labelledby="specific-tab">
											<!-- form start -->
											<form method="post">
												<div class="card-body">
													<div class="form-group row">
														<div class="col-md-4">
															<label for="inputClass" class="control-label"> Select Student</label>
															<select name="student_id" class="form-control select2" style="width:100%;"
															onchange="student_specific_payments(this.value)" required>
																<option value="">Select</option>
																<?php
																	$students = $this->db->get('student')->result_array();
																	foreach($students as $row):
																?>
																<option value="<?php echo $row['student_id'];?>">
																	<?php echo ucwords($row['name']);?>
																</option>
																<?php
																	endforeach;
																?>
															</select>
														</div>
														<!--div class="col-12">
															<button type="submit" class="form-control btn btn-primary"> &nbsp; View Class &nbsp; </button>
														</div-->
													</div>
												</div>
												<!-- /.card-body -->
											</form>
											
											<div id="student_specific_payments_holder">
												<!-- /#student_specific_payments_holder -->
											</div>
											
										</div>
										<!-- /#specific_payments -->
									</div>
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
				// Initialize DataTable Elements
				$('#invoice_table').DataTable();
				
				// Initialize DataTable Elements
				$('#payment_table').DataTable();
				
				/*/ Initialize DataTable Elements
				$('#specific_payments').DataTable({
					"paging": true,
					"lengthChange": false,
					"searching": false,
					"ordering": true,
					"info": true,
					"autoWidth": false
				});*/
				
				// Initialize Select2 Elements
				$('.select2').select2({
					theme: 'bootstrap4'
				})
			});
		</script>
		
		<script type="text/javascript">
			function student_specific_payments(student_id)
			{
				$.ajax({
					url: '<?php echo base_url();?>index.php?admin/get_student_specific_payments/' + student_id,
					success: function(response)
					{
						jQuery('#student_specific_payments_holder').html(response);
					}
				});
			}
		</script>
		