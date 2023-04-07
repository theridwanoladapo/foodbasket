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
							<blockquote class="m-0 mb-3">
								<div class="quote-blue">
									<p class="text-primary text-lg"> Student Promotion Notes </p>
									<p>
									Promoting student from the present class to the next class will create an enrollment of that student to
									the next session. Make sure to select correct class options from the select menu before promoting.If you don't 
									want to promote a student to the next class, please select that option. That will not promote the student to 
									the next class but it will create an enrollment to the next session but in the same class.
									</p>
								</div>
							</blockquote>
						</div>
						<!-- / .col -->
						<div class="col-12">
							<!-- Horizontal Form -->
							<div class="card card-primary card-outline">
								<div class="card-body">
									<?php 
										$running_year_array			= explode("-", $running_year ); 
										$next_year_first_index		= $running_year_array[1];
										$next_year_second_index		= $running_year_array[1]+1;
										$next_year					= $next_year_first_index."-".$next_year_second_index;
										
										$classes = $this->db->get('class')->result_array();
									?>
									<div class="form-group row">
										<div class="col-md-3">
											<label for="inputClass" class="control-label"> Current Session </label>
											<select name="running_year" class="form-control select2">
												<option value="<?php echo $running_year;?>0">
													<?php echo $running_year;?>
												</option>
											</select>
										</div>
										<div class="col-md-3">
											<label for="inputClass" class="control-label"> Promote to Session </label>
											<select name="promotion_year" id="promotion_year" class="form-control select2">
												<option value="<?php echo $next_year;?>">
													<?php echo $next_year;?>
												</option>
											</select>
										</div>
										<div class="col-md-3">
											<label for="inputClass" class="control-label"> Promotion from Class </label>
											<select name="promotion_from" id="promotion_from" class="form-control select2">
												<option value=""> Select </option>
												<?php
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
										<div class="col-md-3">
											<label for="inputClass" class="control-label"> Promotion to Class </label>
											<select name="promotion_to" id="promotion_to" class="form-control select2">
												<option value=""> Select </option>
												<?php
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
									</div>
								</div>
								<!-- /.card-body -->
								<div class="card-footer text-center">
									<button type="button" class="btn btn-primary" onclick="get_students_to_promote('<?php echo $running_year;?>')">
										&nbsp; Manage Promotion &nbsp; 
									</button>
								</div>
								<!-- /.card-footer -->
							</div>
							<!-- /.card -->
						</div>
						<!-- / .col -->
						<div class="col-12">
							<div id="students_for_promotion_holder">
								<!--?php include 'students_for_promotion_holder.php'; ?-->
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
					theme: 'bootstrap4',
					minimumResultsForSearch: -1
				})
			});
		</script>
		
		<script type="text/javascript">
			
			function get_students_to_promote(running_year)
			{
				promotion_from	= $("#promotion_from").val();
				promotion_to	= $("#promotion_to").val();
				promotion_year	= $("#promotion_year").val();
				
				if (promotion_from == "" || promotion_to == "") {
					toastr.error("<?php echo 'Select Class for Promotion To and From';?>")
					return false;
				}
				$.ajax({
					url: '<?php echo base_url();?>index.php?admin/get_students_to_promote/' + promotion_from + '/' + promotion_to + '/' + running_year + '/' + promotion_year,
					success: function(response)
					{
						jQuery('#students_for_promotion_holder').html(response);
					}
				});
				return false;
			}
		
		</script>