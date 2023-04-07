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
						<div class="col-12">
							<!-- Horizontal Form -->
							<div class="card card-primary card-outline">
								<div class="card-header">
									<div class="card-title float-right">
										<a class="btn btn-primary" href="<?php echo base_url();?>index.php?admin/student_add">
											<i class="fas fa-plus-circle"></i>
											Add New Student
										</a>
									</div>
								</div>
								<!-- /.card-header -->
								<!-- form start -->
								<form method="post">
									<div class="card-body">
										<div class="form-group row">
											<div class="col-md-4">
												<label for="inputClass" class="control-label"> Select Class to View Student</label>
												<select name="class_id" class="form-control select2" style="width:100%;"
												onchange="get_students_by_class(this.value)" required>
													<option value="">Select</option>
													<?php
														$classes = $this->db->get('class')->result_array();
														foreach($classes as $row):
													?>
													<option value="<?php echo $row['class_id'];?>">
														<?php echo $row['name'];?>
													</option>
													<?php
														endforeach;
													?>
												</select>
											</div>
											<!--div class="col-12">
												<button type="submit" class="form-control btn btn-primary"> &nbsp; View Class &nbsp; </button>
											</div-->
										</div>
									</div>
									<!-- /.card-body -->
								</form>
							</div>
							<!-- /.card -->
						</div>
						<!-- / .col -->
						<div class="col-12">
							<div id="student_by_class_holder">
								<!-- #student_by_class_holder -->
							</div>
						</div>
						<!-- / .col -->
					</div>
				</div><!--/. container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		
		<script type="text/javascript">
			$(function () {
				//Initialize Select2 Elements
				$('.select2').select2({
					theme: 'bootstrap4'
				})
			});
		</script>
		
		<script type="text/javascript">
			function get_students_by_class(class_id)
			{
				$.ajax({
					url: '<?php echo base_url();?>index.php?admin/get_students_by_class/' + class_id,
					success: function(response)
					{
						jQuery('#student_by_class_holder').html(response);
					}
				});
			}
		</script>
		