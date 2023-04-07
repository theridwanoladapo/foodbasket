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
								<li class="breadcrumb-item active"> Subject </li>
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
										<a class="btn btn-primary" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_subject_add/');"  data-toggle="modal">
											<i class="fas fa-plus-circle"></i>
											Add New Subject
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
												<a class="nav-link <?php if ($row['class_id'] == $class_id) echo 'active';?>" href="<?php echo base_url(); ?>index.php?admin/subject/<?php echo $row['class_id'];?>">
													<i class="fas fa-dot-circle"></i> &nbsp; Class <?php echo ucwords($row['name']);?>
												</a>
												<?php
													endforeach;
												?>
											</div>
										</div>
										
										<div class="col-7 col-sm-9">
											<div class="tab-content" id="section-tabContent">
												<?php require 'subjects.php';?>
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
		