<?php
/*
 * *****************************************************************************
 * file: slidebar.php
 * @autor: Thorn sereyvong
 * @date: 08-09-2015
 * 
 * *****************************************************************************
 */
?>
<?php 
		
	$menu_report = array(
			            'Article'=>array(
	            		     'new-article' => 'New Article',
	            		     'list-articles' => 'List Articles'
                        ),
						'Category'=>array(
							 'new-category' => 'New Category',
							 'list-categories' => 'List Category'
						)
	);
	$menu_item = array(
		"Item", "Category","Brand"
	);
	$menu_post = array(
		"Promotion", "Slideshow"	
	);

?>
<aside class="main-sidebar">
	<section class="sidebar">
		<?php 			
			function showMainMenu($key,$active,$open){
				echo "<li class='".$active."'> <a href='#'><i class='fa fa-circle-o'></i>".$key."<i class='fa fa-angle-left pull-right'></i></a>";
				echo "<ul class='treeview-menu  ".$open."'>";
			}
			function showMenu($link,$name,$active){
				global $server;
				echo "<li class='".$active."'><a href='".$server.$link."'><i class='fa fa-circle-o'></i>".$name."</a></li>";
			}
			function showEndMainMenu(){
				echo "</ul></li>";
			}
			function check($title, $menu){
				if(is_array($menu)){
				foreach ($menu as $key=>$m){
					if($m == $title)
						return true;
				}
				}
				return false;
			}
		?>
	
		<ul class="sidebar-menu">
			<li class="header">MAIN NAVIGATION</li>
			<li class="<?php if($title == 'Dashboard'){ echo "active";} ?> treeview">
				<a href="<?php echo $server; ?>"> <i class="fa fa-dashboard"></i>
					<span>Dashboard</span>
				</a>
			</li>						
			<li class="treeview <?php if($title == 'Report'){ echo "active";} ?>">
				<a href="#"> <i class="fa fa-files-o"></i> <span>Report</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu <?php if($title == 'Report'){ echo "menu-open";} ?>">
					
				<?php 
					foreach ($menu_report as $k =>$menu){
						if(check($title, $menu)==true){
							showMainMenu($k,'active','menu-open');
						}else{
							showMainMenu($k,'','');
						}												
						foreach ($menu as $key=>$m){							
							if($title == $m){
								showMenu($key,$m,'active');
							}else{
								showMenu($key,$m,'');
							}														
						}
						showEndMainMenu();
					}
				?>		
				</ul>
			</li>
			
			
			<li class="treeview <?php if(in_array($title, $menu_item)){ echo "active";} ?>">
				<a href="#"> <i class="fa fa-files-o"></i> <span>Products</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">					
					<li class="<?php if($title == 'Item'){ echo "active";} ?>"><a href="<?php echo $server; ?>item"><i class="fa fa-bullhorn"></i> <span>Item</span></a></li>
					<li class="<?php if($title == 'Category'){ echo "active";} ?>"><a href="<?php echo $server; ?>category"><i class="fa fa-image"></i> <span>Category</span></a></li>	
					<li class="<?php if($title == 'Brand'){ echo "active";} ?>"><a href="<?php echo $server; ?>brand"><i class="fa fa-image"></i> <span>Brand</span></a></li>
				</ul>
			</li>
			
			<li class="treeview <?php if(in_array($title, $menu_post)){ echo "active";} ?>">
				<a href="#"> <i class="fa fa-files-o"></i> <span>Post</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">					
					<li class="<?php if($title == 'Promotion'){ echo "active";} ?>"><a href="<?php echo $server; ?>promotion"><i class="fa fa-bullhorn"></i> <span>Promotion</span></a></li>
					<li class="<?php if($title == 'Slideshow'){ echo "active";} ?>"><a href="<?php echo $server; ?>slideshow"><i class="fa fa-image"></i> <span>Slideshow</span></a></li>	
				</ul>
			</li>
			<li><a href="#"><i class="fa fa-book"></i> <span>Helps</span></a></li>	
		</ul>
		<ul class="sidebar-menu" id="result">
					
		</ul>
	</section>
</aside>