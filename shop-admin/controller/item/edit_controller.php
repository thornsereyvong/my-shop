<?php
include_once '../../app.php';
include_once '../../Untility/DBConnection.php';
include_once '../../Model/promotion/promotion.DAO.php';
$postdata = file_get_contents("php://input");
$msg = array("MESSAGE"=>"FAILED", "MSG"=>"The promotion was failed");;
if(isset($postdata) && !empty($postdata)){
	$data = json_decode($postdata);	
	if($article->edit($data)){
		$msg = array("MESSAGE"=>"UPDATED", "MSG"=>"The promotion was successfully updated.");
	}
}

$json = json_encode($msg);
echo $json;
exit;