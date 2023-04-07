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
								<li class="breadcrumb-item active"> Settings </li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			
			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">System Settings</h3>
								</div>
								
								<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/system_settings/do_update">
								<div class="card-body">
									<div class="form-group row">
										<label for="inputName" class="col-sm-4 control-label"> &nbsp; System Name </label>
										<div class="col-sm-8">
											<input type="text" name="system_name" value="<?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;?>" class="form-control text-capitalize" id="inputName" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="inputTitle" class="col-sm-4 control-label"> &nbsp; System Title </label>
										<div class="col-sm-8">
											<input type="text" name="system_title" value="<?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;?>" class="form-control text-capitalize" id="inputTitle" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="inputAdd" class="col-sm-4 control-label"> &nbsp; Address </label>
										<div class="col-sm-8">
											<textarea class="form-control text-capitalize" name="address" id="inputAdd" required><?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description;?></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label for="inputPhone" class="col-sm-4 control-label"> &nbsp; Phone </label>
										<div class="col-sm-8">
											<input type="text" name="phone" value="<?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description;?>" class="form-control" id="inputPhone" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="inputEmail" class="col-sm-4 control-label"> &nbsp; System Email </label>
										<div class="col-sm-8">
											<input type="text" name="system_email" value="<?php echo $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;?>" class="form-control" id="inputEmail" required>
										</div>
									</div>
									<div class="form-group row">
										<div class="offset-sm-4 col-sm-8">
											<button type="submit" class="btn btn-primary"> &nbsp; Save &nbsp; </button>
										</div>
									</div>
								</div>
								<!-- /.card-body -->
								</form>
							</div>
							<!-- /.card -->
						</div>
													
						<div class="col-md-6">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Upload Logo</h3>
								</div>
								
								<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/system_settings/upload_logo" enctype="multipart/form-data">
								<div class="card-body">
									<div class="form-group row">
										<label for="inputPhoto" class="col-sm-4 control-label"> &nbsp; Photo </label>
										<div class="col-sm-8">
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="fileinput-new thumbnail" style="width: 120px; height: 120px;"
												data-trigger="fileinput">
													<img src="uploads/logo.png" alt="...">
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
											<button type="submit" class="btn btn-primary"> &nbsp; Upload &nbsp; </button>
										</div>
									</div>
								</div>
								<!-- /.card-body -->
								</form>
							</div>
							<!-- /.card -->
							
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Change Session</h3>
								</div>
								
								<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/system_settings/change_session" enctype="multipart/form-data">
								<div class="card-body">
									<div class="form-group row">
										<label for="inputSess" class="col-sm-4 control-label"> &nbsp; Running Session </label>
										<div class="col-sm-8">
										<?php
											$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
										?>
											<select name="running_year" class="form-control select2">
												<option value="" disabled="true">Select Running Session</option>
												<?php for($i = 0; $i < 10; $i++):?>
												<option value="<?php echo (2019+$i);?>-<?php echo (2019+$i+1);?>"
												<?php if($running_year == (2019+$i).'-'.(2019+$i+1)) echo 'selected';?>>
													<?php echo (2019+$i);?>-<?php echo (2019+$i+1);?>
												</option>
												<?php endfor;?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<div class="offset-sm-4 col-sm-8">
											<button type="submit" class="btn btn-primary"> &nbsp; Change Session &nbsp; </button>
										</div>
									</div>
								</div>
								<!-- /.card-body -->
								</form>
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
				// Initialize Select2 Elements
				$('.select2').select2({
					theme: 'bootstrap4',
					minimumResultsForSearch: -1
				})
			});
		</script>
		