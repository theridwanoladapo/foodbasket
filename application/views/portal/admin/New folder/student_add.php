		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
						<h5 class="m-0 text-dark"> <?php echo $page_title; ?> </h5>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php?admin/dashboard"> Dashboard </a></li>
								<li class="breadcrumb-item active"> Student </li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->
		
			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<!-- left column -->
						<div class="col-lg-7">
							<!-- Horizontal Form -->
							<div class="card card-primary card-outline">
								<div class="card-header">
									<h3 class="card-title">Admission Form</h3>
								</div>
								<!-- /.card-header -->
								<!-- form start -->
								<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/student/create" enctype="multipart/form-data">
									<div class="card-body">
										<div class="form-group row">
											<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
											<div class="col-sm-8">
												<input type="text" name="name" class="form-control text-capitalize" id="inputName" autofocus required>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputParent" class="col-sm-4 control-label"> &nbsp; Parent </label>
											<div class="col-sm-8">
											<select name="parent_id" class="form-control select2" style="width:100%;" required>
												<option value="">Select</option>
												<?php
													$parents = $this->db->get('parent')->result_array();
													foreach($parents as $row):
												?>
												<option value="<?php echo $row['parent_id'];?>">
													<?php echo ucwords($row['name']);?>
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
												<select name="class_id" class="form-control select3" style="width: 100%;"
												onchange="return get_class_sections(this.value)" required>
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
											<label for="inputSection" class="col-sm-4 control-label"> &nbsp; Section </label>
											<div class="col-sm-8">
												<select name="section_id" class="form-control select3" style="width: 100%;" id="section_selector_holder" required>
													<option value="">Select Class First</option>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputID" class="col-sm-4 control-label"> &nbsp; ID Number </label>
											<div class="col-sm-8">
												<input type="text" name="student_code" class="form-control" id="inputID"
												value="<?php echo substr(md5(uniqid(rand(), true)), 0, 7); ?>" required>
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
													<option value="">Select</option>
													<option value="male">Male</option>
													<option value="female">Female</option>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputAdd" class="col-sm-4 control-label"> &nbsp; Address </label>
											<div class="col-sm-8">
												<input type="text" name="address" class="form-control text-capitalize" id="inputAdd" value="" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputPhone" class="col-sm-4 control-label"> &nbsp; Phone </label>
											<div class="col-sm-8">
												<input type="text" name="phone" class="form-control" id="inputPhone" value="" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputEmail" class="col-sm-4 control-label"> &nbsp; Email </label>
											<div class="col-sm-8">
												<input type="email" name="email" class="form-control" id="inputEmail" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputPassword" class="col-sm-4 control-label"> &nbsp; Password </label>
											<div class="col-sm-8">
												<input type="password" name="password" class="form-control" id="inputPassword" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputPhoto" class="col-sm-4 control-label"> &nbsp; Photo </label>
											<div class="col-sm-8">
												<div class="fileinput fileinput-new" data-provides="fileinput">
													<div class="fileinput-new thumbnail" style="width: 120px; height: 120px;"
													data-trigger="fileinput">
														<img src="uploads/avatar.png" alt="...">
													</div>
													<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px;
													max-height: 150px"></div>
													<div>
														<span class="btn btn-primary btn-file btn-sm">
															<span class="fileinput-new">Select image</span>
															<span class="fileinput-exists">Change</span>
															<input type="file" name="photo" accept="image/*" required>
														</span>
														<a href="#" class="btn btn-danger btn-sm fileinput-exists" data-dismiss="fileinput">
															Remove
														</a>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<div class="offset-sm-4 col-sm-8">
												<button type="submit" class="btn btn-primary"> &nbsp; Add Student &nbsp; </button>
											</div>
										</div>
									</div>
									<!-- /.card-body -->
								</form>
							</div>
							<!-- /.card -->
						</div>
						<!-- / .col (left) -->
						<!-- left column -->
						<div class="col-lg-5">
							<blockquote class="m-0 mb-3">
								<div class="quote-blue">
									<p class="text-primary text-lg"> Student Admission Notes </p>
									<p>
									Admitting new students will automatically create an enrollment to the selected class in the running session.
									Please check and recheck the informations you have inserted because once you admit new student, you won't be 
									able to edit his/her class,roll,section without promoting to the next session.
									</p>
								</div>
							</blockquote>
						</div>
						<!-- / .col (right) -->
					</div>
				</div><!--/. container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		
		<script type="text/javascript">
			$(function() {
				//Initialize Select2 Elements
				$('.select2').select2({
					theme: 'bootstrap4'
				})
				
				$('.select3').select2({
					theme: 'bootstrap4',
					minimumResultsForSearch: -1
				})
				
				//Timepicker
				$('#datepicker').datetimepicker({
					viewMode: 'years',
					format: 'MM/DD/YYYY'
				})
			});
		</script>
		
		<script type="text/javascript">			
			function get_class_sections(class_id)
			{
				$.ajax({
					url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
					success: function(response)
					{
						jQuery('#section_selector_holder').html(response);
					}
				});
			}
		</script>
