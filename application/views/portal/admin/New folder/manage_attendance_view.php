<?php
	$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
						<h5 class="m-0 text-dark"> <?php echo $page_title; ?> </h5>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php?admin/dashboard"> Dashboard </a></li>
								<li class="breadcrumb-item active"> Attendance </li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->
		
			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<div class="row">
								<div class="col-lg-4 col-6 m-sm-auto">
									<div class="info-box">
										<div class="info-box-content">
											<span class="info-box-text text-center">
												Attendance for Class
												<span class="text-capitalize">
												<?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name;?>
												</span>
											</span>
											<span class="info-box-text text-center">
												Section
												<span class="text-capitalize">
												<?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name;?>
												</span>
											</span>
											<span class="info-box-text text-center">
												<?php echo date('M d, Y', $timestamp); ?>
											</span>
										</div>
										<!-- /.info-box-content -->
									</div>
									<!-- /.info-box -->
								</div>
								<!-- ./col -->
							</div>
						</div>
						<!-- /.col -->
						<div class="col-12">
							<div class="card card-primary card-outline">
								<form method="post" action="<?php echo base_url(); ?>index.php?admin/attendance_update/<?php echo $class_id.'/'.$section_id.'/'.$timestamp; ?>">
									<div class="card-header">
										<h3 class="card-title">
											<a class="" href="<?php echo base_url(); ?>index.php?admin/manage_attendance/">
												<i class="fas fa-arrow-left"></i>
												Back
											</a>
										</h3>
										<h3 class="card-title float-right">
											<a class="btn btn-primary btn-sm" href="javascript:;" onclick="mark_all_present()">
												<i class="fas fa-check"></i>
												Mark All Present
											</a>
											<a class="btn btn-primary btn-sm" href="javascript:;" onclick="mark_all_absent()">
												<i class="fas fa-times"></i>
												Mark All Absent
											</a>
										</h3>
									</div>
									
									<div class="card-body table-responsive">
										<table id="attendance" class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>ID Number</th>
													<th>Name</th>
													<th>Options</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$count = 1;
													$select_id = 0;
													$attendance_of_students = $this->db->get_where('attendance', array(
														'class_id'		=> $class_id,
														'section_id'	=> $section_id,
														'year'			=> $running_year,
														'timestamp'		=> $timestamp
													))->result_array();
													
													foreach ($attendance_of_students as $row):
												?>
												<tr>
													<td> <?php echo $count++; ?> </td>
													<td>
														<?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->student_code; ?>
													</td>
													<td>
														<?php echo ucwords($this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name); ?>
													</td>
													<td>
														<select name="status_<?php echo $row['attendance_id']; ?>" id="status_<?php echo $select_id; ?>" class="form-control">
															<option value="0" <?php if ($row['status'] == 0) echo 'selected'; ?>> Undefined </option>
															<option value="1" <?php if ($row['status'] == 1) echo 'selected'; ?>> Present </option>
															<option value="2" <?php if ($row['status'] == 2) echo 'selected'; ?>> Absent </option>
														</select>
													</td>
												</tr>
												<?php
													$select_id++;
													endforeach;
												?>
											</tbody>
										</table>
									</div>
									<!-- /.card-body -->
									
									<div class="card-footer text-center">
										<button type="submit" class="btn btn-success">
											<i class="fas fa-check"></i>
											&nbsp; Save Changes &nbsp;
										</button>
									</div>
									<!-- /.card-footer -->
								</form>
							</div>
							<!-- /.card -->
						</div>
						<!-- /.col -->
					</div>
				</div><!--/. container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		
		<!-- page script -->
		<script type="text/javascript">
			$(function () {
				$('#attendance').DataTable({
					"paging": true,
					"lengthChange": false,
					"searching": false,
					"ordering": false,
					"info": true,
					"autoWidth": false,
				});
			});
			
			function mark_all_present() {
				var count = <?php echo count($attendance_of_students); ?>;
				
				for(var i = 0; i < count; i++)
					$('#status_' + i).val("1");
			}
			
			function mark_all_absent() {
				var count = <?php echo count($attendance_of_students); ?>;
				
				for(var i = 0; i < count; i++)
					$('#status_' + i).val("2");
			}
		</script>
