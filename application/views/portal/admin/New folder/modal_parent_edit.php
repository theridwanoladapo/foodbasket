<?php 
	if(isset($param2)) $parent_id = $param2;
	
	$edit_data = $this->db->get_where('parent', array('parent_id' => $parent_id))->result_array();
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
								&nbsp; Edit Parent
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/parent/edit/<?php echo $row['parent_id']; ?>">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
									<div class="col-sm-8">
										<input type="text" name="name" value="<?php echo $row['name'];?>" class="form-control text-capitalize" id="inputName" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputJob" class="col-sm-4 control-label"> &nbsp; Profession </label>
									<div class="col-sm-8">
										<input type="text" name="profession" value="<?php echo $row['profession'];?>" class="form-control text-capitalize" id="inputJob">
									</div>
								</div>
								<div class="form-group row">
									<label for="inputAdd" class="col-sm-4 control-label"> &nbsp; Address </label>
									<div class="col-sm-8">
										<input type="text" name="address" value="<?php echo $row['address'];?>" class="form-control text-capitalize" id="inputAdd" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPhone" class="col-sm-4 control-label"> &nbsp; Phone </label>
									<div class="col-sm-8">
										<input type="text" name="phone" value="<?php echo $row['phone'];?>" class="form-control" id="inputPhone" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputEmail" class="col-sm-4 control-label"> &nbsp; Email </label>
									<div class="col-sm-8">
										<input type="email" name="email" value="<?php echo $row['email'];?>" class="form-control" id="inputEmail" required>
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Edit Parent &nbsp; </button>
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
