						<?php
							$num_rows = $this->db->get_where('section', array('class_id' => $class_id))->num_rows();
							if($num_rows > 0):
								$section_id = $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->section_id;
						?>
								<div class="form-group row">
									<label for="inputSection" class="col-sm-4 control-label"> &nbsp; Section </label>
									<div class="col-sm-8">
										<select name="section_id" class="form-control select3" style="width: 100%;" required>
											<option value="all" <?php if($section_id == 0) echo 'selected';?>>
												All Sections
											</option>
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
						?>
							<script type="text/javascript">
								$(function() {
									//Initialize Select2 Elements
									$('.select3').select2({
										theme: 'bootstrap4',
										minimumResultsForSearch: -1
									})
								});
							</script>
