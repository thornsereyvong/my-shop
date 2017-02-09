<?php
	
	include 'app.php';
	
	function show_itme($p){
		global $server;
?>
	<div class="col-md-3 col-sm-6">
		<div class="thumbnails thumbnail-style thumbnail-kenburn">
			<div class="thumbnail-img">
				<div class="overflow-hidden">
					
				
					<?php if($p['img'] != ""){ ?>
					<img class="img-responsive" src="<?php echo $server.'GES_APP/uploads/project/'.$p['PID'].'/'.$p['img']; ?>" alt="">
					<?php }else{ ?>
					<img class="img-responsive" src="<?php echo $server . "img/300-tran.png"; ?>" alt="">
					<?php }?>
				
				</div>
				<a class="btn-more hover-effect" href="<?php echo $server .'product-detail/PRO-'.$p['PID']; ?>">read more +</a>
			</div>
			<div class="caption">
				<h3><a class="hover-effect" href="<?php echo $server .'product-detail/PRO-'.$p['PID']; ?>"><?php echo $p['Title_EN']?></a></h3>
				<p>
					<?php echo $p['Title_KH']?>
				</p>
			</div>
		</div>
	</div>
<?php		
	}
	
	
	
	if(isset($_POST['search']) && isset($_POST ['start']) && isset($_POST ['row_limit'])){
		$pro =  getProductBySearch(mres($_POST['search']), (int) $_POST ['start'], (int) $_POST ['row_limit']);
		if(count($pro)>0){
			$index = 0;
			foreach ($pro as $p){ $index++;
				echo show_itme($p);
				if(($index % 4) == 0){
					echo '<div class="clearfix"></div>';
				}
			}
		}
	}else{
		//echo "Error";
	}
	
	?>