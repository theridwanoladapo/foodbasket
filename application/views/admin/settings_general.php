<div class="app-main" id="main">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin row -->
		<div class="row">
			<div class="col-md-12 m-b-30">
				<!-- begin page title -->
				<div class="d-block d-lg-flex flex-nowrap align-items-center">
					<div class="mr-3">
						<a href="<?php echo base_url().'?admin/settings';?>" class="btn btn-inverse-primary btn-sm btn-icon">
							<i class="fa fa-arrow-left"></i>
						</a>
					</div>
					<div class="page-title mr-4 pr-4 border-right">
						<h1>Settings</h1>
					</div>
					<div class="breadcrumb-bar align-items-center">
						<nav>
							<ol class="breadcrumb p-0 m-b-0">
								<li class="breadcrumb-item">
									<a href><i class="ti ti-home"></i></a>
								</li>
								<li class="breadcrumb-item">Settings</li>
								<li class="breadcrumb-item active" aria-current="page">General Setting</li>
							</ol>
						</nav>
					</div>
					<div class="ml-auto d-flex align-items-center secondary-menu text-center">
						<!--<a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Todo list">
							<i class="fe fe-edit btn btn-icon text-primary"></i>
						</a>
						<a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Projects">
							<i class="fa fa-lightbulb-o btn btn-icon text-success"></i>
						</a>
						<a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Task">
							<i class="fa fa-check btn btn-icon text-warning"></i>
						</a>
						<a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Calendar">
							<i class="fa fa-calendar-o btn btn-icon text-cyan"></i>
						</a>
						<a href="javascript:void(0);" class="tooltip-wrapper" data-toggle="tooltip" data-placement="top" title="" data-original-title="Analytics">
							<i class="fa fa-bar-chart-o btn btn-icon text-danger"></i>
						</a>-->
					</div>
				</div>
				<!-- end page title -->
			</div>
		</div>
		<!-- end row -->
		
		<!-- begin row -->
		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h4>Jump To</h4>
					</div>
					<div class="card-body">
						<ul class="nav nav-pills flex-column">
							<li class="nav-item"><a href="#" class="nav-link active">General</a></li>
							<li class="nav-item"><a href="#" class="nav-link">SEO</a></li>
							<li class="nav-item"><a href="#" class="nav-link">Email</a></li>
							<li class="nav-item"><a href="#" class="nav-link">System</a></li>
							<li class="nav-item"><a href="#" class="nav-link">Security</a></li>
							<li class="nav-item"><a href="#" class="nav-link">Automation</a></li>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="col-md-8">
				<form id="setting-form">
					<div class="card" id="settings-card">
						<div class="card-header">
							<h4>General Settings</h4>
						</div>
						
						<div class="card-body">
							
							<div class="form-group row align-items-center">
								<label for="site-title" class="form-control-label col-sm-3 text-md-right">Site Title</label>
								<div class="col-sm-6 col-md-9">
									<input type="text" name="site_title" class="form-control" id="site-title">
								</div>
							</div>
							
							<div class="form-group row align-items-center">
								<label for="site-description" class="form-control-label col-sm-3 text-md-right">Site Description</label>
								<div class="col-sm-6 col-md-9">
									<textarea class="form-control" name="site_description" id="site-description"></textarea>
								</div>
							</div>
							
							<div class="form-group row align-items-center">
								<label class="form-control-label col-sm-3 text-md-right">Site Logo</label>
								<div class="col-sm-6 col-md-9">
									<div class="custom-file">
										<input type="file" name="site_logo" class="custom-file-input" id="site-logo">
										<label class="custom-file-label">Choose File</label>
									</div>
								</div>
							</div>
							
							<div class="form-group row align-items-center">
								<label class="form-control-label col-sm-3 text-md-right">Favicon</label>
								<div class="col-sm-6 col-md-9">
									<div class="custom-file">
										<input type="file" name="site_favicon" class="custom-file-input" id="site-favicon">
										<label class="custom-file-label">Choose File</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class="card-footer bg-whitesmoke text-md-right">
							<button class="btn btn-primary" id="save-btn">Save Changes</button>
							<button class="btn btn-secondary" type="button">Reset</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- end row -->
	</div>
	<!-- end container-fluid -->
</div>