<?php 
	include 'function/header.php';
	$category = getCategory($dbh);
?>

<header id="header" class="navbar-fixed-top">
	<section class="header-container">
		<div class="banner"></div>
		<div id="topbar">
			<span class="bt-menu-trigger hidden-xs"><span>Menu</span></span>
			<div class="container">
				<div class="inner">
					<nav class="clearfix"></nav>
				</div>
			</div>
		</div>
		<div id="header-main" class="header-left">
			<div class="container">
				<div class="inner">
					<div class="row">
						
						<div id="header_logo"
							class="col-lg-2 col-md-2 col-sm-12 col-xs-12 col-sp-12">
							<a href="<?php echo $server; ?>" title="Leo Clothing"> 
							<img class="logo img-responsive" src="<?php echo $server; ?>img/leo-clothing-1415952171-2.jpg" alt="Leo Clothing" width="158" height="69" />
							</a>
						</div>
						
						<div id="header-right" class="col-xs-12 col-sm-12 col-md-12 col-lg-10 clearfix">
							<div class="header-3 clearfix">
								
								<div class="row">
									<div class="widget col-lg-3 col-md-6 col-sm-6 col-xs-6 col-sp-12">
										<div id="leo-verticalmenu" class="leo-verticalmenu highlighted block float-vertical float-vertical-left">
											<h4 class="title_block float-vertical-button"> Categories<span class="btn-toggle-menu"><i class="fa fa-bars"></i></span>
											</h4>
											<span class="bt-menu-trigger hidden-xs"><span>Menu</span></span>
											<div id="header_logo_sidebar">
												<a href="#" title="Leo Clothing"> 
													<img class="logo img-responsive" src="<?php echo $server; ?>img/leo-clothing-1415952171-2.jpg" alt="Leo Clothing" width="158" height="69" />
												</a>
											</div>
											<div id="left_column" class="box-content block_content">
												<div id="verticalmenu" class="verticalmenu"
													role="navigation">
													<ul class="nav navbar-nav megamenu left">
														<li class="">
															<a href="<?php echo $server; ?>" target="_self" class="has-category">
																<span class="hasicon menu-icon-class">
																	<span class="fa fa-home"></span>
																	<span class="menu-title">Home</span>
																</span>
															</a>
														</li>
														<?php 														
														if(count($category)>0){
															$sub1 = getChild('',$category);
															if(count($sub1)>0){
																foreach ($sub1 as $s1){
																	showMainCat($s1,$category);
																}
															}
														}
																											
														?>
														
													</ul>
												</div>
											</div>
										</div>
										<script type="text/javascript"> 
											/* <![CDATA[ */;
											$(document).ready(function() {
												$('#leo-verticalmenu .dropdown-toggle').removeAttr("disabled");
												$(".dropdown-toggle").click(function() {
													if ($(window).width() <= 767) {
														if ($(this).parent("li").find("div:first").hasClass("level2"))
															return false;
														else
															return true;
													}
												});
											});/* ]]> */
										</script>
									</div>
								</div>
										
								<div id="leo-megamenu" class="clearfix">
									<nav id="cavas_menu" class="sf-contener leo-megamenu">
										<div class="" role="navigation">
											<div class="navbar-header"></div>
											<div id="leo-top-menu" class="collapse navbar-collapse navbar-ex1-collapse">
												<ul class="nav navbar-nav megamenu">
													
													<li class="">
														<a href="<?php echo $server; ?>" target="_self" class="has-category"><span class="menu-title">Home</span></a>
													</li>													
													<?php 														
														if(count($category)>0){
															$sub1 = getChild('',$category);
															if(count($sub1)>0){
																foreach ($sub1 as $s1){
																	showMainCat($s1,$category);
																}
															}
														}
																											
													?>																									
													<li class="">
														<a href="#" target="_self" class="has-category">
															<span class="menu-title">Contact us</span>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</nav>
								</div>

								<div id="search_block_top" class="i-custom-search" style="margin-right:30px;margin-top:-3px;">
									<form id="searchbox" method="get" action="#">
										<input type="hidden" name="controller" value="search" /> <input
											type="hidden" name="orderby" value="position" /> <input
											type="hidden" name="orderway" value="desc" /> <input
											class="search_query form-control input-lg" type="text"
											id="search_query_top" name="search_query"
											placeholder="Search" value="" />
										<button type="submit" name="submit_search"
											class="btn fa fa-search">&nbsp;</button>
									</form>
								</div>
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</header>