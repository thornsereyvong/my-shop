<?php

	function getCategory($dbh){
		$data=array();
		try{			
			$sql = "SELECT * FROM config_category WHERE tin_inactive=0";
			$req = $dbh->prepare($sql);
			$req->execute();
			$num = $req->rowCount();
			if($num != 0){
				while($rows = $req->fetch(PDO::FETCH_ASSOC)){
					$data[] = $rows;
				}
				return $data;
			}
			$req->closeCursor();
		}catch(PDOException $cus){
			//echo $cus->getMessage();
			return $data;
		}
	}
	
	function getChild($catId,$category){
		$cat = array();
		if(count($category)>0){
			foreach ($category as $c){
				if($catId == $c['var_parentid']){
					$cat[] = $c;
				}
			}
		}
		return $cat;		
	}
	
	function showMainCat($cats,$mainCat){
		global $server;
		$cat = getChild($cats['var_id'],$mainCat);
		
		if(count($cat)>0){
			
			echo '<li class="parent dropdown aligned-center">';
				echo '<a class="dropdown-toggle has-category" data-toggle="dropdown" href="'.$server.'products/'.$cats['var_id'].'" target="_self">';
					echo '<span class="menu-title">'.$cats['var_name'].'</span><b class="caret"></b>';
				echo '</a>';
				echo '<div class="dropdown-menu level1">';
					echo '<div class="dropdown-menu-inner">';
						echo '<div class="row">';
							echo '<div class="mega-col col-sm-12" data-type="menu">';
								echo '<div class="mega-col-inner ">';
								
									foreach ($cat as $s1){
										$sub = getChild($s1['var_id'],$mainCat);
										if(count($sub)>0){
											echo '<div class="menu-title"><a href="'.$server.'products/'.$cats['var_id'].'/'.$s1['var_id'].'">'.$s1['var_name'].'</a></div>';
											echo '<ul>';
											foreach ($sub as $s2){
												echo '<li><a href="'.$server.'products/'.$cats['var_id'].'/'.$s1['var_id'].'/'.$s2['var_id'].'">'.$s2['var_name'].'</a></li>';
											}
											echo '</ul>';
										}else{
											echo '<div class="menu-title"><a href="#">'.$s1['var_name'].'</a></div>';
										}
									}
									
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</li>';
		}else{
			echo '<li class=""><a href="'.$server.'products/'.$cats['var_id'].'" target="_self" class="has-category"><span class="menu-title">'.$cats['var_name'].'</span></a></li>';
		}
		
	}
	
	
	
	
	