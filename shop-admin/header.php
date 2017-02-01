<?php 
/* * *****************************************************************************
 * file: head.php
 * @autor: Thorn sereyvong
 * @date: 08-09-2015
 * Balancika co.,ltd
 * ***************************************************************************** */ 

include_once 'check_account.php';

?>
<header class="main-header">
	<a href="<?php echo $server; ?>" class="logo">
		<span class="logo-mini"><b><img alt="" src="img/favicon.png"></b></span>
		<span class="logo-lg"><b>KTS</b></span>
	</a>
	<nav class="navbar navbar-static-top" role="navigation">
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> 
			<span class="sr-only">Toggle navigation</span>
		</a>
		<div class="navbar-custom-menu">			
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
						<img src="img/avatar_m.png" class="user-image" alt="User Image"> <span class="hidden-xs">
						<?php //echo $_SESSION['AME_USERNAME'];?></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header"><img src="img/avatar_m.png"
							class="img-circle" alt="User Image">
							<p>
								<?php echo $_SESSION['ZOBENZ_USER'].' - '.$_SESSION['ZOBENZ_USER_ROLE'];?><small></small>
							</p></li>
						<li class="user-footer">
							<div class="pull-left">
								<a href="#" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
								<a href="<?php echo $server."logout-account";?>" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>					
			</ul>
		</div>
	</nav>
</header>