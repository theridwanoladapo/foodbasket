<?php
	if(isset($param2)) $teacher_id = $param2;
	
	$edit_data = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->result_array();
	foreach($edit_data as $row):
		$links_json = $row['social_links'];
		$links = json_decode($links_json);
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
								&nbsp; Edit Teacher
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/teacher/do_update/<?php echo  $row['teacher_id']; ?>" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputPhoto" class="col-sm-4 control-label"> &nbsp; Photo </label>
									<div class="col-sm-8">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" style="width: 120px; height: 120px;"
											data-trigger="fileinput">
												<img src="<?php echo $this->crud_model->get_image_url('teacher', $row['teacher_id']);?>" alt="...">
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
										<input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control text-capitalize" id="inputName" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputDesign" class="col-sm-4 control-label"> &nbsp; Designation </label>
									<div class="col-sm-8">
										<input type="text" name="designation" value="<?php echo $row['designation']; ?>" class="form-control text-capitalize" id="inputDesign" required>
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
										<select name="gender" class="form-control select_gender" style="width: 100%;" required>
											<option value="">Select</option>
											<option value="male" <?php if($row['gender'] == 'male') echo 'selected'; ?>>Male</option>
											<option value="female" <?php if($row['gender'] == 'female') echo 'selected'; ?>>Female</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputAdd" class="col-sm-4 control-label"> &nbsp; Address </label>
									<div class="col-sm-8">
										<input type="text" name="address" value="<?php echo $row['address']; ?>" class="form-control text-capitalize" id="inputAdd" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPhone" class="col-sm-4 control-label"> &nbsp; Phone </label>
									<div class="col-sm-8">
										<input type="text" name="phone" value="<?php echo $row['phone']; ?>" class="form-control" id="inputPhone" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputEmail" class="col-sm-4 control-label"> &nbsp; Email </label>
									<div class="col-sm-8">
										<input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" id="inputEmail" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputSocialLinks" class="col-sm-4 control-label"> &nbsp; Social Links </label>
									<div class="col-sm-8">
										<div class="input-group mb-3">
											<input type="text" name="linkedin" value="<?php echo $links[0]->linkedin;?>" class="form-control">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fab fa-linkedin-in"></i></span>
											</div>
										</div>
										<div class="input-group mb-3">
											<input type="text" name="facebook" value="<?php echo $links[0]->facebook;?>" class="form-control">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fab fa-facebook-f"></i></span>
											</div>
										</div>
										<div class="input-group mb-3">
											<input type="text" name="twitter" value="<?php echo $links[0]->twitter;?>" class="form-control">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fab fa-twitter"></i></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Edit Teacher &nbsp; </button>
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
			$('.select_gender').select2({
				theme: 'bootstrap4',
				minimumResultsForSearch: -1
			})
			
			//Timepicker
			$('#datepicker').datetimepicker({
				viewMode: 'years',
				format: 'MM/DD/YYYY',
				defaultDate: '<?php echo $row['birthday']; ?>'
			})
		});
	</script>
	
<?php
	endforeach;
?>