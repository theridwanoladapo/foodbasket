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
								<li class="breadcrumb-item active"> Study Material </li>
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
										<a class="btn btn-primary" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_study_material_add/');"  data-toggle="modal">
											<i class="fas fa-plus-circle"></i>
											Add Study Material
										</a>
									</div>
								</div>
									
								<div class="card-body table-responsive">
									<table id="material" class="table table-bordered table-striped projects">
										<thead>
											<tr>
												<th> Date </th>
												<th> Title </th>
												<th> Description </th>
												<th> Class </th>
												<th> Subject </th>
												<th> Options </th>
											</tr>
										</thead>
										
										<tbody>
											<?php
												foreach($study_material_info as $row):
											?>
											<tr>
												<td><?php echo date('d M, Y', $row['timestamp']);?></td>
												<td><?php echo ucwords($row['title']);?></td>
												<td><?php echo ucfirst($row['description']);?></td>
												<td><?php echo ucwords($this->db->get_where('class', array('class_id' => $row['class_id'] ))->row()->name);?></td>
												<td><?php echo ucwords($this->db->get_where('subject', array('subject_id' => $row['subject_id'] ))->row()->name);?></td>
												<td>
													<div class="btn-group">
														<button type="button" class="btn btn-info btn-sm">Action</button>
														<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
															<span class="caret"></span>
															<span class="sr-only">Toggle Dropdown</span>
														</button>
														
														<div class="dropdown-menu" role="menu">
															<a class="dropdown-item" href="<?php echo base_url();?>index.php?admin/download_study_material/<?php echo $row['document_id'];?>">
																<i class="fas fa-download"></i>
																&nbsp; Download
															</a>
															
															<a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_study_material_edit/<?php echo $row['document_id'];?>');">
																<i class="fas fa-pencil-alt"></i>
																&nbsp; Edit
															</a>
															
															<div class="dropdown-divider"></div>
															
															<a class="dropdown-item" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/study_material/delete/<?php echo $row['document_id'];?>');">
																<i class="fas fa-trash"></i>
																&nbsp; Delete
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
				$('#material').DataTable();
			});
		</script>