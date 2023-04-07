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
								<li class="breadcrumb-item active">Teacher</li>
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
								<div class="card-header">
									<div class="card-title float-right">
										<a class="btn btn-primary" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_teacher_add/');"  data-toggle="modal">
											<i class="fas fa-plus-circle"></i>
											Add New Teacher
										</a>
									</div>
								</div>
								
								<div class="card-body table-responsive">
									<table id="teacher" class="table table-bordered table-striped projects">
										<thead>
											<tr>
												<th>
													Photo
												</th>
												<th>
													Name
												</th>
												<th>
													Email
												</th>
												<th>
													Options
												</th>
											</tr>
										</thead>
										
										<tbody>
											<?php
												$count = 1;
												$teachers = $this->db->get('teacher')->result_array();
												foreach($teachers as $row):
											?>
											<tr>
												<td>
													<img src="<?php echo get_image_url('teacher', $row['teacher_id']);?>" alt="Avatar" class="table-avatar">
												</td>
												<td>
													<?php echo ucwords($row['name']);?>
												</td>
												<td>
													<?php echo $row['email'];?>
												</td>
												<td>
													<a class="btn btn-primary btn-sm" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_teacher_profile/<?php echo $row['teacher_id'];?>');">
														<i class="fas fa-eye"></i>
														View
													</a>
													<a class="btn btn-info btn-sm" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_teacher_edit/<?php echo $row['teacher_id'];?>');">
														<i class="fas fa-pencil-alt"></i>
														Edit
													</a>
													<a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/teacher/delete/<?php echo $row['teacher_id'];?>');">
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
				$('#teacher').DataTable();
			});
		</script>