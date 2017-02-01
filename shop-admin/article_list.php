<?php
/*
 * *****************************************************************************
 * file: index.php
 * @autor: Thorn sereyvong
 * @date: 08-09-2015
 * ZOBENZ TEAM
 * *****************************************************************************
 */
?>
<?php

$title = "List Articles";

include_once 'head.php';
include_once 'header.php';
include_once 'slidebar.php';

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Article <small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo $server;?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Article</li>
		</ol>
	</section>
	<section class="content">
		<div class="box box-info collapsed-box">
			<div class="box-header with-border">
				<h3 class="box-title">
					<i class="fa fa-filter"></i> Filter
				</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-plus"></i>
					</button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body" style="display: none;">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="form-group">
							<label>Post Status</label> <select name="poststatus"
								id="poststatus" class="form-control select2 input-lg"
								style="width: 100%;">
								<option value="All">All</option>
								<option value="Open">Open</option>
								<option value="Posted">Posted</option>
								<option value="Voided">Voided</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer" style="display: none;">
				<label></label>
				<button type="submit" name="btnexcel" id="btnexcel"
					class="btn btn-success">

					<i class="fa fa-plus"></i> &nbsp;New
				</button>
				<!-- <button type="submit" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> &nbsp;PDF</button> -->
				<button type="submit" name="btnsearch" id="btnsearch"
					class="btn btn-info pull-right">
					<i class="fa fa-search"></i> &nbsp;Search
				</button>
			</div>
		</div>
		<div class="box box-danger" id="dataCon">
			<div class="box-header">
				<!-- <h3 class="box-title">
					<i class="fa  fa-calendar"></i> <span><span id="sDate"></span> ~ <span
						id="tDate"></span></span>
				</h3> -->
				<!-- 						<p class="mytitle-box"> 
							<i class="fa  fa-calendar"></i> <span style="font-size: 18px;"><span
							id="sDate"></span> ~ <span id="tDate"></span></span> -->
				<!-- 						</p> -->
			</div>
			<div class="box-body table-responsive no-padding">


				<table id="table-content" class="table table-hover">
					<thead>
						<tr>
							<th>Invoice</th>
							<th>Invoice Date</th>
							<th>Location ID</th>
							<th>UOM</th>
							<th>Sales Qty</th>
							<th>Unit Price</th>
							<th>Sale Amount</th>
							<th>Sale Discount</th>
							<th>Specific Tax</th>
							<th>VAT Tax</th>
							<th>After Sales</th>
						</tr>
					</thead>
					<tbody id="listItem">

					</tbody>
					<tfoot>

					</tfoot>
				</table>
			</div>
			<div class="box-footer">
				<label>Page: <span id="currentPage">0</span> of <span id="totalPage">0</span>
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
	</section>







</div>
<?php include_once 'footer.php'; ?>      
