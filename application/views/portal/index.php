<?php
	$running_year	= $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
	$system_name	= $this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
	$system_title	= $this->db->get_where('settings' , array('type' => 'system_title'))->row()->description;
	$account_type	= $this->session->userdata('login_type');
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="shortcut icon" href="uploads/logo.png">
		
	<title> <?php echo $page_title; ?> | <?php echo ucwords($system_name); ?> </title>
	<?php include 'include_top.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed
<?php if($page_name == 'attendance_report_view') echo 'sidebar-collapse';?>">
	
	<div class="wrapper">
		
		<?php include $account_type.'/header.php'; ?>
		
		<?php include $account_type.'/navigation.php'; ?>
		
		<?php include $account_type.'/'.$page_name.'.php'; ?>
		
		
		<!-- Main Footer -->
		<footer class="main-footer">
			<strong>Developed By: <a href="http://genuineict.com">Genuine ICT</a> 2019.</strong>
			<div class="float-right d-none d-sm-inline-block">
				<b>Version</b> 1.0.0
			</div>
		</footer>
	</div>
	<!-- ./wrapper -->
	<?php include 'modal.php';?>
	<?php include 'include_bottom.php'; ?>
	
</body>
</html>