<?php
	class Compernent{
		public function arr($arr){
			echo "<pre>";
			print_r($arr);
			echo "</pre>";
		}
		
		public function locations($dbh){
			try{
				$sql = "select LocationID,Des from tbllocation";
				$req = $dbh->prepare($sql);
				$req->execute();
				$num = $req->rowCount();
				$data='';
				if($num != 0){
					while($rows = $req->fetch(PDO::FETCH_ASSOC)){
						$data[$rows['LocationID']] =$rows['Des'];
					}
				}
				return $data;
				$req->closeCursor();
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function itemName($dbh){	
			try{
				$sql = "select i.ItemID , i.ItemName from tblitem i order by i.ItemID ASC";
				$req = $dbh->prepare($sql);
				$req->execute();
				$num = $req->rowCount();
				$data='';
				if($num != 0){
					while($rows = $req->fetch(PDO::FETCH_ASSOC)){
						$data[] = $rows;
					}
				}				
				$req->closeCursor();
				return $data;
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		public function subCon(){	
			global $dbh;
			try{
				$sql = "select subconid  from tblconsubcontract";
				$req = $dbh->prepare($sql);
				$req = $dbh->bindParam(':project', $project);
				$req->execute();
				$num = $req->rowCount();
				$data='';
				if($num != 0){
					while($rows = $req->fetch(PDO::FETCH_ASSOC)){
						$data[] =array($rows['subconid']=>$rows['subconid']);
					}
				}
				return $data;
				$req->closeCursor();
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		
		public function employees($dbh){
			try{
				$sql = "select EmpID , EmpName  from tblemployee order by EmpID ASC";
				$req = $dbh->prepare($sql);
				$req->execute();
				$num = $req->rowCount();
				$data=array();
				if($num != 0){
					while($rows = $req->fetch(PDO::FETCH_ASSOC)){
						$data[$rows['EmpID']] = $rows['EmpName'];
					}
					return $data;
				}
				$req->closeCursor();
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function projectcon(){
			global $dbh;
			try{
				$sql = "SELECT projcode FROM tblconproject";
				$req = $dbh->prepare($sql);
				$req->execute();
				$num = $req->rowCount();
				$data="";
				if($num != 0){
					while($rows = $req->fetch(PDO::FETCH_ASSOC)){  
						$data[] =array($rows['projcode']=>$rows['projcode']);
					}
					return $data;
				}
				$req->closeCursor();
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function customers($dbh){
			try{
				$sql = "SELECT c.CustID as f1, c.CustName as f2 FROM tblcustomer c INNER JOIN tblsales s ON c.CustID = s.CustID GROUP BY c.CustID  order by c.CustName ASC";
				$req = $dbh->prepare($sql);
				$req->execute();
				$num = $req->rowCount();
				$data="";
				if($num != 0){
					while($rows = $req->fetch(PDO::FETCH_ASSOC)){
						$data[$rows['f1']] =$rows['f2'];
					}
					return $data;
				}
				$req->closeCursor();
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function venders($dbh){
			try{
				$sql = "SELECT VendID , VendName FROM tblvendor";
				$req = $dbh->prepare($sql);
				$req->execute();
				$num = $req->rowCount();
				$data="";
				if($num != 0){
					while($rows = $req->fetch(PDO::FETCH_ASSOC)){
						$data[$rows['VendID']] =$rows['VendName'];
					}
					return $data;
				}
				$req->closeCursor();
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		public function accNo($dbh){
			try{
				$sql = "select AccID , AccName  from tblaccount order by AccID ASC";
				$req = $dbh->prepare($sql);
				$req->execute();
				$num = $req->rowCount();
				$data="";
				if($num != 0){
					while($rows = $req->fetch(PDO::FETCH_ASSOC)){
						$data[$rows['AccID']] =$rows['AccName'];
					}
					return $data;
				}
				$req->closeCursor();
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		public function itemGroup($dbh){
			try{
				$sql = "SELECT ItemGroupID, ItemGroupName FROM tblitemgroup ORDER BY ItemGroupID";
				$req = $dbh->prepare($sql);
				$req->execute();
				$num = $req->rowCount();
				$data="";
				if($num != 0){
					while($rows = $req->fetch(PDO::FETCH_ASSOC)){
						$data[$rows['ItemGroupID']] =$rows['ItemGroupName'];
					}
					return $data;
				}
				$req->closeCursor();
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		public function customerGroup($dbh){
			try{
				$sql = "SELECT CustGroupID, CustGroupName FROM tblcustomergroup ORDER BY CustGroupID";
				$req = $dbh->prepare($sql);
				$req->execute();
				$num = $req->rowCount();
				$data="";
				if($num != 0){
					while($rows = $req->fetch(PDO::FETCH_ASSOC)){
						$data[$rows['CustGroupID']] =$rows['CustGroupName'];
					}
					return $data;
				}
				$req->closeCursor();
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		public function vendorGroup($dbh){
			try{
				$sql = "SELECT VendGroupID, VendGroupName FROM tblvendorgroup ORDER BY VendGroupID";
				$req = $dbh->prepare($sql);
				$req->execute();
				$num = $req->rowCount();
				$data="";
				if($num != 0){
					while($rows = $req->fetch(PDO::FETCH_ASSOC)){
						$data[$rows['VendGroupID']] =$rows['VendGroupName'];
					}
					return $data;
				}
				$req->closeCursor();
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		public function journalType($dbh){
			try{
				$sql = "select JTypeID,JTypeName FROM tbljtype ORDER BY JTypeID";
				$req = $dbh->prepare($sql);
				$req->execute();
				$num = $req->rowCount();
				$data="";
				if($num != 0){
					while($rows = $req->fetch(PDO::FETCH_ASSOC)){
						$data[$rows['JTypeID']] =$rows['JTypeName'];
					}
					return $data;
				}
				$req->closeCursor();
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}