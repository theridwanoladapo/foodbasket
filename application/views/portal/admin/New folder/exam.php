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
									<ul class="nav nav-tabs" id="class-tab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="exam-list-tab" data-toggle="pill" href="#exam-list" role="tab" aria-controls="exam-list" aria-selected="true">
											<i class="fa fa-list"></i> &nbsp; Exam List
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="add-exam-tab" data-toggle="pill" href="#add-exam" role="tab" aria-controls="add-exam" aria-selected="false">
											<i class="fa fa-plus-circle"></i> &nbsp; Add Exam
											</a>
										</li>
									</ul>
									
									<div class="tab-content" id="class-tabContent">
										<div class="tab-pane fade show active" id="exam-list" role="tabpanel" aria-labelledby="exam-list-tab">
											<div class="card-body table-responsive pl-0 pr-0">
												<table id="exam" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th> # </th>
															<th> Exam Name </th>
															<th> Date </th>
															<th> Comment </th>
															<th> Options </th>
														</tr>
													</thead>
													
													<tbody>
														<?php
															$count = 1;
															foreach($exams as $row):
														?>
														<tr>
															<td><?php echo $count++;?></td>
															<td><?php echo ucwords($row['name']); ?></td>
															<td><?php echo $row['date'];?></td>
															<td><?php echo ucfirst($row['comment']);?></td>
															<td>
																<a class="btn btn-info btn-sm" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_exam/<?php echo $row['exam_id'];?>');">
																	<i class="fas fa-pencil-alt"></i>
																	Edit
																</a>
																<a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/exam/delete/<?php echo $row['exam_id'];?>');">
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
										<div class="tab-pane fade" id="add-exam" role="tabpanel" aria-labelledby="add-exam-tab">
											<div class="row">
												<div class="col-lg-8">
													<!-- form start -->
													<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/exam/create">
														<div class="card-body">
															<div class="form-group row">
																<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
																<div class="col-sm-8">
																	<input type="text" name="name" class="form-control text-capitalize" id="inputName" autofocus required>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputDate" class="col-sm-4 control-label"> &nbsp; Date </label>
																<div class="col-sm-8">
																	<input type="text" name="date" class="form-control datetimepicker-input" id="datepicker"
																	data-toggle="datetimepicker" data-target="#datepicker" required>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputComment" class="col-sm-4 control-label"> &nbsp; Comment </label>
																<div class="col-sm-8">
																	<input type="text" name="comment" class="form-control" id="inputComment">
																</div>
															</div>
															<div class="form-group row">
																<div class="offset-sm-4 col-sm-8">
																	<button type="submit" class="btn btn-primary"> &nbsp; Add Exam &nbsp; </button>
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