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
								&nbsp; Upload Academic Syllabus
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/upload_academic_syllabus" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Title </label>
									<div class="col-sm-8">
										<input type="text" name="title" class="form-control text-capitalize" id="inputName" autofocus required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputDes" class="col-sm-4 control-label"> &nbsp; Description </label>
									<div class="col-sm-8">
										<textarea class="form-control" name="description" id="inputDes" style="height:100px"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputClass" class="col-sm-4 control-label"> &nbsp; Class </label>
									<div class="col-sm-8">
										<select name="class_id" class="form-control select2" style="width: 100%;"
										onchange="return get_class_subject(this.value)" required>
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
									<label for="inputClass" class="col-sm-4 control-label"> &nbsp; Subject </label>
									<div class="col-sm-8">
										<select name="subject_id" class="form-control select2" style="width: 100%;"
										id="subject_selector_holder" required>
											<option value="">Select Class First</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputFile" class="col-sm-4 control-label"> &nbsp; File </label>
									<div class="col-sm-8">
										<input type="file" name="file_name" class="form-control" id="inputFile" accept="application/pdf" required>
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Upload Syllabus &nbsp; </button>
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
		$(function(){
			// Initialize Select2 Elements
			$('.select2').select2({
				theme: 'bootstrap4',
				minimumResultsForSearch: -1
			})
		});
	</script>
	
	<script type="text/javascript">			
		function get_class_subject(class_id)
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php?admin/get_class_subject/' + class_id ,
				success: function(response)
				{
					jQuery('#subject_selector_holder').html(response);
				}
			});
		}
	</script>
