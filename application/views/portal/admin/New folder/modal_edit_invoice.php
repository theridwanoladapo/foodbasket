<?php
	if(isset($param2)) $invoice_id = $param2;
	$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
	
	$edit_data = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->result_array();
	foreach($edit_data as $row):
?>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- left column -->
				<div class="col-lg-12">
					<!-- Horizontal Form -->
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">
								<i class="fas fa-pencil-alt"></i>
								&nbsp; Edit Invoice
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/invoice/do_update/<?php echo $row['invoice_id'];?>">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputStudent" class="col-sm-4 control-label"> &nbsp; Student </label>
									<div class="col-sm-8">
										<select name="student_id" class="form-control select2" style="width: 100%;"
										id="student_selector_holder" required>
											<?php
												$students = $this->db->get('student')->result_array();
												foreach($students as $row2):
											?>
											<option value="<?php echo $row2['student_id'];?>" <?php if($row['student_id'] == $row2['student_id'])echo 'selected';?>>
												<?php
													$class_id = $this->db->get_where('enroll', array(
														'student_id' => $row2['student_id'],
														'year' => $running_year
													))->row()->class_id;
													
													echo ucwords(get_type_name_by_id('student', $row2['student_id']).
																' - '.get_class_name($class_id));
												?>
											</option>
											<?php
												endforeach;
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputTitle" class="col-sm-4 control-label">&nbsp; Title </label>
									<div class="col-sm-8">
									<input type="text" name="title" value="<?php echo $row['title'];?>" id="inputTitle" class="form-control text-capitalize" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputDes" class="col-sm-4 control-label">&nbsp; Description </label>
									<div class="col-sm-8">
									<input type="text" name="description" value="<?php echo $row['description'];?>" id="inputDes" class="form-control" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputTotal" class="col-sm-4 control-label"> &nbsp; Total Amount </label>
									<div class="col-sm-8">
										<input type="number" name="amount" value="<?php echo $row['amount']?>" id="inputTotal" class="form-control" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="datepicker" class="col-sm-4 control-label"> &nbsp; Date </label>
									<div class="col-sm-8">
										<input type="text" name="date" class="form-control datetimepicker-input" id="datepicker"
										data-toggle="datetimepicker" data-target="#datepicker">
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Edit Invoice &nbsp; </button>
									</div>
								</div>
								
								<input type="hidden" name="amount_paid" value="<?php echo $row['amount_paid'];?>">
								
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
				defaultDate: '<?php echo date('m/d/Y', $row['creation_timestamp']);?>'
			})
			
			// Initialize Select2 Elements
			$('.select2').select2({
				theme: 'bootstrap4'
			})
		});
	</script>

<?php
	endforeach;
?>