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
								&nbsp; Add Study Material
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/study_material/create" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group row">
									<label for="datepicker" class="col-sm-4 control-label"> &nbsp; Date </label>
									<div class="col-sm-8">
										<input type="text" name="timestamp" class="form-control datetimepicker-input" id="datepicker"
										data-toggle="datetimepicker" data-target="#datepicker" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Title </label>
									<div class="col-sm-8">
										<input type="text" name="title" class="form-control text-capitalize" id="inputName" autofocus required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputDes" class="col-sm-4 control-label"> &nbsp; Description </label>
									<div class="col-sm-8">
										<textarea class="form-control" name="description" id="inputDes" style="height:100px" required></textarea>
										<!--textarea name="description" id="compose-textarea" class="form-control"></textarea-->
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
										<input type="file" name="file_name" class="form-control" id="inputFile" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputClass" class="col-sm-4 control-label"> &nbsp; File Type </label>
									<div class="col-sm-8">
										<select name="file_type" class="form-control select2" style="width: 100%;">
											<option value="">Select File Type</option>
											<option value="image">Image</option>
											<option value="doc">Doc</option>
											<option value="pdf">PDF</option>
											<option value="excel">Excel</option>
											<option value="other">Other</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Upload &nbsp; </button>
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
			
			//Timepicker
			$('#datepicker').datetimepicker({
				format: 'MM/DD/YYYY',
				defaultDate: '<?php echo date("m/d/Y");?>'
			})
			
			/*Add text editor
			$('#compose-textarea').summernote({
				height: '300'
			})*/
		})
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
