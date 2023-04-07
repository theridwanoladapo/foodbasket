						<?php
							$num_rows = $this->db->get_where('section', array('class_id' => $class_id))->num_rows();
							if($num_rows > 0):
								$section_id = $this->db->get_where('class_routine',
											array('class_routine_id' => $class_routine_id))->row()->section_id;
						?>
								<div class="form-group row">
									<label for="inputSection" class="col-sm-4 control-label"> &nbsp; Section </label>
									<div class="col-sm-8">
										<select name="section_id" class="form-control select3" style="width: 100%;" required>
											<?php
												$sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
												foreach($sections as $section):
											?>
											<option value="<?php echo $section['section_id'];?>"
											<?php if($section['section_id'] == $section_id) echo 'selected';?>>
												<?php echo ucwords($section['name']);?> (<?php echo ucwords($section['nick_name']);?>)
											</option>
											<?php
												endforeach;
											?>
										</select>
									</div>
								</div>
						<?php
							endif;
							
							$subject_id = $this->db->get_where('class_routine', array('class_routine_id' => $class_routine_id))->row()->subject_id;
						?>
								<div class="form-group row">
									<label for="inputSection" class="col-sm-4 control-label"> &nbsp; Subject </label>
									<div class="col-sm-8">
										<select name="subject_id" class="form-control select3" style="width: 100%;" required>
											<?php
												$subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
												foreach($subjects as $subject):
											?>
											<option value="<?php echo $subject['subject_id'];?>"
											<?php if($subject['subject_id'] == $subject_id) echo 'selected';?>>
												<?php echo ucwords($subject['name']);?>
											</option>
											<?php
												endforeach;
											?>
										</select>
									</div>
								</div>
							
							<script type="text/javascript">
								$(function() {
									//Initialize Select2 Elements
									$('.select3').select2({
										theme: 'bootstrap4',
										minimumResultsForSearch: -1
									})
								});
							</script>
