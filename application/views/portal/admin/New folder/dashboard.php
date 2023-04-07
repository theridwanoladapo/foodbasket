<?php
	$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
						<h5 class="m-0 text-dark"> <?php echo $page_title; ?> </h5>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"> Dashboard </li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->
		
			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<div class="row">
						
						<div class="col-md-8">
							<div class="card card-primary">
								<div class="card-header">
									<h5> Event Schedule </h5>
								</div>
								
								<div class="card-body p-0">
									<!-- THE CALENDAR -->
									<div id="calendar"></div>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<!-- /.col -->
						
						<div class="col-md-4">
							<!-- small card -->
							<div class="small-box bg-primary">
								<div class="inner">
									<h3>
									<?php
									$number_of_student_in_current_session = $this->db->get_where('enroll', array(
																			'year' => $running_year))->num_rows();
									echo $number_of_student_in_current_session;
									?>
									</h3>
									<h5> Student </h5>
									<small> Total Students </small>
								</div>
								<div class="icon">
									<i class="fa fa-user-friends"></i>
								</div>
							</div>
							
							<!-- small card -->
							<div class="small-box bg-info">
								<div class="inner">
									<h3>
									<?php
										echo $this->db->count_all('teacher');
									?>
									</h3>
									<h5> Teacher </h5>
									<small> Total Teachers </small>
								</div>
								<div class="icon">
									<i class="fas fa-user-tie"></i>
								</div>
							</div>
							
							<!-- small card -->
							<div class="small-box bg-danger">
								<div class="inner">
									<h3>
									<?php
										echo $this->db->count_all('parent');
									?>
									</h3>
									<h5> Parent </h5>
									<small> Total Parents </small>
								</div>
								<div class="icon">
									<i class="fas fa-user"></i>
								</div>
							</div>
							
							<!-- small card -->
							<div class="small-box bg-success">
								<div class="inner">
									<h3>
									<?php
										$check = array(	'timestamp' => strtotime(date('Y-m-d')), 'status' => '1' );
										$query = $this->db->get_where('attendance', $check);
										$present_today = $query->num_rows();
										echo $present_today;
									?>
									</h3>
									<h5> Attendance </h5>
									<small> Total Student Present Today </small>
								</div>
								<div class="icon">
									<i class="fas fa-user-check"></i>
								</div>
							</div>
						</div>
						<!-- /.col -->
						
					</div>
					<!-- /.row -->
					
				</div><!--/. container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		
		<!-- Page specific script -->
		<script>
			$(function () {
				
				/* initialize the calendar
				-----------------------------------------------------------------*/
				//	Date for the calendar events (dummy data)
				var date = new Date()
				var d    = date.getDate(),
					m    = date.getMonth(),
					y    = date.getFullYear()
				
				var Calendar = FullCalendar.Calendar;
				var Draggable = FullCalendarInteraction.Draggable;
				
				var calendarEl = document.getElementById('calendar');
				
				var calendar = new Calendar(calendarEl, {
					plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
					header    : {
						left  : 'title',
						center: '',
						right : 'prev,next today'
					}
				});
				
				calendar.render();
				// $('#calendar').fullCalendar()
				
			})
		</script>