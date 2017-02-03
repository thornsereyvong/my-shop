<?php
/*
 * *****************************************************************************
 * file: app.php
 * @autor: Thorn sereyvong
 * @date: 24-03-2016
 * KTS TEAM
 * *****************************************************************************
 */

	ob_start ();
	ini_set ('session.cookie_httponly', true);
	session_start ();
	if (isset ( $_SESSION ['last_ip'] ) === false) {
		$_SESSION ['last_ip'] = $_SERVER ['REMOTE_ADDR'];
		session_regenerate_id (true);
	}
	if ($_SESSION ['last_ip'] !== $_SERVER ['REMOTE_ADDR']) {
		session_unset();
		session_destroy ();
	}
	
	
	
	
	
	include_once 'Untility/DBConnection.php';
	//include_once 'Untility/Component.php';
	include_once 'Model/Cryption.php';
	include_once 'Model/user/User.DAO.php';
	
	
	$server = "http://localhost/my-shop/shop-admin/";
	
?>