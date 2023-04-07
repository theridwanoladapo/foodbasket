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
								<li class="breadcrumb-item active"> Academic Syllabus </li>
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
										<a class="btn btn-primary" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/academic_syllabus_add/');"  data-toggle="modal">
											<i class="fas fa-plus-circle"></i>
											Add Academic Syllabus
										</a>
									</h3>
								</div>
								
								<div class="card-body">
									<div class="row">
										<div class="col-5 col-sm-3">
											<div class="nav flex-column nav-tabs h-100" id="section-tab" role="tablist" aria-orientation="vertical">
												<?php 
													$classes = $this->db->get('class')->result_array();
													foreach ($classes as $row):
												?>
												<a class="nav-link <?php if ($row['class_id'] == $class_id) echo 'active';?>" href="<?php echo base_url(); ?>index.php?admin/academic_syllabus/<?php echo $row['class_id'];?>">
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
													<div class="table-responsive mt-3">
														<table id="section" class="table table-bordered table-striped">
															<thead>
																<tr>
																	<th> # </th>
																	<th> Title </th>
																	<th> Description </th>
																	<th> Subject </th>
																	<th> Uploader </th>
																	<th> Date </th>
																	<th> File </th>
																	<th> Options </th>
																</tr>
															</thead>
															
															<tbody>
																<?php
																	$count    = 1;
																	$syllabus = $this->db->get_where('academic_syllabus', array(
																		'class_id' => $class_id
																	))->result_array();
																	foreach ($syllabus as $row):
																?>
																<tr>
																	<td><?php echo $count++; ?></td>
																	<td><?php echo ucwords($row['title']);?></td>
																	<td><?php echo ucwords($row['description']);?></td>
																	<td>
																		<?php
																		echo ucwords($this->db->get_where('subject', array(
																		'subject_id' => $row['subject_id']
																		))->row()->name);
																		?>
																	</td>
																	<td>
																		<?php
																		echo ucwords($this->db->get_where($row['uploader_type'], array(
																		$row['uploader_type'].'_id' => $row['uploader_id']
																		))->row()->name);
																		?>
																	</td>
																	<td><?php echo date("m/d/Y" , $row['timestamp']);?></td>
																	<td>
																		<?php echo substr($row['file_name'], 0, 20);?>
																		<?php if(strlen($row['file_name']) > 20) echo '...';?>
																	</td>
																	<td>
																		<div class="btn-group btn-group-sm">
																			<a href="<?php echo base_url();?>index.php?admin/download_academic_syllabus/<?php echo $row['academic_syllabus_code'];?>" class="btn btn-info"><i class="fas fa-download"></i></a>
																			<a href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/delete_academic_syllabus/<?php echo $row['academic_syllabus_code'];?>')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
																		</div>
																	</td>
																</tr>
																<?php
																	endforeach;
																?>
															</tbody>
														</table>
													</div>
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