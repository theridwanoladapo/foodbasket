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
									<ul class="nav nav-tabs" id="payment-tab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="single-tab" data-toggle="pill" href="#single" role="tab" aria-controls="single" aria-selected="true">
											&nbsp; Create Single Invoice
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="mass-tab" data-toggle="pill" href="#mass" role="tab" aria-controls="mass" aria-selected="false">
											&nbsp; Create Mass Invoice
											</a>
										</li>
									</ul>
									
									<div class="tab-content" id="payment-tabContent">
										<div class="tab-pane fade show active" id="single" role="tabpanel" aria-labelledby="single-tab">
											<!-- .form-start -->
											<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/invoice/create">
												<div class="row mt-3">
													<div class="col-md-6">
														<div class="card card-primary">
															<div class="card-header">
																<h3 class="card-title">Invoice Informations</h3>
															</div>
															<div class="card-body">
																<div class="form-group row">
																	<label for="inputClass" class="col-sm-4 control-label"> &nbsp; Class </label>
																	<div class="col-sm-8">
																		<select name="class_id" class="form-control select2" style="width: 100%;"
																		onchange="return get_class_students(this.value)" required>
																			<option value="">Select</option>
																			<?php
																				$classes = $this->db->get('class')->result_array();
																				foreach($classes as $row):
																			?>
																			<option value="<?php echo $row['class_id'];?>">
																				<?php echo ucwords($row['name']);?>
																			</option>
																			<?php
																				endforeach;
																			?>
																		</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label for="inputStudent" class="col-sm-4 control-label"> &nbsp; Student </label>
																	<div class="col-sm-8">
																		<select name="student_id" class="form-control select3" style="width: 100%;"
																		id="student_selector_holder" required>
																			<option value="">Select Class First</option>
																		</select>
																	</div>
																</div>
																<div class="form-group row">
																	<label for="inputName" class="col-sm-4 control-label"> &nbsp; Title </label>
																	<div class="col-sm-8">
																		<input type="text" name="title" class="form-control text-capitalize" id="inputName" required>
																	</div>
																</div>
																<div class="form-group row">
																	<label for="inputDes" class="col-sm-4 control-label"> &nbsp; Description </label>
																	<div class="col-sm-8">
																		<textarea class="form-control" name="description" id="inputDes" required></textarea>
																	</div>
																</div>
																<div class="form-group row">
																	<label for="datepicker" class="col-sm-4 control-label"> &nbsp; Date </label>
																	<div class="col-sm-8">
																		<input type="text" name="date" class="form-control datetimepicker-input" id="datepicker"
																		data-toggle="datetimepicker" data-target="#datepicker">
																	</div>
																</div>
															</div>
															<!-- /.card-body -->
														</div>
														<!-- /.card -->
													</div>
													
													<div class="col-md-6">
														<div class="card card-secondary">
															<div class="card-header">
																<h3 class="card-title">Payment Informations</h3>
															</div>
															
															<div class="card-body">
																<div class="form-group row">
																	<label for="inputTotal" class="col-sm-4 control-label"> &nbsp; Total </label>
																	<div class="col-sm-8">
																		<input type="number" name="amount" id="inputTotal" class="form-control" placeholder="Enter Total Amount" required>
																	</div>
																</div>
																<div class="form-group row">
																	<label for="inputPayment" class="col-sm-4 control-label"> &nbsp; Payment </label>
																	<div class="col-sm-8">
																		<input type="number" name="amount_paid" id="inputPayment" class="form-control" placeholder="Enter Payment Amount" required>
																	</div>
																</div>
																<!--div class="form-group row">
																	<label for="inputStatus" class="col-sm-4 control-label"> &nbsp; Status </label>
																	<div class="col-sm-8">
																		<select name="status" class="form-control select2">
																			<option value="paid"> Paid </option>
																			<option value="unpaid"> Unpaid </option>
																		</select>
																	</div>
																</div-->
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
															</div>
															<!-- /.card-body -->
														</div>
														<!-- /.card -->
													</div>
												</div>
												
												<div class="row">
													<div class="col-12 text-center">
														<input type="submit" value="&nbsp; Add Invoice &nbsp;" class="btn btn-primary">
													</div>
												</div>
											</form>
										</div>
										
										<div class="tab-pane fade" id="mass" role="tabpanel" aria-labelledby="mass-tab">
											<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/invoice/create_mass_invoice">
												<div class="row mt-3">
													<div class="col-md-6">
														<div class="card-body">
															<div class="form-group row">
																<label for="inputClass" class="col-sm-4 control-label"> &nbsp; Class </label>
																<div class="col-sm-8">
																	<select name="class_id" class="form-control select2" style="width: 100%;"
																	onchange="return get_class_students_mass(this.value)" required>
																		<option value="">Select</option>
																		<?php
																			$classes = $this->db->get('class')->result_array();
																			foreach($classes as $row):
																		?>
																		<option value="<?php echo $row['class_id'];?>">
																			<?php echo ucwords($row['name']);?>
																		</option>
																		<?php
																			endforeach;
																		?>
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputName" class="col-sm-4 control-label"> &nbsp; Title </label>
																<div class="col-sm-8">
																	<input type="text" name="title" class="form-control text-capitalize" id="inputName" required>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputDes" class="col-sm-4 control-label"> &nbsp; Description </label>
																<div class="col-sm-8">
																	<textarea class="form-control" name="description" id="inputDes" required></textarea>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputTotal" class="col-sm-4 control-label"> &nbsp; Total </label>
																<div class="col-sm-8">
																	<input type="number" name="amount" id="inputTotal" class="form-control" placeholder="Enter Total Amount" required>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputPayment" class="col-sm-4 control-label"> &nbsp; Payment </label>
																<div class="col-sm-8">
																	<input type="number" name="amount_paid" id="inputPayment" class="form-control" placeholder="Enter Payment Amount" required>
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
																	<input type="text" name="date" class="form-control datetimepicker-input" id="datepicker2"
																	data-toggle="datetimepicker" data-target="#datepicker2">
																</div>
															</div>
															<div class="form-group row">
																<div class="offset-sm-4 col-sm-8">
																	<button type="submit" class="btn btn-primary"> &nbsp; Add Invoice &nbsp; </button>
																</div>
															</div>
														</div>
														<!-- /.card-body -->
													</div>
													
													<div class="col-md-6">
														<!--div class="form-group row">
															<label for="datepicker2" class="col-sm-3 control-label"> &nbsp; Students </label>
															<div class="col-sm-9">
																<div class="card-header">
																	<a class="btn btn-primary btn-sm" href="javascript:;" onclick="select()">
																		Select All
																	</a>
																	<a class="btn btn-primary btn-sm" href="javascript:;" onclick="unselect()">
																		Select None
																	</a>
																</div>
																<div class="card-body">
																	<div class="form-group clearfix">
																		<div class="icheck-primary d-inline">
																			<input type="checkbox" class="check" id="checkboxPrimary1">
																			<label for="checkboxPrimary1">
																				Primary checkbox
																			</label>
																		</div>
																	</div>
																	<div class="form-group clearfix">
																		<div class="icheck-primary d-inline">
																			<input type="checkbox" class="check" id="checkboxPrimary2">
																			<label for="checkboxPrimary2">
																				Primary checkbox
																			</label>
																		</div>
																	</div>
																	<div class="form-group clearfix">
																		<div class="icheck-primary d-inline">
																			<input type="checkbox" class="check" id="checkboxPrimary3">
																			<label for="checkboxPrimary3">
																				Primary checkbox
																			</label>
																		</div>
																	</div>
																</div>
															</div>
														</div-->
														<div id="student_selection_holder_mass"></div>
													</div>
												</div>
											</form>
										</div>
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
				// Initialize Select2 Elements
				$('.select2').select2({
					theme: 'bootstrap4',
					minimumResultsForSearch: -1
				})
				
				// Initialize Select2 Elements
				$('.select3').select2({
					theme: 'bootstrap4'
				})
				
				//Timepicker
				$('#datepicker').datetimepicker({
					format: 'MM/DD/YYYY',
					defaultDate: '<?php echo date('m/d/Y');?>'
				})
				
				//Timepicker
				$('#datepicker2').datetimepicker({
					format: 'MM/DD/YYYY',
					defaultDate: '<?php echo date('m/d/Y');?>'
				})
			});
			
			function select()
			{
				var chk = $('.check');
				for(i = 0; i < chk.length; i++)
				{
					chk[i].checked = true ;
				}
			}
			
			function unselect()
			{
				var chk = $('.check');
				for(i = 0; i < chk.length; i++)
				{
					chk[i].checked = false ;
				}
			}
		</script>
		
		<script type="text/javascript">			
			function get_class_students(class_id)
			{
				$.ajax({
					url: '<?php echo base_url();?>index.php?admin/get_class_students/' + class_id ,
					success: function(response)
					{
						jQuery('#student_selector_holder').html(response);
					}
				});
			}
			
			function get_class_students_mass(class_id) {
				if (class_id !== '') {
					$.ajax({
						url: '<?php echo base_url();?>index.php?admin/get_class_students_mass/' + class_id ,
						success: function(response)
						{
							jQuery('#student_selection_holder_mass').html(response);
						}
					});
				}
			}
		</script>
