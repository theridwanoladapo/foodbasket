						<?php
							$query = $this->db->get_where('section' , array('class_id' => $class_id));
							if($query->num_rows() > 0):
								$sections = $query->result_array();
						?>
								<div class="form-group row">
									<label for="inputSection" class="col-sm-4 control-label"> &nbsp; Section </label>
									<div class="col-sm-8">
										<select name="section_id" class="form-control select3" style="width: 100%;" required>
											<?php
												foreach($sections as $row):
											?>
											<option value="<?php echo $row['section_id'];?>">
												<?php echo ucwords($row['name']);?> (<?php echo ucwords($row['nick_name']);?>)
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
								<div class="form-group row">
									<label for="inputSection" class="col-sm-4 control-label"> &nbsp; Subject </label>
									<div class="col-sm-8">
										<select name="subject_id" class="form-control select3" style="width: 100%;" required>
											<?php
												$subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
												foreach($subjects as $row):
											?>
											<option value="<?php echo $row['subject_id'];?>"><?php echo ucwords($row['name']);?></option>
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
