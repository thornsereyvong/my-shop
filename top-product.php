





<?php for($y=0; $y<2;$y++){ ?>
<div class="row">
	<div class="widget col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12">
		<div class="block products_block exclusive leomanagerwidgets">
			<h4 class="title_block">
				<span>Shop Gentlemen</span> <br /> 
				<em>Perennial Favorites from Every Category</em>
			</h4>
			<div class="block_content row">
				<div id="tab_pro_<?php echo $y; ?>" class="owl-carousel owl-theme grid">
				
				<!-- start item -->
					
					<?php for($i=0;$i<10;$i++){ ?>
					
					<div class="ajax_block_product">
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
									<h5 itemprop="name" class="name">
										<a class="product-name" href="<?php echo $server; ?>detail-product.php" title="Faded Short Sleeve T-shirts" itemprop="url">
											Faded Short Sleeve T-shirts 
										</a>
									</h5>
									<p class="product-desc" itemprop="description">Faded
										short sleeve t-shirt with high neckline. Soft and
										stretchy material for a comfortable fit. Accessorize
										with a straw hat and you're ready for summer!</p>
									<div class="content_price">
										<span itemprop="price" class="price product-price">
											$16.51 </span>
										<meta itemprop="priceCurrency" content="USD" />
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
</div>

<?php } ?>