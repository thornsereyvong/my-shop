<html>
	<head>
		<link rel="stylesheet" href="<?php echo $server; ?>editor/css/smoothness/jquery-ui-1.8.7.custom.css" type="text/css" media="screen" charset="utf-8" /> 	
		<link rel="stylesheet" href="<?php echo $server; ?>editor/css/elrte.min.css"  type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?php echo $server; ?>editor/elfinder/css/elfinder.css" type="text/css" media="screen" charset="utf-8" />
		<script src="<?php echo $server; ?>editor/js/jquery-1.4.4.min.js" type="text/javascript" charset="utf-8"></script>		
		<script src="<?php echo $server; ?>editor/js/jquery-ui-1.8.7.custom.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo $server; ?>editor/js/elrte.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo $server; ?>editor/js/i18n/elrte.en.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo $server; ?>editor/elfinder/js/elfinder.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo $server; ?>editor/elfinder/js/i18n/elfinder.en.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" charset="utf-8">
		$(function (){
			 
				$('#elFinder a').hover(
					function () {
						$('#elFinder a').animate({
							'background-position' : '0 -45px'
						}, 300);
					},
					function () {
						$('#elFinder a').delay(400).animate({
							'background-position' : '0 0'
						}, 300);
					}
				);

			$('#elFinder a').delay(800).animate({'background-position' : '0 0'}, 300);
			
			var opts = {
				absoluteURLs: false,
				cssClass : 'el-rte',
				lang     : 'en',
				height   : 320,
				toolbar  : 'maxi',
				cssfiles : ['css/elrte-inner.css'],
				fmOpen : function(callback) {
					$('<div id="myelfinder" />').elfinder({
						url : '<?php echo $server; ?>editor/elfinder/connectors/php/connector.php',
						lang : 'en',
						dialog : { width : 900, modal : true, title : 'elFinder - file manager for web' },
						closeOnEditorCallback : true,
						editorCallback : callback
					})
				}
			}
			$('#editor').elrte(opts);
		})
		</script>
			
	</head>

<body>
<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="pro" value=""/>
	<input type="hidden" name="type" value=""/>
	<textarea name="text" id="editor" >
		
    </textarea>
</form>
</body>
</html>
