<?php
	if(isset($param2)) $teacher_id = $param2;
	
	$edit_data = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->result_array();
	foreach($edit_data as $row):
		$links_json = $row['social_links'];
		$links = json_decode($links_json);
?>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- left column -->
				<div class="col-lg-5">
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<img class="profile-user-img img-fluid img-circle"
								src="<?php echo get_image_url('teacher', $row['teacher_id']);?>"
								alt="User profile picture">
							</div>
							
							<h3 class="profile-username text-center"><?php echo ucwords($row['name']); ?></h3>
							
							<p class="text-muted text-center"><?php echo ucwords($row['designation']); ?></p>
							
							<ul class="list-group list-group-unbordered mb-1">
								<li class="list-group-item">
									<b>&nbsp; <i class="fab fa-linkedin-in text-primary"></i></b>
									<a href="https://www.linkedin.com/<?php echo $links[0]->linkedin;?>" target="_blank" class="float-right">
										<?php echo $links[0]->linkedin;?>
									</a>
								</li>
								<li class="list-group-item">
									<b>&nbsp; <i class="fab fa-facebook-f text-primary"></i></b>
									<a href="https://www.facebook.com/<?php echo $links[0]->facebook;?>" target="_blank" class="float-right">
										<?php echo $links[0]->facebook;?>
									</a>
								</li>
								<li class="list-group-item">
									<b>&nbsp; <i class="fab fa-twitter text-primary"></i></b>
									<a href="https://www.twitter.com/<?php echo $links[0]->twitter;?>" target="_blank" class="float-right">
										<?php echo $links[0]->twitter;?>
									</a>
								</li>
							</ul>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- / .col -->
				<!-- right column -->
				<div class="col-lg-7">
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<p class="text-muted text-center">Basic Info</p>
							
							<ul class="list-group list-group-unbordered mb-3">
								<li class="list-group-item">
									<b>Birthday</b>
									<a class="float-right"><?php echo $row['birthday']; ?></a>
								</li>
								<li class="list-group-item">
									<b>Gender</b>
									<a class="float-right"><?php echo ucwords($row['gender']); ?></a>
								</li>
								<li class="list-group-item">
									<b>Address</b>
									<a class="float-right"><?php echo $row['address']; ?></a>
								</li>
								<li class="list-group-item">
									<b>Phone</b>
									<a class="float-right"><?php echo $row['phone']; ?></a>
								</li>
								<li class="list-group-item">
									<b>Email</b>
									<span class="float-right text-right">
										<?php echo $row['email']; ?> <br>
										<a href="mailto:<?php echo $row['email']; ?>" class="btn btn-primary btn-sm">Send Mail</a>
									</span>
								</li>
							</ul>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- / .col -->
			</div>
		</div><!--/. container-fluid -->
	</section>
	<!-- /.content -->
		
<?php
	endforeach;
?>