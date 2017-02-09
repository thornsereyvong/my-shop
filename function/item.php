<?php
function listAllItem($dbh){
	$data=array();
	try{
		$sql = "
				SELECT g.var_id, g.var_name, g.var_remark, i.var_urlimg,
						i.var_id AS ItemID,i.var_name AS ItemName,i.var_barcode AS Barcode,itf.var_uomid AS UOM,i.var_sizeid AS Size, i.var_colorid AS Color,
				       (SELECT ip.dou_price FROM config_item_price ip WHERE ip.var_id = i.var_id AND ip.var_uomid = itf.var_uomid LIMIT 1) AS UnitPrice
				FROM config_item_group g
				LEFT JOIN config_item i on g.var_id=i.var_groupid
				LEFT JOIN config_item_factor itf ON i.var_id = itf.var_id
				WHERE g.tin_inactive = 0 AND i.tin_inactive = 0
				ORDER BY g.var_id				
			   ";
		$req = $dbh->prepare($sql);
		$req->execute();
		$num = $req->rowCount();
		if($num != 0){
			while($rows = $req->fetch(PDO::FETCH_ASSOC)){
				$data[] = $rows;
			}
			return $data;
		}
		$req->closeCursor();
	}catch(PDOException $cus){
		return $data;
	}
}

function listItemByCategory($dbh,$cat, $top,$price_level){
	$data=array();
	try{
		$sql = "
				SELECT tbl_item.* , MIN(tbl_item.price_web) 'min_price' 
				FROM 
				       (SELECT g.var_id, g.var_name, g.var_remark,g.datt_createdate, i.var_urlimg, i.var_id AS ItemID,i.var_name AS ItemName,i.var_barcode AS Barcode,itf.var_uomid AS UOM,i.var_sizeid AS Size, i.var_colorid AS Color, 
					   COALESCE((SELECT ip.dou_price FROM config_item_price ip WHERE ip.var_id = i.var_id AND ip.var_uomid = itf.var_uomid AND ip.var_pricelevelid = '".$price_level['com_price']."' LIMIT 1) ,0) AS price_com, 
				       COALESCE((SELECT ip.dou_price FROM config_item_price ip WHERE ip.var_id = i.var_id AND ip.var_uomid = itf.var_uomid AND ip.var_pricelevelid = '".$price_level['web_price']."' LIMIT 1) ,0) AS price_web
				FROM (SELECT * FROM config_item_group WHERE var_categoryid in ($cat) AND tin_inactive =0 LIMIT $top) as g 
				LEFT JOIN config_item i on g.var_id=i.var_groupid 
				LEFT JOIN config_item_factor itf ON i.var_id = itf.var_id 
				WHERE g.tin_inactive = 0 AND i.tin_inactive = 0
				ORDER BY g.datt_createdate desc,g.var_id) as tbl_item
				GROUP BY tbl_item.var_id
				ORDER BY tbl_item.datt_createdate desc
	   	";
		
		$req = $dbh->prepare($sql);
		$req->execute();
		$num = $req->rowCount();
		if($num != 0){
			while($rows = $req->fetch(PDO::FETCH_ASSOC)){
				$data[] = $rows;				
			}
			return $data;
		}
		$req->closeCursor();
	}catch(PDOException $cus){
		return $data;
	}
}

function listItemByCatId($dbh,$group,$itemId, $top,$price_level){
	$data=array();
	try{
		$sql = "
				SELECT tbl_item.* , MIN(tbl_item.price_web) 'min_price'
				FROM
			       (SELECT g.var_id, g.var_name, g.var_remark, i.var_urlimg, i.var_id AS ItemID,i.var_name AS ItemName,i.var_barcode AS Barcode,itf.var_uomid AS UOM,i.var_sizeid AS Size, i.var_colorid AS Color,
				   COALESCE((SELECT ip.dou_price FROM config_item_price ip WHERE ip.var_id = i.var_id AND ip.var_uomid = itf.var_uomid AND ip.var_pricelevelid = '".$price_level['com_price']."' LIMIT 1) ,0) AS price_com,
			       COALESCE((SELECT ip.dou_price FROM config_item_price ip WHERE ip.var_id = i.var_id AND ip.var_uomid = itf.var_uomid AND ip.var_pricelevelid = '".$price_level['web_price']."' LIMIT 1) ,0) AS price_web
			       FROM (SELECT * FROM config_item_group WHERE var_categoryid = :group AND tin_inactive =0 AND var_id  <> :z LIMIT $top) as g
			       LEFT JOIN config_item i on g.var_id=i.var_groupid
			       LEFT JOIN config_item_factor itf ON i.var_id = itf.var_id
			       WHERE g.tin_inactive = 0 AND i.tin_inactive = 0
			       ORDER BY g.datt_createdate desc,g.var_id) as tbl_item
			       GROUP BY tbl_item.var_id
			       ";
			
	       $req = $dbh->prepare($sql);
	       $req->bindParam(":group", $group);
	       $req->bindParam(":itemId", $itemId);
	       $req->execute();
	       $num = $req->rowCount();
	       if($num != 0){
	       	while($rows = $req->fetch(PDO::FETCH_ASSOC)){
	       		$data[] = $rows;
	       	}
	       	return $data;
	       }
	       $req->closeCursor();
	}catch(PDOException $cus){
		return $data;
	}
}


