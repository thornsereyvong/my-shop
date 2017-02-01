<?php
/*
 * *****************************************************************************
 * file: article_new.php
 * @autor: Thorn sereyvong
 * @date: 08-09-2015
 * ZOBENZ TEAM
 * *****************************************************************************
 */
?>
<?php

$title = "New Article";

include_once 'head.php';
include_once 'header.php';
include_once 'slidebar.php';

?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once 'head.php'; ?>
	</head>
	<body class="hold-transition sidebar-mini fixed skin-blue-light">
		<div class="wrapper">
			<?php include_once 'header.php'; ?>
			<?php include_once 'slidebar.php'; ?>
			<div class="content-wrapper">
				<section class="content-header">
					<h1>
						New Article <small>Control panel</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="<?php echo $server;?>"><i class="fa fa-home"></i> Home</a></li>
						<li class="active">New Article</li>
					</ol>
				</section>
				<section class="content">
					<div class="row">
						<div class="col-sm-12">
							<div class="box box-info">
								<div class="box-footer">
									<button type="submit" name="btnsearch" id="btnsearch"
										class="btn btn-info pull-right">
										<i class="fa fa-floppy-o"></i> &nbsp;Save
									</button>
								</div>
							</div>
						</div>
						<!-- Start Form -->
						<div class="col-md-9 col-sm-12">			
							<div class="box box-solid">
								<div class="box-header with-border">
									<i class="fa fa-info-circle"></i>
									<h3 class="box-title">Detail</h3>
								</div>
								<div class="box-body">
									<div class="col-md-12 col-sm-12">
										<div class="form-group">
											<label><span class="text-red">*</span> Title</label> <input
												type="text" class="form-control" placeholder="Enter Title...">
										</div>
									</div>
									<div id="detail" class="col-md-12 col-sm-12">
										<textarea id="editor1" name="editor1">
											
										</textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-12">
							<div class="box box-solid">
								<div class="box-header with-border">
									<i class="fa  fa-globe"></i>
									<h3 class="box-title">Publish</h3>
								</div>
								<div class="box-body">
									<div class="col-md-12 col-sm-12">
										<div class="form-group">
											<label></label> <select class="form-control">
												<option>Publish</option>
												<option>Unpublish</option>
											</select>
										</div>
									</div>
			
								</div>
							</div>
							<div class="box box-solid">
								<div class="box-header with-border">
									<i class="fa fa-th"></i>
									<h3 class="box-title">Category</h3>
								</div>
								<div class="box-body">
									<div class="col-md-12 col-sm-12">
										<div class="form-group">
											<label></label> <select class="form-control">
												<option>cat 1</option>
												<option>cat 2</option>
											</select>
										</div>
									</div>
			
								</div>
							</div>
							<div class="box box-solid">
								<div class="box-header with-border">
									<i class="fa fa-file-image-o"></i>
									<h3 class="box-title">Image Controll</h3>
								</div>
								<div class="box-body">
									<div class="col-md-12 col-sm-12" id="showImgChoose" style="display: none;">
										<div class="col-sm-3"></div>
										<div class="col-sm-6">
											<a href="#" class="thumbnail"> <img src="img/profile.jpg" width="100%" /></a>
										</div>
										<div class="col-sm-3"></div>
									</div>
									<div class="col-md-12 col-sm-12  text-center">
										<a class="btn btn-app" id="browse"> <i class="fa fa-photo"></i>
											Add To Text
										</a> <a class="btn btn-app" id="choose"> <i class="fa fa-photo"></i>
											Thumbnail
										</a>
									</div>
			
								</div>
							</div>
			
						</div>
			
						<!-- end Form -->
			
					</div>
			
					<input type="hidden" id="alertMes" data-toggle="modal"
						data-target="#myModal" />
					<div class="modal fade modal-danger" id="myModal" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Require Field!</h4>
								</div>
								<div class="modal-body">
									<p>Please input *field require.</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline pull-right"
										data-dismiss="modal">Close</button>
			
								</div>
							</div>
			
						</div>
					</div>
					<input type="hidden" id="alertMesError" data-toggle="modal"
						data-target="#myError" />
					<div class="modal fade modal-danger" id="myError" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Error!</h4>
								</div>
								<div class="modal-body">
									<p>Please try again...</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline pull-right"
										data-dismiss="modal">Close</button>
			
								</div>
							</div>
			
						</div>
					</div>
					<div id="errors" style="boder:none;"></div>
				</section>
			</div>
		
			<input type="hidden" id="show_img" data-toggle="modal"
				data-target="#show_img_detail" />
			<div class="modal fade" id="show_img_detail" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Choose Image</h4>
						</div>
						<div class="modal-body">
							<div class="col-sm-6">
								<form id="frm_upload_img" enctype="multipart/form-data" action="" method="post" style="display:none;">
									<input accept="image/*" type="file" name="img_upload" id="inp_img"> 
									<input name="type" type="text" value="article">
								</form>
											
								<a class="btn btn-app" id="browse_img"> <i class="fa fa-photo"></i>
									Browse
								</a>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
			                      <input type="text" name="message" id="searchImg" class="form-control" placeholder="Search...">
			                      <span class="input-group-btn">
			                        <button type="button" id="btnSearch" class="btn btn-success btn-flat">Search</button>
			                      </span>
			                    </div>
								
								
							</div>
							<div class="col-sm-12">
								<hr />
							</div>
							<div class="col-sm-12" id="listItem">
						
							</div>
							<div class="clearfix"></div>
							<div class="col-sm-12">
								<label>Page: <span id="currentPage">0</span> of <span
									id="totalPage">0</span>
								</label>
								<div class="btn-group pull-right" role="group">
									<button onClick="previous()" id="pre" type="button"
										class="btn btn-default">
										<i class="fa  fa-angle-double-left"></i>
									</button>
									<div class="btn-group" role="group">
										<input id="pagenum" onchange="goPage()" type="text"
											style="width: 60px;" class="form-control">
									</div>
									<button onClick="next()" id="nex" type="button"
										class="btn btn-default">
										<i class="fa  fa-angle-double-right"></i>
									</button>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<BR>
						<div class="modal-footer">
							<button type="submit" name="btnsearch" id="btnsearch"
								class="btn btn-danger">
								<i class="fa   fa-times-circle"></i> &nbsp;Delete
							</button>
							<button type="submit" name="btnAddImg" id="btnAddImg"
								class="btn btn-info pull-right">
								<i class="fa  fa-plus-circle"></i> &nbsp;Add
							</button>
						</div>
					</div>
				
				</div>
			</div>
			<?php  include_once 'foot.php'; ?>
		</div>
		<?php  include_once 'footer.php'; ?>
		<script src="plugins/ckeditor/ckeditor.js"></script>
		<script src="bootstrap/js/jquery.form.js"></script>
		
		<script>
			var data = new Array();
			var oldData = new Array();
			var dataSearch = new Array();
			var curpage = 1;
			var perpage = 12;
			var search = false;
			var name_img="";
			var id_img = "errors";
			
			function selectImg(name,img){
				$("#"+id_img).css('border', '1px solid #ddd');		
				name_img = name;
				id_img = img;
				$("#"+id_img).css('border', '1px solid #3c8dbc');
			}
		
			function checkImgSelected(){
		
			}
			
			function addThumbnail(filename){
				$("#showImgChoose").show();
				$("#showImgChoose").find($('img')).attr("src",'<?= $server ?>'+filename);
			}
			function callListImg(){
				data = JSON.parse($.ajax({
					url: "controller-list-images",
					method: "POST",
					async: false,
					data: {
					}
				}).responseText);
			}
			function item(data){
				return '<div class="col-sm-2"><a id="img'+data.FileID+'" style="" onclick="selectImg(\'<?=$server?>'+data.Location+'\', \'img'+data.FileID+'\')" href="#" class="thumbnail"> <img src="<?=$server?>'+data.Location+'" style="width:100px; height:100px;" /></a></div>';
			}
			function previous(){
				curpage = Number(curpage);
				listItem(data,curpage-1,null);
			}
			function next(){
				curpage = Number(curpage);
				listItem(data,curpage+1,null);
			}
			function goPage(){
				listItem(data,$("#pagenum").val(),null);
			}
			function clearPage(){
				$("#pagination").empty();
			}
			function pageDetail(currentPage,totalPage){
				$("#currentPage").text(currentPage);
				$("#totalPage").text(totalPage);
			}
			function paginations(totalpage,page){
				clearPage();
				$("#pagenum").val(page);
				pageDetail(page,totalpage);
			}
		
			function clearListItem(){
				$("#listItem").empty();  
			}
			function listItem(data,page){
				oldData = data;
				
				if(search){
					data = dataSearch;
				}else{
					data = oldData; 
				}
				
				
				clearListItem();
				curpage = page;
				var c = data.length;
				var totalpage = Math.ceil(c/perpage);
				if(page>0 && page<=totalpage){
					var start = (page-1)*perpage;
					var end = page*perpage;
					
					if(end>c){
						end = c;
					}
					
					if(page == 1){
						$("#pre").prop('disabled', true);
					}else{
						$("#pre").prop('disabled', false);
					}
		
					if(page == totalpage){
						$("#nex").prop('disabled', true);
					}else{
						$("#nex").prop('disabled', false);
					}
					var str ="";
					var active = 0;
					for(i=start;i<end;i++){
						str += item(data[i]);
					}			
				}
				$("#listItem").append(str);
				paginations(totalpage,curpage);
			}
			
			$(function (){
		        CKEDITOR.replace('editor1');
		    	$("#choose").click(function(){
		    		// img = "<img src='img/profile.jpg'/>'";
		    		// CKEDITOR.instances.editor1.insertHtml(img);
		    		$("#show_img").click();
		    		callListImg();	
					if(data.length>0){
						listItem(data,1);
		    		}
			   	});	
		
		    	$("#browse_img").click(function(){
					$("#inp_img").click();			
		    	});
		
		    	$("#inp_img").change(function(){
					var formData = new FormData($("#frm_upload_img")[0]);
					$.ajax({
						url : 'controller-upload-image',
						type : 'POST',
						data : formData,
						async : false,
						cache : false,
						contentType : false,
						processData : false,
						success : function(result) {
							if(result=='success'){
								//addThumbnail('img/profile.jpg');
								$("#searchImg").val("");
								search = false;
								callListImg();	
								if(data.length>0){
									listItem(data,1);
					    		}
							}
						},
						error : function() {
							//alert(0);
						}
					}); 
		        });
		    	$("#btnSearch").click(function(){
		    		dataSearch = [];
					search = true;
		    		var searchTxt = $.trim($("#searchImg").val());
		        	if(searchTxt != ''){
		        		for(var i=0; i<data.length; i++){
		        			if((data[i].File_Name).indexOf(searchTxt) != -1 || (data[i].Type).indexOf(searchTxt) != -1)
		        			{
		        				dataSearch.push(data[i]); 
		        			}
		    			}
		        	}else{
		        		search = false;
		        	}
		
		        	listItem(data,1);
					
		        });
				
		    	$("#btnAddImg").click(function(){
					checkImgSelected();
		        });
		
				
		    	/* var fd = new FormData();    
		    	fd.append( 'file', input.files[0] );
		
		    	$.ajax({
		    	  url: 'http://example.com/script.php',
		    	  data: fd,
		    	  processData: false,
		    	  contentType: false,
		    	  type: 'POST',
		    	  success: function(data){
		    	    alert(data);
		    	  }
		    	}); */
		
		
				
		    });
		</script>
	</body>
</html>
	

