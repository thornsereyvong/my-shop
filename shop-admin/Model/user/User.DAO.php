<?php
	class User{
		public function login($username,$password){
			try{
				session_start();
				$dbh = DBConnection::getInstance();
				$sql = "
						 SELECT * FROM config_user WHERE var_id = :userId ; 
					   ";	
			
				
				$req = $dbh->prepare($sql);
				$req->bindParam(":userId", $username);
				$req->execute();
				if($req->rowCount() != 0){
					$rows = $req->fetch(PDO::FETCH_ASSOC);
					$_SESSION['ZOBENZ_USERID'] = $rows['var_id'];
					$_SESSION['ZOBENZ_USER'] = $rows['var_name'];
					$_SESSION['ZOBENZ_USER_ROLE'] = "";
					$passDB = (new Cryption())->BalDecrypt($rows['var_pwd']);
					
					if($password == $passDB){
						echo "success";
					}else{
						echo "Error";
					}
					
				}else{
					echo "Error";
				}
				$req->closeCursor();
			}catch(PDOException $e){
				echo "Error";
			}
		}
		public function register($data){
			try{
				$dbh = DBConnection::getInstance();
				$sql = "INSERT INTO z_users(Username, Full_Name,Description,Email, Password, Img, Type, Role ) 
						             VALUES(:username, :fullname, :description, :email, :passwd, :img, :type, :role);";
				$passwd = (new Cryption())->IMD5($data['password']);
				$req = $dbh->prepare($sql);
				$req->bindParam(":username", $data['username']);
				$req->bindParam(":passwd", $passwd);
				$req->bindParam(":email", $data['email']);
				$req->bindParam(":fullname", $data['fullname']);
				$req->bindParam(":description", $data['description']);
				$req->bindParam(":role", $data['role']);
				$req->bindParam(":type", $data['type']);
				$req->bindParam(":img", $data['img']);
				$req->execute();
				$num = $req->rowCount();
				if($num != 0){
					echo "success";
				}else{
					echo "1";
				}
				$req->closeCursor();
			}catch(PDOException $e){
				
				echo "Error";
			}
		}
		
		public function active($dbh,$userid){
			try{
				$sql = "UPDATE z_users SET Active = 1-Active WHERE UserID=:userid;";
				$req = $dbh->prepare($sql);
				$req->bindParam(":userid", $userid);
				$req->execute();
				$num = $req->rowCount();
				if($num != 0){
					return true;
				}else{
					return false;
				}
				$req->closeCursor();
			}catch(PDOException $e){
				return false;
			}
		}
		
		public function checkUserEmail($dbh,$str,$option){
			try{
				if($option == 'username'){
					$sql = "SELECT * FROM tbluser WHERE Username = :username";
					$req = $dbh->prepare($sql);
					$req->bindParam(":username", $str);
					$req->execute();
					$num = $req->rowCount();
					if($num != 0){
						return true;
					}else{
						return false;
					}
					$req->closeCursor();
				}else if($option == 'email'){
					$sql = "SELECT * FROM tbluser WHERE Email = :email";
					$req = $dbh->prepare($sql);
					$req->bindParam(":email", $str);
					$req->execute();
					$num = $req->rowCount();
					if($num != 0){
						return true;
					}else{
						return false;
					}
					$req->closeCursor();
				}
			}catch(PDOException $e){
				return true;
			}
			return true;
		}
	}
	$user  = new User();