<div class="app-main" id="main">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin row -->
		<div class="row">
			<div class="col-md-12 m-b-30">
				<!-- begin page title -->
				<div class="d-block d-lg-flex flex-nowrap align-items-center">
					<div class="mr-3">
						<a href="<?php echo base_url().'?member/profile';?>" class="btn btn-inverse-primary btn-sm btn-icon">
							<i class="fa fa-arrow-left"></i>
						</a>
					</div>
					<div class="page-title mr-4 pr-4 border-right">
						<h1>Edit Profile</h1>
					</div>
					<div class="breadcrumb-bar align-items-center">
						<nav>
							<ol class="breadcrumb p-0 m-b-0">
								<li class="breadcrumb-item">
									<a href><i class="ti ti-home"></i></a>
								</li>
								<li class="breadcrumb-item">Edit</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
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
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h4>Jump To</h4>
					</div>
					<div class="card-body">
						<ul class="nav nav-pills flex-column">
							<li class="nav-item">
								<a href="<?php echo base_url().'?member/edit/profile';?>" class="nav-link active">Edit Profile</a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url().'?member/edit/pin';?>" class="nav-link">Security</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="col-md-8">
				<?php
					$user_id = $this->session->userdata('member_login_id');
					$user = $this->db->get_where('user', array('user_id' => $user_id))->row();
				?>
				<form method="post" action="<?php echo base_url().'index.php?member/manage/profile/'.$user_id;?>" id="editform">
					<div class="card" id="settings-card">
						<div class="card-header">
							<h4>Edit Profile</h4>
						</div>
						
						<div class="card-body">
							<div class="form-group row align-items-center">
								<label for="site-title" class="form-control-label col-sm-3 text-md-right">Username</label>
								<div class="col-sm-6 col-md-9">
									<input type="text" name="username" class="form-control" value="<?php echo $user->username;?>" tabindex="1" autocomplete="off" required>
								</div>
							</div>
							
							<div class="form-group row align-items-center">
								<label for="site-title" class="form-control-label col-sm-3 text-md-right">Firstname</label>
								<div class="col-sm-6 col-md-9">
									<input type="text" name="firstname" class="form-control" value="<?php echo $user->firstname;?>" tabindex="1" autocomplete="off" required>
								</div>
							</div>
							
							<div class="form-group row align-items-center">
								<label for="site-title" class="form-control-label col-sm-3 text-md-right">Lastname</label>
								<div class="col-sm-6 col-md-9">
									<input type="text" name="lastname" class="form-control" value="<?php echo $user->lastname;?>" tabindex="2" autocomplete="off" required>
								</div>
							</div>
							
							<div class="form-group row align-items-center">
								<label for="site-title" class="form-control-label col-sm-3 text-md-right">Email</label>
								<div class="col-sm-6 col-md-9">
									<input type="email" name="email" class="form-control" value="<?php echo $user->email;?>" tabindex="3" autocomplete="off" required>
								</div>
							</div>
							
							<div class="form-group row align-items-center">
								<label for="site-title" class="form-control-label col-sm-3 text-md-right">Mobile</label>
								<div class="col-sm-6 col-md-9">
									<input type="text" name="mobile" class="form-control" value="<?php echo $user->mobile;?>" tabindex="4" autocomplete="off" required>
								</div>
							</div>
						</div>
						
						<div class="card-footer bg-whitesmoke text-md-right">
							<button type="submit" class="btn btn-primary" id="save-btn">Save Changes</button>
						</div>
					</div>
				</form>
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
	$("#editform").submit(function(e) {
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
							window.location = "<?php echo base_url().'?member/profile'?>"
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