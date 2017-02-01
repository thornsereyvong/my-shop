<?php
	
	$server = "http://localhost/we-shop/";
	include_once 'connection/DBConnection.php';
	
	$dbh = new DBConnection('localhost', 'temp_pos', 'root', '');
	$dbh = $dbh->getConnection();
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// 123456789