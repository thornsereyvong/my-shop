<?php

define("SQL_DSN", 'mysql:dbname=web_report;host=localhost');
define("SQL_USERNAME", 'root');
define("SQL_PASSWORD", '');

class DBConnection extends PDO {
	private static $_instance;
	public function __construct( ){}
	public static function getInstance() {	
		if (!isset(self::$_instance)) {			
			try {			
				self::$_instance = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));			
			} catch (PDOException $e) {			
				echo $e;
			}
		} 
		return self::$_instance; 
	}
}