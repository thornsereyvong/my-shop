<?php
/*
 * *****************************************************************************
 * file: category.php
 * @autor: Thorn sereyvong
 * @date: 08-09-2015
 * ZOBENZ TEAM
 * *****************************************************************************
 */
?>
<?php

	$title = "Category";
	include_once 'app.php';
	
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once 'head.php'; ?>		
		<script type="text/javascript">

			var description = "";
			var img_thumb = "";
			var app = angular.module('category_app', ['angularUtils.directives.dirPagination','angular-loading-bar', 'ngAnimate']).config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
				    cfpLoadingBarProvider.includeSpinner = false;
		  	}]);
			var self = this;
			var server = "<?php echo $server; ?>";
			var index = 0;
			var pId = 0;
			app.controller('category_cl',['$scope','$http',function($scope, $http){

				$scope.sort = function(keyname){
				    $scope.sortKey = keyname;
				    $scope.reverse = !$scope.reverse;
				};
				$scope.pageSize = {};
				$scope.pageSize.rows = [ 
								{ value: "5", label: "5" },
			    				{ value: "10", label: "10" },
			            		{ value: "15", label: "15" },
			            		{ value: "20", label: "20" },
			            		{ value: "25", label: "25" },
			            		{ value: "30", label: "30" },
            	];
				$scope.pageSize.row = $scope.pageSize.rows[0].value;
				
				$scope.listPromotion = function(){					
					$http({
					    method: 'POST',
					    url: server+'controller-list-promotion',
					    data:{"catId": "promotion"}		    
					}).success(function(response) {		
						if(response.MESSAGE == "FOUNDED"){													
							$scope.promotion = response.DATA;	    					
						}else{
							$scope.promotion = [];
						}
					});
												
				}

				$scope.btnNewPromotion = function(){					
					$scope.clearFrmPromotion();					
					$("#frmNew").modal({backdrop:'static'});
					$scope.evt = {activity:"CREATE", title:"SAVE"};				
				}

				$scope.cancelPromotionClick = function(){
					$scope.clearFrmPromotion();
				}
				
				$scope.clearFrmPromotion = function(){
					description.setData("");					
					$('#frmAddPromotion').bootstrapValidator('resetForm', 'true');
					$("#status").val("1");
					$("#sorder").val("0");
					$("#showImgChoose").attr("style","display:none;");
					$("#imgDis").attr("src","");
					img_thumb = "";
				}

				$scope.btnEditPromotion = function(proId){
					index = $scope.searchPromotion(proId);
					$scope.promotion[index];
					pId = proId;
					$("#title").val($scope.promotion[index].Title);
					$("#status").val($scope.promotion[index].Status);
					$("#sorder").val($scope.promotion[index].Sort_Order);
					description.setData($scope.promotion[index].Description);

					if($scope.promotion[index].img != ""){
						$("#imgDis").attr("src",server+"uploads/images/thumb/"+$scope.promotion[index].img);	
						$("#imgDis").show();
						$("#showImgChoose").attr("style","");									
						img_thumb = $scope.promotion[index].img;
					}else{
						$("#showImgChoose").attr("style","display:none;");
						$("#imgDis").attr("src","");
						img_thumb = "";
					}
					$("#icon_load").hide();
					
					$("#frmNew").modal({backdrop:'static'});
					$scope.evt = {activity:"UPDATE", title:"UPDATE"};
					
				}

				$scope.searchPromotion = function(proId){
					for(var i=0; i<$scope.promotion.length; i++){
						if(proId == $scope.promotion[i].ArtID){
							return i;
						}
					}
					return false;
				}
				
				$scope.btnDeletePromotion = function(proId){
					swal({   
						title: "<span style='font-size: 25px;'>You are about to delete promotion.</span>",
						text: "Click OK to continue or CANCEL to abort.",
						type: "info",
						html: true,
						showCancelButton: true,
						closeOnConfirm: false,
						showLoaderOnConfirm: true,		
					}, function(){ 
						setTimeout(function(){
							$http({
							    method: 'POST',
							    url: server+'controller-delete-promotion',
							    data:{
							    	"artId": proId
							    }							    
							}).success(function(response) {											
								if(response.MESSAGE == "DELETED"){						
									$scope.listPromotion();
									swal({
			    						title: "SUCCESSFUL",
			    					  	text: response.MSG,
			    					  	html: true,
			    					  	timer: 2000,
			    					  	type: "success"
			    					});														    			
								}else{
									swal({
			    						title: "UNSUCCESSFUL",
			    					  	text: response.MSG,
			    					  	html: true,
			    					  	timer: 2000,
			    					  	type: "error"
			    					});
								}
							});
						}, 500);
					});
				}

				$scope.btnPromotionSave = function(){					
					if($scope.evt.activity == 'CREATE'){
						$('#frmAddPromotion').data('bootstrapValidator').validate();
			    		var statusAddPro = $("#frmAddPromotion").data('bootstrapValidator').validate().isValid();
			    		if(statusAddPro){				    	
			    			swal({   
								title: "<span style='font-size: 25px;'>You are about to create new category.</span>",
								text: "Click OK to continue or CANCEL to abort.",
								type: "info",
								html: true,
								showCancelButton: true,
								closeOnConfirm: false,
								showLoaderOnConfirm: true,		
							}, function(){ 
								setTimeout(function(){
									$http({
									    method: 'POST',
									    url: server+'controller-create-category',
									    data:{
									    	"status": getInt('status'),
									    	"img": img_thumb,
									    	"sorder" : getInt('sorder'),
									    	"catId": "promotion",
									    	"detail":[
												{"title":getValueStringById('title'), "description":description.getData(), "lang":"EN"}
											]
									    }
									    
									}).success(function(response) {											
										if(response.MESSAGE == "INSERTED"){						
											$scope.listPromotion();
											swal({
					    						title: "SUCCESSFUL",
					    					  	text: response.MSG,
					    					  	html: true,
					    					  	timer: 2000,
					    					  	type: "success"
					    					});
											setTimeout(function(){ $scope.clearFrmPromotion(); $("#frmNew").modal('toggle'); }, 2000);					    				
										}else{
											swal({
					    						title: "UNSUCCESSFUL",
					    					  	text: response.MSG,
					    					  	html: true,
					    					  	timer: 2000,
					    					  	type: "error"
					    					});
										}
									});
								}, 500);
							});
			    		}
					}else if($scope.evt.activity == 'UPDATE'){
						$('#frmAddPromotion').data('bootstrapValidator').validate();
			    		var statusAddPro = $("#frmAddPromotion").data('bootstrapValidator').validate().isValid();
			    		if(statusAddPro){
			    			swal({   
								title: "<span style='font-size: 25px;'>You are about to update category.</span>",
								text: "Click OK to continue or CANCEL to abort.",
								type: "info",
								html: true,
								showCancelButton: true,
								closeOnConfirm: false,
								showLoaderOnConfirm: true,		
							}, function(){ 
								setTimeout(function(){
									$http({
									    method: 'POST',
									    url: server+'controller-edit-category',
									    data:{
										    'artId' : pId,
									    	"status": getInt('status'),
									    	"img": img_thumb,
									    	"sorder" : getValueStringById('sorder'),
									    	"catId": "promotion",
									    	"detail":[
												{"title":getValueStringById('title'), "description":description.getData(), "lang":"EN"}
											]
									    }
									    
									}).success(function(response) {									
										if(response.MESSAGE == "UPDATED"){
											$scope.listPromotion();											
											swal({
					    						title: "SUCCESSFUL",
					    					  	text: response.MSG,
					    					  	html: true,
					    					  	timer: 2000,
					    					  	type: "success"
					    					});											
											setTimeout(function(){ $scope.clearFrmPromotion(); $("#frmNew").modal('toggle'); }, 2000);					    					
										}else{
											swal({
					    						title: "UNSUCCESSFUL",
					    					  	text: response.MSG,
					    					  	html: true,
					    					  	timer: 2000,
					    					  	type: "error"
					    					});
										}
									});
								}, 500);
							});
			    		}
					}
				}	
			}]);

			$(function(){
				description = CKEDITOR.replace('description');
				
				$("#browse_img").click(function(){
					$("#inp_img").click();			
		    	});
		
		    	$("#inp_img").change(function(){					
			    	
					var formData = new FormData($("#frm_upload_img")[0]);
					var img = $('#inp_img').get(0).files[0];
					if(img != null){
						$("#imgDis").hide();
						$("#showImgChoose").attr("style","");
						$("#icon_load").attr("style",'display:block;width:25px;');
						
						setTimeout(function(){
							$.ajax({
								url : 'controller-upload-image',
								type : 'POST',
								data : formData,
								cache : false,
								contentType : false,
								processData : false,
								success : function(result) {
									if(result != 'Errors'){
										$("#imgDis").attr("src",server+"uploads/images/thumb/"+result);	
										$("#imgDis").show();									
										img_thumb = result;
									}else{
										alert("Error, please try again.");
										$("#showImgChoose").attr("style","display:none;");
										$("#imgDis").attr("src","");
										img_thumb = "";
									}
									$("#icon_load").hide();
									
								},
								error : function() {
									//alert(0);
								}
							});
						},500); 
					}
		        });
				$("#delImgThumb").click(function(){
					$("#showImgChoose").attr("style","display:none;");
					$("#imgDis").attr("src","");
					img_thumb = "";
				});

				$('#frmAddPromotion').bootstrapValidator({
					message: 'This value is not valid',//use to display message
					feedbackIcons: {
						valid: '',// show correct symbol when condition is valid
						invalid: '',// show incorrect symbol when condition is invalid
						validating: 'glyphicon glyphicon-refresh'
					},
					fields: {
						title: {
	                        validators: {
								notEmpty: {
									message: 'The title is required and cannot be empty'
								}
							} 
						},
						status: {
	                        validators: {
								notEmpty: {
									message: 'The status is required and cannot be empty'
								}
							} 
						},
						sorder: {
	                        validators: {
	                        	notEmpty: {
									message: 'The short order is required and cannot be empty'
								},
                        		numeric: {
                                    message: 'The value is not an number',
                                    // The default separators
                                    thousandsSeparator: '',
                                    decimalSeparator: '.'
                                }
	                            
							} 
						}
					}
				});
				
			});

			
		</script>				
	</head>
	<body class="hold-transition sidebar-mini fixed skin-blue-light">
		<div class="wrapper">
			<?php include_once 'header.php'; ?>
			<?php include_once 'slidebar.php'; ?>
			<div class="content-wrapper">
				<section class="content-header">
					<h1>
						Category<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="<?php echo $server;?>"><i class="fa fa-home"></i> Home</a></li>
						<li class="active">Category</li>
					</ol>
				</section>
				<section class="content" ng-app="category_app" ng-controller="category_cl"  data-ng-init="listPromotion()">
					<div class="row">
						<div class="col-sm-12"  style="padding-right: 0px;">
							<div class="box box-primary">
								<div class="box-header">
									<button ng-click="btnNewPromotion()" type="button" name="btnNew" id="btnNew"
										class="btn btn-primary">
										<i class="fa fa-plus"></i> &nbsp;CREATE
									</button>
								</div>
								<div class="box-footer">									
									<div class="col-sm-12">
									  	<div class="col-sm-3" style="margin-left: -15px;">
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Search..." ng-model="search" id="search" name="search">
											</div>
										</div>
										<div class="col-sm-2">
										  	<form class="form-inline">
										        <div class="form-group">
										        	<div class="input-group">
										        		<select class="form-control" ng-model="pageSize.row" id ="row" ng-options="obj.value as obj.label for obj in pageSize.rows"></select>
										        	</div>
										        </div>
										    </form>
										    <br/>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="box-body table-responsive no-padding">
											<table class="table table-hover">
												<tbody>
													<tr class="active">
														<th>ID</th>
														<th>TITLE</th>
														<th>DATE</th>
														<th>STATUS</th>
														<th>CREATE BY</th>
														<th>ACTION</th>
													</tr>
													<tr dir-paginate="pro in promotion |orderBy:sortKey:reverse |filter:search |itemsPerPage:pageSize.row" class="ng-cloak">
														<td>{{pro.ArtID}}</td>
														<td>{{pro.Title}}</td>
														<td>{{pro.cdate}}</td>
														<td><span ng-if="pro.Status == 1" class="label label-success">Publish</span><span ng-if="pro.Status == 0" class="label label-warning">Unpublish</span></td>
														<td>[{{pro.var_id}}] {{pro.var_name}}</td>
														<td>
															<button ng-click="btnEditPromotion(pro.ArtID)" type="button" class="btn btn-primary btn-sm">
																<i class="fa fa-pencil"></i>
															</button>
															<button ng-click="btnDeletePromotion(pro.ArtID)" type="button" class="btn btn-danger btn-sm">
																<i class="fa fa-trash"></i>
															</button>
														</td>
													</tr>
												</tbody>
											</table>
											
											<dir-pagination-controls 
												max-size="pageSize.row" 
												direction-links="true"
												boundary-links="true"> 
											</dir-pagination-controls>
										</div>
										<br><br>
									</div>																
								</div>								
							</div>
						</div>
						<div id="errors"></div>
						
						
						<!-- START MODAL -->
						<input type="hidden" id="btn_show_product" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#frmNew" />
						<div class="modal fade modal-default" id="frmNew" role="dialog">
							<div class="modal-dialog  modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" ng-click="cancelPromotionClick()" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">
											<b>[{{evt.activity}}] CATEGORY</b>
										</h4>
									</div>
									
									<div class="modal-body">
										<div class="row">
											<form id="frmAddPromotion" method="post">
												<div class="col-sm-6">
													<div class="form-group">
														<label>Title <span class="requrie">(Required)</span></label>
														<input  id="title" name="title" class="form-control" type="text" placeholder="">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label>Status <span class="requrie">(Required)</span></label> 
														<select name="status" class="form-control" id="status">
															<option value="1">Publish</option>
															<option value="0">Unpublish</option>
														</select>
													</div>
												</div>
												<div class="clearfix"></div>
												<div class="col-sm-6">
													<div class="form-group">
														<label>Parent <span class="requrie">(Required)</span></label> 
														<select name="status" class="form-control" id="status">
															<option value="1">Publish</option>
															<option value="0">Unpublish</option>
														</select>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label>Short Order</label>
														<input id="sorder" name="sorder" value="0" class="form-control" type="text" placeholder="">
													</div>
												</div>
												<div class="col-md-12 col-sm-12">
													<textarea id="description" name="description">
														
													</textarea>
												</div>	
											</form>
											<div class="col-md-12 col-sm-12">&nbsp;
											</div>
											<div class="col-sm-2" style="margin-left: -10px;">
												<form id="frm_upload_img" enctype="multipart/form-data" action="" method="post" style="display: none;">
													<input accept="image/*" type="file" name="img_upload" id="inp_img">
													<input type="text" name="type" value="promotion">
												</form>
					
												<a class="btn btn-app" id="browse_img">
													<i class="fa fa-photo"></i>
														Browse
												</a>
											</div>
											<div class="col-sm-2" style="display:none;" id="showImgChoose">
										 		<div class="thumbnail">
										 			<img id="icon_load" src="<?php echo $server; ?>img/load2.gif" />
											      	<img id="imgDis" src="<?php echo $server; ?>img/profile.jpg" alt="...">											    	
											    	<div class="caption text-center" style="">
												       	<button id="delImgThumb" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
											      	</div>
										      	</div>
											</div>			
										</div>				
									</div>
									
									<div class="modal-footer">
										<button type="button" id="btnPromotionCancel" ng-click="cancelPromotionClick()" name="btnPromotionCancel"
											class="btn btn-danger" data-dismiss="modal">CANCEL</button>
										&nbsp;&nbsp;
										<button type="button" ng-click="btnPromotionSave()" class="btn btn-primary pull-right"
											id="btnPromotionSave" name="btnPromotionSave">{{evt.title}}</button>
					
									</div>
								</div>
							</div>				
						</div>
					</div>
					
					<!-- END MODAL -->
					</div>					
				</section>
				
				
			<?php  include_once 'foot.php'; ?>
		</div>
		<?php  include_once 'footer.php'; ?>
	</body>
</html>
	

