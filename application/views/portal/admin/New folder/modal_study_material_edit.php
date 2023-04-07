<?php 
	if(isset($param2)) $document_id = $param2;
	
	$edit_data = $this->db->get_where('document' , array('document_id' => $document_id))->result_array();
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
								<i class="fas fa-pencil-alt"></i>
								&nbsp; Edit Study Material
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/study_material/update/<?php echo $row['document_id'] ?>" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group row">
									<label for="datepicker" class="col-sm-4 control-label"> Date </label>
									<div class="col-sm-8">
										<input type="text" name="timestamp" class="form-control datetimepicker-input" id="datepicker"
										data-toggle="datetimepicker" data-target="#datepicker" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Title </label>
									<div class="col-sm-8">
										<input type="text" name="title" value="<?php echo $row['title'];?>" class="form-control text-capitalize" id="inputName" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputDes" class="col-sm-4 control-label"> &nbsp; Description </label>
									<div class="col-sm-8">
										<textarea class="form-control" name="description" id="inputDes" style="height:100px" required><?php echo $row['description'];?></textarea>
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
												foreach($classes as $row2):
											?>
											<option value="<?php echo $row2['class_id'];?>"
											<?php if($row['class_id'] == $row2['class_id']) echo 'selected'; ?>>
												<?php echo ucwords($row2['name']);?>
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
											<?php
												$subject = $this->db->get_where('subject',array('class_id' => $row['class_id']))->result_array();
												foreach($subject as $sub):
											?>
											<option value="<?php echo $sub['subject_id']; ?>"
											<?php if ($row['subject_id'] == $sub['subject_id']) echo 'selected'; ?>>
												<?php echo ucwords($sub['name']); ?>
											</option>
											<?php
												endforeach;
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Update &nbsp; </button>
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
				defaultDate: '<?php echo date("m/d/Y", $row['timestamp']);?>'
			})
			
			/*Add text editor
			$('#compose-textarea').summernote({
				height: '300'
			})*/
		})
	</script>
	
<?php
	endforeach;
?>
