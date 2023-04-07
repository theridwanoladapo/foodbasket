<?php date_default_timezone_set('Africa/Lagos'); ?>

<!DOCTYPE HTML>
<html>
<head>
	<title> <?php echo ucwords($page_title);?> </title>
	<meta charset="utf-8">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="shortcut icon" href="assets/img/logo-icon.png">
	
	<?php include('styles.php'); ?>
</head>

<body class="light-sidebar">
	
	<!-- app -->
	<div class="app">
		<!-- begin app-wrap -->
		<div class="app-wrap">
			<!-- begin pre-loader -->
			<div class="loader">
				<div class="h-100 d-flex justify-content-center">
					<div class="align-self-center">
						<img src="assets/img/loader/loader.svg" alt="loader">
					</div>
				</div>
			</div>
			<!-- end pre-loader -->

			<!-- begin app-header -->
			<?php if(
				$page_name != 'login' ) include('header.php');
			?>
			<!-- end app-header -->

			<!-- begin app-container -->
			<div class="app-container">
				<!-- begin app-navbar -->
				<?php if(
					$page_name != 'login' ) include('navbar.php');
				?>
				<!-- end app-navbar -->
				<!-- begin app-main -->
				<?php include($page_name.'.php'); ?>
				<!-- end app-main -->
				<!-- begin footer -->
				<?php if(
					$page_name != 'login' ) include('footer.php');
				?>
				<!-- end footer -->
			</div>
			<!-- end app-container -->
		</div>
		<!-- end app-wrap -->
	</div>
	
	<?php include('scripts.php'); ?>
	
</body>
</html>