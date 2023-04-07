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
								&nbsp; Add Expense
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/expense/create">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Title </label>
									<div class="col-sm-8">
										<input type="text" name="title" class="form-control text-capitalize" id="inputName" autofocus required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputCat" class="col-sm-4 control-label"> &nbsp; Category </label>
									<div class="col-sm-8">
										<select name="expense_category_id" class="form-control select2" style="width: 100%;" required>
											<option value="">Select</option>
											<?php
												$expenses = $this->db->get('expense_category')->result_array();
												foreach($expenses as $row):
											?>
											<option value="<?php echo $row['expense_category'];?>">
												<?php echo ucwords($row['name']);?>
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
										<textarea class="form-control" name="description" id="inputDes" required></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputAmount" class="col-sm-4 control-label"> &nbsp; Amount </label>
									<div class="col-sm-8">
										<input type="number" name="amount" id="inputAmount" class="form-control" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputTotal" class="col-sm-4 control-label"> &nbsp; Method </label>
									<div class="col-sm-8">
										<select name="method" class="form-control select2">
											<option value="1"> Cash </option>
											<option value="2"> Check </option>
											<option value="3"> Card </option>
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
										<button type="submit" class="btn btn-primary"> &nbsp; Add Expense &nbsp; </button>
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
				defaultDate: '<?php echo date('m/d/Y');?>'
			})
		});
	</script>