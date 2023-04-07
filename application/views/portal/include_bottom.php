	<!-- REQUIRED SCRIPTS -->
	
	<!-- JQueryUI -->
	<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Bootstrap -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="plugins/moment/moment.min.js"></script>
	<!-- InputMask -->
	<!--script src="plugins/inputmask/jquery.inputmask.bundle.js"></script-->
	<!-- jQuery Validate -->
	<!--script src="plugins/jquery-validate/jquery.validate.min.js"></script-->
	<!-- Select2 -->
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE -->
	<script src="dist/js/raw.js"></script>
	<!-- Toastr -->
	<script src="plugins/toastr/toastr.min.js"></script>
	<!-- DataTables -->
	<script src="plugins/datatables/jquery.dataTables.js"></script>
	<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	
	<!-- PAGE PLUGINS -->
	<!-- jQuery Mapael -->
	<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
	<script src="plugins/raphael/raphael.min.js"></script>
	<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
	<script src="plugins/jquery-mapael/maps/world_countries.min.js"></script>
	<!-- ChartJS -->
	<script src="plugins/chart.js/Chart.min.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- File Input -->
	<script src="plugins/bootstrap-fileinput/js/bootstrap-fileinput.js"></script>
	<!-- Summernote -->
	<script src="plugins/summernote/summernote-bs4.min.js"></script>
	<!-- PAGE SCRIPTS -->
	<script src="dist/js/pages/dashboard2.js"></script>
	<!-- fullCalendar 2.2.5 -->
	<script src="plugins/fullcalendar/main.min.js"></script>
	<script src="plugins/fullcalendar-daygrid/main.min.js"></script>
	<script src="plugins/fullcalendar-timegrid/main.min.js"></script>
	<script src="plugins/fullcalendar-interaction/main.min.js"></script>
	<script src="plugins/fullcalendar-bootstrap/main.min.js"></script>


	<!-- SHOW TOASTR NOTIFIVATION -->
	<?php if($this->session->flashdata('flash_message') != ''): ?>
		
		<script type="text/javascript">
			toastr.success('<?php echo $this->session->flashdata("flash_message"); ?>');
		</script>
		
	<?php endif;?>
	
	<?php if($this->session->flashdata('error_message') != ''): ?>
		
		<script type="text/javascript">
			toastr.error('<?php echo $this->session->flashdata("error_message"); ?>');
		</script>
		
	<?php endif;?>
