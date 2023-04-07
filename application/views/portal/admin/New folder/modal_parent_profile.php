<?php
	if(isset($param2)) $parent_id = $param2;
	
	$edit_data = $this->db->get_where('parent', array('parent_id' => $parent_id))->result_array();
	foreach($edit_data as $row):
?>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- left column -->
				<div class="col-lg-7 m-auto">
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<h3 class="profile-username text-center"><?php echo ucwords($row['name']); ?></h3>
							
							<p class="text-center">
								<b>Profession:</b>
								<span class="text-nuted"><?php echo ucwords($row['profession']); ?></span>
							</p>
							
							<ul class="list-group list-group-unbordered mb-1">
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