function listItemByItemGroup($dbh,$group, $price_level){
	$data=array();
	try{
		$sql = "
				SELECT g.var_id, g.var_name, g.var_remark, g.var_categoryid, i.var_urlimg, i.var_id AS ItemID,i.var_name AS ItemName,i.var_barcode AS Barcode,itf.var_uomid AS UOM,i.var_sizeid AS Size, i.var_colorid AS Color, 
				       COALESCE((SELECT ip.dou_price FROM config_item_price ip WHERE ip.var_id = i.var_id AND ip.var_uomid = itf.var_uomid AND ip.var_pricelevelid = '".$price_level['com_price']."' LIMIT 1) ,0) AS price_com, 
				       COALESCE((SELECT ip.dou_price FROM config_item_price ip WHERE ip.var_id = i.var_id AND ip.var_uomid = itf.var_uomid AND ip.var_pricelevelid = '".$price_level['web_price']."' LIMIT 1) ,0) AS price_web 
				FROM (SELECT * FROM config_item_group WHERE var_id= :group AND tin_inactive =0) as g 
				
				LEFT JOIN config_item i on i.var_groupid = :group
				LEFT JOIN config_item_factor itf ON i.var_id = itf.var_id 
				
				WHERE g.tin_inactive = 0 AND i.tin_inactive = 0 
				ORDER BY g.datt_createdate desc,g.var_id
	       ";

       $req = $dbh->prepare($sql);
       $req->bindParam(":group", $group);
       $req->execute();
       $num = $req->rowCount();
       if($num != 0){
       		while($rows = $req->fetch(PDO::FETCH_ASSOC)){
       		$data[] = $rows;
       }
       return $data;
    }
       $req->closeCursor();
	}catch(PDOException $cus){
		return $data;
	}
}
function getPriceLevel($dbh){
	$data=array();
	try{
		$sql = "call sp_loading_price_level()";
		$req = $dbh->prepare($sql);
		$req->execute();
		$num = $req->rowCount();
		if($num != 0){
			while($rows = $req->fetch(PDO::FETCH_ASSOC)){
				return $rows;
			}
			return $data;
		}
		$req->closeCursor();
	}catch(PDOException $cus){
		return $data;
	}	
}

function displayItem($data){	
	if(count($data)>0){
		$group = $data[0]['var_id'];
		disMainItem($data[0]);
		for($i=0; $i<count($data); $i++){
			if($group != $data[$i]['var_id']){				
				disMainItem($data[$i]);
				$group = $data[$i]['var_id'];
			}else{
				
			}			
		}		
	}
}

function disMainItem($data){
	global $server;	
	echo '<div class="ajax_block_product">';
		echo '<div class="product-container product-block text-center" >';
			echo '<div class="left-block">';
				echo '<div class="product-image-container image ImageWrapper">';
				echo '<div class="leo-more-info" data-idproduct="1"></div>';
				echo '<a class="product_img_link" href="'.$server.'detail-product.php" title="Faded Short Sleeve T-shirts" itemprop="url">';
					echo '<img class="replace-2x img-responsive" src="'.$server.'img/product/1/faded-short-sleeve-tshirts.jpg" alt="'.$data['var_name'].'" title="'.$data['var_name'].'" itemprop="image" />';
					echo '<span class="product-additional" data-idproduct="1">';							
						echo '<img class="replace-2x img-responsive" src="'.$server.'img/product/1/blouse.jpg" alt="'.$data['var_name'].'" title="'.$data['var_name'].'" itemprop="image" />';					
					echo '</span>';
				echo '</a>';
			echo '</div>';
		echo '</div>';
		echo '<div class="right-block"><div class="product-meta"><h5 itemprop="name" class="name">';	
		echo '<a class="product-name" href="'.$server.'detail-product.php" title="'.$data['var_name'].'" itemprop="url">'.$data['var_name'].'</a>';	
		echo '</h5>';
		
		if($data['var_remark']!='')
			echo '<p class="product-desc" itemprop="description">'.$data['var_remark'].'</p>';
		
		if($data['min_price'] <= 0)
			echo '<div class="content_price"><span itemprop="price" class="price product-price"><small>Ask for Price</small></span><meta itemprop="priceCurrency" content="USD" /></div>';
		else 
			echo '<div class="content_price"><span itemprop="price" class="price product-price">$'.$data['min_price'].'</span><meta itemprop="priceCurrency" content="USD" /></div>';
		
		echo '<div class="product-flags"></div>';
		echo '<div class="functional-buttons clearfix">';
		echo '<div class="cart">';
		echo '<a class="button ajax_add_to_cart_button btn" href="#" rel="nofollow" title="Add to cart" data-id-product="1" data-minimal_quantity="1"> <i class="fa fa-shopping-cart"></i> <span>Add to order</span></a>';						
		echo '</div></div></div></div></div></div>';	
}

