<?php
	
	include 'app.php';
	
	if(isset($_POST['name']) && isset($_POST ['email']) && isset($_POST ['comment'])){
		$pro =  sendmail(mres($_POST['name']), mres($_POST ['email']), mres($_POST ['comment']));
		if($pro){
			echo "success";
		}else{
			echo "unsuccess";
		}
	}else{
		echo "unsuccess";
	}
	
	?>