<?php
	if(isset($param2)) $class_id = $param2;
	
	$edit_data = $this->db->get_where('class', array('class_id' => $class_id))->result_array();
	
	foreach($edit_data as $row):
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
								&nbsp; Edit Class
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/classes/do_update/<?php echo $row['class_id'];?>">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
									<div class="col-sm-8">
										<input type="text" name="name" value="<?php echo $row['name'];?>" class="form-control text-capitalize" id="inputName" autofocus required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputNuN" class="col-sm-4 control-label"> &nbsp; Numeric Name </label>
									<div class="col-sm-8">
										<input type="text" name="name_numeric" value="<?php echo $row['name_numeric'];?>" class="form-control" id="inputNuN">
									</div>
								</div>
								<div class="form-group row">
									<label for="inputSection" class="col-sm-4 control-label"> &nbsp; Teacher </label>
									<div class="col-sm-8">
										<select name="teacher_id" class="form-control select2" style="width: 100%;" required>
											<option value="">Select</option>
											<?php 
												$teachers = $this->db->get('teacher')->result_array();
												foreach($teachers as $row2):
											?>
											<option value="<?php echo $row2['teacher_id'];?>"
											<?php if($row['teacher_id'] == $row2['teacher_id'])echo 'selected';?>>
												<?php echo ucwords($row2['name']);?>
											</option>
											<?php
												endforeach;
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Edit Class &nbsp; </button>
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
				theme: 'bootstrap4'
			})
		});
	</script>
	
<?php
	endforeach;
?>