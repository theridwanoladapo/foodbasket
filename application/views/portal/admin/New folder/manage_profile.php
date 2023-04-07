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
								<li class="breadcrumb-item active"> Manage Account </li>
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
								<div class="card-body">
									<ul class="nav nav-tabs" id="profile-tab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="edit-profile-tab" data-toggle="pill" href="#edit-profile" role="tab" aria-controls="edit-profile" aria-selected="true">
											<i class="fa fa-user"></i> &nbsp; Manage Profile
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="chng-pass-tab" data-toggle="pill" href="#chng-pass" role="tab" aria-controls="chng-pass" aria-selected="false">
											<i class="fa fa-lock"></i> &nbsp; Change Password
											</a>
										</li>
									</ul>
									
									<div class="tab-content" id="profile-tabContent">
										<div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
											<div class="row">
												<div class="col-lg-8">
													<?php
														$profile = $edit_data;
														foreach($profile as $row):
													?>
													<!-- form start -->
													<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/manage_profile/update_profile_info" enctype="multipart/form-data">
														<div class="card-body">
															<div class="form-group row">
																<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
																<div class="col-sm-8">
																	<input type="text" name="name" value="<?php echo $row['name']?>" class="form-control text-capitalize" id="inputName" autofocus required>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputEmail" class="col-sm-4 control-label"> &nbsp; Email </label>
																<div class="col-sm-8">
																	<input type="email" name="email" value="<?php echo $row['email']?>" class="form-control" id="inputEmail">
																</div>
															</div>
															<div class="form-group row">
																<label for="inputPhoto" class="col-sm-4 control-label"> &nbsp; Photo </label>
																<div class="col-sm-8">
																	<div class="fileinput fileinput-new" data-provides="fileinput">
																		<div class="fileinput-new thumbnail" style="width: 120px; height: 120px;"
																		data-trigger="fileinput">
																			<img src="<?php echo $this->crud_model->get_image_url('admin', $row['admin_id']);?>" alt="...">
																		</div>
																		<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px;
																		max-height: 150px"></div>
																		<div>
																			<span class="btn btn-primary btn-file btn-sm">
																				<span class="fileinput-new">Select image</span>
																				<span class="fileinput-exists">Change</span>
																				<input type="file" name="photo" accept="image/*">
																			</span>
																			<a href="#" class="btn btn-danger btn-sm fileinput-exists" data-dismiss="fileinput">
																				Remove
																			</a>
																		</div>
																	</div>
																</div>
															</div>
															<div class="form-group row">
																<div class="offset-sm-4 col-sm-8">
																	<button type="submit" class="btn btn-primary"> &nbsp; Update Profile &nbsp; </button>
																</div>
															</div>
														</div>
														<!-- /.card-body -->
													</form>
													<?php
														endforeach;
													?>
												</div>
											</div>
										</div>
										
										<div class="tab-pane fade" id="chng-pass" role="tabpanel" aria-labelledby="chng-pass-tab">
											<div class="row">
												<div class="col-lg-8">
													<!-- form start -->
													<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/manage_profile/change_password">
														<div class="card-body">
															<div class="form-group row">
																<label for="inputCP" class="col-sm-4 control-label"> &nbsp; Current Password </label>
																<div class="col-sm-8">
																	<input type="password" name="password" class="form-control" id="inputCP" required>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputNP" class="col-sm-4 control-label"> &nbsp; New Password </label>
																<div class="col-sm-8">
																	<input type="password" name="new_password" class="form-control" id="inputNP" required>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputCNP" class="col-sm-4 control-label"> &nbsp; Confirm New Password </label>
																<div class="col-sm-8">
																	<input type="password" name="cnew_password" class="form-control" id="inputCNP" required>
																</div>
															</div>
															<div class="form-group row">
																<div class="offset-sm-4 col-sm-8">
																	<button type="submit" class="btn btn-primary"> &nbsp; Change Password &nbsp; </button>
																</div>
															</div>
														</div>
														<!-- /.card-body -->
													</form>
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
				$('#class').DataTable();
				
				// Initialize Select2 Elements
				$('.select2').select2({
					theme: 'bootstrap4'
				})
			});
		</script>