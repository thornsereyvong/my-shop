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
		//echo $cus->getMessage();
		return $data;
	}
}

function listItemByCategory($dbh){
	$data=array();
	try{
		$sql = "
				SELECT g.var_id, g.var_name, g.var_remark, i.var_urlimg,
						i.var_id AS ItemID,i.var_name AS ItemName,i.var_barcode AS Barcode,itf.var_uomid AS UOM,i.var_sizeid AS Size, i.var_colorid AS Color,
				       (SELECT ip.dou_price FROM config_item_price ip WHERE ip.var_id = i.var_id AND ip.var_uomid = itf.var_uomid LIMIT 1) AS UnitPrice
				FROM config_item_group g
				LEFT JOIN config_item i on g.var_id=i.var_groupid
				LEFT JOIN config_item_factor itf ON i.var_id = itf.var_id
				WHERE g.tin_inactive = 0 AND i.tin_inactive = 0 AND g.var_categoryid='Man'
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
		//echo $cus->getMessage();
		return $data;
	}
}
