<?php
	if(isset($param2)) $grade_id = $param2;
	
	$edit_data = $this->db->get_where('grade', array('grade_id' => $grade_id))->result_array();
	
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
								&nbsp; Edit Grade
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/grade/do_update/<?php echo $row['grade_id'];?>">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
									<div class="col-sm-8">
										<input type="text" name="name" value="<?php echo $row['name'];?>" class="form-control text-capitalize" id="inputName" autofocus required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputGP" class="col-sm-4 control-label"> &nbsp; Grade Point </label>
									<div class="col-sm-8">
										<input type="text" name="grade_point" value="<?php echo $row['grade_point'];?>" class="form-control" id="inputGP" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputMF" class="col-sm-4 control-label"> &nbsp; Mark From </label>
									<div class="col-sm-8">
										<input type="text" name="mark_from" value="<?php echo $row['mark_from'];?>" class="form-control" id="inputMF" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputMT" class="col-sm-4 control-label"> &nbsp; Mark Upto </label>
									<div class="col-sm-8">
										<input type="text" name="mark_upto" value="<?php echo $row['mark_upto'];?>" class="form-control" id="inputMT" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputComment" class="col-sm-4 control-label"> &nbsp; Comment </label>
									<div class="col-sm-8">
										<input type="text" name="comment" value="<?php echo $row['comment'];?>" class="form-control text-capitalize" id="inputComment">
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Edit Grade &nbsp; </button>
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
	
<?php
	endforeach;
?>