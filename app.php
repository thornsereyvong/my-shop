<?php
	
	$server = "http://localhost/my-shop/";
	include_once 'connection/DBConnection.php';
	
	$dbh = new DBConnection('localhost', 'web_report', 'root', '');
	$dbh = $dbh->getConnection();
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// 123456789