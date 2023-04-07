<hr>
			<div class="col-12">
				<div class="row">
					<div class="col-lg-5 col-6 m-sm-auto">
						<div class="info-box">
							<div class="info-box-content">
								<span class="info-box-text lead">
								Students Of Class
								<?php echo ucwords($this->db->get_where('class', array('class_id' => $promotion_from))->row()->name);?>
								</span>
							</div>
							<!-- /.info-box-content -->
							<span class="info-box-icon bg-primary"><i class="fas fa-users fa-lg"></i></span>
						</div>
						<!-- /.info-box -->
					</div>
					<!-- ./col -->
				</div>
			</div>
			<!-- /.col -->
			<div class="col-12">
				<div class="card card-primary card-outline">
					<!-- form start -->
					<form class="" method="post" action="<?php echo base_url();?>index.php?admin/promote/<?php echo $promotion_from.'/'.$promotion_to.'/'.$running_year.'/'.$promotion_year;?>">
					<div class="card-body table-responsive">
						<table id="promotion_tab" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Name</th>
									<th>ID Number</th>
									<th>Class - Section</th>
									<th>Info</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$students = $this->db->get_where('enroll', array(
									'class_id' => $promotion_from,
									'year' => $running_year
								))->result_array();
								
								foreach($students as $row):
							?>
								<tr>
									<td>
									<?php echo ucwords($this->db->get_where('student', 
												array('student_id' => $row['student_id']))->row()->name);?>
									</td>
									<td>
									<?php echo $this->db->get_where('student', 
												array('student_id' => $row['student_id']))->row()->student_code;?>
									</td>
									<td>
									<?php
									if($row['class_id'] != '' && $row['class_id'] != 0)
										echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;
									?>
									-
									<?php
									if($row['section_id'] != '' && $row['section_id'] != 0)
										echo $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name;
									?>
									</td>
									<td>
										<button type="button" class="btn btn-info btn-sm"
										onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/student_promotion_performance/<?php echo $row['student_id'];?>/<?php echo $promotion_from;?>');">
											View Academic Performance
										</button>
									</td>
									<td>
									<?php
										$query = $this->db->get_where('enroll', array(
											'student_id' => $row['student_id'],'year' => $promotion_year
										));
										if($query->num_rows() == 0):
									?>
										<select name="promotion_status_<?php echo $row['student_id'];?>" class="form-control btn-sm">
											<option value="<?php echo $promotion_to;?>">
												Enroll to Class - <?php echo ucwords(get_class_name($promotion_to));?>
											</option>
											<option value="<?php echo $promotion_from;?>">
												Enroll to Class - <?php echo ucwords(get_class_name($promotion_from));?>
											</option>
										</select>
									<?php else: ?>
										<button class="btn btn-success btn-sm">
											<i class="fas fa-check"></i> Student Already Enrolled
										</button>
									<?php endif; ?>
									</td>
								</tr>
							<?php
								endforeach;
							?>
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
					
					<div class="card-footer text-center">
						<button type="submit" class="btn btn-success">
							<i class="fas fa-check"></i>
							&nbsp; Promote Selected Students &nbsp;
						</button>
					</div>
					<!-- /.card-footer -->
					</form>
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
			
			<!-- page script -->
			<script type="text/javascript">
				$(function () {
					$('#promotion_tab').DataTable({
						"paging": true,
						"lengthChange": false,
						"searching": false,
						"ordering": false,
						"info": true,
						"autoWidth": false,
					});
				});
			</script>