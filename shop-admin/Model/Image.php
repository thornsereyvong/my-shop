<?php
	class Image{
		
		public $cur_time;
		
		public function __construct() {
			$this->cur_time = date('YmdHms');
		}
		public function end_me($arr){
			return $arr[count($arr)-1];
		}
		public function createthum($path, $save, $width, $height){
			
			$path = '../'.$path;
			$save = '../'.$save;
			
			$info = getimagesize($path);
			$size = array($info[0],$info[1]);
			$ext = array("image/png","image/gif","image/jpg","image/jpeg");
			if($info['mime'] == 'image/png'){
				$src = imagecreatefrompng($path);
			}else if($info['mime'] == 'image/jpeg'){
				$src = imagecreatefromjpeg($path);
			}else if($info['mime'] == 'image/jpg'){
				$src = imagecreatefromjpeg($path);
			}else if($info['mime'] == 'image/gif'){
				$src = imagecreatefromgif($path);
			}else{
				return false;
			}
			list($width,$height)=getimagesize($path);
		
			$newwidth1=300;
			$newheight1=($height/$width)*$newwidth1;
			$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
		
			imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);
		
			imagejpeg($tmp1,$save,100);
		
			imagedestroy($src);
			imagedestroy($tmp1);
		}
		public function upload_image($files, $p, $type){
			
			$file_name = $files['name'];
			$file_size = $files['size'];
			$file_tmp = $files['tmp_name'];
			$file_ext = strtolower($this->end_me(explode('.' , $file_name)));
			$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
			$detectedType = exif_imagetype($files['tmp_name']);
			if(!in_array($detectedType, $allowedTypes)){
				return false;
			}else if($file_size > 5242880){
				return false;
			}else if(empty($errors)){
				$new_name = $this->cur_time.'.'.$file_ext;
				$path = $p.'/'.$new_name;
				if(move_uploaded_file($file_tmp, '../'.$path)){
					$save = $p.'/thumb/'.$new_name;
					$this->createthum($path,$save,300,300);
					if($this->insertImage($new_name,$type,$save)){
						return $new_name;
					}
					return false;
				}				
			}
			return false;
		}
		
		public function insertImage($filename,$type,$save){
			try{
				$dbh = DBConnection::getInstance();
				$sql = "INSERT INTO z_files(File_Name,Type,Location) VALUES(:filename, :type, :location);";
				$req = $dbh->prepare($sql);
				$req->bindParam(":filename", $filename);
				$req->bindParam(":type", $type);
				$req->bindParam(":location", $save);
				$req->execute();
				$num = $req->rowCount();
				if($num != 0){
					return true;
				}
				return false;
				$req->closeCursor();
			}catch(PDOException $e){
				return false;
			}
		}
		public function listImageImage(){
			$data=array();
			try{
				$dbh = DBConnection::getInstance();
				$sql = "SELECT * FROM z_files ORDER BY FileID DESC;";
				$req = $dbh->prepare($sql);
				$req->execute();
				if($req->rowCount() != 0){
					while($rows = $req->fetch(PDO::FETCH_ASSOC)){
						$data[] = $rows;
					}
				}
				$req->closeCursor();
			}catch(PDOException $e){				
			}finally {
				return $data;
			}
			
		}
	}