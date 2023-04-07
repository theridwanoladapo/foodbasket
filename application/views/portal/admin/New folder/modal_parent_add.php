	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- left column -->
				<div class="col-lg-12">
					<!-- Horizontal Form -->
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">
								<i class="fas fa-plus-circle"></i>
								&nbsp; Add Parent
							</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form id="parentAdd" class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/parent/create">
							<div class="card-body">
								<div class="form-group row">
									<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
									<div class="col-sm-8">
										<input type="text" name="name" class="form-control text-capitalize" id="inputName" autofocus required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputJob" class="col-sm-4 control-label"> &nbsp; Profession </label>
									<div class="col-sm-8">
										<input type="text" name="profession" class="form-control text-capitalize" id="inputJob">
									</div>
								</div>
								<div class="form-group row">
									<label for="inputAdd" class="col-sm-4 control-label"> &nbsp; Address </label>
									<div class="col-sm-8">
										<input type="text" name="address" class="form-control text-capitalize" id="inputAdd" value="" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPhone" class="col-sm-4 control-label"> &nbsp; Phone </label>
									<div class="col-sm-8">
										<input type="text" name="phone" class="form-control" id="inputPhone" value="" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputEmail" class="col-sm-4 control-label"> &nbsp; Email </label>
									<div class="col-sm-8">
										<input type="email" name="email" class="form-control" id="inputEmail" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPassword" class="col-sm-4 control-label"> &nbsp; Password </label>
									<div class="col-sm-8">
										<input type="password" name="password" class="form-control" id="inputPassword" required>
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary"> &nbsp; Add Parent &nbsp; </button>
									</div>
								</div>
							</div>
							<!-- /.card-body -->
						</form>
					</div>
					<!-- /.card -->
				</div>
				<!-- / .col -->
			</div>
		</div><!--/. container-fluid -->
	</section>
	<!-- /.content -->
	