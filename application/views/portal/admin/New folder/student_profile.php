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
								<li class="breadcrumb-item active"> Student </li>
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
					<?php
						$student_info = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
						foreach ($student_info as $row):
							$enroll_info = $this->db->get_where('enroll', array(
							  'student_id' => $row['student_id'], 'year' => $running_year
							))->row();
							$class_id = $enroll_info->class_id;
							$section_id = $enroll_info->section_id;
							$class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
							$section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
					?>
						<div class="col-md-4">
							<!-- Profile Image -->
							<div class="card card-primary card-outline">
								<div class="card-body box-profile">
									<div class="text-center">
										<img class="profile-user-img img-fluid img-circle"
										src="<?php echo get_image_url('student', $student_id)?>"
										alt="User profile picture">
									</div>
									
									<h3 class="profile-username text-center"><?php echo ucwords($row['name']); ?></h3>
									<p class="text-muted text-center">
										<?php echo 'Class'.' - '.$class_name.' | '. 'Section'.' - '.$section_name; ?>
									</p>
									
									<!--ul class="list-group list-group-unbordered mb-3">
										<li class="list-group-item">
											<b>Class</b> <a class="float-right"><?php //echo $class_name; ?></a>
										</li>
										<li class="list-group-item">
											<b>Section</b> <a class="float-right"><?php //echo $section_name; ?></a>
										</li>
									</ul>
									
									<a class="btn btn-primary btn-block"
									href="<?php //echo base_url();?>index.php?admin/student_information/">
										<b> Student Information </b>
									</a-->
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<!-- /.col -->
						
						<div class="col-md-8">
							<div class="card">
								<div class="card-header p-2">
									<ul class="nav nav-pills">
										<li class="nav-item">
											<a class="nav-link active" href="#basic_info" data-toggle="tab"> Basic Info </a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#parent_info" data-toggle="tab"> Parent Info </a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#exam_marks" data-toggle="tab"> Exam Marks </a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#payments" data-toggle="tab"> Payments </a>
										</li>
									</ul>
								</div>
								<!-- /.card-header -->
								
								<div class="card-body">
									<div class="tab-content">
										<div class="active tab-pane" id="basic_info">
											<?php
												$basic_info_titles = array(
													'name','parent', 'class', 'section',
													'email', 'phone', 'address', 'gender', 'birthday'
												);
												$basic_info_values = array(
													ucwords($row['name']),
													$row['parent_id'] == NULL ? '' : ucwords($this->db->get_where('parent',
													array('parent_id' => $row['parent_id']))->row()->name),
													$class_name, $section_name, $row['email'],
													$row['phone'] == NULL ? '' : $row['phone'],
													$row['address'] == NULL ? '' : ucwords($row['address']),
													$row['gender'] == NULL ? '' : ucwords($row['gender']),$row['birthday']
												);
											?>
											<table class="table table-bordered">
												<tbody>
												<?php
													for($i = 0; $i < count($basic_info_titles); $i++):
												?>
													<tr>
														<td>
															<strong><?php echo ucfirst($basic_info_titles[$i]); ?></strong>
														</td>
														<td>
															<?php echo $basic_info_values[$i]; ?>
														</td>
													</tr>
												<?php
													endfor;
												?>
												</tbody>
											</table>
										</div>
										<!-- /.tab-pane -->
										
										<div class="tab-pane" id="parent_info">
											<?php
												if($row['parent_id'] == NULL):
											?>
											<div style="margin-top: 20px;">
												<center>
													<?php echo 'Parent Information is not Available'; ?>
												</center>
											</div>
											<?php
												else:
													$parent_info = $this->db->get_where('parent',
														array('parent_id' => $row['parent_id']))->result_array();
													$parent_info_titles = array('name', 'email', 'phone', 'address', 'profession');
													
													foreach($parent_info as $info):
														$parent_info_values = array(
															ucwords($info['name']), $info['email'],
															$info['phone'] == NULL ? '' : $info['phone'],
															$info['address'] == NULL ? '' : ucwords($info['address']),
															$info['profession'] == NULL ? '' : ucwords($info['profession'])
														);
													endforeach;
												endif;
											?>
											<table class="table table-bordered">
												<tbody>
												<?php
													for($i = 0; $i < count($parent_info_titles); $i++):
												?>
													<tr>
														<td>
															<strong><?php echo ucfirst($parent_info_titles[$i]); ?></strong>
														</td>
														<td>
															<?php echo $parent_info_values[$i]; ?>
														</td>
													</tr>
												<?php
													endfor;
												?>
												</tbody>
											</table>
										</div>
										<!-- /.tab-pane -->
										
										<div class="tab-pane" id="exam_marks">
										<?php
											$exams = $this->db->get_where('exam', array('year' => $running_year))->result_array();
											foreach($exams as $exam): 
										?>
										<div id="marksheet<?php echo $exam['exam_id'];?>">
											<div class="card card-primary">
												<div class="card-header">
													<h5><?php echo ucwords($exam['name']);?></h5>
												</div>
												<div class="card-body p-0">
													<table class="table table-bordered table-striped">
														<thead>
															<tr>
																<th style="width:30%;"> Subject </th>
																<th> Total Mark </th>
																<th> Obtained Mark </th>
																<th> Grade </th>
																<th> Comment </th>
															</tr>
														</thead>
														<tbody>
														<?php
															$total_marks = 0;
															$total_grade_point = 0;
															$total_subjects = 0;
															$sql = 'SELECT * FROM `subject` WHERE'.
																	' `class_id` = "'.$class_id.
																	'" AND `year` = "'.$running_year.
																	'" AND (`section_id` = "'.$section_id.'" OR `section_id` = 0)';
															
															$subjects = $this->db->query($sql)->result_array();
															foreach($subjects as $sub):
														?>
															<tr>
																<td><?php echo ucwords($sub['name']);?></td>
																<td>
																	100
																</td>
																<?php
																	$obtained_mark = $this->db->get_where('mark', array(
																	'subject_id' => $sub['subject_id'], 'exam_id' => $exam['exam_id'],
																	'class_id' => $class_id, 'student_id' => $student_id,
																	'year' => $running_year));
																	
																	$marks = $obtained_mark->result_array();
																?>
																<td>
																<?php
																	if($obtained_mark->num_rows() > 0):
																		foreach($marks as $mark):
																			echo $mark['mark_obtained'];
																			$total_marks += $mark['mark_obtained'];
																			$total_subjects++;
																		endforeach;
																	endif;
																?>
																</td>
																<td>
																<?php
																	if($obtained_mark->num_rows() > 0):
																		foreach($marks as $mark):
																			$grade = get_grade($mark['mark_obtained']);
																			echo ucwords($grade['name']);
																			$total_grade_point += $grade['grade_point'];
																		endforeach;
																	endif;
																?>
																</td>
																<td>
																<?php
																	if($obtained_mark->num_rows() > 0):
																		foreach($marks as $mark):
																			echo ucwords($mark['comment']);
																		endforeach;
																	endif;
																?>
																</td>
																<?php
																?>
															</tr>
														<?php
															endforeach;
														?>
														</tbody>
														<tfoot>
															<tr>
																<th colspan="4" class="text-right"> Total Marks </th>
																<td> <?php echo $total_marks?> </td>
															</tr>
															<tr>
																<th colspan="4" class="text-right"> Average Grade Point </th>
																<td>
																<?php
																	if($total_grade_point != 0 && $total_subjects != 0)
																		echo round($total_grade_point / $total_subjects, 2);
																?>
																</td>
															</tr>
														</tfoot>
													</table>
												</div>
											</div>
											
											<!-- this row will not appear when printing -->
											<div class="row no-print mb-4">
												<div class="col-12">
													<a href="javascript:;" onClick="PrintElem('#marksheet<?php echo $exam['exam_id'];?>')" class="btn btn-primary">
														<i class="fas fa-print"></i> Print Marksheet
													</a>
												</div>
											</div>
										</div>
										<hr>
										<?php
											endforeach;
										?>
										</div>
										<!-- /.tab-pane -->
										
										<div class="tab-pane" id="payments">
											<div class="table-responsive pl-0 pr-0">
												<table id="payment_tab" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th> # </th>
															<th> Title </th>
															<th> Amount </th>
															<th> Date </th>
															<th>&nbsp;</th>
														</tr>
													</thead>
													
													<tbody>
														<?php
															$count = 1;
															$where = array('student_id' => $row['student_id'], 'year' => $running_year);
															$orderby = array('timestamp' => 'DESC');
															$invoices = $this->db->get_where('payment', $where, $orderby)->result_array();
															foreach($invoices as $row2):
														?>
														<tr>
															<td><?php echo $count++;?></td>
															<td><?php echo ucwords($row2['title']); ?></td>
															<td><?php echo $row2['amount']; ?></td>
															<td><?php echo date('m/d/Y', $row2['timestamp']); ?></td>
															<td>
																<a class="btn btn-info btn-sm" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $row2['invoice_id'];?>');">
																	<i class="fas fa-eye"></i> &nbsp; View Invoice
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
										<!-- /.tab-pane -->
										
									</div>
									<!-- /.tab-content -->
								</div>
								<!-- /.card-body -->
							</div>
						<!-- /.nav-tabs-custom -->
						</div>
						<!-- /.col -->
					<?php
						endforeach;
					?>						
					</div>
					<!-- /.row -->
				</div><!--/. container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		
		<!-- page script -->
		<script type="text/javascript">
			$(function () {
				// Initialize DataTable Elements
				$('#payment_tab').DataTable({
					"paging": true,
					"lengthChange": false,
					"searching": false,
					"ordering": true,
					"info": true,
					"autoWidth": false
				});
			});
		</script>
		
		<script type="text/javascript">
		
			// print function
			function PrintElem(elem)
			{
				Popup($(elem).html());
			}
		
			function Popup(data)
			{
				var mywindow = window.open('', 'invoice', 'height=400,width=600');
				mywindow.document.write('<html><head><title>Invoice</title>');
				mywindow.document.write('<link rel="stylesheet" href="dist/css/raw.css">');
				mywindow.document.write('<link rel="stylesheet" href="plugins/fontawesome-free/css/all.css">');
				mywindow.document.write('</head><body >');
				mywindow.document.write(data);
				mywindow.document.write('</body></html>');
		
				var is_chrome = Boolean(mywindow.chrome);
				if (is_chrome) {
					setTimeout(function() {
						mywindow.print();
						mywindow.close();
		
						return true;
					}, 250);
				}
				else {
					mywindow.print();
					mywindow.close();
		
					return true;
				}
		
				return true;
			}
		
		</script>