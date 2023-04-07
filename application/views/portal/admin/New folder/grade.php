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
								<li class="breadcrumb-item active">Exam</li>
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
									<ul class="nav nav-tabs" id="grade-tab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="grade-list-tab" data-toggle="pill" href="#grade-list" role="tab" aria-controls="grade-list" aria-selected="true">
											<i class="fa fa-list"></i> &nbsp; Grade List
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="add-grade-tab" data-toggle="pill" href="#add-grade" role="tab" aria-controls="add-exam" aria-selected="false">
											<i class="fa fa-plus-circle"></i> &nbsp; Add Grade
											</a>
										</li>
									</ul>
									
									<div class="tab-content" id="grade-tabContent">
										<div class="tab-pane fade show active" id="grade-list" role="tabpanel" aria-labelledby="grade-list-tab">
											<div class="card-body table-responsive pl-0 pr-0">
												<table id="exam" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th> # </th>
															<th> Grade Name </th>
															<th> Grade Point </th>
															<th> Mark From </th>
															<th> Mark Upto </th>
															<th> Comment </th>
															<th> Options </th>
														</tr>
													</thead>
													
													<tbody>
														<?php
															$count = 1;
															foreach($grades as $row):
														?>
														<tr>
															<td><?php echo $count++; ?></td>
															<td><?php echo ucwords($row['name']); ?></td>
															<td><?php echo $row['grade_point'];?></td>
															<td><?php echo $row['mark_from'];?></td>
															<td><?php echo $row['mark_upto'];?></td>
															<td><?php echo ucfirst($row['comment']);?></td>
															<td>
																<div class="btn-group">
																	<button type="button" class="btn btn-info btn-sm">Action</button>
																	<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
																		<span class="caret"></span>
																		<span class="sr-only">Toggle Dropdown</span>
																	</button>
																	
																	<div class="dropdown-menu" role="menu">
																		<a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_grade/<?php echo $row['grade_id'];?>');">
																			<i class="fas fa-pencil-alt"></i>
																			Edit
																		</a>
																		
																		<div class="dropdown-divider"></div>
																		
																		<a class="dropdown-item" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/grade/delete/<?php echo $row['grade_id'];?>');">
																			<i class="fas fa-trash"></i>
																			Delete
																		</a>
																	</a>
																	</div>
																</div>
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
										<div class="tab-pane fade" id="add-grade" role="tabpanel" aria-labelledby="add-grade-tab">
											<div class="row">
												<div class="col-lg-8">
													<!-- form start -->
													<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/grade/create">
														<div class="card-body">
															<div class="form-group row">
																<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
																<div class="col-sm-8">
																	<input type="text" name="name" class="form-control text-capitalize" id="inputName" autofocus required>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputGP" class="col-sm-4 control-label"> &nbsp; Grade Point </label>
																<div class="col-sm-8">
																	<input type="text" name="grade_point" class="form-control" id="inputGP" required>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputMF" class="col-sm-4 control-label"> &nbsp; Mark From </label>
																<div class="col-sm-8">
																	<input type="text" name="mark_from" class="form-control" id="inputMF" required>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputMT" class="col-sm-4 control-label"> &nbsp; Mark Upto </label>
																<div class="col-sm-8">
																	<input type="text" name="mark_upto" class="form-control" id="inputMT" required>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputComment" class="col-sm-4 control-label"> &nbsp; Comment </label>
																<div class="col-sm-8">
																	<input type="text" name="comment" class="form-control text-capitalize" id="inputComment">
																</div>
															</div>
															<div class="form-group row">
																<div class="offset-sm-4 col-sm-8">
																	<button type="submit" class="btn btn-primary"> &nbsp; Add Grade &nbsp; </button>
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
				$('#exam').DataTable();
				
				// Initialize Select2 Elements
				$('.select2').select2({
					theme: 'bootstrap4'
				})
				
				//Timepicker
				$('#datepicker').datetimepicker({
					format: 'MM/DD/YYYY'
				})
			});
		</script>