function disMainItemStyle($datas, $style){
	global $server;
	if(count($datas)>0){		
		for($i=0; $i<count($datas); $i++){
			$data = $datas[$i];
			echo '<div class="'.$style.'  ajax_block_product">';
			echo '<div class="product-container product-block text-center" >';
			echo '<div class="left-block">';
			echo '<div class="product-image-container image ImageWrapper">';
			echo '<div class="leo-more-info" data-idproduct="1"></div>';
			echo '<a class="product_img_link" href="'.$server.'detail-product.php" title="Faded Short Sleeve T-shirts" itemprop="url">';
			echo '<img class="replace-2x img-responsive" src="'.$server.'img/product/1/faded-short-sleeve-tshirts.jpg" alt="'.$data['var_name'].'" title="'.$data['var_name'].'" itemprop="image" />';
			echo '<span class="product-additional" data-idproduct="1">';
			echo '<img class="replace-2x img-responsive" src="'.$server.'img/product/1/blouse.jpg" alt="'.$data['var_name'].'" title="'.$data['var_name'].'" itemprop="image" />';
			echo '</span>';
			echo '</a>';
			echo '</div>';
			echo '</div>';
			echo '<div class="right-block"><div class="product-meta"><h5 itemprop="name" class="name">';
			echo '<a class="product-name" href="'.$server.'detail-product.php" title="'.$data['var_name'].'" itemprop="url">'.$data['var_name'].'</a>';
			echo '</h5>';
			
			if($data['var_remark']!='')
				echo '<p class="product-desc" itemprop="description">'.$data['var_remark'].'</p>';
			
				if($data['min_price'] <= 0)
					echo '<div class="content_price"><span itemprop="price" class="price product-price"><small>Ask for Price</small></span><meta itemprop="priceCurrency" content="USD" /></div>';
					else
						echo '<div class="content_price"><span itemprop="price" class="price product-price">$'.$data['min_price'].'</span><meta itemprop="priceCurrency" content="USD" /></div>';
			
						echo '<div class="product-flags"></div>';
						echo '<div class="functional-buttons clearfix">';
						echo '<div class="cart">';
						echo '<a class="button ajax_add_to_cart_button btn" href="#" rel="nofollow" title="Add to cart" data-id-product="1" data-minimal_quantity="1"> <i class="fa fa-shopping-cart"></i> <span>Add to order</span></a>';
						echo '</div></div></div></div></div></div>';
		}
	}
	
	
}


function listItemByCatByPage($dbh,$str, $start,$num_row,$price_level){
	$data=array();
	try{
		$sql = "
				SELECT tbl_item.* , MIN(tbl_item.price_web) 'min_price'
				FROM
				       (SELECT g.var_id, g.var_name, g.var_remark,g.datt_createdate, i.var_urlimg, i.var_id AS ItemID,i.var_name AS ItemName,i.var_barcode AS Barcode,itf.var_uomid AS UOM,i.var_sizeid AS Size, i.var_colorid AS Color,
					   COALESCE((SELECT ip.dou_price FROM config_item_price ip WHERE ip.var_id = i.var_id AND ip.var_uomid = itf.var_uomid AND ip.var_pricelevelid = '".$price_level['com_price']."' LIMIT 1) ,0) AS price_com,
				       COALESCE((SELECT ip.dou_price FROM config_item_price ip WHERE ip.var_id = i.var_id AND ip.var_uomid = itf.var_uomid AND ip.var_pricelevelid = '".$price_level['web_price']."' LIMIT 1) ,0) AS price_web
				       FROM (SELECT * FROM config_item_group WHERE var_categoryid in ($str) AND tin_inactive =0 ORDER BY datt_createdate desc LIMIT $start, $num_row) as g
				       LEFT JOIN config_item i on g.var_id=i.var_groupid
				       LEFT JOIN config_item_factor itf ON i.var_id = itf.var_id
				       WHERE g.tin_inactive = 0 AND i.tin_inactive = 0
				       ORDER BY g.datt_createdate desc,g.var_id) as tbl_item
		       GROUP BY tbl_item.var_id
		       ORDER BY tbl_item.datt_createdate desc
			";

       $req = $dbh->prepare($sql);
       $req->execute();
       $num = $req->rowCount();
       if($num != 0){
       		while($rows = $req->fetch(PDO::FETCH_ASSOC)){
       			$data[] = $rows;
       		}
       	return $data;
       }
       $req->closeCursor();
	}catch(PDOException $cus){
		return $data;
	}
}

function listItemByCatByPageCount($dbh,$str){
	$data=array();
	try{
		$sql = "
				SELECT COUNT(*) 'cpro' FROM config_item_group 
				WHERE var_categoryid in ($str) AND tin_inactive =0
			";

		$req = $dbh->prepare($sql);
		$req->execute();
		$num = $req->rowCount();
		if($num != 0){
			while($rows = $req->fetch(PDO::FETCH_ASSOC)){
				return $rows['cpro'];
			}
		}
		$req->closeCursor();
	}catch(PDOException $cus){
		return 0;
	}
}
