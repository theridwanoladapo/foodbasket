<?php
	$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
?>
		<ul class="nav nav-tabs" id="subject-tab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="home-tab" data-toggle="pill" href="#home" role="tab" aria-controls="home" aria-selected="true">
					&nbsp; General Subjects
				</a>
			</li>
			<?php 
				$sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
				foreach ($sections as $row):
			?>
			<li class="nav-item">
				<a class="nav-link" id="sub<?php echo $row['section_id'];?>-tab" data-toggle="pill" href="#sub<?php echo $row['section_id'];?>" role="tab" aria-controls="sub<?php echo $row['section_id'];?>" aria-selected="false">
					Section <?php echo $row['name'];?> (<?php echo $row['nick_name'];?>)
				</a>
			</li>
			<?php
				endforeach;
			?>
		</ul>
		
		<div class="tab-content" id="subject-tabContent">
			<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				<div class="card-body table-responsive pl-0 pr-0">
					<table id="subjects" class="table table-bordered table-striped projects">
						<thead>
							<tr>
								<th> # </th>
								<th> Subject Name </th>
								<th> Teacher </th>
								<th> Options </th>
							</tr>
						</thead>
						
						<tbody>
						<?php
							$count = 1;
							$subjects = $this->db->get_where('subject', array(
								'class_id' => $class_id,
								'section_id' => 0,
								'year' => $running_year
							))->result_array();
							foreach ($subjects as $row):
						?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo ucwords($row['name']);?></td>
								<td>
								<?php
									if($row['teacher_id'] != '' || $row['teacher_id'] != 0)
									echo ucwords(get_type_name_by_id('teacher' ,$row['teacher_id']));
								?>
								</td>
								<td>
								<a class="btn btn-info btn-sm" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_subject_edit/<?php echo $row['subject_id']; ?>');">
									<i class="fas fa-pencil-alt"></i> Edit
								</a>
								<a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/subjects/delete/<?php echo $row['subject_id']; ?>');">
									<i class="fas fa-trash"></i> Delete
								</a>
								</td>
							</tr>
						<?php
							endforeach;
						?>
						</tbody>
					</table>
				</div>
				<!-- /.card-body -->
			</div>
			
		<?php 
			$sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
			foreach ($sections as $row):
		?>
			<div class="tab-pane fade" id="sub<?php echo $row['section_id'];?>" role="tabpanel" aria-labelledby="sub<?php echo $row['section_id'];?>-tab">
				<div class="card-body table-responsive pl-0 pr-0">
					<table id="table-<?php echo $row['section_id'];?>" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th> # </th>
								<th> Subject Name </th>
								<th> Teacher </th>
								<th> Options </th>
							</tr>
						</thead>
						
						<tbody>
						<?php
							$count = 1;
							$subjects   =   $this->db->get_where('subject', array(
								'class_id' => $class_id,
								'section_id' => $row['section_id'],
								'year' => $running_year
							))->result_array();
							foreach($subjects as $row):
						?>
							<tr>
								<td><?php echo $count++; ?></td>
								<td><?php echo ucwords($row['name']);?></td>
								<td>
								<?php
									if($row['teacher_id'] != '' || $row['teacher_id'] != 0)
									echo ucwords(get_type_name_by_id('teacher', $row['teacher_id']));
								?>
								</td>
								<td>
								<a class="btn btn-info btn-sm" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_subject_edit/<?php echo $row['subject_id']; ?>');">
									<i class="fas fa-pencil-alt"></i> Edit
								</a>
								<a class="btn btn-danger btn-sm" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/subjects/delete/<?php echo $row['subject_id']; ?>');">
									<i class="fas fa-trash"></i> Delete
								</a>
								</td>
							</tr>
						<?php
							endforeach;
						?>
						</tbody>
					</table>
				</div>
				<!-- /.card-body -->
			</div>
			
		<?php
			endforeach;
		?>
		</div>

		<!-- page script -->
		<script type="text/javascript">
			$(function () {
				// Initialize DataTable Elements
				$('#subjects').DataTable();
				
			<?php 
				$sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
				foreach ($sections as $row):
			?>
				$('#table-<?php echo $row['section_id'];?>').DataTable({
					"paging": true,
					"lengthChange": false,
					"searching": false,
					"ordering": true,
					"info": true,
					"autoWidth": false
				});
			<?php
				endforeach;
			?>
			
			});
		</script>