
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
		/* <![CDATA[ */;
		var page_name='category';		
		/* ]]> */
	</script>


</head>
<body class="">
	
	<section id="page" data-column="col-xs-12 col-sm-6 col-md-4" data-type="grid">
				
		<?php include 'layout/header.php';?>
		<div class="s-detail-product"></div>
		
		<?php 		
			$price_level = getPriceLevel($dbh);
			getChild_data(getChildMain('WOMEN'));
			
			$str .= '\'WOMEN\'';
			$items = listItemByCategory($dbh,$str,10,$price_level);
			//echo "<pre>";
			//print_r(getChildMain('WOMEN'));
			//echo "</pre>";
			//print_r($items);
		//exit();
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
									<span>
										<a href="#" title="">
											<span>Women</span>
										</a>
									</span>
									<span class="navigation-pipe">&gt;</span>
									Tops
								</span>
							</div>
						</div>
						<!-- end header page -->
						
						<h1 class="page-heading product-listing">
							<span class="cat-name"> Tops&nbsp; </span> 
							<small class="heading-counter">There are 3 products.</small>
						</h1>
						
						
						<!-- start filter data -->
						
						<div class="content_sortPagiBar clearfix">
							<div class="sortPagiBar clearfix row">
								<div class="col-sm-12">
									<div class="sort">
										<div class="display hidden-xs pull-left">
											<div id="grid">
												<a rel="nofollow" href="#" title="Grid"><i class="fa fa-th-large"></i></a>
											</div>
											<div id="list">
												<a rel="nofollow" href="#" title="List"><i class="fa fa-th-list"></i></a>
											</div>
										</div>
										<form action="#" class="productsSortForm form-horizontal pull-right hidden-xs ">
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
										</form>
									</div>
								</div>
								
							</div>
						</div>
						
						<!-- end filter data -->
						
						<div class="">
							
							<?php // displayItem($items); ?>	
							
							
							
							<?php for($i=0;$i<10;$i++){ ?>
					
								<div class="col-sm-3 col-xs-12">
									<div class="product-container product-block text-center" >
										<div class="left-block">
											<div class="product-image-container image ImageWrapper">
												<div class="leo-more-info" data-idproduct="1"></div>
												<a class="product_img_link" href="<?php echo $server; ?>detail-product.php" title="Faded Short Sleeve T-shirts" itemprop="url">
													<img class="replace-2x img-responsive" src="<?php echo $server; ?>img/product/1/faded-short-sleeve-tshirts.jpg" alt="....." title="...." itemprop="image" />
													
													<span class="product-additional" data-idproduct="1">
														<img class="replace-2x img-responsive" src="<?php echo $server; ?>img/product/1/blouse.jpg" alt="....." title="...." itemprop="image" />
													</span>
												</a>
												
												<span class="label-new label-info label">New</span>
											</div>
										</div>
										<div class="right-block">
											<div class="product-meta">
												<h5 class="name">
													<a class="product-name" href="<?php echo $server; ?>detail-product.php" title="Faded Short Sleeve T-shirts" itemprop="url">
														Faded Short Sleeve T-shirts 
													</a>
												</h5>
												<p class="product-desc" >Faded
													short sleeve t-shirt with high neckline. Soft and
													stretchy material for a comfortable fit. Accessorize
													with a straw hat and you're ready for summer!</p>
												<div class="content_price">
													<span class="price product-price">
														$<?php echo $i; ?> </span>
													
												</div>
												<div class="product-flags"></div>
												<div class="functional-buttons clearfix">
													
													<div class="cart">
														<a class="button ajax_add_to_cart_button btn"
															href="#"
															rel="nofollow" title="Add to cart"
															data-id-product="1" data-minimal_quantity="1"> <i
															class="fa fa-shopping-cart"></i> <span>Add to
																order</span>
														</a>
													</div>
													
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
							
						</div>
						
						
						<div class="content_sortPagiBar">
							<div class="bottom-pagination-content clearfix row">
								<div class="col-md-10 col-sm-8 col-xs-6">
									<div class="pagination clearfix">
										
									</div>
								</div>								
							</div>
						</div>
						
						
						
					</section>
				</div>
			</div>
		</section>
		<?php include 'layout/footer.php';?>
	</section>
	
</body>
</html>