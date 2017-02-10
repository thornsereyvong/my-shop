
<?php 
	include 'app.php';
	include 'function/item.php';
	$price_level = getPriceLevel($dbh);
	$var_alias = "";
	if(isset($_GET['fr']))
		$var_alias = $_GET['fr'];
		
	$items = listItemByAlias($dbh,$var_alias,$price_level);
	
	$group = "";
	$itemId = "";
	if(count($items)>0){
		$itemId = $items[0]['var_id'];
		$group = $items[0]['var_categoryid'];
	}
	
	$items_relate = listItemByCatId($dbh,$group,$itemId, 10,$price_level);
	

?>

<!DOCTYPE HTML>
<html lang="en-us" class="default">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>

<?php include 'layout/head.php';?>


</head>
<body class="">
	
	<section id="page" data-column="col-xs-12 col-sm-6 col-md-4" data-type="grid">
				
		<?php include 'layout/header.php';?>
		<div class="s-detail-product"></div>
		
		
		<section id="columns" class="columns-container">
			<div class="container">
				<div class="row">
					<section id="center_column" class="col-md-12">
						<div id="breadcrumb" class="clearfix">
							<div class="breadcrumb clearfix">
								<a class="home" href="<?php echo $server; ?>" title="Return to Home"><i class="fa fa-home"></i></a> <span
									class="navigation-pipe">&gt;</span> <?php echo $items[0]['var_name']; ?>
							</div>
						</div>
						<div class="primary_block row">
							<div class="container">
								<div class="top-hr"></div>
							</div>
							<div class="pb-left-column col-xs-12 col-sm-12 col-md-5">
								<div id="image-block" class="clearfix">
									<!-- <div class="p-label">
										<span class="label-new label label-info">New</span>
									</div> -->
									<span id="view_full_size"> 
										<img id="bigpic" src="<?php echo $server; ?>img/product/1/blouse.jpg" title="" alt="" /> 
										<span class="span_link no-print status-enable btn btn-outline"></span>
									</span>
								</div>
								<div id="views_block" class="clearfix ">
									<div id="thumbs_list">
										<ul id="thumbs_list_frame">
											<?php for($i=0;$i<5;$i++){?>
											<li id="thumbnail_<?php echo $i; ?>">
												<a href="<?php echo $server; ?>img/product/1/blouse.jpg" data-fancybox-group="other-views" class="fancybox shown" title="<?php echo $i;?>"> 
													<img class="img-responsive" id="thumb_173" src="<?php echo $server; ?>img/product/1/blouse.jpg" alt="<?php echo $i;?>" title="<?php echo $i;?>"  />
												</a>
											</li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>
							
							<div class="pb-center-column col-xs-12 col-sm-7 col-md-7">
								<p class="socialsharing_product list-inline no-print">
									<button data-type="twitter" type="button"
										class="btn btn-outline btn-twitter social-sharing">
										<i class="fa fa-twitter"></i> Tweet
									</button>
									<button data-type="facebook" type="button"
										class="btn btn-outline btn-facebook social-sharing">
										<i class="fa fa-facebook"></i> Share
									</button>
									<button data-type="google-plus" type="button"
										class="btn btn-outline btn-google-plus social-sharing">
										<i class="fa fa-google-plus"></i> Google+
									</button>
									<button data-type="pinterest" type="button"
										class="btn btn-outline btn-pinterest social-sharing">
										<i class="fa fa-pinterest"></i> Pinterest
									</button>
								</p>
								<p id="">
									<label>Reference: </label> 
									<span class="editable"><?php echo $items[0]['var_id']; ?></span>
								</p>
								<!-- <p id="product_condition">New</p> -->
								<div id="">
									<div id="short_description_content" class="rte align_justify" >
										<p>
											<?php echo $items[0]['var_remark']; ?>
										</p>
									</div>
								</div>
								<ul id="usefull_link_block"
									class="clearfix no-print list-inline">
									<li class="sendtofriend">
										<a id="send_friend_button" href="#send_friend_form"> Send to a friend </a>
										<div style="display: none;">
											<div id="send_friend_form">
												<h2 class="page-subheading">Send to a friend</h2>
												<div class="row">
													<div class="product clearfix col-xs-12 col-sm-6">
														<!-- <img src="" alt="Printed Dress" /> -->
														<div class="product_desc">
															<p class="product_name">
																<strong><?php echo $items[0]['var_name']; ?></strong>
															</p>
															<p><?php echo $items[0]['var_remark']; ?></p>
														</div>
													</div>
													<div class="send_friend_form_content col-xs-12 col-sm-6" id="send_friend_form_content">
														<div id="send_friend_form_error"></div>
														<div id="send_friend_form_success"></div>
														<div class="form_container">
															<p class="intro_form">Recipient : <?php echo $items[0]['var_id']; ?></p>
															<p class="text">
																<label for="friend_name"> Name of your friend <sup
																	class="required">*</sup> :
																</label> <input id="friend_name" name="friend_name" type="text"
																	value="" class="form-control" />
															</p>
															<p class="text">
																<label for="friend_email"> E-mail address of
																	your friend <sup class="required">*</sup> :
																</label> <input id="friend_email" name="friend_email"
																	type="text" value="" class="form-control" />
															</p>
															<p class="txt_required">
																<sup class="required">*</sup> Required fields
															</p>
														</div>
														<p class="submit">
															<button id="sendEmail"
																class="btn button button-small btn-sm" name="sendEmail"
																type="submit">
																<span>Send</span>
															</button>
															&nbsp; or&nbsp; <a class="closefb" href="#"> Cancel </a>
														</p>
													</div>
												</div>
											</div>
										</div></li>
									
									</a></li>
								</ul>
							</div>
							
							<div class="pb-right-column col-xs-12 col-sm-7 col-md-7">
								<form id="" action="#" zmethod="post">
									
									<div class="box-info-product">
										<div id="attributes">
											<div class="clearfix"></div>
											<fieldset class="attribute_fieldset">
												<label class="attribute_label" for="size_product">Size&nbsp;</label>
												<div class="attribute_list">
													<select id="size_product" name="size_product" class="form-control" >
														<option value="1" selected="selected" title="S">S</option>
														<option value="2" title="M">M</option>
														<option value="3" title="L">L</option>
													</select>
												</div>
											</fieldset>
											<fieldset class="attribute_fieldset">
												<label class="attribute_label">Color&nbsp;</label>
												<div class="attribute_list">
													
													<button type="button" style="border:1px solid black; width:30px; height:30px; background-color: #2db6c2 !important; " class="btn btn-primary"></button>
													<button type="button" style="width:30px; height:30px; background-color: #2db6c2 !important; " class="btn btn-primary"></button>
													<button type="button" style="width:30px; height:30px; background-color: #2db6c2 !important; " class="btn btn-primary"></button>
													<button type="button" style="width:30px; height:30px; background-color: #2db6c2 !important; " class="btn btn-primary"></button>
													
												</div>
											</fieldset>
										</div>
										<div class="content_prices clearfix">
											<div class="price">
												<p class="our_price_display" >
													<link itemprop="availability" href="#" />
													<span id="" itemprop="price">$ 2424</span>
													<meta itemprop="priceCurrency" content="USD" />
												</p>
											</div>
											<div class="clear"></div>
										</div>
										<div class="clearfix"></div>
										<div class="product_attributes clearfix">
											<p id="quantity_wanted_p">
												<input type="text" name="qty" id="quantity_wanted" class="text form-control" value="1" /> 
												<a href="#" data-field-qty="qty" class="btn btn-outline status-enable button-minus btn-sm product_quantity_down">
													<span><i class="fa fa-minus"></i></span>
												</a> 
												<a href="#" data-field-qty="qty" class="btn btn-outline status-enable button-plus btn-sm product_quantity_up ">
													<span><i class="fa fa-plus"></i></span>
												</a> 
												<a href="#" class="btn btn-outline status-enable button-plus btn-sm product_quantity_up ">
													<span>ADD TO ORDER</span>
												</a> 
												<span class="clearfix"></span>
											</p>
											<p id="minimal_quantity_wanted_p" style="display: none;">
												The minimum purchase order quantity for the product is <b
													id="minimal_quantity_label">1</b>
											</p>
											
										</div>
										
										<!-- <div class="box-cart-bottom">
											<p class="buttons_bottom_block no-print">
												<a id="wishlist_button" href="#"  rel="nofollow" title="Add to my wishlist"> Add to
													wishlist </a>
											</p>
											
											<strong></strong>
										</div> -->
									</div>
								</form>
							</div>
						</div>
						
						
						<!-- description -->
						
						<ul class="nav nav-tabs tab-info page-product-heading">
							<!-- <li class="active">
								<a href="#tab2" data-toggle="tab">More info</a></li> -->
							<!-- <li><a href="#tab3" data-toggle="tab">Data sheet</a></li> -->
						</ul>
						<!-- <div class="tab-content">
							<section id="tab2" class="tab-pane page-product-box active">
								<div class="rte">
									<p>---------</p>
								</div>
							</section>
							<section id="tab3" class="tab-pane page-product-box">
								<table class="table-data-sheet">
									<tr class="odd">
										<td>Compositions</td>
										<td>Viscose</td>
									</tr>
								</table>
							</section>
						</div> -->
						<!-- end desciption -->
						
						<?php include 'related-product.php';?>
						
						
					</section>
				</div>
			</div>
		</section>
		<?php include 'layout/footer.php';?>
	</section>
	<script>

		var dataObj = '<?php if(count($items)>0) echo json_encode($items); ?>';

	 	var dataObj = JSON.parse(dataObj);

		
	</script>
	
	
	
</body>
</html>