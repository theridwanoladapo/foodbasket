<?php
	$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
?>
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
							<li class="breadcrumb-item active"> Class Routine </li>
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
								<h3 class="card-title float-right">
									<a class="btn btn-primary" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/class_routine_add/');"  data-toggle="modal">
										<i class="fas fa-plus-circle"></i>
										Add Class Routine
									</a>
								</h3>
							</div>
							
							<div class="card-body">
								<div class="row">
									<div class="col-4 col-sm-3">
										<div class="nav flex-column nav-tabs h-100" id="section-tab" role="tablist" aria-orientation="vertical">
											<?php 
												$classes = $this->db->get('class')->result_array();
												foreach ($classes as $row):
											?>
											<a class="nav-link <?php if ($row['class_id'] == $class_id) echo 'active';?>" href="<?php echo base_url(); ?>index.php?admin/class_routine_view/<?php echo $row['class_id'];?>">
												<i class="fas fa-dot-circle"></i> &nbsp; Class <?php echo ucwords($row['name']);?>
											</a>
											<?php
												endforeach;
											?>
										</div>
									</div>
									
									<div class="col-7 col-sm-9">
										<div class="tab-content" id="section-tabContent">
											<div class="tab-pane fade show active">
												<!-- .routine-card -->
												<?php
													$query = $this->db->get_where('section' , array('class_id' => $class_id));
													if($query->num_rows() > 0):
														$sections = $query->result_array();
														foreach($sections as $row):
												?>
												<div class="card card-primary card-outline">
													<div class="card-header">
														<div class="card-title">
															Class - 
															<span class="text-capitalize">
																<?php echo $this->db->get_where('class',
																array('class_id' => $class_id))->row()->name;?> 
															</span>
															: Section - 
															<span class="text-capitalize">
																<?php echo $row['name'];?>
																<?php echo '('.$row['nick_name'].')';?>
															</span>
														</div>
													</div>
													
													<div class="card-body table-responsive p-0">
														<table class="table table-bordered">
															<tbody>
																<?php 
																	for($d = 1; $d <= 7; $d++):
																	
																		if($d == 1)	$day = 'sunday';
																		else if($d == 2)	$day = 'monday';
																		else if($d == 3)	$day = 'tuesday';
																		else if($d == 4)	$day = 'wednesday';
																		else if($d == 5)	$day = 'thursday';
																		else if($d == 6)	$day = 'friday';
																		else if($d == 7)	$day = 'saturday';
																?>
																<tr>
																	<td style="width:10%;"><?php echo strtoupper($day); ?></td>
																	<td>
																	<?php
																		$order_by = array('time_start', 'ASC');
																		$where = array('day' => $day,
																			'class_id' => $class_id,
																			'section_id' => $row['section_id'],
																			'year' => $running_year
																		);
																		$routines = $this->db->get_where('class_routine', $where, $order_by)->result_array();
																		foreach($routines as $row2):
																	?>
																		<div class="btn-group mb-1">
																			<button type="button" class="btn btn-primary btn-sm">
																			<?php
																				echo ucwords(get_subject_name_by_id($row2['subject_id']));
																				
																				if($row2['time_start'] > 12){
																					$time_start = ($row2['time_start'] - 12).':'
																					.$row2['time_start_min'].' PM';
																				}else{
																					$time_start = $row2['time_start'].':'
																					.$row2['time_start_min'].' AM';
																				}
																				if($row2['time_end'] > 12){
																					$time_end = ($row2['time_end'] - 12).':'
																					.$row2['time_end_min'].' PM';
																				}else{
																					$time_end = $row2['time_end'].':'
																					.$row2['time_end_min'].' AM';
																				}
																				
																				echo ' ('.$time_start.' - '.$time_end.')';
																			?>
																			</button>
																			<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
																				<span class="caret"></span>
																				<span class="sr-only">Toggle Dropdown</span>
																			</button>
																			
																			<div class="dropdown-menu" role="menu">
																				<a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_class_routine/<?php echo $row2['class_routine_id'];?>');">
																					<i class="fas fa-pencil-alt"></i> &nbsp; Edit
																				</a>
																				
																				<div class="dropdown-divider"></div>
																				
																				<a class="dropdown-item" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/class_routine/delete/<?php echo $row2['class_routine_id'];?>');">
																					<i class="fas fa-trash"></i> &nbsp; Delete
																				</a>
																			</div>
																		</div>
																	<?php
																		endforeach;
																	?>
																	</td>
																</tr>
																<?php
																	endfor;
																?>
															</tbody>
														</table>
													</div>
												</div>
												<?php
														endforeach;
													endif;
												?>
												<!-- /.routine-card -->
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
			$('#section').DataTable({
				"paging": false,
				"lengthChange": false,
				"searching": false,
				"ordering": false,
				"info": false,
				"autoWidth": true
			});
		});
	</script>