<?php 
	include 'app.php';
	$title = "HOME";

?>
<!DOCTYPE html>
<html>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<head>
		<?php include 'layout/head.php';?>
	</head>
	<body id="index" class="index hide-left-column hide-right-column lang_en fullwidth header-default sidebar-default double-menu keep-header">
	
		<h1 class="hidden">Leo Clothing</h1>
		<section id="page" data-column="col-xs-12 col-sm-6 col-md-4" data-type="grid">
			
			
			<?php include 'layout/slideshow.php';?>
			<?php include 'layout/header.php';?>
			
			<section id="columns" class="columns-container">
				<div class="container">
					<div class="row">
						<section id="center_column" class="col-md-12">
							<div class="clearfix">
								<div class="nopadding margin-30-70 clearfix">
									<?php   include 'layout/top-content.php';?>
								</div>
								<?php include 'top-product.php';?>
							</div>
						</section>
					</div>
				</div>
			</section>
			<?php  include 'layout/footer.php';?>
			
		</section>	
		<script>
	function orderFrm(){
		swal.withFormAsync({
		    title: 'Cool Swal-Forms example',
		    text: 'Any text that you consider useful for the form',
		    showCancelButton: true,
		    confirmButtonColor: '#DD6B55',
		    confirmButtonText: 'Get form data!',
		    closeOnConfirm: true,
		    formFields: [
		      { id: 'name', placeholder: 'Name Field', required: true },
		      { id: 'nickname', placeholder: 'Add a cool nickname' }
		    ]
		  }, function (isConfirm) {
		    // do whatever you want with the form data
		    console.log(this.swalForm) // { name: 'user name', nickname: 'what the user sends' }
		  })
	}
</script>
	</body>
</html>