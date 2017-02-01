<?php
include_once '../app.php';
include_once '../Model/Image.php';
	
echo json_encode((new Image())->listImageImage());