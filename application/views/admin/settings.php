<div class="app-main" id="main">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin row -->
		<div class="row">
			<div class="col-md-12 m-b-30">
				<!-- begin page title -->
				<div class="d-block d-lg-flex flex-nowrap align-items-center">
					<div class="page-title mr-4 pr-4 border-right">
						<h1>Settings</h1>
					</div>
					<div class="breadcrumb-bar align-items-center">
						<nav>
							<ol class="breadcrumb p-0 m-b-0">
								<li class="breadcrumb-item">
									<a href><i class="ti ti-home"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Settings</li>
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
			<div class="col-lg-6">
				<div class="card card-large-icons">
					<div class="card-icon bg-primary text-white">
						<i class="fa fa-cog"></i>
					</div>
					<div class="card-body">
						<h4>General</h4>
						<p>General settings such as, site title, site description, address and so on.</p>
						<br>
						<a href="<?php echo base_url() . '?admin/settings/general';?>" class="card-cta">Change Setting <i class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="card card-large-icons">
					<div class="card-icon bg-primary text-white">
						<i class="fa fa-search"></i>
					</div>
					<div class="card-body">
						<h4>SEO</h4>
						<p>Search engine optimization settings, such as meta tags and social media.</p>
						<br>
						<a href="features-setting-detail.html" class="card-cta">Change Setting <i class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="card card-large-icons">
					<div class="card-icon bg-primary text-white">
						<i class="fa fa-envelope"></i>
					</div>
					<div class="card-body">
						<h4>Email</h4>
						<p>Email SMTP settings, notifications and others related to email.</p>
						<br>
						<a href="features-setting-detail.html" class="card-cta">Change Setting <i class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="card card-large-icons">
					<div class="card-icon bg-primary text-white">
						<i class="fa fa-power-off"></i>
					</div>
					<div class="card-body">
						<h4>System</h4>
						<p>PHP version settings, time zones and other environments.</p>
						<br>
						<a href="features-setting-detail.html" class="card-cta">Change Setting <i class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="card card-large-icons">
					<div class="card-icon bg-primary text-white">
						<i class="fa fa-lock"></i>
					</div>
					<div class="card-body">
						<h4>Security</h4>
						<p>Security settings such as firewalls, server accounts and others.</p>
						<br>
						<a href="features-setting-detail.html" class="card-cta">Change Setting <i class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
			
			<div class="col-lg-6">
				<div class="card card-large-icons">
					<div class="card-icon bg-primary text-white">
						<i class="ion ion-ios-stopwatch"></i>
					</div>
					<div class="card-body">
						<h4>Automation</h4>
						<p>Settings about automation such as cron job, backup automation and so on.</p>
						<br>
						<a href="features-setting-detail.html" class="card-cta text-primary">Change Setting <i class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			</div>
		</div>
		<!-- end row -->
	</div>
	<!-- end container-fluid -->
</div>