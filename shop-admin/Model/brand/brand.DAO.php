<?php
	class Brand{
		
		private $str = "";
		private $num =0;
		public function insert($data){			
			try{
				$dbh = DBConnection::getInstance();
				$sql = "
						INSERT INTO z_Categorys_master(`Status`, `CatID`,`Create_Date`,`UserID`, `img`, `Sort_Order`) VALUES(:status, :catId, now(), :userId, :img, :sor) 
					   ";	
				
				$req = $dbh->prepare($sql);
				$req->bindParam(":status", $data->status);
				$req->bindParam(":catId", $data->catId);
				$req->bindParam(":img", $data->img);
				$req->bindParam(":sor", $data->sorder);
				$req->bindParam(":userId", $_SESSION['ZOBENZ_USERID']);
				$req->execute();
				$num = $req->rowCount();
				if($num == 0){
					return false;
				}
				$lastid = $dbh->lastInsertId();
				
				$sql2 = "INSERT INTO z_Categorys_detail(`ArtID`,`Title`, `Description`, `Lang`) VALUES ({$lastid}, :title0, :des0, :lang0)";
				
				for($i=1; $i<count($data->detail); $i++){
					$sql2 .=", ({$lastid}, :title$i, :des$i, :lang$i)";
				}
				
				$sql2 .= ";";
				
				$req2 = $dbh->prepare($sql2);
				for($i=0; $i<count($data->detail); $i++){
					$req2->bindParam(":title".$i, $data->detail[$i]->title);
					$req2->bindParam(":des".$i, $data->detail[$i]->description);
					$req2->bindParam(":lang".$i, $data->detail[$i]->lang);
					
				}
				$req2->execute();
				$num = $req2->rowCount();
				if($num != 0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				return false;
			}
		}
		public function edit($data){
			try{
				$dbh = DBConnection::getInstance();
				$sql = "
						UPDATE  z_Categorys_master SET `Status` = :status, `CatID` = :catId, `img` = :img, `UserID` = :userId , `Sort_Order` = :sor WHERE `ArtID` = :artId					   
						";		
				$req = $dbh->prepare($sql);				
				$req->bindParam(":status", $data->status);
				$req->bindParam(":catId", $data->catId);
				$req->bindParam(":img", $data->img);
				$req->bindParam(":sor", $data->sorder);
				$req->bindParam(":userId", $_SESSION['ZOBENZ_USERID']);
				$req->bindParam(":artId", $data->artId);
				
				if($req->execute()){
					return true;
				}else{
					return false;
				}
				$lastid = $data->artId;
		
				$sql2 = "
						DELETE FROM z_Categorys_detail WHERE `ArtID` = ".$data->artId.";	
					INSERT INTO z_Categorys_detail(`ArtID`,`Title`, `Description`, `Lang`) VALUES ({$lastid}, :title0, :des0, :lang0)";
		
				for($i=1; $i<count($data->detail); $i++){
					$sql2 .=", ({$lastid}, :title$i, :des$i, :lang$i)";
				}
				
				$sql2 .= ";";
				
				$req2 = $dbh->prepare($sql2);
				for($i=0; $i<count($data->detail); $i++){
					$req2->bindParam(":title".$i, $data->detail[$i]->title);
					$req2->bindParam(":des".$i, $data->detail[$i]->description);
					$req2->bindParam(":lang".$i, $data->detail[$i]->lang);
					
				}
				$req2->execute();
				$num = $req2->rowCount();
				if($num != 0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				return false;
			}
		}
		public function delete($data){
			try{
				$dbh = DBConnection::getInstance();
				$sql = "
						DELETE FROM z_Categorys_detail WHERE `ArtID` = ".$data->artId.";
						DELETE FROM z_Categorys_master WHERE `ArtID` = ".$data->artId.";
					   ";
		
				$req = $dbh->prepare($sql);
				
				if($req->execute()){
					return true;
				}
				return false;			
			}catch(PDOException $e){
				echo false;
			}
		}
		
		public function listCategoryById($data){
			try{
				$dbh = DBConnection::getInstance();
				$sql = "
						SELECT m.ArtID, COALESCE(m.Alias,'') Alias , DATE_FORMAT(m.Create_Date, '%d-%b-%Y') as cdate, m.CatID, m.Sort_Order, m.UserID,
						       d.Title,m.img, m.`Status`,d.Lang,d.Description
						FROM z_Categorys_master m
						JOIN z_Categorys_detail d on m.ArtID=d.ArtID
						WHERE m.ArtID = $data
						
					   ";
		
				$req = $dbh->prepare($sql);
				$req->execute();
				$num = $req->rowCount();
				$data=array();
				if($num != 0){
					while($rows = $req->fetch(PDO::FETCH_ASSOC)){
						$data[] =$rows;
					}
				}
				return $data;
				$req->closeCursor();
			}catch(PDOException $e){
				echo "Error";
			}
		}
		public function listBrand(){
			$data = array();
			try{
				$dbh = DBConnection::getInstance();
				$sql = "SELECT * FROM config_brand WHERE tin_inactive=0";
		
				$req = $dbh->prepare($sql);
				$req->execute();
				$num = $req->rowCount();
				$data=array();
				if($num != 0){
					while($rows = $req->fetch(PDO::FETCH_ASSOC)){
						$data[] =$rows;
					}
				}				
				$req->closeCursor();
				return $data;
			}catch(PDOException $e){
				return $data;
			}
		}
		public function getChild($category){
			if(count($category)>0){
				foreach ($category as $c){
					echo "<option value='".$c['var_id']."'>".$this->genStr($this->num)."[".$c['var_id']."] ".$c['var_name']."</option>";																																				
					$this->num++;
					$this->getChild($this->getChildMain($c['var_id']));					
				}
				$this->num--;
				return;
			}else{
				$this->num--;
				return;
			}
		}
		
		public function genStr($n){
			$str = "";
			for($i=0;$i<$n;$i++){
				$str .="--> ";
			}
			return $str;
		}
		
		public function getChildMain($catId){
			global $category_data;
			$cat = array();
			if(count($category_data)>0){
				foreach ($category_data as $c){
					if($c['var_parentid'] == $catId){
						$cat[] = $c;
					}
				}
			}
			return $cat;
		}
		
	}
	$brand  = new Brand();