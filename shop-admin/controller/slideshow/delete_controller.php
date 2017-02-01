<?php
include_once '../../app.php';
include_once '../../Untility/DBConnection.php';
include_once '../../Model/slideshow/slideshow.DAO.php';
$postdata = file_get_contents("php://input");
$msg = array("MESSAGE"=>"FAILED", "MSG"=>"The slideshow was failed");;
if(isset($postdata) && !empty($postdata)){
	$data = json_decode($postdata);
	if($article->delete($data)){
		$msg = array("MESSAGE"=>"DELETED", "MSG"=>"The slideshow was successfully deleted.");
	}
}

$json = json_encode($msg);
echo $json;
exit;