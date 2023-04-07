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
								&nbsp; Add Subject
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/subjects/create">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
									<div class="col-sm-8">
										<input type="text" name="name" class="form-control text-capitalize" id="inputName" autofocus required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputClass" class="col-sm-4 control-label"> &nbsp; Class </label>
									<div class="col-sm-8">
										<select name="class_id" class="form-control select2" style="width: 100%;"
										onchange="return get_class_section_select(this.value)" required>
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
								<div id="section_for_subject_selection_holder">
								</div>
								<div class="form-group row">
									<label for="inputTeacher" class="col-sm-4 control-label"> &nbsp; Teacher </label>
									<div class="col-sm-8">
										<select name="teacher_id" class="form-control select3" style="width: 100%;" required>
											<option value="">Select</option>
											<?php
												$teachers = $this->db->get('teacher')->result_array();
												foreach($teachers as $row):
											?>
											<option value="<?php echo $row['teacher_id'];?>">
												<?php echo ucwords($row['name']);?>
											</option>
											<?php
												endforeach;
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Add Subject &nbsp; </button>
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
			// Initialize Select2 Elements
			$('.select3').select2({
				theme: 'bootstrap4'
			})
		});
		
		function get_class_section_select(class_id) {
			$.ajax({
				url: '<?php echo base_url();?>index.php?admin/get_class_section_select/' + class_id ,
				success: function(response)
				{
					jQuery('#section_for_subject_selection_holder').html(response);
				}
			});
		}
	</script>