<?php
include_once '../../app.php';
include_once '../../Untility/DBConnection.php';
include_once '../../Model/promotion/promotion.DAO.php';

$postdata = file_get_contents("php://input");
$msg = array("MESSAGE"=>"FAILED", "MSG"=>"The pomotion was failed");;
if(isset($postdata) && !empty($postdata)){
	$data = json_decode($postdata);
	$data = $article->listArticle($data);
	if($data!= false){
		$msg = array("MESSAGE"=>"FOUNDED", "MSG"=>"The promotion was successfully created.", "DATA"=>$data);
	}
}

$json = json_encode($msg);
echo $json;
exit;