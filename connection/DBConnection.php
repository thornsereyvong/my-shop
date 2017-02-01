<?php 
/* * *****************************************************************************
 * file: DBConnection.php
 * @autor: Thorn sereyvong
 * @date: 08-09-2015
 * Balancika co.,ltd
 * ***************************************************************************** */ 
?>
<?php
	class DBConnection extends PDO{
		private $dbName;
		private $host;
		private $dbUser;
		private $dbPwd;
		private $_instance = null;
		
		public function __construct($host,$dbName,$dbUser,$dbPwd) {
			$this->host = $host;
			$this->dbName = $dbName;
			$this->dbUser = $dbUser;
			$this->dbPwd = $dbPwd;
		}
		
		public function getConnection(){
			if (!isset($_instance)) {	
				try {
					$this->_instance = new PDO('mysql:host='. $this->host .';dbname='.$this->dbName , $this->dbUser, $this->dbPwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				}
				catch (PDOException $e) {
					echo 'PDO2 Erreur : '.$e->getMessage().'<br />';
					die();
				}
			}
			return $this->_instance;
		}
	}
	
	//$pdo = new DBConnection('192.168.0.2', 'temp_dbbmgcorp_new', 'posadmin', 'Pa$$w0rd');	