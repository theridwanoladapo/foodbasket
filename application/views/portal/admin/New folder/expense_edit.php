<?php 
	if(isset($param2)) $expense_id = $param2;
	
	$edit_data = $this->db->get_where('expense', array('expense_id' => $expense_id))->result_array();
	foreach ($edit_data as $row):
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
								<i class="fas fa-plus-circle"></i>
								&nbsp; Edit Expense
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/expense/edit/<?php echo $row['expense_id'];?>">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Title </label>
									<div class="col-sm-8">
										<input type="text" name="title" value="<?php echo $row['title']?>" class="form-control text-capitalize" id="inputName" autofocus required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputCat" class="col-sm-4 control-label"> &nbsp; Category </label>
									<div class="col-sm-8">
										<select name="expense_category_id" class="form-control select2" style="width: 100%;" required>
											<option value="">Select</option>
											<?php
												$expenses = $this->db->get('expense_category')->result_array();
												foreach($expenses as $row2):
											?>
											<option value="<?php echo $row2['expense_category_id'];?>" <?php if ($row['expense_category_id'] == $row2['expense_category_id'])	echo 'selected';?>>
												<?php echo ucwords($row2['name']);?>
											</option>
											<?php
												endforeach;
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputDes" class="col-sm-4 control-label"> &nbsp; Description </label>
									<div class="col-sm-8">
										<textarea class="form-control" name="description" id="inputDes" required><?php echo $row['description'];?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputAmount" class="col-sm-4 control-label"> &nbsp; Amount </label>
									<div class="col-sm-8">
										<input type="number" name="amount" value="<?php echo $row['amount']?>" id="inputAmount" class="form-control" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputTotal" class="col-sm-4 control-label"> &nbsp; Method </label>
									<div class="col-sm-8">
										<select name="method" class="form-control select2">
											<option value="1" <?php if ($row['method'] == 1) echo 'selected';?>> Cash </option>
											<option value="2" <?php if ($row['method'] == 2) echo 'selected';?>> Check </option>
											<option value="3" <?php if ($row['method'] == 3) echo 'selected';?>> Card </option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="datepicker2" class="col-sm-4 control-label"> &nbsp; Date </label>
									<div class="col-sm-8">
										<input type="text" name="timestamp" class="form-control datetimepicker-input" id="datepicker"
										data-toggle="datetimepicker" data-target="#datepicker">
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Update &nbsp; </button>
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
			// Initialize Select2 Elements
			$('.select2').select2({
				theme: 'bootstrap4',
				minimumResultsForSearch: -1
			})
			
			//Timepicker
			$('#datepicker').datetimepicker({
				format: 'MM/DD/YYYY',
				defaultDate: '<?php echo date('m/d/Y', $row['timestamp']);?>'
			})
		});
	</script>

<?php
	endforeach;
?>
