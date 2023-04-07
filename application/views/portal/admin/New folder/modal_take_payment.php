<?php
	if(isset($param2)) $invoice_id = $param2;
	
	$edit_data = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->result_array();
	
	foreach($edit_data as $row):
?>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- left column -->
				<div class="col-lg-12">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">
								<i class="fas fa-pencil-alt"></i>
								&nbsp; Payment History
							</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body p-0">
							<table class="table table-striped">
								<thead>
									<tr>
										<th> # </th>
										<th> Amount </th>
										<th> Method </th>
										<th> Date </th>
									</tr>
								</thead>
								
								<tbody>
									<?php
										$count = 1;
										$where = array('invoice_id' => $row['invoice_id']);
										$invoices = $this->db->get_where('payment', $where)->result_array();
										foreach($invoices as $row2):
									?>
									<tr>
										<td><?php echo $count++;?></td>
										<td><?php echo $row2['amount']; ?></td>
										<td>
											<?php
												if($row2['method'] == 1)
													echo 'Cash';
												if($row2['method'] == 2)
													echo 'Check';
												if($row2['method'] == 3)
													echo 'Card';
											?>
										</td>
										<td><?php echo date('d M,Y', $row2['timestamp']); ?></td>
									</tr>
									<?php
										endforeach;
									?>
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					
					<!-- Horizontal Form -->
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">
								<i class="fas fa-pencil-alt"></i>
								&nbsp; Take Payment
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/invoice/take_payment/<?php echo $row['invoice_id'];?>">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputTotal" class="col-sm-4 control-label"> &nbsp; Total Amount </label>
									<div class="col-sm-8">
										<input type="number" name="amount" value="<?php echo $row['amount']?>" id="inputTotal" class="form-control" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPayment" class="col-sm-4 control-label"> &nbsp; Amount Paid </label>
									<div class="col-sm-8">
										<input type="number" name="amount_paid" value="<?php echo $row['amount_paid']?>" id="inputPayment" class="form-control" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPayment" class="col-sm-4 control-label"> &nbsp; Due Amount </label>
									<div class="col-sm-8">
										<input type="number" value="<?php echo $row['due']?>" id="inputPayment" class="form-control" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPayment" class="col-sm-4 control-label"> &nbsp; Payment </label>
									<div class="col-sm-8">
										<input type="number" name="payment" id="inputPayment" class="form-control" placeholder="Enter Payment Amount" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputMethod" class="col-sm-4 control-label"> &nbsp; Method </label>
									<div class="col-sm-8">
										<select name="method" class="form-control select2">
											<option value="1"> Cash </option>
											<option value="2"> Check </option>
											<option value="3"> Card </option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="datepicker" class="col-sm-4 control-label"> &nbsp; Date </label>
									<div class="col-sm-8">
										<input type="text" name="date" class="form-control datetimepicker-input" id="datepicker"
										data-toggle="datetimepicker" data-target="#datepicker">
									</div>
								</div>
								
								<input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id'];?>">
								<input type="hidden" name="student_id" value="<?php echo $row['student_id'];?>">
								<input type="hidden" name="title" value="<?php echo $row['title'];?>">
								<input type="hidden" name="description" value="<?php echo $row['description'];?>">
								
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Take Payment &nbsp; </button>
									</div>
								</div>
							</div>
							<!-- /.card-body -->
						</form>
					</div>
					<!-- /.card -->
				</div>
				<!-- / .col -->
			</div>
		</div><!--/. container-fluid -->
	</section>
	<!-- /.content -->
	
	<!-- page script -->
	<script type="text/javascript">
		$(function () {
			//Timepicker
			$('#datepicker').datetimepicker({
				format: 'MM/DD/YYYY',
				defaultDate: '<?php echo date('m/d/Y');?>'
			})
			
			// Initialize Select2 Elements
			$('.select2').select2({
				theme: 'bootstrap4',
				minimumResultsForSearch: -1
			})
		});
	</script>

<?php
	endforeach;
?>