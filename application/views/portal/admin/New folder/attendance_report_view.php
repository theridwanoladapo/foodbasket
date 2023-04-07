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
											<?php
											$section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
											$class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
											if ($month == 1)	$m = 'january';
											else if ($month == 2)	$m = 'february';
											else if ($month == 3)	$m = 'march';
											else if ($month == 4)	$m = 'april';
											else if ($month == 5)	$m = 'may';
											else if ($month == 6)	$m = 'june';
											else if ($month == 7)	$m = 'july';
											else if ($month == 8)	$m = 'august';
											else if ($month == 9)	$m = 'september';
											else if ($month == 10)	$m = 'october';
											else if ($month == 11)	$m = 'november';
											else if ($month == 12)	$m = 'december';
											?>
											<span class="info-box-text text-center lead">
												Attendance Sheet
											</span>
											<span class="info-box-text text-center">
												Class
												<?php echo ucwords($this->db->get_where('class', array('class_id' => $class_id))->row()->name); ?>
												 : Section
												<?php echo ucwords($this->db->get_where('section', array('section_id' => $section_id))->row()->name); ?>
											</span>
											<span class="info-box-text text-center">
												<?php echo ucwords($m.', '.$sessional_year); ?>
											</span>
										</div>
										<!-- /.info-box-content -->
										<span class="info-box-icon bg-primary"><i class="fas fa-users fa-lg"></i></span>
									</div>
									<!-- /.info-box -->
								</div>
								<!-- ./col -->
							</div>
						</div>
						<!-- /.col -->
						<div class="col-12">
							<div class="card card-primary card-outline">
								<div class="card-header">
									<h3 class="card-title">
										<a class="" href="<?php echo base_url(); ?>index.php?admin/attendance_report/">
											<i class="fas fa-arrow-left"></i>
											Back
										</a>
									</h3>
								</div>
								
								<div class="card-body table-responsive pr-2">
									<table id="attendance" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th style="min-width:250px;">
												Students <i class="fas fa-long-arrow-alt-down"></i>
												 | Date <i class="fas fa-long-arrow-alt-right"></i>
												</th>
												<?php
													$year = explode('-', $running_year);
													$days = cal_days_in_month(CAL_GREGORIAN, $month, $sessional_year);
													
													for ($i = 1; $i <= $days; $i++) {
												?>
												<th><?php echo $i; ?></th>
												<?php
													}
												?>
											</tr>
										</thead>
										<tbody>
											<?php
												$data = array();
												$students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();
												foreach ($students as $row):
											?>
											<tr>
												<td style="min-width:250px;">
													<?php echo ucwords($this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name); ?>
												</td>
												<?php
													$status = 0;
													for ($i = 1; $i <= $days; $i++):
														$timestamp = strtotime($i.'-'.$month.'-'.$sessional_year);
														$groupby = array('timestamp');
														$where = array(
															'section_id' => $section_id,
															'class_id' => $class_id,
															'year' => $running_year,
															'timestamp' => $timestamp,
															'student_id' => $row['student_id']
														);
														$attendance = $this->db->get_where('attendance', $where, $groupby)->result_array();
														
														
														foreach ($attendance as $row1):
															$month_d = date('d', $row1['timestamp']);
															if ($i == $month_d)
																$status = $row1['status'];
														endforeach;
												?>
												<td>
													<?php if ($status == 1) { ?>
													<i class="fas fa-circle text-success"></i>
													<?php  } if($status == 2)  { ?>
													<i class="fas fa-circle text-danger"></i>
													<?php  } $status = 0;?>
												</td>
												<?php endfor; ?>
											</tr>
											<?php
												endforeach;
											?>
										</tbody>
									</table>
								</div>
								<!-- /.card-body -->
								
								<div class="card-footer text-center">
									<a href="" class="btn btn-primary">
										&nbsp; Print Attendance Sheet &nbsp;
									</a>
								</div>
								<!-- /.card-footer -->
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
				var count = 12 <?php //echo count($attendance_of_students); ?>;
				
				for(var i = 0; i < count; i++)
					$('#status_' + i).val("1");
			}
			
			function mark_all_absent() {
				var count = 12 <?php //echo count($attendance_of_students); ?>;
				
				for(var i = 0; i < count; i++)
					$('#status_' + i).val("2");
			}
		</script>
