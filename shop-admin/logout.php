<?php
include_once 'app.php';

if(isset($_SESSION['ZOBENZ_USER']) && isset($_SESSION['ZOBENZ_USERID']) && isset($_SESSION['ZOBENZ_USER_ROLE'])){
	session_unset();
	session_destroy();
}
header('Location:'.$server."login-account");
exit();
