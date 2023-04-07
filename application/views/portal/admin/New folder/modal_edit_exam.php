<?php
	if(isset($param2)) $exam_id = $param2;
	
	$edit_data = $this->db->get_where('exam', array('exam_id' => $exam_id))->result_array();
	
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
								&nbsp; Edit Exam
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/exam/do_update/<?php echo $row['exam_id'];?>">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
									<div class="col-sm-8">
										<input type="text" name="name" value="<?php echo $row['name'];?>" class="form-control text-capitalize" id="inputName" autofocus required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputDate" class="col-sm-4 control-label"> &nbsp; Date </label>
									<div class="col-sm-8">
										<input type="text" name="date" class="form-control datetimepicker-input" id="dpicker"
										data-toggle="datetimepicker" data-target="#dpicker" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputComment" class="col-sm-4 control-label"> &nbsp; Comment </label>
									<div class="col-sm-8">
										<input type="text" name="comment" value="<?php echo ucfirst($row['comment']);?>" class="form-control" id="inputComment">
									</div>
								</div>
								<div class="form-group row">
									<label for="inputStatus" class="col-sm-4 control-label"> &nbsp; Availability for Viewing Result </label>
									<div class="col-sm-8">
										<select name="status" class="form-control select2">
											<option value="available" <?php if($row['status'] == 'available') echo 'selected'?>>
												Available
											</option>
											<option value="unavailable" <?php if($row['status'] == 'unavailable') echo 'selected'?>>
												Unavailable
											</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Edit Exam &nbsp; </button>
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
			});
			
			//Timepicker
			$('#dpicker').datetimepicker({
				format: 'MM/DD/YYYY',
				defaultDate: '<?php echo $row['date'];?>'
			});
		});
	</script>
	
<?php
	endforeach;
?>