
<?php 
	include 'app.php';	
	include 'function/item.php';
?>

<!DOCTYPE HTML>
<html lang="en-us" class="default">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>

	<?php include 'layout/head.php';?>
	<script type="text/javascript">
		var page_name='category';
	</script>


</head>
<body class="">
	
	<section id="page" data-column="col-xs-12 col-sm-6 col-md-4" data-type="grid">
				
		<?php include 'layout/header.php';?>
		<div class="s-detail-product"></div>
		
		<?php
			
			$act_product= "active";
			$act_con = "";
			$act_about = "";
			$act_home = "";
			$act_document = "";
			$act_service = "";
			$act_solution = "";
			$act_search = "";
			
			$row_limit =1;
			
			
			$first = "";
			$second = "";
			$third = "";
			$cat_search = "";
			if(isset($_GET['fr']))
				$first = $_GET['fr'];
			if(isset($_GET['sd']))
				$second = $_GET['sd'];
			if(isset($_GET['th']))
				$third = $_GET['th'];
			
			if($first != "" && $third != "" && $second != ""){
				$cat_search = $third;
			}elseif ($first != "" && $third == "" && $second != ""){
				$cat_search = $second;
			}elseif ($first != "" && $third == "" && $second == ""){
				$cat_search = $first;
			}
			
			$cat_search = getChildMainAlias($cat_search);
			
			$price_level = getPriceLevel($dbh);
			getChild_data(getChildMain($cat_search));			
			$str .= '\''.$cat_search.'\'';
		?>
		
		
		<section id="columns" class="columns-container">
			<div class="container">
				<div class="row">
					<section id="center_column" class="col-md-12">
						
						<!-- start header page -->
						
						<div id="breadcrumb" class="clearfix">
							<div class="breadcrumb clearfix">
								<a class="home" href="<?php echo $server; ?>" title="Return to Home"><i class="fa fa-home"></i></a> 
								<span class="navigation-pipe">&gt;</span> 
								<span class="navigation_page">
									<?php 
									
									$cur_cat = "";	
									if($first != "" && $third != "" && $second != ""){										
										echo '<span><a href="'.$server.'/'.$first.'" title=""><span>'.getChildMainAliasName($first).'</span></a></span>';
										echo '<span class="navigation-pipe">&gt;</span>';
										echo '<span><a href="'.$server.'/'.$first.'/'.$second.'" title=""><span>'.getChildMainAliasName($second).'</span></a></span>';
										echo '<span class="navigation-pipe">&gt;</span>';
										echo getChildMainAliasName($third);										
										$cur_cat = getChildMainAliasName($third);										
									}elseif ($first != "" && $third == "" && $second != ""){
										echo '<span><a href="'.$server.'/'.$first.'" title=""><span>'.getChildMainAliasName($first).'</span></a></span>';
										echo '<span class="navigation-pipe">&gt;</span>';
										echo getChildMainAliasName($second);
										$cur_cat = getChildMainAliasName($second);
									}elseif ($first != "" && $third == "" && $second == ""){
										echo '<span><a href="#" title=""><span>'.getChildMainAliasName($first).'</span></a></span>';
										$cur_cat = getChildMainAliasName($first);
									}
									?>
									
								</span>
							</div>
						</div>
						<!-- end header page -->
						
						<!-- start filter data -->
						
						<?php 
							$pros =  listItemByCatByPage($dbh,$str,0,$row_limit,$price_level);
							$count_pro = listItemByCatByPageCount($dbh,$str);
							$index = 0;
							$click_act = ceil($count_pro / $row_limit);
							
						?>
						<div class="content_sortPagiBar clearfix">
							<div class="sortPagiBar clearfix row">
								<div class="col-sm-12">
									<div class="sort">
										<div class="display hidden-xs pull-left">
											<div id="grid">
												<span class="cat-name" style="font-size: 15px;font-weight: 700;text-transform: uppercase;color: #2db6c2;"> <?php echo $cur_cat; ?>&nbsp; </span> 
												<small class="heading-counter">There are <?php echo $count_pro; ?> products.</small>
											</div>
											
										</div>
										<!-- <form action="#" class="productsSortForm form-horizontal pull-right hidden-xs ">
											<div class="select">
												<label for="">Sort by</label> 
												<select class="form-control" id="shortItem">
													<option value="position:asc" selected="selected">--</option>
													<option value="price:asc">Price: Lowest first</option>
													<option value="price:desc">Price: Highest first</option>
													<option value="name:asc">Product Name: A to Z</option>
													<option value="name:desc">Product Name: Z to A</option>
													<option value="reference:asc">Reference: Lowest first</option>
													<option value="reference:desc">Reference: Highest first</option>
												</select>
											</div>
										</form> -->
									</div>
								</div>
								
							</div>
						</div>
						
						<!-- end filter data -->
						
						<div class="" id="data_row_pro">
							
						<?php 
							
							if(count($pros)>0){
								disMainItemStyle($pros, 'col-sm-3 col-xs-12');
							}
							
						?>
							
						</div>
						
						<div class="content_sortPagiBar">
							<div class="bottom-pagination-content clearfix row">
								<div class="col-md-12" style="text-align: center;">
									
									<?php 
										if($count_pro>$row_limit){ 
											echo '<button id="view_more_pro" style="background-color: #2db6c2 !important; border-color: #2db6c2 !important;" class="btn btn-primary"><i class="fa fa-plus-circle"></i> MORE</button>';
										}
									?>
								</div>								
							</div>
							<br>
						</div>
						
					</section>
				</div>
			</div>
		</section>
		<?php include 'layout/footer.php';?>
		
		<script>
			var start = 0;
			var row_limit = <?php echo $row_limit; ?>;
			var count_item_show = row_limit;
			var btn_view_more_can_click = <?php echo $click_act; ?>;
			var btn_view_more_click = 1;
			var total_row = <?php echo $count_pro; ?>;
			var search_text = "<?php echo $str; ?>";	
			var server = '<?php echo $server; ?>';
			var tDis = "list";

			$(function(){
				$("#view_more_pro").click(function(){  
					start += row_limit; btn_view_more_click++;
					if(btn_view_more_click <= btn_view_more_can_click){
						$.ajax({
							url: server+"ajax-list-product",
							method: "POST",
							data: {
								search : search_text,
								start : start,
								row_limit : row_limit
							},success: function(data){
								$("#data_row_pro").append(data);
							}
						});

						if(btn_view_more_click==btn_view_more_can_click){
							$("#view_more_pro").attr("disabled","disabled");
						}
						
					}else{
						$("#view_more_pro").attr("disabled","disabled");
					}
				});

			});


			
		</script>
		
	<div id="errors"></div>	
		
	</section>
	
</body>
</html>