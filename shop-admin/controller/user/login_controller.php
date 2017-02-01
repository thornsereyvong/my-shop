<?php

include_once '../../Untility/DBConnection.php';
include_once '../../Model/user/User.DAO.php';
include_once '../../Model/Cryption.php';
if(isset($_POST['kts_password']) && isset($_POST ['kts_username'])){
	$user->login($_POST['kts_username'], $_POST ['kts_password']);
}else{
	echo "Error";
}