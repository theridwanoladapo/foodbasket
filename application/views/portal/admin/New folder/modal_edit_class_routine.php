<?php
	$class_routine_id = $param2;
	$edit_data = $this->db->get_where('class_routine', array('class_routine_id' => $class_routine_id))->result_array();
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
								&nbsp; Edit Class Routine
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<?php
							foreach($edit_data as $row):
						?>
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/class_routine/do_update/<?php echo $row['class_routine_id'];?>">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputClass" class="col-sm-4 control-label"> &nbsp; Class </label>
									<div class="col-sm-8">
										<select id="class_id" name="class_id" class="form-control select2" style="width: 100%;"
										onchange="section_subject_select(this.value, <?php echo $class_routine_id;?>)" required>
											<option value="">Select</option>
											<?php
												$classes = $this->db->get('class')->result_array();
												foreach($classes as $row2):
											?>
											<option value="<?php echo $row2['class_id'];?>"
											<?php if($row['class_id'] == $row2['class_id'])	echo 'selected';?>>
												<?php echo $row2['name'];?>
											</option>
											<?php
												endforeach;
											?>
										</select>
									</div>
								</div>
								<div id="section_subject_edit_holder"></div>
								<div class="form-group row">
									<label for="inputSection" class="col-sm-4 control-label"> &nbsp; Day </label>
									<div class="col-sm-8">
										<select name="day" class="form-control select2" style="width: 100%;" required>
											<option value="sunday" <?php if($row['day'] == 'sunday')	echo 'selected';?>>Sunday</option>
											<option value="monday" <?php if($row['day'] == 'monday')	echo 'selected';?>>Monday</option>
											<option value="tuesday" <?php if($row['day'] == 'tuesday')	echo 'selected';?>>Tuesday</option>
											<option value="wednesday" <?php if($row['day'] == 'wednesday')	echo 'selected';?>>Wednesday</option>
											<option value="thursday" <?php if($row['day'] == 'thursday')	echo 'selected';?>>Thursday</option>
											<option value="friday" <?php if($row['day'] == 'friday')	echo 'selected';?>>Friday</option>
											<option value="saturday" <?php if($row['day'] == 'saturday')	echo 'selected';?>>Saturday</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputET" class="col-sm-4 control-label"> &nbsp; Starting Time </label>
									<div class="col-sm-8">
										<?php 
											if($row['time_start'] > 12)
											{
												$time_start			=	$row['time_start'] - 12;
												$time_start_min		=   $row['time_start_min'];
												$time_start_ampm	=	2;
											}else
											{
												$time_start			=	$row['time_start'];
												$time_start_min		=   $row['time_start_min'];
												$time_start_ampm	=	1;
											}
										?>
										<div class="row">
											<div class="col-sm-4 control-label">
												<select name="time_start" class="form-control select2" required>
													<option value=""> Hour </option>
													<?php for($i = 0; $i <= 12; $i++):?>
													<option value="<?php echo $i;?>" <?php if($i == $time_start)	echo 'selected';?>>
														<?php echo $i;?>
													</option>
													<?php endfor;?>
												</select>
											</div>
											<div class="col-sm-4 control-label">
												<select name="time_start_min" class="form-control select2" required>
													<option value=""> Minutes </option>
													<?php for($i = 0; $i <= 11; $i++):?>
													<option value="<?php echo $i * 5;?>" <?php if(($i * 5) == $time_start_min) echo 'selected';?>>
														<?php echo $i * 5;?>
													</option>
													<?php endfor;?>
												</select>
											</div>
											<div class="col-sm-4 control-label">
												<select name="time_start_ampm" class="form-control select2" required>
													<option value="1" <?php if($time_start_ampm	==	'1')	echo 'selected';?>>AM</option>
													<option value="2" <?php if($time_start_ampm	==	'2')	echo 'selected';?>>PM</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputET" class="col-sm-4 control-label"> &nbsp; Ending Time </label>
									<div class="col-sm-8">
										<?php 
											if($row['time_end'] > 12)
											{
												$time_end			=	$row['time_end'] - 12;
												$time_end_min		=   $row['time_end_min'];
												$time_end_ampm	=	2;
											}else
											{
												$time_end			=	$row['time_end'];
												$time_end_min		=   $row['time_end_min'];
												$time_end_ampm	=	1;
											}
										?>
										<div class="row">
											<div class="col-sm-4 control-label">
												<select name="time_end" class="form-control select2" required>
													<option value=""> Hour </option>
													<?php for($i = 0; $i <= 12; $i++):?>
													<option value="<?php echo $i;?>" <?php if($i == $time_end)	echo 'selected';?>>
														<?php echo $i;?>
													</option>
													<?php endfor;?>
												</select>
											</div>
											<div class="col-sm-4 control-label">
												<select name="time_end_min" class="form-control select2" required>
													<option value=""> Minutes </option>
													<?php for($i = 0; $i <= 11; $i++):?>
													<option value="<?php echo $i * 5;?>" <?php if(($i * 5) == $time_end_min) echo 'selected';?>>
														<?php echo $i * 5;?>
													</option>
													<?php endfor;?>
												</select>
											</div>
											<div class="col-sm-4 control-label">
												<select name="time_end_ampm" class="form-control select2" required>
													<option value="1" <?php if($time_end_ampm	==	'1')	echo 'selected';?>>AM</option>
													<option value="2" <?php if($time_end_ampm	==	'2')	echo 'selected';?>>PM</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Edit Class Routine &nbsp; </button>
									</div>
								</div>
							</div>
							<!-- /.card-body -->
						</form>
						<?php
							endforeach;
						?>
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
		
		function section_subject_select(class_id, class_routine_id) {
			$.ajax({
				url: '<?php echo base_url();?>index.php?admin/section_subject_edit/' + class_id + '/' + class_routine_id ,
				success: function(response)
				{
					jQuery('#section_subject_edit_holder').html(response);
				}
			});
		}
	</script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			var class_id = $('#class_id').val();
			var class_routine_id = '<?php echo $class_routine_id;?>';
			section_subject_select(class_id, class_routine_id);
		}); 
	</script>

<!--
								<div class="form-group row">
									<label for="inputST" class="col-sm-4 control-label"> &nbsp; Starting Time </label>
									<div class="col-sm-8">
										<input type="text" name="start_time" class="form-control datetimepicker-input" id="timepicker"
										data-toggle="datetimepicker" data-target="#timepicker" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputET" class="col-sm-4 control-label"> &nbsp; Ending time </label>
									<div class="col-sm-8">
										<input type="text" name="end_time" class="form-control datetimepicker-input" id="timepicker2"
										data-toggle="datetimepicker" data-target="#timepicker2" required>
									</div>
								</div>
-->