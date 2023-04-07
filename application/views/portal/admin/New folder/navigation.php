		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-light-primary elevation-4">
			<!-- Brand Logo -->
			<a href="" class="brand-link">
				<img src="uploads/logo.png" alt="AdminLTE Logo" class="brand-image elevation-3 bg-white">
				<span class="brand-text font-weight-light text-uppercase"> <?php echo $system_title; ?> </span>
			</a>
			
			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar Menu -->
				<nav class="mt-2 mb-3">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item has-treeview">
							<a href="<?php echo base_url(); ?>index.php?admin/dashboard" class="nav-link <?php if($page_name == 'dashboard') echo 'active'; ?>">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p> Dashboard </p>
							</a>
						</li>
						<li class="nav-item has-treeview <?php if($page_name == 'student_add' ||
																$page_name == 'student_information' ||
																$page_name == 'student_marksheet' ||
																$page_name == 'student_promotion' ||
																$page_name == 'student_profile')
																	echo 'active menu-open'; ?>">
							<a href="javascript:;" class="nav-link <?php if($page_name == 'student_add' ||
																			$page_name == 'student_information' ||
																			$page_name == 'student_marksheet' ||
																			$page_name == 'student_promotion' ||
																			$page_name == 'student_profile')
																				echo 'active'; ?>">
								<i class="nav-icon fas fa-users"></i>
								<p> Student <i class="fas fa-angle-left right"></i> </p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/student_add" class="nav-link <?php if($page_name == 'student_add') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p> Admit Student </p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/student_information" class="nav-link <?php if($page_name == 'student_information' || $page_name == 'student_profile' || $page_name == 'student_marksheet') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Student Information </p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/student_promotion" class="nav-link <?php if($page_name == 'student_promotion') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p> Student Promotion </p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item has-treeview">
							<a href="<?php echo base_url(); ?>index.php?admin/teacher" class="nav-link <?php if($page_name == 'teacher') echo 'active'; ?>">
								<i class="nav-icon fas fa-user-tie"></i>
								<p> Teachers </p>
							</a>
						</li>
						<li class="nav-item has-treeview">
							<a href="<?php echo base_url(); ?>index.php?admin/parent" class="nav-link <?php if($page_name == 'parent') echo 'active'; ?>">
								<i class="nav-icon fas fa-user"></i>
								<p> Parents </p>
							</a>
						</li>
						<li class="nav-item has-treeview">
							<a href="<?php echo base_url(); ?>index.php?admin/accountant" class="nav-link <?php if($page_name == 'accountant') echo 'active'; ?>">
								<i class="nav-icon fas fa-briefcase"></i>
								<p> Accountant </p>
							</a>
						</li>
						<li class="nav-item has-treeview <?php if($page_name == 'class' ||
																$page_name == 'section')
																	echo 'active menu-open'; ?>">
							<a href="javascript:;" class="nav-link <?php if($page_name == 'class' ||
																			$page_name == 'section')
																				echo 'active'; ?>">
								<i class="nav-icon fas fa-code-branch"></i>
								<p> Class <i class="fas fa-angle-left right"></i> </p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/classes" class="nav-link <?php if($page_name == 'class') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p> Manage Classes </p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/section" class="nav-link <?php if($page_name == 'section') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p> Manage Sections </p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item has-treeview <?php if($page_name == 'manage_attendance' ||
																$page_name == 'manage_attendance_view' ||
																$page_name == 'attendance_report' ||
																$page_name == 'attendance_report_view')
																	echo 'active menu-open'; ?>">
							<a href="javascript:;" class="nav-link <?php if($page_name == 'manage_attendance' ||
																			$page_name == 'manage_attendance_view' ||
																			$page_name == 'attendance_report' ||
																			$page_name == 'attendance_report_view')
																				echo 'active'; ?>">
								<i class="nav-icon fas fa-chart-area"></i>
								<p> Attendance <i class="fas fa-angle-left right"></i> </p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/manage_attendance" class="nav-link <?php if($page_name == 'manage_attendance' || $page_name == 'manage_attendance_view')	echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p> Daily Attendance </p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/attendance_report" class="nav-link <?php if($page_name == 'attendance_report' || $page_name == 'attendance_report_view')	echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p> Attendance Report </p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item has-treeview <?php if($page_name == 'subject' ||
																$page_name == 'academic_syllabus' ||
																$page_name == 'study_material')
																	echo 'active menu-open'; ?>">
							<a href="javascript:;" class="nav-link <?php if($page_name == 'subject' ||
																			$page_name == 'academic_syllabus' ||
																			$page_name == 'study_material')
																				echo 'active'; ?>">
								<i class="nav-icon fas fa-book-reader"></i>
								<p> Subject <i class="fas fa-angle-left right"></i> </p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/subject" class="nav-link <?php if($page_name == 'subject') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p> Manage Subjects </p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/academic_syllabus" class="nav-link <?php if($page_name == 'academic_syllabus') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p> Academic Syllabus </p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/study_material" class="nav-link <?php if($page_name == 'study_material') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p> Study Materials </p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item has-treeview">
							<a href="<?php echo base_url(); ?>index.php?admin/class_routine_view/" class="nav-link <?php if($page_name == 'class_routine_view')	echo 'active'; ?>">
								<i class="nav-icon fas fa-table"></i>
								<p> Class Routine </p>
							</a>
						</li>
						<li class="nav-item has-treeview <?php if($page_name == 'exam' ||
																$page_name == 'grade' ||
																$page_name == 'marks_manage' ||
																$page_name == 'marks_manage_view' ||
																$page_name == 'question_paper')
																	echo 'active menu-open';?>">
							<a href="javascript:;" class="nav-link <?php if($page_name == 'exam' ||
																			$page_name == 'grade' ||
																			$page_name == 'marks_manage' ||
																			$page_name == 'marks_manage_view' ||
																			$page_name == 'question_paper')
																				echo 'active';?>">
								<i class="nav-icon fas fa-chart-area"></i>
								<p> Exam <i class="fas fa-angle-left right"></i> </p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/exam" class="nav-link <?php if($page_name == 'exam') echo 'active';?>">
										<i class="far fa-circle nav-icon"></i>
										<p> Manage Exam </p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/grade" class="nav-link <?php if($page_name == 'grade') echo 'active';?>">
										<i class="far fa-circle nav-icon"></i>
										<p> Exam Grades </p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/marks_manage" class="nav-link <?php if($page_name == 'marks_manage' || $page_name == 'marks_manage_view') echo 'active';?>">
										<i class="far fa-circle nav-icon"></i>
										<p> Manage Marks </p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item has-treeview">
							<a href="<?php echo base_url();?>index.php?admin/book" class="nav-link <?php if($page_name == 'book') echo 'active';?>">
								<i class="nav-icon fas fa-book"></i>
								<p> Library </p>
							</a>
						</li>
						<li class="nav-item has-treeview <?php if($page_name == 'income' ||
																$page_name == 'expense' ||
																$page_name == 'expense_category' ||
																$page_name == 'student_payment')
																	echo 'active menu-open';?>">
							<a href="javascript:;" class="nav-link <?php if($page_name == 'income' ||
																			$page_name == 'expense' ||
																			$page_name == 'expense_category' ||
																			$page_name == 'student_payment')
																				echo 'active';?>">
								<i class="nav-icon fas fa-briefcase"></i>
								<p> Accounting <i class="fas fa-angle-left right"></i> </p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/student_payment" class="nav-link <?php if($page_name == 'student_payment') echo 'active';?>">
										<i class="far fa-circle nav-icon"></i>
										<p> Create Student Payment </p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/income" class="nav-link <?php if($page_name == 'income') echo 'active';?>">
										<i class="far fa-circle nav-icon"></i>
										<!--p> Student Payments </p-->
										<p> Invoices </p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/expense" class="nav-link <?php if($page_name == 'expense') echo 'active';?>">
										<i class="far fa-circle nav-icon"></i>
										<p> Expenses </p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?php echo base_url(); ?>index.php?admin/expense_category" class="nav-link <?php if($page_name == 'expense_category') echo 'active';?>">
										<i class="far fa-circle nav-icon"></i>
										<p> Expense Category </p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url(); ?>index.php?admin/system_settings" class="nav-link <?php if($page_name == 'system_settings') echo 'active';?>">
								<i class="nav-icon fas fa-cog"></i>
								<p> Settings </p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url(); ?>index.php?admin/manage_profile" class="nav-link <?php if($page_name == 'manage_profile') echo 'active';?>">
								<i class="nav-icon fas fa-user-lock"></i>
								<p> Account </p>
							</a>
						</li>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>
		