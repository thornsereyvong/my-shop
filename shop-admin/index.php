<?php
/*
 * *****************************************************************************
 * file: index.php
 * @autor: Thorn sereyvong
 * @date: 08-09-2015
 * KTS TEAM
 * *****************************************************************************
 */

$title = "Dashboard";
include_once 'app.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once 'head.php'; ?>
	</head>
	<body class="hold-transition sidebar-mini fixed skin-blue-light">
		<div class="wrapper">
			<?php include_once 'header.php'; ?>
			<?php include_once 'slidebar.php'; ?>
				<div class="content-wrapper">
					<!-- Content Header (Page header) -->
					<section class="content-header">
						<h1>
							Dashboard <small>Control panel</small>
						</h1>
						<ol class="breadcrumb">
							<li><a href="<?php echo $server;?>"><i class="fa fa-home"></i> Home</a></li>
							<li class="active">Dashboard</li>
						</ol>
					</section>
				</div>

		
			<?php include_once 'foot.php'; ?>
		</div> 
		<?php include_once 'footer.php'; ?>  
	</body>
</html>    
