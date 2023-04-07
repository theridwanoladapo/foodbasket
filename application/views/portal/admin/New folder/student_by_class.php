<hr>
<?php
	$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
?>
			<div class="card card-primary card-outline">
				<div class="card-body">
				
				<div id="tabs">
				
					<ul class="nav nav-tabs">
						<li class="nav-item">
							<a class="nav-link active" href="#home" data-toggle="pill" role="tab" aria-selected="true">
								&nbsp; All Students
							</a>
						</li>
						<?php 
							$sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
							foreach ($sections as $row):
						?>
						<li class="nav-item">
							<a class="nav-link" href="#tabs-<?php echo $row['section_id'];?>" data-toggle="pill" role="tab" aria-selected="false">
								Section <?php echo $row['name'];?> (<?php echo $row['nick_name'];?>)
							</a>
						</li>
						<?php
							endforeach;
						?>
					</ul>
					
					<div class="tab-pane" id="home">
						<div class="card-body table-responsive pl-0 pr-0">
							<table id="students" class="table table-bordered table-striped projects">
								<thead>
									<tr>
										<th>ID Number</th>
										<th>Photo</th>
										<th>Name</th>
										<th>Email</th>
										<th>Options</th>
									</tr>
								</thead>
								
								<tbody>
									<?php
										$students   =   $this->db->get_where('enroll' , array(
														'class_id' => $class_id,
														'year' => $running_year
														))->result_array();
										foreach($students as $row):
									?>
									<tr>
										<td>
										<?php
											echo $this->db->get_where('student' , array(
												'student_id' => $row['student_id']
												))->row()->student_code;
										?>
										</td>
										<td><img src="<?php echo get_image_url('student', $row['student_id']);?>" alt="Avatar" class="table-avatar"></td>
										<td>
										<?php
											echo ucwords($this->db->get_where('student' , array(
												'student_id' => $row['student_id']
												))->row()->name);
										?>
										</td>
										<td>
										<?php
											echo $this->db->get_where('student' , array(
												'student_id' => $row['student_id']
												))->row()->email;
										?>
										</td>
										<td>
											<div class="btn-group">
												<button type="button" class="btn btn-info btn-sm">Action</button>
												<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												
												<div class="dropdown-menu" role="menu">
													<a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_marksheet/<?php echo $row['student_id'];?>');">
														<i class="fas fa-chart-bar"></i> &nbsp; Mark Sheet
													</a>
													
													<a class="dropdown-item" href="<?php echo base_url();?>index.php?admin/student_profile/<?php echo $row['student_id'];?>">
														<i class="fas fa-user"></i> &nbsp; Profile
													</a>
													
													<a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_edit/<?php echo $row['student_id'];?>');">
														<i class="fas fa-pencil-alt"></i> &nbsp; Edit
													</a>
													
													<div class="dropdown-divider"></div>
													
													<a class="dropdown-item" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/delete_student/<?php echo $row['student_id'];?>/<?php echo $class_id;?>');">
														<i class="fas fa-trash"></i> &nbsp; Delete
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
					<!-- /#home -->
						
					<?php 
						$sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
						foreach ($sections as $row):
					?>
					<div class="tab-pane" id="tabs-<?php echo $row['section_id'];?>">
						<div class="card-body table-responsive pl-0 pr-0">
							<table id="table-<?php echo $row['section_id'];?>" class="table table-bordered table-striped projects">
								<thead>
									<tr>
										<th>ID Number</th>
										<th>Photo</th>
										<th>Name</th>
										<th>Email</th>
										<th>Options</th>
									</tr>
								</thead>
								
								<tbody>
									<?php
										$students = $this->db->get_where('enroll', array(
														'class_id' => $class_id,
														'section_id' => $row['section_id'],
														'year' => $running_year
														))->result_array();
										foreach($students as $row):
									?>
									<tr>
										<td>
										<?php
											echo $this->db->get_where('student' , array(
												'student_id' => $row['student_id']
												))->row()->student_code;
										?>
										</td>
										<td><img src="<?php echo get_image_url('student', $row['student_id']);?>" alt="Avatar" class="table-avatar"></td>
										<td>
										<?php
											echo ucwords($this->db->get_where('student' , array(
												'student_id' => $row['student_id']
												))->row()->name);
										?>
										</td>
										<td>
										<?php
											echo $this->db->get_where('student' , array(
												'student_id' => $row['student_id']
												))->row()->email;
										?>
										</td>
										<td>
											<div class="btn-group">
												<button type="button" class="btn btn-info btn-sm">Action</button>
												<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												
												<div class="dropdown-menu" role="menu">
													<a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_marksheet/<?php echo $row['student_id'];?>');">
														<i class="fas fa-chart-bar"></i> &nbsp; Mark Sheet
													</a>
													
													<a class="dropdown-item" href="<?php echo base_url();?>index.php?admin/student_profile/<?php echo $row['student_id'];?>">
														<i class="fas fa-user"></i> &nbsp; Profile
													</a>
													
													<a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_edit/<?php echo $row['student_id'];?>');">
														<i class="fas fa-pencil-alt"></i> &nbsp; Edit
													</a>
													
													<div class="dropdown-divider"></div>
													
													<a class="dropdown-item" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/delete_student/<?php echo $row['student_id'];?>/<?php echo $class_id;?>');">
														<i class="fas fa-trash"></i> &nbsp; Delete
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
					<?php
						endforeach;
					?>
					
				</div>
				
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
			
			<!-- page script -->
			<script type="text/javascript">
				// Tabs
				$("#tabs").tabs();
				
				$(function () {
					// Initialize DataTable Elements
					$('#students').DataTable();
					
				<?php 
					$sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
					foreach ($sections as $row):
				?>
					$('#table-<?php echo $row['section_id'];?>').DataTable({
						"paging": true,
						"lengthChange": false,
						"searching": false,
						"ordering": true,
						"info": true,
						"autoWidth": false
					});
				<?php
					endforeach;
				?>
				
				});
			</script>