<?php 
	include 'function/item.php';
	$price_level = getPriceLevel($dbh);	
	for($y=0; $y< count($main_cat_dis);$y++){ 		
		getChild_data(getChildMain($main_cat_dis[$y]['var_id']));
		$str .= '\''.$main_cat_dis[$y]['var_id'].'\'';
		$items = listItemByCategory($dbh,$str,10,$price_level);
		$str = "";		
		if(count($items)>0){		
?>
<div class="row">
	<div class="widget col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12">
		<div class="block products_block exclusive leomanagerwidgets">
			<h4 class="title_block">
				<span><?php echo $main_cat_dis[$y]['var_name'];?></span> <br /> 
				<em><?php echo $main_cat_dis[$y]['var_remark'];?></em>
			</h4>
			<div class="block_content row">
				<div id="tab_pro_<?php echo $y; ?>" class="owl-carousel owl-theme grid">				
					<!-- start item -->					
					<?php  displayItem($items); ?>					
					<!-- end item -->
				</div>
				</div>
			</div>
		</div>
		<script>
			/* <![CDATA[ */;
			$(document).ready(function() {
				$("#tab_pro_<?php echo $y; ?>").owlCarousel({
					items : 4,
					singleItem : false,
					itemsScaleUp : false,
					slideSpeed : 200,
					paginationSpeed : 800,
					rewindSpeed : 1000,
					autoPlay : 2000,
					stopOnHover : true,
					navigation : false,
					navigationText : ["&lsaquo;","&rsaquo;" ],
					rewindNav : true,
					scrollPerPage : false,
					pagination : false,
					paginationNumbers : false,
					responsive : true,
					lazyLoad : false,
					lazyFollow : true,
					lazyEffect : "fade",
					autoHeight : false,
					mouseDrag : true,
					touchDrag : true,
					addClassActive : true,
				});
			});/* ]]> */
		</script>
	</div>
<?php }} ?>
</div>