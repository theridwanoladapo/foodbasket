<?php
	$system_name = $this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
	$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
	
	if(isset($param2)) $student_id = $param2;
?>
<?php
	$student_info = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
	foreach ($student_info as $row):
		$enroll_info = $this->db->get_where('enroll', array(
		  'student_id' => $row['student_id'], 'year' => $running_year
		))->row();
		$class_id = $enroll_info->class_id;
		$section_id = $enroll_info->section_id;
		$class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
		$section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
?>
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<!-- Main content -->
				<?php
					$exams = $this->db->get_where('exam', array('year' => $running_year))->result_array();
					foreach($exams as $exam): 
				?>
				<div id="sheet<?php echo $exam['exam_id'];?>">
					<div class="card card-primary">
						<div class="card-header">
							<h5><?php echo ucwords($exam['name']);?></h5>
						</div>
						<div class="card-body p-0">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="width:30%;"> Subject </th>
										<th> Total Mark </th>
										<th> Obtained Mark </th>
										<th> Grade </th>
										<th> Comment </th>
									</tr>
								</thead>
								<tbody>
								<?php
									$total_marks = 0;
									$total_grade_point = 0;
									$total_subjects = 0;
									$sql = 'SELECT * FROM `subject` WHERE'.
											' `class_id` = "'.$class_id.
											'" AND `year` = "'.$running_year.
											'" AND (`section_id` = "'.$section_id.'" OR `section_id` = 0)';
									
									$subjects = $this->db->query($sql)->result_array();
									foreach($subjects as $sub):
								?>
									<tr>
										<td><?php echo ucwords($sub['name']);?></td>
										<td>
											100
										</td>
										<?php
											$obtained_mark = $this->db->get_where('mark', array(
											'subject_id' => $sub['subject_id'], 'exam_id' => $exam['exam_id'],
											'class_id' => $class_id, 'student_id' => $student_id, 'year' => $running_year));
												
												$marks = $obtained_mark->result_array();
										?>
										<td>
										<?php
											if($obtained_mark->num_rows() > 0):
												foreach($marks as $mark):
													echo $mark['mark_obtained'];
													$total_marks += $mark['mark_obtained'];
													$total_subjects++;
												endforeach;
											endif;
										?>
										</td>
										<td>
										<?php
											if($obtained_mark->num_rows() > 0):
												foreach($marks as $mark):
													$grade = get_grade($mark['mark_obtained']);
													echo ucwords($grade['name']);
													$total_grade_point += $grade['grade_point'];
												endforeach;
											endif;
										?>
										</td>
										<td>
										<?php
											if($obtained_mark->num_rows() > 0):
												foreach($marks as $mark):
													echo ucwords($mark['comment']);
												endforeach;
											endif;
										?>
										</td>
										<?php
										?>
									</tr>
								<?php
									endforeach;
								?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="4" class="text-right"> Total Marks </th>
										<td> <?php echo $total_marks?> </td>
									</tr>
									<tr>
										<th colspan="4" class="text-right"> Average Grade Point </th>
										<td>
										<?php
											if($total_grade_point != 0 && $total_subjects != 0)
													echo round($total_grade_point / $total_subjects, 2);
										?>
										</td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
					
					<!-- this row will not appear when printing -->
					<div class="row no-print mb-4">
						<div class="col-12">
							<a href="javascript:;" onClick="PrintElem('#sheet<?php echo $exam['exam_id'];?>')" class="btn btn-primary">
								<i class="fas fa-print"></i> Print Marksheet
							</a>
						</div>
					</div>
				</div>
				<hr>
				<?php
					endforeach;
				?>
				
				</div>
				<!-- /.col -->
			</div
			><!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>

<?php
	endforeach;
?>

<script type="text/javascript">

    // print function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'invoice', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('<link rel="stylesheet" href="dist/css/raw.css">');
        mywindow.document.write('<link rel="stylesheet" href="plugins/fontawesome-free/css/all.css">');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        var is_chrome = Boolean(mywindow.chrome);
        if (is_chrome) {
            setTimeout(function() {
                mywindow.print();
                mywindow.close();

                return true;
            }, 250);
        }
        else {
            mywindow.print();
            mywindow.close();

            return true;
        }

        return true;
    }

</script>