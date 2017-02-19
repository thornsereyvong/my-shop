
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
	$size = array();
	$color = array();
	$curColor = "";
	$curSize = "";
	if(count($items)>0){
		$itemId = $items[0]['var_id'];
		$group = $items[0]['var_categoryid'];
		
		$s = $items[0]['Size'];
		$c = $items[0]['Color'];
		$curColor = $c;
		$curSize = $s;
		$size[] = $s;
		$color[] = $c;
		for ($i=0; $i<count($items); $i++){
			if($s != $items[$i]['Size'])
				$size[] = $items[$i]['Size'];
			
			if($c != $items[$i]['Color'])
				$color[] = $items[$i]['Color'];
		}
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
		<?php 				
		//echo "<pre>";
			
			//print_r($items);
			
		//echo "</pre>";
		?>
		
		<section id="columns" class="columns-container">
			<div class="container">
				<div class="row">
					<section id="center_column" class="col-md-12">
						<div id="breadcrumb" class="clearfix">
							<div class="breadcrumb clearfix">
								<a class="home" href="<?php echo $server; ?>" title="Return to Home"><i class="fa fa-home"></i></a> 
								<span class="navigation-pipe">&gt;</span>
								<?php echo $items[0]['var_name']; ?>
							</div>
						</div>
						<div class="primary_block row">
							<div class="container">
								<div class="top-hr"></div>
							</div>
							<div class="pb-left-column col-xs-12 col-sm-12 col-md-5">
								<div id="image-block" class="clearfix">
									<div class="p-label">
										<span class="label-new label label-info"></span>
									</div>
									<span id="view_full_size"> 
										<img id="bigpic" src="<?php echo $server; ?>img/product/1/blouse.jpg" title="..." alt="..." /> 
										<span class="span_link no-print status-enable btn btn-outline"></span>
									</span>
								</div>
								<div id="views_block" class="clearfix ">
									<span class="view_scroll_spacer"> 
										<a id="view_scroll_left" class="" title="Other views" href="javascript:{}"> Previous </a>
									</span>
									<div id="thumbs_list">
										<ul id="thumbs_list_frame">
											<?php for($i=0;$i<3;$i++){?>
											<li id="">
												<a href="<?php echo $server; ?>img/product/1/blouse.jpg" data-fancybox-group="other-views" class="fancybox shown" title="<?php echo $i; ?>"> 
													<img class="img-responsive" id="" src="<?php echo $server; ?>img/product/1/blouse.jpg" alt="<?php echo $i; ?>" title="<?php echo $i; ?>"  />
												</a>
											</li>
											<?php } ?>
										</ul>
									</div>
									<a id="view_scroll_right" title="Other views" href="javascript:{}"> Next </a>
								</div>
								<p class="resetimg clear no-print">
									<span id="wrapResetImages" style="display: none;"> 
									<a href="#" name="resetImages"> 
										<i class="fa fa-repeat"></i> Display all pictures
									</a>
									</span>
								</p>
							</div>
							
							
							
							<div class="pb-center-column col-xs-12 col-sm-7 col-md-7">
								<h1 itemprop="name"><?php echo $items[0]['var_name']; ?></h1>
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
									<span class="editable" itemprop="sku"><?php echo $items[0]['var_id']; ?></span>
								</p>
								<p id="product_condition"></p>
								<div id="short_description_block">
									<div id="short_description_content" class="rte align_justify" itemprop="description">
										<p><?php echo $items[0]['var_remark']; ?></p>
									</div>
								</div>
								<p id="availability_statut">
									<span id="availability_value"></span>
								</p>
								<p id="availability_date" style="display: none;">
									<span id="availability_date_label">Availability date:</span> <span
										id="availability_date_value"></span>
								</p>
								<div id="oosHook" style="display: none;"></div>
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
															<p class="intro_form">Recipient :</p>
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
														<?php 
															foreach ($size as $s){
																echo '<option value="'.$s.'" title="'.$s.'">'.$s.'</option>';
															}
														?>
													</select>
												</div>
											</fieldset>
											<br>
											<fieldset class="attribute_fieldset">
												<label class="attribute_label">Color&nbsp;</label>
												<div class="attribute_list">
													<?php 
														$x = 0;
														foreach ($color as $c){ $x++;
															if($x ==1)
																echo '<button id="btnColor'.$x.'" onclick="colorChange(\''.$x.'\',\''.$c.'\')" type="button" style="border:2px solid #357ebd; width:30px; height:30px; background-color: '.$c.' !important; " class="btn btn-primary"></button>';
															else
																echo '&nbsp;&nbsp;<button id="btnColor'.$x.'"  type="button" onclick="colorChange(\''.$x.'\',\''.$c.'\')" style="width:30px; height:30px; border:0px; background-color: '.$c.' !important; " class="btn btn-primary"></button>';
														}
													?>
												</div>
											</fieldset>
										</div>
										<br>
										<div class="content_prices clearfix">
											<div class="price">
												<p class="our_price_display" >
													<link itemprop="availability" href="#" />
													<?php 
														if($items[0]['price_com']>0){
															echo '<span id="" itemprop="price"><em><del>$ '.number_format($items[0]['price_web'],2).'</del></em>&nbsp;&nbsp;</span>';
															echo '<span id="" itemprop="price" style="color:#2db6c2;"><i>$ '.number_format($items[0]['price_com'],2).'</i></span>';
														}
													?>
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
												The minimum purchase order quantity for the product is 
												<b id="minimal_quantity_label">1</b>
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
							<div class="pb-right-column col-xs-12 col-sm-7 col-md-7" style="display:none;">
								<form id="buy_block" action="#" method="post">
									<p class="hidden">
										<input type="hidden" name="token" value="e5c389008168788b1efa3b314b1a6868" /> 
										<input type="hidden" name="id_product" value="4" id="product_page_product_id" /> 
										<input type="hidden" name="add" value="1" /> 
										<input type="hidden" name="id_product_attribute" id="idCombination" value="" />
									</p>
									
									<div class="box-info-product">
										<div class="content_prices clearfix">
											<div class="price">
												<p class="our_price_display" >
													<link itemprop="availability" href="#" />
													<span id="our_price_display" itemprop="price">$50.99</span>
													<meta itemprop="priceCurrency" content="USD" />
												</p>
												<p id="reduction_percent" style="display: none;">
													<span id="reduction_percent_display"> </span>
												</p>
												<p id="old_price" class="hidden">
													<span id="old_price_display">$50.99</span>
												</p>
											</div>
											<p id="reduction_amount" style="display: none">
												<span id="reduction_amount_display"> </span>
											</p>
											<div class="clear"></div>
										</div>
										<div class="product_attributes clearfix">
											<p id="quantity_wanted_p">
												<input type="text" name="qty" id="quantity_wanted" class="text form-control" value="1" /> 
												<a href="#" data-field-qty="qty" class="btn btn-outline status-enable button-minus btn-sm product_quantity_down">
													<span><i class="fa fa-minus"></i></span>
												</a> 
												<a href="#" data-field-qty="qty" class="btn btn-outline status-enable button-plus btn-sm product_quantity_up ">
													<span><i class="fa fa-plus"></i></span>
												</a> 
												<span class="clearfix"></span>
											</p>
											<p id="minimal_quantity_wanted_p" style="display: none;">
												The minimum purchase order quantity for the product is 
												<b id="minimal_quantity_label">1</b>
											</p>
											<div class="box-cart-bottom">
												<div>
													<p id="add_to_cart" class="buttons_bottom_block no-print">
														<button type="submit" name="Submit"
															class="exclusive btn btn-outline status-enable">
															<span>Add to order</span>
														</button>
													</p>
												</div>
											</div>
											<div id="attributes">
												<div class="clearfix"></div>
												<fieldset class="attribute_fieldset">
													<label class="attribute_label" for="group_1">Size&nbsp;</label>
													<div class="attribute_list">
														<select class="form-control attribute_select no-print" name="group_1" id="group_1">
															<option value="1" selected="selected" title="S">S</option>
															<option value="2" title="M">M</option>
															<option value="3" title="L">L</option>
														</select>
													</div>
												</fieldset>
												<fieldset class="attribute_fieldset">
													<label class="attribute_label">Color&nbsp;</label>
													<div class="attribute_list">
														<ul id="color_to_pick_list" class="clearfix">
															<li class="selected">
																<a href="#" id="color_7" name="Beige" class="color_pick selected" style="background: #f5f5dc;" title="Beige"> </a>
															</li>
															<li>
																<a href="4-printed-dress.html" id="color_24" name="Pink" class="color_pick" style="background: #FCCACD;" title="Pink"> </a>
															</li>
														</ul>
														<input type="hidden" class="color_pick_hidden" name="group_3" value="7" />
													</div>
												</fieldset>
											</div>
										</div>
										<div class="box-cart-bottom">
											<p class="buttons_bottom_block no-print">
												<a id="wishlist_button" href="#"  rel="nofollow" title="Add to my wishlist"> Add to wishlist </a>
											</p>
											<strong></strong>
										</div>
									</div>
								</form>
							</div>
						</div>
						
						
						<!-- description -->
						
						
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
		var cur_color = '<?php echo $curColor;?>';
		var cur_size = '<?php echo $curSize;?>';
		var cur_color_index = 1;
		function colorChange(index,color){
			$("#btnColor"+cur_color_index).attr("style","width:30px; height:30px; border:0px; background-color: "+cur_color+" !important; ");
			$("#btnColor"+index).attr('style',"border:2px solid #357ebd; width:30px; height:30px; background-color: "+color+" !important; ")
			cur_color = color;
			cur_color_index = index;
		}
	 	
		
	</script>
	
	
	
</body>
</html>