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
								<li class="breadcrumb-item active"> Exam </li>
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
												Marks for
												<span class="text-capitalize">
												<?php echo $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name; ?>
												</span>
											</span>
											<span class="info-box-text text-center">
												Class -
												<span class="text-capitalize">
												<?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?>
												</span>
												: Section -
												<span class="text-capitalize">
												<?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name; ?>
												</span>
											</span>
											<span class="info-box-text text-center text-bold">
												Subject : <br>
												<span class="text-capitalize text-break">
												<?php echo $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name; ?>
												</span>
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
								<form method="post" autocomplete="off" action="<?php echo base_url(); ?>index.php?admin/marks_update/<?php echo $exam_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id; ?>">
									<div class="card-header">
										<h3 class="card-title">
											<a class="" href="<?php echo base_url(); ?>index.php?admin/marks_manage/">
												<i class="fas fa-arrow-left"></i>
												Back
											</a>
										</h3>
									</div>
									
									<div class="card-body table-responsive">
										<table id="manage" class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th> # </th>
													<th> ID Number </th>
													<th> Student Name </th>
													<th> Total Mark </th>
													<th> Mark Obtained </th>
													<th> Comment </th>
												</tr>
											</thead>
											<tbody>
												<?php
													$count = 1;
													$marks_of_students = $this->db->get_where('mark', array(
														'class_id' => $class_id, 
														'section_id' => $section_id ,
														'year' => $running_year,
														'subject_id' => $subject_id,
														'exam_id' => $exam_id
													))->result_array();
													
													foreach ($marks_of_students as $row):
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
														<input type="text" class="form-control" name="mark_total_<?php echo $row['mark_id'];?>"
														value="<?php echo $row['mark_total'];?>">
													</td>
													<td>
														<input type="text" class="form-control" name="marks_obtained_<?php echo $row['mark_id'];?>"
														value="<?php echo $row['mark_obtained'];?>">
													</td>
													<td>
														<input type="text" class="form-control text-capitalize" name="comment_<?php echo $row['mark_id'];?>"
														value="<?php echo $row['comment'];?>">
													</td>
												</tr>
												<?php
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
				$('#manage').DataTable({
					"paging": true,
					"lengthChange": false,
					"searching": false,
					"ordering": false,
					"info": true,
					"autoWidth": false,
				});
			});
		</script>
