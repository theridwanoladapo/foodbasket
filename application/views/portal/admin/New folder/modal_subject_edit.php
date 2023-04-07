<?php
	if(isset($param2)) $subject_id = $param2;

	$edit_data = $this->db->get_where('subject', array('subject_id' => $subject_id))->result_array();
	
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
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/subjects/do_update/<?php echo $row['subject_id']; ?>">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
									<div class="col-sm-8">
										<input type="text" name="name" value="<?php echo $row['name'];?>" class="form-control text-capitalize" id="inputName" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputClass" class="col-sm-4 control-label"> &nbsp; Class </label>
									<div class="col-sm-8">
										<select id="class_id" name="class_id" class="form-control select2" style="width: 100%;"
										onchange="class_section_edit(this.value, <?php echo $subject_id;?>)" required>
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
								<div id="class_section_edit_holder">
								</div>
								<div class="form-group row">
									<label for="inputTeacher" class="col-sm-4 control-label"> &nbsp; Teacher </label>
									<div class="col-sm-8">
										<select name="teacher_id" class="form-control select3" style="width: 100%;" required>
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
			// Initialize Select2 Elements
			$('.select3').select2({
				theme: 'bootstrap4'
			})
		});
		
		function class_section_edit(class_id, subject_id) {
			$.ajax({
				url: '<?php echo base_url();?>index.php?admin/class_section_edit/' + class_id + '/' + subject_id ,
				success: function(response)
				{
					jQuery('#class_section_edit_holder').html(response);
				}
			});
		}
	</script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			var class_id = $('#class_id').val();
			var subject_id = '<?php echo $subject_id;?>';
			class_section_edit(class_id, subject_id);
		}); 
	</script>

<?php
	endforeach;
?>