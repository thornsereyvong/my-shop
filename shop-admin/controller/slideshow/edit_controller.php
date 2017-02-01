<?php
include_once '../../app.php';
include_once '../../Untility/DBConnection.php';
include_once '../../Model/slideshow/slideshow.DAO.php';
$postdata = file_get_contents("php://input");
$msg = array("MESSAGE"=>"FAILED", "MSG"=>"The slideshow was failed");;
if(isset($postdata) && !empty($postdata)){
	$data = json_decode($postdata);	
	if($article->edit($data)){
		$msg = array("MESSAGE"=>"UPDATED", "MSG"=>"The slideshow was successfully updated.");
	}
}

$json = json_encode($msg);
echo $json;
exit;