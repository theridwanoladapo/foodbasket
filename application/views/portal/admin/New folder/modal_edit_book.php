<?php
	if(isset($param2)) $book_id = $param2;
	
	$edit_data = $this->db->get_where('book', array('book_id' => $book_id))->result_array();
	
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
								&nbsp; Edit Book
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/book/do_update/<?php echo $row['book_id'];?>" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
									<div class="col-sm-8">
										<input type="text" name="name" value="<?php echo $row['name'];?>" class="form-control text-capitalize" id="inputName" autofocus required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputAuthor" class="col-sm-4 control-label"> &nbsp; Author </label>
									<div class="col-sm-8">
										<input type="text" name="author" value="<?php echo $row['author'];?>" class="form-control text-capitalize" id="inputAuthor" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputDes" class="col-sm-4 control-label"> &nbsp; Description </label>
									<div class="col-sm-8">
										<textarea class="form-control" name="description" id="inputDes" style="height:100px"><?php echo $row['description'];?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputCopy" class="col-sm-4 control-label"> &nbsp; Copies </label>
									<div class="col-sm-8">
										<input type="number" name="copies" value="<?php echo $row['total_copies'];?>" class="form-control" id="inputCopy" required>
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
									<label for="inputFile" class="col-sm-4 control-label"> &nbsp; File </label>
									<div class="col-sm-8">
										<input type="file" name="file_name" class="form-control" id="inputFile" accept="application/pdf">		
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Edit Book &nbsp; </button>
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