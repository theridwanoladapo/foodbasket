<?php
	$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
?>
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
								<li class="breadcrumb-item active"> Attendance </li>
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
								<!-- form start -->
								<form class="" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/attendance_selector/<?php echo $running_year;?>">
									<div class="card-body">
										<div class="form-group row">
											<div class="col-md-4">
												<label for="inputClass" class="control-label"> Class </label>
												<select name="class_id" class="form-control select2" style="width: 100%;"
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
											<div class="col-md-4">
												<label for="inputSection" class="control-label"> Section </label>
												<select name="section_id" class="form-control select2" style="width: 100%;"
												id="section_selector_holder" required>
													<option value="">Select Class First</option>
												</select>
											</div>
											<div class="col-md-4">
												<label for="datepicker" class="control-label"> Date </label>
												<input type="text" name="timestamp" class="form-control datetimepicker-input" id="datepicker"
												data-toggle="datetimepicker" data-target="#datepicker" required>
											</div>
										</div>
									</div>
									<!-- /.card-body -->
									<div class="card-footer text-center">
										<button type="submit" class="btn btn-primary"> &nbsp; Manage Attendance &nbsp; </button>
									</div>
									<!-- /.card-footer -->
								</form>
							</div>
							<!-- /.card -->
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
					theme: 'bootstrap4',
					minimumResultsForSearch: -1
				})
				
				//Timepicker
				$('#datepicker').datetimepicker({
					format: 'MM/DD/YYYY',
					defaultDate: '<?php echo date("m/d/Y");?>'
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
