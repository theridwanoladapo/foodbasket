<?php
	if(isset($param2))	$student_id = $param2;
	$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
	
	$edit_data = $this->db->get_where('enroll', array(
		'student_id' => $student_id,
		'year' => $running_year
	))->result_array();
	
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
								&nbsp; Edit Student
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/student/do_update/<?php echo $row['student_id']; ?>" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputPhoto" class="col-sm-4 control-label"> &nbsp; Photo </label>
									<div class="col-sm-8">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" style="width: 120px; height: 120px;"
											data-trigger="fileinput">
												<img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']);?>" alt="...">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px;
											max-height: 150px"></div>
											<div>
												<span class="btn btn-primary btn-file btn-sm">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="photo" accept="image/*">
												</span>
												<a href="#" class="btn btn-danger btn-sm fileinput-exists" data-dismiss="fileinput">
													Remove
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
									<div class="col-sm-8">
										<input type="text" name="name" value="<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>" class="form-control text-capitalize" id="inputName" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputParent" class="col-sm-4 control-label"> &nbsp; Parent </label>
									<div class="col-sm-8">
									<select name="parent_id" class="form-control select2" style="width:100%;" id="parent" required>
										<option value="">Select</option>
										<?php
											$parents = $this->db->get('parent')->result_array();
											$parent_id = $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->parent_id;
											foreach($parents as $rowp):
										?>
										<option value="<?php echo $rowp['parent_id'];?>"
										<?php if($rowp['parent_id'] == $parent_id)	echo 'selected';?>>
											<?php echo ucwords($rowp['name']);?>
										</option>
										<?php
											endforeach;
										?>
									</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputClass" class="col-sm-4 control-label"> &nbsp; Class </label>
									<div class="col-sm-8">
										<input type="text" name="class_id" value="<?php echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name; ?>" class="form-control text-capitalize" id="inputName" disabled>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputSection" class="col-sm-4 control-label"> &nbsp; Section </label>
									<div class="col-sm-8">
										<select name="section_id" class="form-control select3" style="width: 100%;" id="section_selector_holder" required>
											<option value="">Select Section</option>
											<?php
												$sections = $this->db->get_where('section', array('class_id' => $row['class_id']))->result_array();
												foreach($sections as $rows):
											?>
											<option value="<?php echo $rows['section_id'];?>"
											<?php if($row['section_id'] == $rows['section_id'])	echo 'selected';?>>
												<?php echo $rows['name'];?>
											</option>
											<?php
												endforeach;
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputID" class="col-sm-4 control-label"> &nbsp; ID Number </label>
									<div class="col-sm-8">
										<input type="text" name="student_code" class="form-control" id="inputID"
										value="<?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->student_code;?>" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="datepicker" class="col-sm-4 control-label"> &nbsp; Birthday </label>
									<div class="col-sm-8">
										<input type="text" name="birthday" class="form-control datetimepicker-input" id="datepicker"
										data-toggle="datetimepicker" data-target="#datepicker" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputSection" class="col-sm-4 control-label"> &nbsp; Gender </label>
									<div class="col-sm-8">
										<select name="gender" class="form-control select3" style="width: 100%;" required>
											<?php
											$gender = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->gender;
											?>
											<option value="">Select</option>
											<option value="male" <?php if($gender == 'male')echo 'selected';?>>Male</option>
											<option value="female" <?php if($gender == 'female')echo 'selected';?>>Female</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputAdd" class="col-sm-4 control-label"> &nbsp; Address </label>
									<div class="col-sm-8">
										<input type="text" name="address" class="form-control text-capitalize" id="inputAdd"
										value="<?php echo ucwords($this->db->get_where('student', array('student_id' => $row['student_id']))->row()->address); ?>" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPhone" class="col-sm-4 control-label"> &nbsp; Phone </label>
									<div class="col-sm-8">
										<input type="text" name="phone" class="form-control" id="inputPhone"
										value="<?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->phone; ?>" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputEmail" class="col-sm-4 control-label"> &nbsp; Email </label>
									<div class="col-sm-8">
										<input type="email" name="email" class="form-control" id="inputEmail"
										value="<?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->email; ?>" required>
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Edit Student &nbsp; </button>
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
				theme: 'bootstrap4'
			});
			
			// Initialize Select2 Elements
			$('.select3').select2({
				theme: 'bootstrap4',
				minimumResultsForSearch: -1
			});
			
			//Timepicker
			$('#datepicker').datetimepicker({
				viewMode: 'years',
				format: 'MM/DD/YYYY',
				defaultDate: '<?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->birthday;?>'
			});
		});
	</script>
	
<?php
	endforeach;
?>