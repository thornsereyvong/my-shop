<?php
	
	include 'app.php';
	include 'function/item.php';
	$price_level = getPriceLevel($dbh);
	
	if(isset($_POST['search']) && isset($_POST ['start']) && isset($_POST ['row_limit'])){
		
		$pros =  listItemByCatByPage($dbh,$_POST['search'],(int) $_POST ['start'], (int) $_POST ['row_limit'],$price_level);		
		if(count($pros)>0){
			disMainItemStyle($pros, 'col-sm-3 col-xs-12');
		}
	}else{
		
	}
	
	?>