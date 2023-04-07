<?php 
	$usr_id = $this->session->userdata('agent_login_id');
	$ref_code = $this->db->get_where('user', array('user_id' => $usr_id))->row()->referral_code;
?>

	<div class="app-main" id="main">
		<!-- begin container-fluid -->
		<div class="container-fluid">
			<!-- begin row -->
			<div class="row">
				<div class="col-md-12 m-b-30">
					<!-- begin page title -->
					<div class="d-block d-lg-flex flex-nowrap align-items-center">
						<div class="page-title mr-4 pr-4 border-right">
							<h1>Add Member</h1>
						</div>
						<div class="breadcrumb-bar align-items-center">
							<nav>
								<ol class="breadcrumb p-0 m-b-0">
									<li class="breadcrumb-item">
										<a href><i class="ti ti-home"></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Add New Member</li>
								</ol>
							</nav>
						</div>
					</div>
					<!-- end page title -->
				</div>
			</div>
			<!-- end row -->

			<!-- begin row -->
			<div class="row">
				<div class="col-xs-8 offset-xs-2 col-sm-8 offset-sm-2 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
					<div class="card rounded">
						<div class="card-header">
							<div class="card-heading">
								<h4 class="card-title">Register a New Member</h4>
							</div>
						</div>
						<div class="card-body">
							<form method="post" action="<?php echo base_url().'index.php?agent/membersignup';?>" id="membersignup" class="mt-2 mt-sm-2 ">
								<div class="row">
									<div class="col-12 col-sm-6 col-md-12">
										<div class="form-group">
											<label class="control-label">First Name</label>
											<input type="text" name="firstname" class="form-control" placeholder="Enter your first name" tabindex="1" autocomplete="off" required>
										</div>
									</div>
									<div class="col-12 col-sm-6 col-md-12">
										<div class="form-group">
											<label class="control-label">Last Name</label>
											<input type="text" name="lastname" class="form-control" placeholder="Enter your last name" tabindex="2" autocomplete="off" required>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label class="control-label">Email</label>
											<input type="email" name="email" class="form-control" placeholder="Enter your email address" tabindex="3" autocomplete="off" required>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label class="control-label">Phone Number</label>
											<input type="text" name="mobile" class="form-control" placeholder="Provide your phone number" tabindex="4" autocomplete="off" required>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<!-- referrer id -->
											<input type="hidden" name="referrer" pattern="[0-9]{7}" class="form-control" maxlength="7" value="<?php echo $ref_code;?>">

											<label class="control-label">Username</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"> @</span>
												</div>
												<input type="text" name="username" class="form-control" placeholder="Choose a username" tabindex="5" autocomplete="off" required>
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label class="control-label">Pin</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"> <i class="fa fa-key"></i> </span>
												</div>
												<input type="password" name="upin" inputmode="numeric" pattern="[0-9]{6}" class="form-control" placeholder="Set your 6 digits pin" maxlength="6" tabindex="6" onKeyPress="return onlyNumberKey(event)" autocomplete="off" required>
											</div>
										</div>
									</div>
									<div class="col-12 mt-3">
										<button type="submit" class="btn btn-primary btn-lg btn-block text-uppercase" id="add">Add Member</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- end row -->
		</div>
		<!-- end container-fluid -->
	</div>


	<script> 
		function onlyNumberKey(evt) { 
			// Only ASCII charactar in that range allowed 
			var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
			if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
				return false;

			return true; 
		}
		
		$(document).ready(function() {
			$("#membersignup").submit(function(e) {
				e.preventDefault();
				
				var form = $(this);

				$.ajax(
				{
					url: form.attr('action'),
					type: 'POST',
					data: form.serialize(),
					cache: false,
					success: function(response)
					{
						var data = JSON.parse(response);
						if(data.type == 'success')
						{
							swal({
								type: data.type,
								title: data.title,
								html: data.text,
								footer: data.footer,
								allowOutsideClick: false
							}).then((result) => {
								if (result.value) {
									$.get("<?php echo base_url().'?agent/activate_user/'?>"+data.user_id, function(datas, status){
										if(status == 'success'){
											swal({
												type: 'success',
												title: 'Success',
												html: 'Account Activated Succesfully.',
												allowOutsideClick: false
											}).then((result) => {
												if (result.value) {
													window.location = "<?php echo base_url().'?agent/add_member'?>";
												}
											});
										}
									});
								}
							});
						}
						else if(data.type == 'error')
						{
							swal({
								type: data.type,
								title: data.title,
								html: data.text,
								footer: data.footer,
								allowOutsideClick: false
							});
						}
					}
				});
			});
		});
	</script>