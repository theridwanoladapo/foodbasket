<?php 
	if(isset($param2)) $expense_category_id = $param2;
	
	$edit_data = $this->db->get_where('expense_category', array('expense_category_id' => $expense_category_id))->result_array();
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
								&nbsp; Edit Expense Category
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/expense_category/edit/<?php echo $row['expense_category_id']; ?>">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
									<div class="col-sm-8">
										<input type="text" name="name" value="<?php echo $row['name'];?>" class="form-control text-capitalize" id="inputName" required>
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Edit Expense Category &nbsp; </button>
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
