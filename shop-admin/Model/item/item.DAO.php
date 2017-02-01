<?php
	class Article{
		public function insert($data){
			try{
				$dbh = DBConnection::getInstance();
				$sql = "
						INSERT INTO z_articles_master(`Status`, `CatID`,`Create_Date`,`UserID`, `img`, `Sort_Order`) VALUES(:status, :catId, now(), :userId, :img, :sor) 
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
				
				$sql2 = "INSERT INTO z_articles_detail(`ArtID`,`Title`, `Description`, `Lang`) VALUES ({$lastid}, :title0, :des0, :lang0)";
				
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
						UPDATE  z_articles_master SET `Status` = :status, `CatID` = :catId, `img` = :img, `UserID` = :userId , `Sort_Order` = :sor WHERE `ArtID` = :artId					   
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
						DELETE FROM z_articles_detail WHERE `ArtID` = ".$data->artId.";	
					INSERT INTO z_articles_detail(`ArtID`,`Title`, `Description`, `Lang`) VALUES ({$lastid}, :title0, :des0, :lang0)";
		
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
						DELETE FROM z_articles_detail WHERE `ArtID` = ".$data->artId.";
						DELETE FROM z_articles_master WHERE `ArtID` = ".$data->artId.";
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
		public function listArticle($data){
			try{
				$dbh = DBConnection::getInstance();
				$sql = "
						SELECT m.ArtID, COALESCE(m.Alias,'') Alias , DATE_FORMAT(m.Create_Date, '%d-%b-%Y') as cdate, c.CatID,c.CatName, m.Sort_Order, u.var_id,u.var_name,
									 d.Title,m.img, m.`Status` , d.Description
						FROM z_articles_master m
						JOIN z_articles_detail d on m.ArtID=d.ArtID
						LEFT JOIN z_categories c on c.CatID=m.CatID
						LEFT JOIN config_user u on u.var_id= m.UserID
						WHERE m.CatID = :catId
						GROUP BY m.ArtID
						ORDER BY m.ArtID DESC
					   ";
		
				$req = $dbh->prepare($sql);
				$req->bindParam(":catId", $data->catId);
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
				echo false;
			}
		}
		public function listArticleById($data){
			try{
				$dbh = DBConnection::getInstance();
				$sql = "
						SELECT m.ArtID, COALESCE(m.Alias,'') Alias , DATE_FORMAT(m.Create_Date, '%d-%b-%Y') as cdate, m.CatID, m.Sort_Order, m.UserID,
						       d.Title,m.img, m.`Status`,d.Lang,d.Description
						FROM z_articles_master m
						JOIN z_articles_detail d on m.ArtID=d.ArtID
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
		
		
		
	}
	$article  = new Article();