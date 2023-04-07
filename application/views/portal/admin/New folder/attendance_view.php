<?php
	$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
?>
							<hr>
							<div class="card card-primary card-outline">
								<form method="post" action="<?php echo base_url(); ?>index.php?admin/attendance_update/">
									<div class="card-header">
										<h3 class="card-title float-right">
											<a class="btn btn-primary" href="javascript:;" onclick="mark_all_present()">
												<i class="fas fa-check"></i>
												Mark All Present
											</a>
											<a class="btn btn-primary" href="javascript:;" onclick="mark_all_absent()">
												<i class="fas fa-times"></i>
												Mark All Absent
											</a>
										</h3>
									</div>
									
									<div class="card-body table-responsive">
										<table id="promotion_tab" class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Name</th>
													<th>ID Number</th>
													<th>Options</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$count = 1;
													$select_id = 0;
													$attendance_of_students = $this->db->get_where('attendance', array(
														'class_id'		=> $class_id,
														'section_id'	=> $section_id,
														'year'			=> $running_year,
														'timestamp'		=> $timestamp
													))->result_array();
													
													foreach ($attendance_of_students as $row):
												?>
												<tr>
													<td> <?php echo $count++; ?> </td>
													<td>
														<?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->student_code; ?>
													</td>
													<td>
														<?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
													</td>
													<td>
														<select name="status_<?php echo $row['attendance_id']; ?>" id="status_<?php echo $select_id; ?>" class="form-control btn-sm" required>
															<option value="0" <?php if ($row['status'] == 0) echo 'selected'; ?>> Undefined </option>
															<option value="1" <?php if ($row['status'] == 1) echo 'selected'; ?>> Present </option>
															<option value="2" <?php if ($row['status'] == 2) echo 'selected'; ?>> Absent </option>
														</select>
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
											&nbsp; Save Changes &nbsp;
										</button>
									</div>
									<!-- /.card-footer -->
								</form>
							</div>
							<!-- /.card -->
		
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
								
								function mark_all_present() {
									var count = 12 <?php //echo count($attendance_of_students); ?>;
									
									for(var i = 0; i < count; i++)
										$('#status_' + i).val("1");
								}
								
								function mark_all_absent() {
									var count = 12 <?php //echo count($attendance_of_students); ?>;
									
									for(var i = 0; i < count; i++)
										$('#status_' + i).val("2");
								}
					
								$(function () {
									//Initialize Select2 Elements
									$('.select2').select2({
										theme: 'bootstrap4',
										minimumResultsForSearch: -1
									})
									
									//Timepicker
									$('#datepicker').datetimepicker({
										viewMode: 'years',
										format: 'MM/DD/YYYY',
										defaultDate: '<?php echo date("m/d/Y", $timestamp);?>'
									})
								});
							</script>
							
							<script type="text/javascript">			
								function get_class_sections(class_id)
								{
									$.ajax({
										url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
										success: function(response)
										{
											jQuery('#section_selector_holder').html(response);
										}
									});
								}
							</script>
