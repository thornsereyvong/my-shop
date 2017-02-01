<div class="page-product-box blockproductscategory products_block block ">
	<h4 class="title_block">
		<span>Related Products</span>
	</h4>
	<div id="productscategory_list" class="clearfix product_list grid">
		<div class="block_content">
			<div class=" carousel slide" id="blockproductscategory">
				<a class="carousel-control left" href="#blockproductscategory" data-slide="prev"> </a> 
				<a class="carousel-control right" href="#blockproductscategory" data-slide="next"> </a>
				<div class="carousel-inner">
					
					<?php for($i=0;$i<3;$i++){ ?>
					
					<div class="item <?php if($i==0) echo 'active'; ?>">
						<div class="row clearfix">
							<?php for($i=0;$i<4;$i++){?>
							<!-- A item -->
							
							<div class="col-sm-3 col-xs-12 product_block ajax_block_product">
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
						
							<!-- end item -->
							<?php } ?>
						</div>
					</div>
					
					<?php } ?>
					
				</div>
			</div>
		</div>
	</div>
</div>