		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
						<h5 class="m-0 text-dark"> <?php echo $page_title; ?> </h5>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php?admin/dashboard">Dashboard</a></li>
								<li class="breadcrumb-item active"> Class </li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			
			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<!-- Default box -->
							<div class="card card-primary card-outline">
								<div class="card-body">
									<ul class="nav nav-tabs" id="class-tab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="class-list-tab" data-toggle="pill" href="#class-list" role="tab" aria-controls="class-list" aria-selected="true">
											<i class="fa fa-list"></i> &nbsp; Class List
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="add-class-tab" data-toggle="pill" href="#add-class" role="tab" aria-controls="add-class" aria-selected="false">
											<i class="fa fa-plus-circle"></i> &nbsp; Add Class
											</a>
										</li>
									</ul>
									
									<div class="tab-content" id="class-tabContent">
										<div class="tab-pane fade show active" id="class-list" role="tabpanel" aria-labelledby="class-list-tab">
											<div class="card-body table-responsive pl-0 pr-0">
												<table id="class" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th> # </th>
															<th> Name </th>
															<th> Name Numeric </th>
															<th> Teacher </th>
															<th> Options </th>
														</tr>
													</thead>
													
													<tbody>
														<?php
															$count = 1;
															foreach($classes as $row):
														?>
														<tr>
															<td><?php echo $count++;?></td>
															<td><?php echo $row['name']; ?></td>
															<td><?php echo $row['name_numeric'];?></td>
															<td>
																<?php
																	if($row['teacher_id'] != '' || $row['teacher_id'] != 0)
																		echo ucwords(get_type_name_by_id('teacher' ,$row['teacher_id']));
																?>
															</td>
															<td>
																<a class="btn btn-info btn-sm" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_class/<?php echo $row['class_id'];?>');">
																	<i class="fas fa-pencil-alt"></i>
																	Edit
																</a>
																<a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/classes/delete/<?php echo $row['class_id'];?>');">
																	<i class="fas fa-trash"></i>
																	Delete
																</a>
															</td>
														</tr>
														<?php
															endforeach;
														?>
													</tbody>
												</table>
											</div>
											<!-- /.card-body -->
										</div>
										<div class="tab-pane fade" id="add-class" role="tabpanel" aria-labelledby="add-class-tab">
											<div class="row">
												<div class="col-lg-8">
													<!-- form start -->
													<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/classes/create">
														<div class="card-body">
															<div class="form-group row">
																<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
																<div class="col-sm-8">
																	<input type="text" name="name" class="form-control text-capitalize" id="inputName" autofocus required>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputNuN" class="col-sm-4 control-label"> &nbsp; Numeric Name </label>
																<div class="col-sm-8">
																	<input type="text" name="name_numeric" class="form-control" id="inputNuN">
																</div>
															</div>
															<div class="form-group row">
																<label for="inputTeacher" class="col-sm-4 control-label"> &nbsp; Teacher </label>
																<div class="col-sm-8">
																	<select name="teacher_id" class="form-control select2" style="width: 100%;" required>
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
																	<button type="submit" class="btn btn-primary"> &nbsp; Add Class &nbsp; </button>
																</div>
															</div>
														</div>
														<!-- /.card-body -->
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
					</div>
				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		
		<!-- page script -->
		<script type="text/javascript">
			$(function () {
				// Initialize DataTable Elements
				$('#class').DataTable();
				
				// Initialize Select2 Elements
				$('.select2').select2({
					theme: 'bootstrap4'
				})
			});
		</script>