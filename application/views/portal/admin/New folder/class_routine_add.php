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
								&nbsp; Add Class Routine
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/class_routine/create">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputClass" class="col-sm-4 control-label"> &nbsp; Class </label>
									<div class="col-sm-8">
										<select name="class_id" class="form-control select2" style="width: 100%;"
										onchange="return get_class_section_subject(this.value)" required>
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
								<div id="section_subject_selection_holder">
								</div>
								<div class="form-group row">
									<label for="inputSection" class="col-sm-4 control-label"> &nbsp; Day </label>
									<div class="col-sm-8">
										<select name="day" class="form-control select2" style="width: 100%;" required>
											<option value="sunday"> Sunday </option>
											<option value="monday"> Monday </option>
											<option value="tuesday"> Tuesday </option>
											<option value="wednesday"> Wednesday </option>
											<option value="thursday"> Thursday </option>
											<option value="friday"> Friday </option>
											<option value="saturday"> Saturday </option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputET" class="col-sm-4 control-label"> &nbsp; Starting Time </label>
									<div class="col-sm-8">
										<div class="row">
											<div class="col-sm-4 control-label">
												<select name="time_start" class="form-control select2" required>
													<option value=""> Hour </option>
													<?php for($i = 0; $i <= 12; $i++):?>
													<option value="<?php echo $i;?>"><?php echo $i;?></option>
													<?php endfor;?>
												</select>
											</div>
											<div class="col-sm-4 control-label">
												<select name="time_start_min" class="form-control select2" required>
													<option value=""> Minutes </option>
													<?php for($i = 0; $i <= 11; $i++):?>
													<option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
													<?php endfor;?>
												</select>
											</div>
											<div class="col-sm-4 control-label">
												<select name="time_start_ampm" class="form-control select2" required>
													<option value="1">AM</option>
													<option value="2">PM</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputET" class="col-sm-4 control-label"> &nbsp; Ending Time </label>
									<div class="col-sm-8">
										<div class="row">
											<div class="col-sm-4 control-label">
												<select name="time_end" class="form-control select2" required>
													<option value=""> Hour </option>
													<?php for($i = 0; $i <= 12; $i++):?>
													<option value="<?php echo $i;?>"><?php echo $i;?></option>
													<?php endfor;?>
												</select>
											</div>
											<div class="col-sm-4 control-label">
												<select name="time_end_min" class="form-control select2" required>
													<option value=""> Minutes </option>
													<?php for($i = 0; $i <= 11; $i++):?>
													<option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
													<?php endfor;?>
												</select>
											</div>
											<div class="col-sm-4 control-label">
												<select name="time_end_ampm" class="form-control select2" required>
													<option value="1">AM</option>
													<option value="2">PM</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Add Class Routine &nbsp; </button>
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
	
	<script type="text/javascript">
		$(function() {
			//Initialize Select2 Elements
			$('.select2').select2({
				theme: 'bootstrap4',
				minimumResultsForSearch: -1
			})
			
			/*/Timepicker
			$('#timepicker').datetimepicker({
				format: 'LT'
			});
			//Timepicker
			$('#timepicker2').datetimepicker({
				format: 'LT'
			});*/
		});
				
		function get_class_section_subject(class_id) {
			$.ajax({
				url: '<?php echo base_url();?>index.php?admin/get_class_section_subject/' + class_id ,
				success: function(response)
				{
					jQuery('#section_subject_selection_holder').html(response);
				}
			});
		}
	</script>
	