<?php
/*
 * *****************************************************************************
 * file: login.php
 * @autor: Thorn sereyvong
 * @date: 24-03-2016
 * KTS TEAM
 * *****************************************************************************
 */
?>
<?php

	$title = "LOGIN ACCOUNT";
	include_once 'app.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include_once 'head.php'; ?>
	</head>
	<body>

	<div class="container">
	<br>
		<div class="row">
			
			<div class="col-sm-3 "></div>
			<div class="col-sm-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="login-logo">
							<h2 class="text-center">Login Account</h2>
						</div>
						<!-- /.login-logo -->
						<div class="login-box-body">
							<p class="login-box-msg text-center"></p>
							<p class="" id="inv" style="color: #dd4b39; display: none;">*USERNAME
								and PASSWORD invalid.</p>
							<div id="load"></div>
							<form id="frmSignIn" action="" method="post"
								novalidate="novalidate" class="bv-form">
								<button type="submit" class="bv-hidden-submit"
									style="display: none; width: 0px; height: 0px;"></button>
								<div class="form-group">
									<input type="text" name="kts_username" value="ROOT" id="kts_username"
										class="form-control" placeholder="USERNAME" data-bv-field="kts_username">
		
									<small class="help-block" data-bv-validator="regexp"
										data-bv-for="kts_username" data-bv-result="NOT_VALIDATED"
										style="display: none;">The value is not a valid username address</small><small
										class="help-block" data-bv-validator="notEmpty"
										data-bv-for="kts_username" data-bv-result="NOT_VALIDATED"
										style="display: none;">The username is required and cannot be empty</small>
								</div>
								<div class="form-group">
									<input type="password" value="" name="kts_password" id="kts_password"
										class="form-control" placeholder="PASSWORD"
										data-bv-field="kts_password"> <small class="help-block"
										data-bv-validator="notEmpty" data-bv-for="kts_password"
										data-bv-result="NOT_VALIDATED" style="display: none;">The
										password is required and cannot be empty</small>
								</div>
								<button type="button" id="signin"
									class="btn btn-primary pull-right">Login</button>
		
		
							</form>
							<div class="clearfix"></div>
							<!-- <a href="#">I forgot my password.</a><br>  -->
						</div>
						<!-- /.login-box-body -->
					</div>
					<div class="col-sm-2"></div>
					<div id="errors"></div>
				</div>
			</div>
		</div>
	</div>
	
	<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="bootstrap/js/jquery-ui.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/bootstrapValidator.js"></script>
	<script src="bootstrap/js/function.mine.js"></script> 
	
	<script type="text/javascript">
		function error(){
			$("#inv").show();
			$("#kts_username").parent().removeClass("has-success").addClass("has-error");
			$("#password").parent().removeClass("has-success").addClass("has-error");
		}
	
		$(function(){
			$("#signin").click(function(){
				$('#frmSignIn').submit();
			});
			$('#frmSignIn').bootstrapValidator({
				message: 'This value is not valid',//use to display message
				feedbackIcons: {
					valid: '',// show correct symbol when condition is valid
					invalid: '',// show incorrect symbol when condition is invalid
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {
					kts_username: {
	                    validators: {// check password is exist or not
	                    	
							notEmpty: {
								message: 'The username is required and cannot be empty'
							}
						}                    
					}
/*
					,
					kts_password: {
						validators: {// check password is exist or not
							notEmpty: {
								message: 'The password is required and cannot be empty'
							}
						}
					}
				*/
			
				}
			}).on('success.form.bv', function(e) {			
				$.ajax({
					url: "login-controller",
					method: "POST",
					data: {
						kts_username : $.trim($("#kts_username").val()),
						kts_password : $.trim($("#kts_password").val())
					},success: function(data){
						if(data=="success"){
							window.location.href="<?php // echo $server;?>dashboard";
						}else{
							error();
						}
					}
				});
			});
		});
	</script>
	</body>
</html>
