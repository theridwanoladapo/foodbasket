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
								<li class="breadcrumb-item active">Section</li>
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
										<a class="btn btn-primary" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_section_add/');"  data-toggle="modal">
											<i class="fas fa-plus-circle"></i>
											Add New Section
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
												<a class="nav-link <?php if ($row['class_id'] == $class_id) echo 'active';?>" href="<?php echo base_url(); ?>index.php?admin/section/<?php echo $row['class_id'];?>">
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
														<table id="section" class="table table-bordered table-striped datatable">
															<thead>
																<tr>
																	<th> # </th>
																	<th> Section Name </th>
																	<th> Nick Name </th>
																	<th> Teacher </th>
																	<th> Options </th>
																</tr>
															</thead>
															
															<tbody>
																<?php
																	$count    = 1;
																	$sections = $this->db->get_where('section', array(
																		'class_id' => $class_id
																	))->result_array();
																	foreach ($sections as $row):
																?>
																<tr>
																	<td><?php echo $count++; ?></td>
																	<td><?php echo ucwords($row['name']);?></td>
																	<td><?php echo ucwords($row['nick_name']);?></td>
																	<td>
																		<?php
																			if($row['teacher_id'] != '' || $row['teacher_id'] != 0)
																				echo ucwords(get_type_name_by_id('teacher' ,$row['teacher_id']));
																		?>
																	</td>
																	<td>
																		<a class="btn btn-info btn-sm" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_section_edit/<?php echo $row['section_id']; ?>');">
																			<i class="fas fa-pencil-alt"></i>
																			Edit
																		</a>
																		<a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/sections/delete/<?php echo $row['section_id']; ?>');">
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