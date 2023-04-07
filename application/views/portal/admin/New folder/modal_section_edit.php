<?php
	if(isset($param2)) $section_id = $param2;

	$edit_data = $this->db->get_where('section', array('section_id' => $section_id))->result_array();
	
	foreach ($edit_data as $row):
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
								&nbsp; Edit Section
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/sections/edit/<?php echo $row['section_id']; ?>">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
									<div class="col-sm-8">
										<input type="text" name="name" value="<?php echo $row['name'];?>" class="form-control text-capitalize" id="inputName" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Nick Name </label>
									<div class="col-sm-8">
										<input type="text" name="nick_name" value="<?php echo $row['nick_name'];?>" class="form-control text-capitalize" id="inputName">
									</div>
								</div>
								<div class="form-group row">
									<label for="inputClass" class="col-sm-4 control-label"> &nbsp; Class </label>
									<div class="col-sm-8">
										<select name="class_id" class="form-control select2" style="width: 100%;" required>
											<option value="">Select</option>
											<?php
												$classes = $this->db->get('class')->result_array();
												foreach($classes as $row2):
											?>
											<option value="<?php echo $row2['class_id'];?>"
											<?php if ($row['class_id'] == $row2['class_id']) echo 'selected';?>>
												<?php echo ucwords($row2['name']);?>
											</option>
											<?php
												endforeach;
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputTeacher" class="col-sm-4 control-label"> &nbsp; Teacher </label>
									<div class="col-sm-8">
										<select name="teacher_id" class="form-control select2" style="width: 100%;" required>
											<option value="">Select</option>
											<?php
												$teachers = $this->db->get('teacher')->result_array();
												foreach($teachers as $row3):
											?>
											<option value="<?php echo $row3['teacher_id'];?>"
											<?php if ($row['teacher_id'] == $row3['teacher_id']) echo 'selected';?>>
												<?php echo ucwords($row3['name']);?>
											</option>
											<?php
												endforeach;
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Edit Section &nbsp; </button>
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
				theme: 'bootstrap4',
				minimumResultsForSearch: -1
			})
		});
	</script>
	
<?php
	endforeach;
?>